<?php
 //データーの更新
// データーベース接続繰り返し使い回し
function serverConect(){
  $dsn = 'mysql:host=db;dbname=test_database;charaset=UTF8';
  $user = 'root';
  $pass = 'root';
  try {
    $dbh = new PDO($dsn,$user,$pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//エラーを出力するPDOException
      ]);
      
    } catch (PDOException $e) {
      echo '接続失敗' . $e->getMessage();
      exit;
    }
    return $dbh;
  }
$update = <<< _UPDATE_
SET @i := 0;
UPDATE users SET id = (@i := @i+1);
_UPDATE_;

$dbh = serverConect();
//番号の歯抜け処理
$dbh->query($update);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://unpkg.com/react@17/umd/react.development.js"></script> 
  <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script> 
  
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <style>
    .formLavel {
      width: 120px;
      height: 30px;
    }
  </style>

  <div id="root">

  </div>

  <script type="text/babel">
  (() => {

    //reactUser登録
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
          url : "new_user",
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
          url : "mail_post",
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


    //新規登録フォーム
    function SignUp(props) {
      const fetchOption = {};
      const headers = new Headers();
      headers.append('Content-Type', 'text/plain');
      headers.append('X-Custom-Header', 'custom-header');
      headers.append('Content-Type', 'application/json;charset=utf-8');
      headers.append('Access-Control-Allow-Origin', '*');
      fetchOption["headers"]= headers;
      console.log(fetchOption);
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
    }
    
    //ログインフォーム
      function SignIn(props) {
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
              <button type="submit">login</button> 
            </div>
          </div>
        );
        
      }

    class App extends React.Component {
      constructor(props) {
        super(props);
        this.state = {
          signup_name: "",
          signup_password: "",
          signup_email: "",
          login_id: "",
          login_password: ""
        };
        this.addFormName = this.addFormName.bind(this);
        this.addFormPassword = this.addFormPassword.bind(this);
        this.addFormEmail = this.addFormEmail.bind(this);

        this.addLoginId = this.addLoginId.bind(this);
        this.addLoginPassword = this.addLoginPassword.bind(this);
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


      render() {
      return (
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
          />
        </div>
      );
    }

  }

    ReactDOM.render(
      <App/>,
      document.getElementById('root')
    );

  })();

  </script>
</body>
</html>

