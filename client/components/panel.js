/**
 * Created by lizhicheng on 2017/1/7.
 */
import React,{Component} from 'react';

export class Panel extends Component{


    render(){
        var className = this.props.className?this.props.className:'panel-info';
        var style = this.props.style?this.props.style:{};
        return (
            <div className={`panel ${className}`} style={style}>
                {this.props.children}
            </div>
        );
    }
}

export class Header extends Component{

    render(){
        var className = this.props.className?this.props.className:'';
        var style = this.props.style?this.props.style:{"position":"relative","textAlign":"center","backgroundColor":"#343434","color":"#f7f7f7","padding":"22px","fontSize":"22px"};
        return (
            <div className={`panel-heading ${className}`} style={style}>
                {this.props.children}
            </div>
        );
    }
}

export class Footer extends Component{

    render(){
        var className = this.props.className?this.props.className:'';
        var style = this.props.style?this.props.style:{"textAlign":"center"};
        return (
            <div className={`panel-footer ${className}`} style={style}>
                {this.props.children}
            </div>
        );
    }
}

export class Body extends Component{

    render(){
        var className = this.props.className?this.props.className:'';
        var style = this.props.style?this.props.style:{};
        return (
            <div className={`panel-body ${className}`} style={style}>
                {this.props.children}
            </div>
        );
    }
}