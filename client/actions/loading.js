import fetch from 'isomorphic-fetch';
import * as myActions from '../constant/myActions';
import * as config from '../constant/config';

export const getData = () => (dispatch,getState) =>{
    dispatch({type:myActions.LOADING_DATA});
    let url = `${config.APP_URL}/test.php`;
    return fetch(url)
        .then(response => response.json())
        .then(json => dispatch({data:json,type:myActions.LOADED_DATA}));
}