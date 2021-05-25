@extends('layout')

@section('content')
<!--  -->
<script src="react_dom_test.js" type="text/babel"></script>

<script type="text/babel">
(() => {

  //削除時のアラート
  function deleteDate(props) {
    // console.log(props.list.id);
    if(window.confirm('削除してよろしいですか？')){
      axios
        // POST送信
      fetch("delete/" + props.list.id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          id: "",
        })
      }).then(function(response) {
        // レスポンス結果
      }, function(error) {
        // エラー内容
      });
      return window.confirm('削除されました。');
    } else {
      return;
    }
  }

  //react投稿
  function postData(props) {
    const item = [props.item_name, props.item_contents, props.item_pas, props.imageNmae, props.imageData];
    const method = "POST";
    if(!window.confirm('投稿しますか？')){
      return;
    }else {
      if (item[0] === "") {
      return window.confirm('名前は必須項目です。')
      }
      if (item[1] === "") {
        return window.confirm('本文は必須項目です。')
      }
      if (item[2] === "") {
        return window.confirm('パスワードは必須項目です。')
      }
      if (item[2].length <= 3) {
        return window.confirm('パスワードは4桁以上数字のみです。')
      }
      axios({
        method : "POST",
        // url : "image_post",
        url : "test",
        data : item
      })
      .then((response)=> {
        console.log(response);
      })
      .catch((error)=> {
        console.info(error);
      });
      return props.rsetItem();
    }
  }

  //react編集
  function updateData(props) {
    const item = [props.item_id, props.item_name_e, props.item_contents_e, props.item_pas_e];
    console.log(item);
    const method = "POST";
    if(!window.confirm('編集しますか？')){
      return;
    }else {
      if (item[1] === "") {
      return window.confirm('名前は必須項目です。')
      }
      if (item[2] === "") {
        return window.confirm('本文は必須項目です。')
      }
      if (item[3] === "") {
        return window.confirm('パスワードは必須項目です。')
      }
      if (item[3].length <= 3) {
        return window.confirm('パスワードは4桁以上数字のみです。')
      }
      axios({
        method : "POST",
        url : "update",
        data : item
      })
      .then((response)=> {
        // console.log(response);
      })
      .catch((error)=> {
        console.info(error);
      });
      return props.formModReturn();
    }
  }

  ////コンポーネント/////
  //TodoListの小要素
  function TodoItem(props) {
    const d_href = "delete/" + props.list.id;
    const e_href = "edit/" + props.list.id;
    return (
      <div className="div_item">
        <p>{props.list.id}</p>
        <p><a href={props.list.id}>{props.list.name}</a></p>
        <p>{props.list.contents}</p>
        <img width="400" height="250" src={props.list.image_name}/>
        <p>{props.list.created_at}</p>
          <button type="submit" className="btn btn-primary" onClick={(e) => deleteDate(props)}>
            削除
          </button>
        <form method="POST" onSubmit={props.formModChange}>
          <button type="submit" className="btn btn-primary" onClick={(e) => props.editFormId(props.list.id)}>
            編集
          </button>
        </form>
      </div>
    );
  }

  //Appの小要素
  function TodoList(props) {
    const info = props.info.map(list => {
      return (
        <TodoItem
          key={list.id}
          list={list}
          formModChange={props.formModChange}
          editFormId={props.editFormId}
        />
      );
    });
    return (
      //投稿がない時の出力
      <div>
        {props.info.length ? info : <p>Nothing to do!</p>}
      </div>
    );
  }

  //Appの小要素
  function FormTodo(props) {
    // console.log(props);
    // console.log(props.imageData);

    const imageData = props.imageData
    let preview = ''
    if(imageData != null) {
        preview = (
            <div>
            <img width="400" height="250" src={imageData}/>
            </div>
        )
    }

    if (props.form_mod === 0) {
      return (
        <div>
          {preview}
            <div>
              <label className="formLavel">名前</label>
              <input name="name" type="text" value={props.item_name} onChange={props.updateItemName} />
            </div>
            <div>
              <label className="formLavel">本文</label>
              <textarea name="contents" onChange={props.updateItemContents} rows="4" value={props.item_contents}/>
            </div>

            <div>
              <label className="formLavel">画像・動画</label>
              <input type="file" name="upimg" onChange={(e) => props.onFileChange(e)}/>
            </div>
            
            <div>
              <label className="formLavel">パスワード（4桁以上 数字）</label>
              <input name="pas" type="text" value={props.item_pas} onChange={props.updateItemPas} />
            </div>
            <div>
              <button type="submit" onClick={(e) => postData(props)}>投稿</button> 
            </div>
        </div>
      );
    }
    if (props.form_mod === 1) {
      return (
        <div>
          <div>
            <label className="formLavel">名前</label>
            <input type="text" value={props.item_name_e} onChange={props.updateItemName} />
          </div>
          <div>
            <label className="formLavel">本文</label>
            <textarea onChange={props.updateItemContents} rows="4" value={props.item_contents_e}/>
          </div>
          <div>
            <label className="formLavel">パスワード（4桁以上 数字）</label>
            <input type="text" value={props.item_pas_e} onChange={props.updateItemPas} />
          </div>
          <div>
            <input type="hidden" value={props.item_id}/>
            <button type="submit" onClick={(e) => updateData(props)}>編集</button> 
            <button type="submit" onClick={props.formModReturn}>キャンセル</button> 
          </div>
        </div>
      );
    }

  }

  //テスト


  class App extends React.Component {
    constructor(props) {
      super(props);
      this.state = {
        //ALL Data
        info: [],
        item_name: "",
        item_contents: "",
        item_pas: "",
        imageNmae: "",
        imageData: null,
        imgTest: "",

        item_id: "",
        item_name_e: "",
        item_contents_e: "",
        item_pas_e: "",
        form_mod: 0
      };
      this.getData = this.getData.bind(this);
      this.updateItemName = this.updateItemName.bind(this);
      this.updateItemContents = this.updateItemContents.bind(this);
      this.updateItemPas = this.updateItemPas.bind(this);
      this.onFileChange = this.onFileChange.bind(this);
      this.rsetItem = this.rsetItem.bind(this);

      this.formModChange = this.formModChange.bind(this);
      this.formModReturn = this.formModReturn.bind(this);
      this.editFormId = this.editFormId.bind(this);
    }

    getData(event) {
      axios
        .get('/pos')
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
    rsetItem() {
      this.setState({
        item_name: "",
        item_contents: "",
        item_pas: ""
      });
      return false;
    }

    formModChange(e) {
      e.preventDefault();
      if (this.state.form_mod === 0) {
        this.setState({
          form_mod: 1
        });
      }
    }
    formModReturn(e) {
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

    editFormId(item) {
      axios({
        method : "POST",
        url : "editItem/" + item
      })
      .then((response)=> {
        const data = response.data;
        // console.log(data);
        this.setState({
          item_id: data.id,
          item_name_e: data.name,
          item_contents_e: data.contents,
          item_pas_e: data.pas_wd
        });
      })
      .catch((error)=> {
        console.info(error);
      });
    }

    onFileChange(e) {
      const files = e.target.files

      // console.log(e.target.files);
      // console.log(files[0]);
      if(files.length > 0) {
          let file = files[0]
          let reader = new FileReader()
          //画像の名前
          // console.log(file.name);
          this.setState({ 
            imageNmae: file.name
          });
          this.setState({ 
            imgTest: file
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
      console.log(this.state.imageNmae);
      console.log(this.state.imgTest);
      console.log(this.state.imageData);
    }

    //tets

    render() {

      const getData = this.getData;
      return (
        <div className="body_div">
          <div className="form_div">
            <FormTodo 
              //投稿用
              updateItemName={this.updateItemName}
              updateItemContents={this.updateItemContents}
              updateItemPas={this.updateItemPas}
              rsetItem={this.rsetItem}
              formModReturn={this.formModReturn}
              onFileChange={this.onFileChange}
              //編集用           

              //投稿用
              item_name={this.state.item_name}
              item_contents={this.state.item_contents}
              item_pas={this.state.item_pas}   
              imageNmae={this.state.imageNmae}   
              imageData={this.state.imageData}   
              //編集用           
              item_name_e={this.state.item_name_e}
              item_contents_e={this.state.item_contents_e}
              item_pas_e={this.state.item_pas_e}              
              item_id={this.state.item_id}              
              form_mod={this.state.form_mod}              
            />
          </div>
          <div className="container" onLoad={getData}> 
            <button type="submit" variant="contained" color="primary" onClick={this.getData}>ツイート取得</button> 
            <TodoList
              info={this.state.info}
              formModChange={this.formModChange}
              editFormId={this.editFormId}
            />
          </div>
          
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
@endsection