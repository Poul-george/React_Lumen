const App = () => {
  const [resources, setResources] = useState([]);
  

  // const getPosts = async () => {
  //   // try {
  //   //   const posts = await default_url.get('/posts');
  //   //   setResources(posts.data);
  //   // } catch (err) {
  //   //   console.log(err);
  //   // }
  //   axios.get("https://jsonplaceholder.typicode.com/posts")
  //     .then(response => {
  //       const posts = response;      
  //       console.log(posts);  
  //       setResources(posts.data);
  //     })
  //     .catch(error => {
  //       console.log(error);
  //       console.log("no");
  //     });

  // };

  // const getAlbums = async () => {
  //   try {
  //     const albums = await default_url.get('/albums');
  //     setResources(albums.data);
  //   } catch (err) {
  //     console.log(err);
  //   }
  // };

  const getTests = async () => {
    try {
      const tests = await test_url.get('/pos');
      setResources(tests.data);
    } catch (err) {
      console.log(err);
      console.log("no");
    }
  };

  return (
    <div className='ui container' style={{marginTop: '30px'}}>
      {/* <Button onClick={getPosts} color='skyblue' text="posts"/>
      <Button onClick={getAlbums} color="red" text="albums"/> */}
      <Button onClick={getTests} color="yellow" text="ツイートを取得"/>
      <Data resources={resources} />
    </div>
  );
};




const Data=({ resources })=>{  

  const TestD=({ id })=>{
    let d_url = "http://localhost/delete/" + 7;
    try {
      axios.post(d_url);
      console.log("きてるよ" + d_url );
    } catch (err) {
      console.log(err);
      console.log("delete no");
    }
    
  }
      
  const resource_data = resources.map(resource => {
    let seven = 7;
    return (
      <div key={resource.id} className="div_item">
        <p>{resource.id}</p>
        <p><a href={resource.id}>{resource.name}</a></p>
        <p>{resource.contents}</p>
        <img width="400" height="250" src={resource.image_name}/>
        <p>{resource.created_at}</p>
        <button type="submit"onClick={(seven) => TestD(seven)}>削除</button> 
        {/* <a href={resource.id}>aaaaa</a> */}
      </div>
    );
  });
  return (
    //投稿がない時の出力
    <div>
      {resource_data.length ? resource_data : <p>Nothing to do!</p>}
    </div>
  );
   
}


            //投稿用
            // updateItemName={this.updateItemName}
            // updateItemContents={this.updateItemContents}
            // updateItemPas={this.updateItemPas}
            // rsetItem={this.rsetItem}
            // formModReturn={this.formModReturn}
            // onFileChange={this.onFileChange}
            //編集用           

            //投稿用
            // item_name={this.state.item_name}
            // item_contents={this.state.item_contents}
            // item_pas={this.state.item_pas}   
            // imageNmae={this.state.imageNmae}   
            // imageData={this.state.imageData}   
            //編集用   






            axios
            .post('http://localhost/login/register', { 
              name: this.state.name
             })
            .then(response => {
              console.log(response.data)
            })
            .catch(error => {
              console.log(error);
            });

            // public function register(Request $request) {
            //   return response()->json($req); 
            // }

            axios({
              method : "POST",
              url : "http://localhost/login/register",
              data: user
            })
            .then((response)=> {
              // console.log(response);
            })
            .catch((error)=> {
              console.info(error);
            });


            axios
            .post('http://localhost/post_test')
              .then(response => {
                      
                console.log(response.data);  
              })
              .catch(() => {
                console.log('通信に失敗しました');
              });




              <div className="Board">
                    <div>名前</div>
                    <input
                        type="text"
                        value={this.state.yourname}
                        onChange={this.handleChangeNmae}
                    />
                    
                    <br>
                    </br>
                    <br>
                    </br>

                    <div>コメント</div>
                    <textarea
                        value={this.state.comment}
                        onChange={this.handleChangeComment}
                    />

                    <br>
                    </br>
                    <br>
                    </br>

                    <button type="submit" onClick={this.handleSubmit}>キャンセル</button> 
            </div>







import React from 'react';

function handleSubmit(props) {
  alert('Your name is: ' + props.yourname);
}


function FormAdd(props) {
  return (
    <div className="Board">
      <div>名前</div>
      <input
          type="text"
          value={props.yourname}
          onChange={props.handleChangeNmae}
      />
      
      <br>
      </br>
      <br>
      </br>

      <div>コメント</div>
      <textarea
          value={props.comment}
          onChange={props.handleChangeComment}
      />

      <br>
      </br>
      <br>
      </br>

      <button type="submit" onClick={(e) => handleSubmit(props)}>投稿</button> 
    </div>
  );
}


class Board extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            yourname: "",
            comment:"",
            password: ""
        };
        this.handleChangeNmae = this.handleChangeNmae.bind(this);
        this.handleChangeComment = this.handleChangeComment.bind(this);
    }

    handleChangeNmae(event) {
        this.setState({
          yourname: event.target.yourname}
          );
    }
    handleChangeComment(event) {
        this.setState({
          comment: event.target.comment
        }); 
    }
   
    render(){
        return (
            <FormAdd 
              handleChangeNmae={this.handleChangeNmae}
              handleChangeComment={this.handleChangeComment}

              yourname={this.state.yourname}
              comment={this.state.comment}
            />
        )
    }
}

export default Board;





