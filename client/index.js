import React from 'react';
import {Router,hashHistory,IndexRoute} from "react-router";
import { Provider } from 'react-redux';
import {render} from 'react-dom';

import {createStore,applyMiddleware} from 'redux';
import thunk from 'redux-thunk';
import reducer from './reducers/rootReducer';

import routes from './routes';

var iniState = {
    routing:{},
    loading:{},
    articles:{},
    article:{}
    /*
    comments:{},
    comment:{}*/
};

//创建store
var store = createStore(reducer,iniState,applyMiddleware(thunk));

var $$ = id => document.getElementById(id);

render(
<Provider store={store}>
    <Router history={hashHistory} routes={routes} />
</Provider>
, $$('app'));
