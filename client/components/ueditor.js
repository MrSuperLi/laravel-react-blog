/**
 * Created by lizhicheng on 2017/1/7.
 */

import React, {Component} from 'react'

let toolbars = [[
    'fullscreen', 'source', '|', 'undo', 'redo', '|',
    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
    'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
    'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
    'directionalityltr', 'directionalityrtl', 'indent', '|',
    'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
    'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
    'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
    'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
    'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
    'print', 'preview', 'searchreplace', 'help', 'drafts'
]];

let fontfamily = [
    { label:'',name:'songti',val:'宋体,SimSun'},
    { label:'',name:'kaiti',val:'楷体,楷体_GB2312, SimKai'},
    { label:'',name:'yahei',val:'微软雅黑,Microsoft YaHei'},
    { label:'',name:'heiti',val:'黑体, SimHei'},
    { label:'',name:'lishu',val:'隶书, SimLi'},
    { label:'',name:'andaleMono',val:'andale mono'},
    { label:'',name:'arial',val:'arial, helvetica,sans-serif'},
    { label:'',name:'arialBlack',val:'arial black,avant garde'},
    { label:'',name:'comicSansMs',val:'comic sans ms'},
    { label:'',name:'impact',val:'impact,chicago'},
    { label:'',name:'timesNewRoman',val:'times new roman'}
]

let fontsize = [10, 11, 12, 14, 16, 18, 20, 24, 36]

class Ueditor extends Component{
    constructor(props){
        super(props); //继承父类constructor方法
        this.defaultConfig = {
            //字体
            'fontfamily':fontfamily,
            //字号
            'fontsize':fontsize,
            'lang': 'zh-cn',
            readonly:this.props.disabled
        };
        //工具栏
        this.defaultConfig.toolbars = (props.config && props.config.toolbars)?props.config.toolbars:toolbars;
        //高度
        if(props.config && props.config.height){
            this.defaultConfig.initialFrameHeight = props.config.height;
        }
    }

    componentDidMount(){
        //直接跳转即可Ueditor,不用DidUpdate
        UE.getEditor(this.props.id,this.defaultConfig);
    }

    componentDidUpdate() {
        //实现数据的更新
        let editor = UE.getEditor(this.props.id,this.defaultConfig);
        editor.ready( function( ueditor ) {
            var value = this.props.value?this.props.value:'<p></p>';
            editor.setContent(value);
        }.bind(this));
    }

    componentWillUnmount(){
        UE.getEditor(this.props.id).destroy();
    }

    render(){
        var name = this.props.name?this.props:'content';
        return (
            <div id={this.props.id} name={name} type="text/plain">
            </div>
        );
    }
}

export default Ueditor;
