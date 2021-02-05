// index.js
const util = require("../../utils/util");
Page({
  data: {
    user: null
  },
  onLoad() {},

  // 获取资料
  login: function (r) {
    if (r.detail.userInfo) {
      this.userInfo = r.detail.userInfo;
    }
    this.enter(true);
  },

  // 授权登录
  enter: function () {
    var that = this;
    that.promise('login').then(function (res) {
      that.promise('getSetting').then(function (set) {
        that.promise('getUserInfo').then(function (data) {
          var data = {
            "code": res.code,
            "user_data": JSON.stringify(data),
          };
          that.user_login(data);
        }).catch(function (error) {
          if (error.errMsg == "getUserInfo:fail auth deny") {
            vphp.toast('授权失败！')
          }
        })
      }).catch(function (error) {
        that.user_login(error.errMsg);
      })
    }).catch(function (error) {
      that.user_login(error.errMsg);
    })
  },

  // 请求后台
  user_login: function (data) {
    var that = this;
    util.request({
      url: 'user/auth',
      data: data,
      success: function (res) {
        console.log(res);
        that.setData({
          user: res.data
        })
      }
    })
  },

  phone: function (e) {
    if (e.detail.errMsg == "getPhoneNumber:ok") {
      var openid = this.data.user.openid;
      var session_key = this.data.user.session_key;
      if (openid == '' || session_key == '') {
        util.toast('请先授权登录~');
        return false;

      }
      util.request({
        url: 'user/get-phone',
        data: {
          encryptedData: e.detail.encryptedData,
          iv: e.detail.iv,
          session_key: session_key,
          openid: openid,
        },
        success: function (res) {
          console.log(res);
        },
      })
    } else if (e.detail.errMsg == "getPhoneNumber:fail user deny") {
      util.toast('用户拒绝授权~');
      return false;
    }
  },

  // promise 简化微信 api
  promise: function promisify(method, options = {}) {
    return new Promise((resolve, reject) => {
      options.success = resolve
      options.fail = err => {
        reject(err)
      }
      wx[method](options)
    })
  }
})