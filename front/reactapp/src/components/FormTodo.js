import React from "react";
import axios from 'axios';
import firebase, { storage } from "./firebase";

function FormTodo(props) {
  // console.log(props);
  // console.log(props.imageData);
  // console.log(props.imageFile);

  /// imageFile 中身 file[0];

  const imageData = props.imageData
  let preview = ''
  if(imageData != null) {
      preview = (
          <div>
          <img alt="投稿画像" width="400" height="250" src={imageData}/>
          </div>
      )
  }
  // name[0] contents[1] pas_wd[2] image_name[3] imageData
  let post_item = [props.item_name, props.item_contents, props.item_pas, props.imageFile, props.imageData]

  //投稿時のフォーム
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
            <button type="submit" onClick={(e) => PostData(post_item, props)}>投稿</button> 
          </div>
      </div>
    );
  }

  //編集時のフォーム
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

function PostData(item,props) {
  const post_url = "http://localhost/test";
  // console.log(item[3]);
  const image_file = item[3];
  // console.log(image_file.name);

  const items = [item[0], item[1], item[2], image_file.name]
  if(!window.confirm('投稿しますか？')){
    return;
  }else {
    if (items[0] === "") {
    return window.confirm('名前は必須項目です。')
    }
    if (items[1] === "") {
      return window.confirm('本文は必須項目です。')
    }
    if (items[2] === "") {
      return window.confirm('パスワードは必須項目です。')
    }
    if (items[2].length <= 3) {
      return window.confirm('パスワードは4桁以上数字のみです。')
    }
    //画像Firebaseに保存
    // const uploadTask = storage.ref(`/images/${image_file.name}`).put(image_file);
    // uploadTask.on(
    //   firebase.storage.TaskEvent.STATE_CHANGED
    // );

    imagePush(image_file);



    axios({
      method : "POST",
      url : post_url,
      data : items
    })
    .then((response)=> {
      // console.log(response.data);
    })
    .catch((error)=> {
      console.info(error);
    });
    return props.formModReturn();
  }
}

//編集保存
function updateData(props) {
  const item = [props.item_id, props.item_name_e, props.item_contents_e, props.item_pas_e];
  // console.log(item);
  const updata_url = "http://localhost/update";
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
      url : updata_url,
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

//画像保存Firebase
function imagePush(image) {
  storage.ref(`/images/${image.name}`).put(image);
  
  // if (image === "") {
  //   console.log("ファイルが選択されていません");
  // }
  // // アップロード処理
  // const uploadTask = storage.ref(`/images/${image.name}`).put(image);
  // uploadTask.on(
  //   firebase.storage.TaskEvent.STATE_CHANGED,
  //   next,
  //   error,
  //   complete
  // );

  // const next = snapshot => {
  //   // 進行中のsnapshotを得る
  //   // アップロードの進行度を表示
  //   const percent = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
  //   console.log(percent + "% done");
  //   console.log(snapshot);
  // };
  // const error = error => {
  //   // エラーハンドリング
  //   console.log(error);
  // };
  // const complete = () => {
  //   // 完了後の処理
  //   // 画像表示のため、アップロードした画像のURLを取得
  //   console.log("upload OK");
  // };

}


export default FormTodo;