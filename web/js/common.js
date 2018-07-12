var baseHost = getHost();
var apiBaseUrl = 'http://api.' + baseHost;
var wwwBaseUrl = 'http://www.' + baseHost;
var skinBaseUrl = 'http://skin.' + baseHost;
var shareBaseUrl = 'http://share.' + baseHost;
var groupBaseUrl = 'http://group.' + baseHost;
var memberBaseUrl = 'http://member.' + baseHost;
var userBaseUrl = 'http://u.' + baseHost;
var passportBaseUrl = 'https://passport.' + baseHost;
var photoSize = ['58', '200', '400', 'org'];
var avatarSize = ['30', '80', '160'];
var goodsLoadingImg = skinBaseUrl+'/img/goods_loading.gif';
var divLoadingImg = skinBaseUrl+'/img/loading.gif';
jQuery.extend({
    getContent: function (url, data, callback, async, sucfunc) {
        if (typeof async == 'boolean') {
            async = async ? true : false;
        } else {
            async = true;
        }
        $.ajax({
            async: async,
            url: url,
            type: "GET",
            dataType: 'jsonp',
            jsonp: 'callback',
            data: data,
            cache: false,
            jsonpCallback: "success_" + callback,
            success: function (json) {
                if (typeof sucfunc == "function") {
                    sucfunc(json);
                }
            }
        });
    },
    getJsonp: function(url, data, succfunc) {
        $.jsonp({
            url: url,
            data: data,
            callbackParameter: "callback",
            success: succfunc,
            error: function (xOptions, textStatus) {
               // console.log(xOptions)
            }
        });
    },

});

Date.prototype.format = function(format) {
    var date = {
        "M+": this.getMonth() + 1,
        "d+": this.getDate(),
        "h+": this.getHours(),
        "m+": this.getMinutes(),
        "s+": this.getSeconds(),
        "q+": Math.floor((this.getMonth() + 3) / 3),
        "S+": this.getMilliseconds()
    };
    if (/(y+)/i.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
    }

    for (var k in date) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length == 1
                ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
        }
    }
    return format;
}

function getHost(url) {
    var host = "null";
    if (typeof url == "undefined"
        || null == url)
        url = window.location.href;
    var regex = /.*\:\/\/([^\/|:]*).*/;
    var match = url.match(regex);
    if (typeof match != "undefined"
        && null != match) {
        host = match[1];
    }
    if (typeof host != "undefined"
        && null != host) {
        var strAry = host.split(".");
        if (strAry.length > 1) {
            host = strAry[strAry.length - 2] + "." + strAry[strAry.length - 1];
        }
    }
    return host;
}


function createGoodsImgUrl(name, width, height) {
    return 'http://img.' + baseHost + '/pic-' + width + '-' + height + '/' + name;
}

function createUserFaceImgUrl(name, width) {
    if (!name) {
        name = '000000000000.jpg';
        return 'http://img.' + baseHost + '/userface/' + width + '/' + name;
    }
    return 'http://img.' + baseHost + '/userface/' + width + '/' + name;
}

function createShareImgUrl(name, size) {
    return 'http://img.' + baseHost + '/userpost/' + size + '/' + name;
}

function createTempImgUrl(name) {
    return 'http://img.' + baseHost + '/temp/' + name;
}

function createGoodsUrl(productId) {
    return 'http://www.' + baseHost + '/product/' + productId + '.html';
}

function createPeriodUrl(periodId) {
    return 'http://www.' + baseHost + '/lottery/' + periodId + '.html';
}

function  createActiveImgUrl(name, size) {
    return 'http://img.' + baseHost + '/active/' + size + '/' + name;
}

function createPeriodListUrl(catId, page) {
    if (catId) {
        if (page > 1) {
            return 'http://www.' + baseHost + '/lottery/i' + catId + 'm' + page + '.html';
        }
        return 'http://www.' + baseHost + '/lottery/i' + catId + '.html';
    } else {
        if (page > 1) {
            return 'http://www.' + baseHost + '/lottery/m' + page + '.html';
        }
        return 'http://www.' + baseHost + '/lottery/m1.html';
    }
}

function createUserCenterUrl(userHomeId) {
    return 'http://u.' + baseHost + '/' + userHomeId;
}

function createShareDetailUrl(shareTopicId) {
    return 'http://share.' + baseHost + '/detail-' + shareTopicId + '.html';
}

function createShareMemberDetailUrl(shareTopicId) {
    return 'http://member.' + baseHost + '/share/detail-' + shareTopicId + '.html';
}

function createLoginUrl(iframe, forword) {
    var url = 'http://passport.' + baseHost + '/login.html';
    url = url + '?iframe=' + iframe;
    url = url + '&forword=' + forword;
    return url;
}

function getPeriodIdByUrl(url) {
    var periodId = '';
    var s = 'lottery/([0-9]+)\.html';
    var reg = new RegExp(s);
    var r = url.match(reg);
    if (r != null) {
        periodId = r[1];
    }
    return periodId;
}

function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return decodeURI(r[2]);
    return null;
}

function getHtmlUrlParam(j) {
    var href = window.location.href;
    var s = "list";
    for (var i = href.split("-").length - 1; i > 0; i--) {
        s += '-([0-9]*)';
    }
    ;
    s += ".html";
    var reg = new RegExp(s);
    var r = href.match(reg);
    if (r != null) {
        if (r[j]) {
            return r[j];
        } else {
            return 0;
        }
    }
    ;
    return 0;
}

function closeWindow(id) {
    $('#'+id).window('close');
}

$.extend($.fn.validatebox.defaults.rules, {
    phone: {
        validator: function(value){
            var reg = /^0?1[3|4|5|7|8][0-9]\d{8}$/;
            if (reg.test(value)) {
                return true;
            } else {
                return false;
            }
        },
        message: '请输入正确电话或手机格式'
    }
});

function formatTime(val, row) {
    if (val == 0) {
        return;
    }
    return new Date(parseInt(val) * 1000).toLocaleString();
}

function formatName(val, row) {
    result = '';

    if (row.phone) {
        result += '手机号：' + row.phone + '<br />';
    }
    if (row.email) {
        result += '邮箱：' + row.email;
    }

    return result;
}

function formatNickname(val, row) {
    if (val == null) {
        return '无';
    }
    return val;
}
