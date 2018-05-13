/**
 * Created by lizhicheng on 2017/1/6.
 */
import * as myType from '../constant/myActions';
import * as config from '../constant/config';

export function getBlogList(page = null){
    let url = `${config.REQUEST_URL}/articles`;

    return (dispatch,getState)=>{
        if(!page){
            page = (getState()).articles.activePage;
        }
        let param = {'page':page};
        return  $.get(url,param).done((data)=>{
            if(data.ret == 0){console.log(data.data);
                dispatch({type:myType.LOADED_BLOG_LIST,data:data.data});
                dispatch(setActivePage(page));
            }
        });
    }

}

export function showModal(name='comfirm'){
    if (name == 'comfirm') {
        return {type:myType.SHOW_COMFIRM_MODAL};
    }
    return {type:myType.DELETE_ARTICLE_ERR};
}

export function selectArticle(id){
    return {type:myType.SELECT_ARTICLE,data:id};
}

export function deleteArticle(id){

    let url = `${config.REQUEST_URL}/articles/${id}`;
    return (dispatch,getState)=>{
        return $.ajax({
            url:url,
            type:"DELETE"
        }).done((json)=>{
            if (json.ret != 0) {
                dispatch({type:myType.DELETE_ARTICLE_ERR});
            }else{
                dispatch(getBlogList(1));
            }
        });
    }
}

export function setActivePage(page = 1){
    return {type:myType.SET_BLOG_PAGE,data:page};
}