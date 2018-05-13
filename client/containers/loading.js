import React,{Component} from "react";
import { connect } from 'react-redux';
import * as actions from '../actions/loading';

class Loading extends Component{

    onClickHandler(){
        const {dispatch} = this.props;
        dispatch(actions.getData());
    }

    render(){
        const {loading} = this.props;
        var str='';
        if(!loading.content){
            str = ('click me!.....');
        }else if (loading.loading) {
            str = ('loading');
        }else{
            str = ('loaded');
        }
        return (
            <h1 onClick={this.onClickHandler.bind(this)} style={{'background':'#aa6688','border':'1px solid #96f','cursor':'pointer'}}>
                {
                    str
                }&nbsp;&nbsp;
                <span>{loading.content}</span>
            </h1>
        );
    }
}

function mapStateToProps(state){
    const {loading} = state;
    return {
        loading
    };
}

export default connect(mapStateToProps)(Loading);