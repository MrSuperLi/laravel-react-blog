import React from "react";
import {Route,IndexRoute} from "react-router";

import Articles from './containers/articles';
import Article from './containers/article';
import Modify from './containers/edit';
import Home from './containers/Home';
import Comment from './containers/Comment';
import Comments from './containers/Comments';
import App from './containers/layout';

import * as fuc from './common/function';

const routes = (
    <Route path='/' component={App} onEnter={fuc.authCheck} >
        <IndexRoute component={Home} />
        <Route path='articles' component={Articles} ></Route>
        <Route path='article/:id' component={Article} ></Route>
        <Route path='create' component={Modify} ></Route>
        <Route path='edit/:id' component={Modify} ></Route>
        <Route path='comments' component={Comments} ></Route>
        <Route path='comment/:id' component={Comment} ></Route>
    </Route>
);
export default routes;