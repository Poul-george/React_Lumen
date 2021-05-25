import React, { useState } from "react";
import axios from 'axios';
import firebase, { storage } from "./firebase";

function Data(props) {
  const info = props.info.map(list => {
    return (
      <DataItem
        key={list.id}
        list={list}
        EditForm={props.EditForm}
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

function DataItem(props) {
  const [imageUrl, setImageUrl] = useState("");

    storage
      .ref("images")
      .child(props.list.image_name)
      .getDownloadURL()
      .then(fireBaseUrl => {
        setImageUrl(fireBaseUrl);
    });


  return (
    <div className="div_item">
      <p>{props.list.id}</p>
      <p><a href={props.list.id}>{props.list.name}</a></p>
      <p>{props.list.contents}</p>
      <img alt="投稿画像" width="400" height="250" src={imageUrl}/>
      <p>{props.list.created_at}</p>
      <button type="submit"onClick={(e) => DataDelete(props.list.id)}>削除</button> 
      <button type="submit"onClick={(e) => props.EditForm(props.list.id)}>編集</button> 
    </div>
  );
}

function DataDelete(id) {
  const d_url = "http://localhost/delete/" + id;
  // const d_url = "http://localhost/post_test";
  // const d_url = "http://localhost/test";
  const item = ["KD", "ddd", 1111, "fahbflkhbk;arbjgbg;jog;ber", "imagedata"]; 
  // console.log(d_url);
  if(window.confirm('削除してよろしいですか？')){

    axios({
      method : "POST",
      url : d_url,
      data: item
    })
    .then((response)=> {
      console.log(response);
    })
    .catch((error)=> {
      console.info(error);
    });

    return window.confirm('削除されました。');
  } else {
    return;
  }
}

export default Data;






