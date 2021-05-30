import axios from 'axios';
import React from 'react';


function PostUser(props) {
  const index = props.signup_email.indexOf("@");
  let user_id = props.signup_email.substring(0, index);
  user_id = user_id+Math.random().toString(36).slice(-4);
  let randamId = Math.random().toString(36).slice(-10);
  randamId = randamId + Math.random().toString(36).slice(-10);
  const item = [props.signup_name, props.signup_email, props.signup_password, user_id, randamId];
  console.log(item);

  const method = "POST";
  if(!window.confirm('登録しますか？')){
    return;
  }else {
    if (item[0] === "") {
    return window.confirm('名前は必須項目です。')
    }
    if (item[1] === "") {
      return window.confirm('メールは必須項目です。')
    }
    if (item[2] === "") {
      return window.confirm('パスワードは必須項目です。')
    }
    if (item[2].length <= 7) {
      return window.confirm('パスワードは英数字8桁以上です。')
    }
    //user登録
    axios({
      method : "POST",
      url : "http://localhost/new_user",
      data : item
    })
    .then((response)=> {
      // console.log(response.data);
    })
    .catch((error)=> {
      console.info(error);
    });
    // formリセット

    //承認メール送信
    axios({
      method : "POST",
      url : "http://localhost/mail_post",
      data : item
    })
    .then((response)=> {
      console.log(response.data);
    })
    .catch((error)=> {
      console.info(error);
    });
  }
}

function LogOut() {
  if(!window.confirm('ログアウトしますか？')){
    return;
  } else {
    window.sessionStorage.setItem(['user_log_id'],[""]);
    window.confirm('ログアウトししました');
    window.location = "http://localhost:3000/";
    return;
  }
}


//新規登録フォーム
function SignUp(props) {
  const fetchOption = {};
  const headers = new Headers();
  headers.append('Content-Type', 'text/plain');
  headers.append('X-Custom-Header', 'custom-header');
  headers.append('Content-Type', 'application/json;charset=utf-8');
  headers.append('Access-Control-Allow-Origin', '*');
  fetchOption["headers"]= headers;
  // console.log(fetchOption);

  if (window.sessionStorage.getItem(['user_log_id']) === "") {
    return (
      <div>
        <h2>新規登録</h2>
        <div>
          <label className="formLavel">名前</label>
          <input type="text" value={props.signup_name} onChange={props.addFormName}/>
        </div>
        <div>
          <label className="formLavel">password</label>
          <input type="text" value={props.signup_password} onChange={props.addFormPassword}/>
        </div>
        <div>
          <label className="formLavel">メールアドレス</label>
          <input type="text" value={props.signup_email} onChange={props.addFormEmail}/>
        </div>
        <div>
          <button type="submit" onClick={(e) => PostUser(props)}>signUp</button> 
        </div>
      </div>
    );
  } else {
    return (
      <button type="submit" onClick={(e) => LogOut()}>サインアウト</button> 
    );
  }
}

//ログインフォーム
  function SignIn(props) {
    if (window.sessionStorage.getItem(['user_log_id']) === "") {
      return (
        <div>
        <h2>サインイン</h2>
          <div>
            <label className="formLavel">ID</label>
            <input type="text" value={props.login_id} onChange={props.addLoginId}/>
          </div>
          <div>
            <label className="formLavel">password</label>
            <input type="text" value={props.login_password} onChange={props.addLoginPassword}/>
          </div>
          <div>
            <button type="submit" onClick={(e) => props.LoginUser(props)}>login</button> 
          </div>
        </div>
      );
    } else {
      return (
        <p>ログインしています</p>
      );
    }
  }


class UserLog extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      signup_name: "",
      signup_password: "",
      signup_email: "",
      login_id: "",
      login_password: "",
      user_get: []
    };
    this.addFormName = this.addFormName.bind(this);
    this.addFormPassword = this.addFormPassword.bind(this);
    this.addFormEmail = this.addFormEmail.bind(this);

    this.addLoginId = this.addLoginId.bind(this);
    this.addLoginPassword = this.addLoginPassword.bind(this);
    this.LoginUser = this.LoginUser.bind(this);
  }

  LoginUser(props) {
    const items = [props.login_id, props.login_password];
    axios({
      method : "POST",
      url : "http://localhost/user_judge",
      data : items
    })
    .then((response)=> {
      const users = response.data;
      console.log(users);

      let login_user_num = 0;
      for (let i = 0; i < users.length; i++) {
        if (users[i].user_id === props.login_id) {
          if (users[i].user_password === props.login_password) {
            console.log(users[i].user_name);
            console.log("がログインしました");
            window.sessionStorage.setItem(['user_log_id'],[props.login_id]);
            window.confirm('ログインしました。');
            window.location = "http://localhost:3000/";
            return
          }
        }
      }
    })
    .catch((error)=> {
      console.info(error);
    });
  
  }

  addFormName(e){
    this.setState({
      signup_name: e.target.value
    });
  }
  addFormPassword(e){
    this.setState({
      signup_password: e.target.value
    });
  }
  addFormEmail(e){
    this.setState({
      signup_email: e.target.value
    });
  }
  addLoginId(e){
    this.setState({
      login_id: e.target.value
    });
  }
  addLoginPassword(e){
    this.setState({
      login_password: e.target.value
    });
  }


  render(){
    return(
      <div className="form_div">
        <SignUp 
          signup_name={this.state.signup_name}
          signup_password={this.state.signup_password}
          signup_email={this.state.signup_email}

          addFormName={this.addFormName}
          addFormPassword={this.addFormPassword}
          addFormEmail={this.addFormEmail}
        />
        <SignIn 
          login_id={this.state.login_id}
          login_password={this.state.login_password}

          addLoginId={this.addLoginId}
          addLoginPassword={this.addLoginPassword}
          LoginUser={this.LoginUser}
        />
      </div>
    )
  }

}

export default UserLog;