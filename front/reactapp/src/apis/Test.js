import React from 'react';
import {
  useParams,
  useHistory,
  useLocation,
} from 'react-router-dom';
window.sessionStorage.setItem(['key1'],['value1']);
var a = window.sessionStorage.getItem(['key1']);
console.log(a);  

function Test(props){
  const l = useLocation(); // URL path や パラメータなど。JSのlocationと同じ
  const p = useParams();     // URLのパスパラメータを取得。例えば、 /uses/2 なら、2の部分を取得
  const h = useHistory();   // historyオブジェクトを取得。
  // console.log(props);
  console.log(l.pathname);
  console.log(p);
  console.log(h);

  return(
    <div>

      {/* <p>履歴：{props.history}</p> */}
    </div>
  )

}

// function Test() {
//   return (
//     <p>aaaaaaaa</p>
//   );
// }

export default Test;