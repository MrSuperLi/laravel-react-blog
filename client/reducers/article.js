/**
 * Created by lizhicheng on 2017/1/6.
 */
import * as myAction from '../constant/myActions';

let iniState = {
    status:false,
    data:{
        'id':null,
        'title':'',
        'summary':'',
        'updated_at':null,
        'created_at':null,
        'body':''
    },
    showSaveModal:false,
    showMsgModal:false,
    msg:''
};

export default function articles(state = iniState,action={}){
    let data = state.data;
    switch(action.type){
        case myAction.LOADING_BLOG:
            var newItem = {status:true};
            return Object.assign({},state,newItem);
        case myAction.LOADED_BLOG:
            var newItem = {status:false,data:action.data,msg:action.msg};
            return Object.assign({},state,newItem);
        case myAction.EDIT_BLOG:
            var newItem = {status:true};
            return Object.assign({},state,newItem);
        case myAction.SHOW_SAVE_MODAL:
            return Object.assign({},state,{showSaveModal:!state.showSaveModal});
        case myAction.SHOW_MSG_MODAL:
            return Object.assign({},state,{showMsgModal:!state.showMsgModal,msg:action.msg});
        case myAction.UPDATE_BLOG_TITLE:
            data = Object.assign({},data,{title:action.data});
            return Object.assign({},state,{data:data});
        case myAction.UPDATE_BLOG_SUMMARY:
            //data.summary = action.data;
            data = Object.assign({},data,{summary:action.data});
            return Object.assign({},state,{data:data});
        case myAction.UPDATE_BLOG_BODY:
            //data.body = action.data;
            data = Object.assign({},data,{body:action.data});
            return Object.assign({},state,{data:data});
        case myAction.CLRAE_ARTICLE_CONTENT:
            return Object.assign({},state,{data:iniState.data});
    }
    return state;
}