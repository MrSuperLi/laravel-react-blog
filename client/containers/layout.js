import React,{Component} from 'react';
import {connect} from 'react-redux';
import {Link} from 'react-router';
import {Navbar,Nav,NavItem,NavDropdown,MenuItem} from 'react-bootstrap';
import {LinkContainer} from 'react-router-bootstrap';

export default class App extends Component{

    logout(){
        $.get('/check/logout')
            .done(()=>{window.account = {};window.location.reload();})
            .fail(()=>{});
    }

    render(){
        return (
            <div style={{margin:0,padding:0}}>
                <Navbar inverse collapseOnSelect fixedTop style={{zIndex:1}} >
                    <div className='container-fluid'>
                        <Navbar.Header>
                            <Navbar.Brand>
                                <a href='#'>XIAOLI</a>
                            </Navbar.Brand>
                            <Navbar.Toggle/>
                        </Navbar.Header>

                        <Navbar.Collapse>
                            <Nav>
                                <LinkContainer to='/'>
                                    <NavItem eventKey={1}>首页</NavItem>
                                </LinkContainer>
                                <NavDropdown eventKey={2} title='博文管理' id='blogManage'>
                                    <LinkContainer to='/create'>
                                        <MenuItem eventKey={2.2}>新建博文</MenuItem>
                                    </LinkContainer>
                                    <LinkContainer to='/articles'>
                                        <MenuItem eventKey={2.2}>博文列表</MenuItem>
                                    </LinkContainer>
                                </NavDropdown>
                                <NavDropdown eventKey={3} title='评论管理' id='commentManage'>
                                    <MenuItem header>评论</MenuItem>
                                    <MenuItem divider />
                                    <LinkContainer to='/comments'>
                                        <MenuItem eventKey={3.1}>评论列表</MenuItem>
                                    </LinkContainer>
                                </NavDropdown>
                            </Nav>
                            <Nav pullRight>
                                <NavDropdown eventKey={4} title={window.account.name} id='logout'>
                                    <MenuItem eventKey={4.1} onClick={this.logout}>注销</MenuItem>
                                </NavDropdown>
                            </Nav>
                        </Navbar.Collapse>
                    </div>
                </Navbar>
                {this.props.children}
                <div className='container footer'>
                    <div className='footer-content'>
                        <h3><a href="mailto:1140926800@qq.com">@XIAOLI</a></h3>
                    </div>
                </div>
                <style type="text/css">{`
                    body{margin-top:80px;}
                    .footer{bottom:20px;text-align:center;margin-top:"50px";border-top:5px dotted #898989;}
                    .footer-content{margin:0 auto;}
                    `}</style>
            </div>
        );
    }
}
