var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Test = function (_React$Component) {
  _inherits(Test, _React$Component);

  function Test(props) {
    _classCallCheck(this, Test);

    var _this = _possibleConstructorReturn(this, (Test.__proto__ || Object.getPrototypeOf(Test)).call(this, props));

    _this.state = {
      file: null
    };
    _this.getImage = _this.getImage.bind(_this);
    return _this;
  }

  _createClass(Test, [{
    key: "getImage",
    value: function getImage(e) {
      this.setState({
        file: e.target.files[0]
      });
      var params = new FormData();
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

  }, {
    key: "render",
    value: function render() {
      var _this2 = this;

      return React.createElement(
        "div",
        null,
        React.createElement(
          "form",
          null,
          React.createElement(
            "label",
            { htmlFor: "img" },
            "\u753B\u50CF"
          ),
          React.createElement("input", { id: "img", type: "file", accept: "image/*,.png,.jpg,.jpeg,.gif", onChange: function onChange(e) {
              return _this2.getImage(e);
            } }),
          React.createElement("input", { type: "button", value: "\u4FDD\u5B58" })
        )
      );
    }
  }]);

  return Test;
}(React.Component);

ReactDOM.render(React.createElement(Test, null), document.getElementById('okc'));