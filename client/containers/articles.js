/**
 * Created by lizhicheng on 2017/1/6.
 */
import React,{Component} from 'react';
import {connect} from 'react-redux';
import {Link} from 'react-router';


import * as actions from '../actions/articles';
import Container from '../components/container';
import * as Panel from '../components/panel';

import {Modal,Button,Pagination} from 'react-bootstrap';

class Articles extends Component{

    componentDidMount(){
        const {dispatch,articles} = this.props;
        dispatch(actions.getBlogList(articles.activePage));
    }

    handleDelete(){
        const {dispatch,articles} = this.props;
        dispatch(actions.deleteArticle(articles.selectedId));
        this.hideModal('comfirm');
    }

    hideModal(name){
        const {dispatch} = this.props;
        dispatch(actions.showModal(name));
    }

    handleSelect(id){
        const {dispatch} = this.props;
        this.hideModal('comfirm');
        dispatch(actions.selectArticle(id));
    }

    handlePage(eventKey) {
        const {dispatch} = this.props;
        dispatch(actions.getBlogList(eventKey));
    }


    render(){
       let {articles} = this.props;
        if(!articles.list){
            return (<h1 style={{textAlign:"center","margin":"100px auto"}}>loading...</h1>);
        }
        const showComfirmModal = articles.showComfirmModal;
        const showErrMsg = articles.showErrMsg;
        var list = articles.list;
        //list = Array.prototype.slice.call(list,0);console.log(typeof list);
        list =  list.map((article) => {
            return (
                <div className='row' key={article.id}>
                    <div className="col-md-12">
                        <ul className='list-group'>
                            <li className='list-group-item'>
                                <div className="list-group-item-heading">
                                    <a href="">
                                        <h4>{article.title}</h4>
                                    </a>
                                </div>
                                <div className="list-group-item-text">
                                    <h5>{article.created_at}</h5>
                                    <p>{article.summary}</p>
                                </div>
                                <div className="btn-group btn-group-left">
                                    <Link className='btn btn-primary' to={`/edit/${article.id}`}>编辑</Link>
                                    <Button bsStyle='danger' onClick={this.handleSelect.bind(this,article.id)}>删除</Button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            );
        });
        return (
            <Container>
                <Modal show={showComfirmModal} onHide={this.hideModal.bind(this,'comfirm')}>
                    <Modal.Header closeButton>
                        提示：
                    </Modal.Header>
                    <Modal.Body>
                        <h4>是否执行操作？将不可更改</h4>
                    </Modal.Body>
                    <Modal.Footer>
                        <Button bsStyle='danger' onClick={this.handleDelete.bind(this)}>是</Button>
                        <Button bsStyle='info' onClick={this.hideModal.bind(this,'comfirm')}>否</Button>
                    </Modal.Footer>
                </Modal>
                <Modal show={showErrMsg} onHide={this.hideModal.bind(this,'msg')}>
                    <Modal.Header closeButton>
                        提示：
                    </Modal.Header>
                    <Modal.Body>
                        <h4>操作失败</h4>
                    </Modal.Body>
                    <Modal.Footer>
                        <Button onClick={this.hideModal.bind(this,'msg')}>是</Button>
                    </Modal.Footer>
                </Modal>
                <Panel.Panel>
                    <Panel.Header>
                        <Link className='btn btn-success'style={{"left":"20px","position":"absolute","top":"35px"}} to={`/create`}>新建</Link>
                        <h3 style={{"color":"#f7f7f7"}}>推文管理  共{articles.total}篇</h3>
                    </Panel.Header>
                    <Panel.Body>
                        {list}
                    </Panel.Body>
                    <Panel.Footer>
                        <Pagination
                            prev
                            next
                            first
                            last
                            ellipsis
                            boundaryLinks
                            items={articles.last_page}
                            maxButtons={5}
                            activePage={articles.activePage}
                            onSelect={this.handlePage.bind(this)} />
                    </Panel.Footer>
                </Panel.Panel>
                <style type="text/css">{`
                @media screen and (min-width: 700px){
                    .btn-group-left{position:absolute;right:20px;top:10px; }
                }
            `}</style>
            </Container>
        );
    }
}

const mapStateToProps = function(state){
    const {articles} = state;
    return {
        articles
    }
}

export default connect(mapStateToProps)(Articles);


