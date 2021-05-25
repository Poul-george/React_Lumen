import React from 'react'
import {
  Link,
} from 'react-router-dom';

class RootTest extends React.Component {
  
  render(){
    return(
      <div>
        <Link key="sign" to="/Sign_in">Sign_in</Link><br/>
        <Link key="top" to="/top">Top</Link><br/>
        <Link key="tweet" to="/formadd">Tweet</Link><br/>
        <Link key="abput" to="/About">About</Link><br/>
      </div>
    )
  }
}

export default RootTest;