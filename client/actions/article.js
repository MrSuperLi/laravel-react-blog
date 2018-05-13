/**
 * Created by lizhicheng on 2017/1/7.
 */
import * as myActions from '../constant/myActions';
import * as config from '../constant/config';
import * as fuc from '../common/function';

export function showModal(name,msg=''){
    var type = 'msg';
    if(name == 'save'){
        return {"type":myActions.SHOW_SAVE_MODAL};
    }
    return {"type":myActions.SHOW_MSG_MODAL,"msg":msg};
}

export function getArticle(id){
    const url = `${config.REQUEST_URL}/articles/${id}`;
    return (dispatch, getState)=>{
        $.get(url)
            .done((json)=>{
                if(json.ret != 0){
                    dispatch({type:myActions.SHOW_MSG_MODAL,data:null,msg:`可能没有该文章，转为新建`});
                }else{
                    dispatch({type:myActions.LOADED_BLOG,data:json.data,msg:json.msg});
                }
            });
    }
}

export function titleChange(title){
    return {type:myActions.UPDATE_BLOG_TITLE,data:title};
}

export function summaryChange(summary){
    return {type:myActions.UPDATE_BLOG_SUMMARY,data:summary};
}

export function bodyChange(body){
    return {type:myActions.UPDATE_BLOG_BODY,data:body};
}


export function blogSave(article={}){
    return (dispatch,getState)=>{
        let url = `${config.REQUEST_URL}/articles`;
        let data = {
            title:article.title,
            summary:article.summary,
            body:article.body,
            id:(article.id)?article.id:null
        };
        return $.ajax({
            url:url,
            type:"POST",
            headers:{
                "X-XSRF-TOKEN":fuc.getCookie('XSRF-TOKEN')
            },
            data:data
        }).done((json)=>{
            if(json.ret != 0){
                dispatch({type:myActions.SHOW_MSG_MODAL,msg:json.msg});
            }else{
                if(!data.id){
                    dispatch(clearContent());
                }
                dispatch({type:myActions.SHOW_MSG_MODAL,msg:"保存成功！"});
            }
        });
    }
};

export function clearContent(){
    return {type:myActions.CLRAE_ARTICLE_CONTENT};
}