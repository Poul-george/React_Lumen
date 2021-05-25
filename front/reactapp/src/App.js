import React from 'react';
import FormTodo from './components/FormTodo';
import Data from './components/Data';
import Test from './apis/Test';
import UserLog from './login_js/UserLog';
//test
import RootTest from './test_js/RootTest';
import About from './test_js/About';

import axios from 'axios';
import { BrowserRouter as Router, Route } from 'react-router-dom';

class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      //Test data
      location: {},
      params: {},
      history: {},


      //ALL Data
      info: [],
      item_name: "",
      item_contents: "",
      item_pas: "",
      imageFile: null,
      imageData: null,

      //編集時の値の保持
      item_id: "",
      item_name_e: "",
      item_contents_e: "",
      item_pas_e: "",

      //formのモード
      form_mod: 0
    };
    this.getData = this.getData.bind(this);
    this.updateItemName = this.updateItemName.bind(this);
    this.updateItemContents = this.updateItemContents.bind(this);
    this.updateItemPas = this.updateItemPas.bind(this);
    this.onFileChange = this.onFileChange.bind(this);
    this.formModReturn = this.formModReturn.bind(this);
    this.EditForm = this.EditForm.bind(this);

  }
  

  getData(event) {
    axios
    .get('http://localhost/pos')
      .then(response => {
        const data = response.data;      
        // console.log(data);  
        this.setState({
          info: data
        });
      })
      .catch(() => {
        console.log('通信に失敗しました');
      });
      // console.log(this.state.info);    
  }

  //投稿Formのinoutの変更
  updateItemName(e){
    if (this.state.form_mod === 0) {
      this.setState({
        item_name: e.target.value
      });
    }
    if (this.state.form_mod === 1) {
      this.setState({
        item_name_e: e.target.value
      });
    }
  }
  updateItemContents(e){
    if (this.state.form_mod === 0) {
      this.setState({
        item_contents: e.target.value
      });
    }
    if (this.state.form_mod === 1) {
      this.setState({
        item_contents_e: e.target.value
      });
    }
  }
  updateItemPas(e){
    if (this.state.form_mod === 0) {
      this.setState({
        item_pas: e.target.value
      });
    }
    if (this.state.form_mod === 1) {
      this.setState({
        item_pas_e: e.target.value
      });
    }
  }

  ////編集画面表示
  EditForm(id) {
    // console.log(id);
    const edit_url = "http://localhost/editItem/" + id;
    if (id === "") {
      return window.confirm('その投稿は、存在しません');
    } else {
      axios({
        method : "POST",
        url : edit_url
      })
      .then((response)=> {
        const data = response.data;
        // console.log(data);
        this.setState({
          item_id: data.id,
          item_name_e: data.name,
          item_contents_e: data.contents,
          item_pas_e: data.pas_wd,
          form_mod: 1
        });
      })
      .catch((error)=> {
        console.info(error);
      });
    }
  }


  //投稿Formのinputリセット 編集時も中身リセット 編集時は編集後formのモードが投稿ように切り替わる
  formModReturn(e) {
    if (this.state.form_mod === 0) {
      this.setState({
        item_name: "",
        item_contents: "",
        item_pas: "",
        imageFile: null,
        imageData: null,
      });
    }
    if (this.state.form_mod === 1) {
      this.setState({
        item_id: "",
        item_name_e: "",
        item_contents_e: "",
        item_pas_e: "",
        form_mod: 0
      });
    }

  }

  //画像ファイルの処理
  onFileChange(e) {
    const files = e.target.files

    // console.log(e.target.files);
    // console.log(files[0]);
    if(files.length > 0) {
        let file = files[0]
        let reader = new FileReader()
        //画像の名前
        // console.log(file);
        this.setState({ 
          imageFile: file
        });
        reader.onload = (e) => {
          // console.log(e.target.readyState);
          this.setState({ 
            imageData: e.target.result 
          })
        };
        reader.readAsDataURL(file)
    } else {
        this.setState({ imageData: null })
    }
  }

 
  //tets

  render() {

    return (
      <div className="body_div">
        <Router>
          <RootTest /><hr/>
            <Route key="sign" path='/Sign_in' component={UserLog} />

            <Route key="top" path='/top' render={ () => [<button type="submit" variant="contained" color="primary" onClick={this.getData}>ツイート取得</button>, <Data info={this.state.info} EditForm={this.EditForm} />]  } />
            <Route key="tweet" exact path='/formadd' 
              render={ () => <FormTodo 
                  //投稿用
                  updateItemName={this.updateItemName}
                  updateItemContents={this.updateItemContents}
                  updateItemPas={this.updateItemPas}
                  formModReturn={this.formModReturn}
                  
                  
                  onFileChange={this.onFileChange}
                  
                  //編集用
                  item_id={this.state.item_id}
                  item_name_e={this.state.item_name_e}
                  item_contents_e={this.state.item_contents_e}
                  item_pas_e={this.state.item_pas_e}

                  //投稿用
                  item_name={this.state.item_name}
                  item_contents={this.state.item_contents}
                  item_pas={this.state.item_pas}   
                  imageFile={this.state.imageFile}   
                  imageData={this.state.imageData}   
                  form_mod={this.state.form_mod}   
                  //編集用   
                />
              }
            />
            <Route key="about" path='/About' component={About}/>
          <div className="container"> 

          </div>
          <Test
            location={this.state.location}
            params={this.state.params}
            history={this.state.history}
          />
        </Router>
        
      </div>
    );
  }
}


export default App;