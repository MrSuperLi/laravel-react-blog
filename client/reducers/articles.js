/**
 * Created by lizhicheng on 2017/1/6.
 */
import * as myAction from '../constant/myActions';

let iniState = {
    status:false,
    list:[],
    total:0,
    showComfirmModal:false,
    selectedId:null,
    showErrMsg:false,
    activePage:1,
    last_page:1,
    prev_page_url:null,
    next_page_url:null
};

export default function articles(state = iniState,action={}){

    switch(action.type){
        case myAction.LOADING_BLOG_LIST:
            var newItem = {status:true};
            return Object.assign({},state,newItem);
        case myAction.LOADED_BLOG_LIST:
            var newItem = {
                status:false,
                list:action.data.data,
                total:action.data.total,
                last_page:action.data.last_page,
                prev_page_url:action.data.prev_page_url,
                next_page_url:action.data.next_page_url
            };
            return Object.assign({},state,newItem);
        case myAction.SHOW_COMFIRM_MODAL:
            return Object.assign({},state,{showComfirmModal:!state.showComfirmModal});
        case myAction.SELECT_ARTICLE:
            return Object.assign({},state,{selectedId:action.data});
        case myAction.DELETE_ARTICLE_ERR:
            return Object.assign({},state,{showErrMsg:!state.showErrMsg});
        case myAction.SET_BLOG_PAGE:
            return Object.assign({},state,{activePage:action.data});
    }
    return state;
}