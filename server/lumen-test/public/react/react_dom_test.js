class Test extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      file: null,
    };
    this.getImage = this.getImage.bind(this);
  }

  getImage(e) {
    this.setState({
      file: e.target.files[0]
    });
    const params = new FormData();
    params.append('file', e.target.files[0]);
    console.log(e.target.files[0]);
    console.log(params);
    console.log(this.state.file);
    // const params = new FormData()
    // const file = e.target.files[0]
    // params.append('file', file)
    // console.log(params);
  }

  // submitImage() {
  // const header = { headers: {
  //   'Content-Type': 'application/json;charset=UTF-8',
  //   "Access-Control-Allow-Origin": "*",
  //   }}
  //   const data = new FormData()
  //   data.append('file', image)
  //   const imgUri = '任意のURL'
  //   axios.post(imgUri, data, header)
  //   .then(res => {
  //     //任意の処理
  //   }).catch(err => {
  //     //任意の処理
  //   })
  // }

  render() {
    return (
      <div>
        <form>
          <label htmlFor="img">画像</label>
          <input id="img" type="file" accept="image/*,.png,.jpg,.jpeg,.gif" onChange={(e) => this.getImage(e)} />
          <input type="button" value="保存"  />
        </form>
      </div>
    );
  }
}

ReactDOM.render(
  <Test/>,
  document.getElementById('okc')
);
