/**
 * Created by lizhicheng on 2017/1/6.
 */
import * as myAction from '../constant/myActions';

let iniState = {
    loading:false,
    content:''
};

export default function loading(state = iniState,action={}){

    switch(action.type){
        case myAction.LOADING_DATA:
            var newItem = {loading:true};
            return Object.assign({},state,newItem);
        case myAction.LOADED_DATA:
            var newItem = {loading:false,content:action.data.content};
            return Object.assign({},state,newItem);
        //return {...state,...newItem};
    }
    return state;
}