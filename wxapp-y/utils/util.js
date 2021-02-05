var util = {};
util.server_url = "";

/**
 * 
 * @param {*} options 
 * wx.request 封装
 */
util.request = function (options) {
  if (!options) {
    options = {};
  }
  var the = this;
  the.url = options.url;
  the.data = options.data;
  the.success = options.success;
  the.fail = options.fail;
  the.complete = options.complete;

  wx.request({
    url: util.server_url + the.url,
    data: util.params(the.data),
    method: 'POST',
    header: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Accept': 'application/json',
    },
    success: function (info) {
      if (the.success && info.data.status == 1) {
        the.success(info.data)
      }
      if (the.fail && info.data.status == -1) {
        the.fail(info.data)
      } else if (!the.fail && info.data.status == -1) {
        util.toast(info.data.msg);
        return false;
      }
    },
    fail: function (info) {
      if (the.fail) {
        the.fail(info.data)
      } else {
        util.toast(info.data.msg);
        return;
      }
    },
    complete: function (info) {}
  });
}


/**
 * 组装post所需的数据
 * （微信wx.request并不能自动构建数组post，所以才需要该方法进行处理）
 * 
 * @param {object} data
 * @param {string} [prefix] 键名前缀
 * @returns {object}
 */
util.params = function (data, prefix) {
  var res = {};
  for (var k in data) {
    if (typeof data[k] == 'object') {
      var _prefix;
      if (prefix === undefined) {
        _prefix = k;
      } else {
        _prefix = prefix + "[" + k + "]";
      }
      var _res = util.params(data[k], _prefix);
      for (var j in _res) {
        res[j] = _res[j];
      }
    } else {
      if (prefix === undefined) {
        res[k] = data[k];
      } else {
        res[prefix + "[" + k + "]"] = data[k];
      }
    }
  }
  return res;
};

var toast_queue = [];
var toast_show = false;

// 弹出提示框
util.toast = function (v, callback) {
  if (toast_show) {
    for (var k in toast_queue) {
      if (toast_queue[k][1] == v && toast_queue[k][2] == callback) {
        return;
      }
    }
    toast_queue.push([util.time(), v, callback]);
  } else {
    toast_show = true;
    var show = function (vv) {
      wx.showToast({
        title: vv,
        icon: 'none',
        duration: 1500,
      });
      setTimeout(function () {
        if (callback) {
          callback();
        }
      }, 1500);
      setTimeout(function () {
        var v = toast_queue.shift();
        if (v === undefined) {
          toast_show = false;
        } else {
          show(v[1], v[2]);
        }
      }, 1600);
    };
    show(v, callback);
  }
};

// 关闭弹出框
util.toast.hide = function (wait) {
  var time = util.time();
  var _toast_queue = [];
  for (var k in toast_queue) {
    if (toast_queue[k][0] > time) {
      _toast_queue.push(toast_queue[k]);
    }
  }
  toast_queue = _toast_queue;
  if (!wait) {
    wx.hideToast();
  }
};

// 当前时间戳
util.time = function () {
  return Date.now();
};



module.exports = util;