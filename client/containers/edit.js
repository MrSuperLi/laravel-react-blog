/**
 * Created by lizhicheng on 2017/1/7.
 */
import React,{Component} from 'react';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import * as Panel from '../components/panel';
import * as actions from '../actions/article';
import Container from '../components/container';
import Ueditor from '../components/ueditor';

import {Modal,Button} from 'react-bootstrap';

class Edit extends Component{

    componentDidMount() {
        let {id} = this.props.params;
        if (id) {
            const {dispatch} = this.props;
            dispatch(actions.getArticle(id));
        }
        window.onhashchange=(this.clearContent).bind(this);
    }

    clearContent(){
        const {dispatch} = this.props;
        dispatch(actions.clearContent());
    }


    hideModal(name){
        const {dispatch} = this.props;
        dispatch(actions.showModal(name));
    }

    onTitleChange(e){
        const {dispatch} = this.props;
        this.setBody();
        dispatch(actions.titleChange(e.target.value));
    }

    onSummaryChange(e){
        const {dispatch} = this.props;
        this.setBody();
        dispatch(actions.summaryChange(e.target.value));
    }

    handleSubmit(e){
        const {dispatch,article} = this.props;
        const value = UE.getEditor('editor').getContent();
        let data = Object.assign({},article.data,{body:value});
        dispatch(actions.blogSave(data));
    }

    setBody(){
        const {dispatch} = this.props;
        const value = UE.getEditor('editor').getContent();
        dispatch(actions.bodyChange(value));
    }


    render(){
        let id = this.props.params.id;
        var header = '新建博文';
        var title = '';
        var summary = '';
        var body = '';
        let article = this.props.article;
        const showSaveModal = article.showSaveModal;
        const showMsgModal = article.showMsgModal;
        const msg = article.msg;

        if(article.data){
            title = article.data.title;
            summary = article.data.summary;
            body = article.data.body;
            if(article.data.id){
                header = '修改博文';
            }
        }


        return (
            <Container>
                <Modal show={showMsgModal} onHide={this.hideModal.bind(this,'msg')} >
                    <Modal.Header closeButton>
                        <Modal.Title>提示:</Modal.Title>
                    </Modal.Header>

                    <Modal.Body>
                        <h4>{msg}</h4>
                    </Modal.Body>

                    <Modal.Footer>
                        <Button bsStyle="primary" onClick={this.hideModal.bind(this,'msg')}>OK</Button>
                    </Modal.Footer>
                </Modal>
                <Panel.Panel>
                    <Panel.Header>
                        {header}
                        <Button onClick={this.handleSubmit.bind(this)} bsStyle='primary' style={{"float":"right","marginRight":"20px"}} >保存</Button>
                    </Panel.Header>

                    <Panel.Body>
                        <div className="form-group row">
                            <label htmlFor="title" className="control-label col-md-1 col-xs-1">标题:</label>
                            <div className="col-md-11 col-xs-11">
                                <input onChange={this.onTitleChange.bind(this)}  id='title' value={title} name="title" type="text" autoComplete="off" data-limit='s,1,100' className="form-control" placeholder="标题1~100字符" required="required" />
                            </div>
                        </div>
                        <div className="form-group row">
                            <label htmlFor="summary" className="control-label col-md-1 col-xs-1">摘要:</label>
                            <div className="col-md-11 col-xs-11">
                                <input  id='summary' onChange={this.onSummaryChange.bind(this)} value={summary} autoComplete="off" name="summary" type="text" data-limit='s,1,100' className="form-control" placeholder="摘要1~100字符" required="required" />
                            </div>
                        </div>
                        <div className="form-group row">
                            <label htmlFor="body" className="control-label col-md-1 col-xs-1">内容:</label>
                            <div className="col-md-11 col-xs-11">
                                <Ueditor id="editor" name="body"  value={body}  />
                            </div>
                        </div>
                        <div className="form-group row">
                            <div className="btn-group col-md-11 col-xs-11 col-xs-offset-1 col-md-offset-1">
                                <input id="submit" name="submit" type="submit" onClick={this.handleSubmit.bind(this)} className="btn btn-primary col-md-12 col-xs-12" value="保存" />
                            </div>
                        </div>
                    </Panel.Body>
                </Panel.Panel>
            </Container>
        );
    }
}

function mapStateToProps(state){
    let {article} = state;
    return {article};
}

export default connect(mapStateToProps)(Edit);

