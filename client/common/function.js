/**
 * Created by lizhicheng on 2017/1/7.
 */

import * as config from  '../constant/config';

export function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
    }
    return "";
}

//onEnter
export function authCheck(nextState, replace,callback){
    $.get(`${config.APP_URL}/check/is-login`)
        .done(function(data){
            if(data.ret != 0){//replace('/auth/login');
                window.location = (`${config.APP_URL}/auth/login`);
            }else{
                window.account = data.data;
                callback();//登录成功，callback进行渲染
            }
        });
}