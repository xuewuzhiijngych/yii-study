// app.js
const util = require("./utils/util");
const env = require('env.js');

App({
  /**
   * 应用初始化
   * 
   */
  init: function () {
    util.server_url = env.server_url;
  },


  onLaunch() {
    this.init();
  },
  globalData: {}
})