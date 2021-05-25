console.log(2222);
{
axios
.get('/')             //リクエストを飛ばすpath
        .then(response => {
          setPosts(response.data);
          const data = response.data;      
          console.log(data);  
          console.log(response.data);  
          this.setState({
            info: data
          });
        })                               //成功した場合、postsを更新する（then）
        .catch(() => {
          console.log('通信に失敗しました');
        });
}

// function 消す
function getData() {
  axios
    .get('/')
    .then(response => {
      const data = response.data;      
      console.log(response.data);  
      this.setState({
        info: data
      });
    })
    .catch(() => {
      console.log('通信に失敗しました');
    });

    
}