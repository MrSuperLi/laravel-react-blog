/**
 * Created by lizhicheng on 2017/1/7.
 */
import React,{Component} from 'react';

export default class Container extends Component{

    render(){
        var style = this.props.style?this.props.style:{};
        return (
            <div className="container" style={style}>
                <div className="row">
                    <div className="col-md-10 col-md-offset-1">
                        {this.props.children}
                    </div>
                </div>
            </div>
        );
    }
}