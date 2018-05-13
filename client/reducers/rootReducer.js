/**
 * Created by lizhicheng on 2017/1/6.
 */
import { combineReducers } from 'redux';
import { routerReducer } from 'react-router-redux';

import loading from './loading';
import article from './article';
import articles from './articles';
import comment from './comment';
import comments from './comments';

const rootReducer = combineReducers({
    routing:routerReducer,
    loading,
    articles,
    article/*,
    comments,
    comment*/
});

export default rootReducer;