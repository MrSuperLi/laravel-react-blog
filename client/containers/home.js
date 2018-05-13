/**
 * Created by lizhicheng on 2017/1/7.
 */

import React,{Component} from 'react';

export default class Home extends Component{

    render(){
        return (
            <div className="container home">
                <div className="content">
                    <div className="title xiaoli-text-shadow">博客管理后台</div>
                </div>
                <style>{`
                    body {
                    color: #B0BEC5;
                    height:500px;
                    width:100%;
                    font-weight: 100;
                    font-family: 'Lato';
                }
                .home{
                    height:500px;
                    width:100%;
                    text-align: center;
                    vertical-align: middle;
                }
                    .content {
                    height:500px;
                    line-height:500px;
                    text-align: center;
                }
                    .title {
                    font-size: 96px;
                    margin-bottom: 40px;
                }
                `}</style>
            </div>
        );
    }
}
