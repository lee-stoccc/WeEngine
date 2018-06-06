// pages/pt/order-submit/order-submit.js
var api = require('../../../api.js');
var app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
      address: null,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
      app.pageOnLoad(this);
      var page = this;
      var goods_info = options.goods_info;
      var goods = JSON.parse(goods_info);
      page.setData({
          options: options,
          type: goods.type,
          parent_id: goods.parent_id ? goods.parent_id:0,
      });
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
  
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
      app.pageOnShow(this);

      var page = this;
      var address = wx.getStorageSync("picker_address");
      if (address) {
          page.setData({
              address: address,
              name: address.name,
              mobile: address.mobile
          });
          wx.removeStorageSync("picker_address");
      }
      page.getOrderData(page.data.options);
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {
  
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {
  
  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
  
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
  
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  
  },
    /**
     * 获取提交订单信息
     */
    getOrderData: function (options) {
        var page = this;
        var address_id = "";
        if (page.data.address && page.data.address.id)
            address_id = page.data.address.id;
        if (options.goods_info) {
            wx.showLoading({
                title: "正在加载",
                mask: true,
            });
        //   var goods_info = options.goods_info;
        //   var goods = JSON.parse(goods_info);
            app.request({
                url: api.group.submit_preview,
                data: {
                    goods_info: options.goods_info,
                    address_id: address_id,
                    type: page.data.type,
                },
                success: function (res) {
                    wx.hideLoading();
                    if (res.code == 0) {
                        var total_price_1 = parseFloat((res.data.total_price - res.data.colonel) > 0 ? (res.data.total_price - res.data.colonel) : 0.01) + res.data.express_price;
                        page.setData({
                            total_price: res.data.total_price,
                            goods_list: res.data.list,
                            goods_info: res.data.goods_info,
                            address: res.data.address,
                            express_price: parseFloat(res.data.express_price),
                            coupon_list: res.data.coupon_list,
                            name: res.data.address ? res.data.address.name : '',
                            mobile: res.data.address ? res.data.address.mobile : '',
                            send_type: res.data.send_type,
                            level: res.data.level,
                            total_price_1: total_price_1.toFixed(2),
                            colonel: res.data.colonel,
                        });
                    }
                    if (res.code == 1) {
                        wx.showModal({
                            title: "提示",
                            content: res.msg,
                            showCancel: false,
                            confirmText: "返回",
                            success: function (res) {
                                if (res.confirm) {
                                    wx.navigateBack({
                                        delta: 1,
                                    });
                                }
                            }
                        });
                    }
                }
            });
        }
    },
    /**
     * 绑定参数
     */
    bindkeyinput: function (e) {
        this.setData({
            content: e.detail.value
        });
    },
    /**
     * 订单提交
     */
    orderSubmit: function () {
        var page = this;
        var data = {};
        if (!page.data.address || !page.data.address.id) {
            wx.showToast({
                title: "请选择收货地址",
                image: "/images/icon-warning.png",
            });
            return;
        }
        data.address_id = page.data.address.id;

        if (page.data.goods_info) {
            data.goods_info = JSON.stringify(page.data.goods_info);
        }
        if (page.data.picker_coupon) {
            data.user_coupon_id = page.data.picker_coupon.user_coupon_id;
        }
        if (page.data.content) {
            data.content = page.data.content
        }
        if(page.data.type){
            data.type = page.data.type
        }
        
        if (page.data.parent_id){
            data.parent_id = page.data.parent_id
        }
        wx.showLoading({
            title: "正在提交",
            mask: true,
        });
        //提交订单
        app.request({
            url: api.group.submit,
            method: "post",
            data: data,
            success: function (res) {
                if (res.code == 0) {
                    setTimeout(function () {
                        wx.hideLoading();
                    }, 1000);
                    setTimeout(function () {
                        page.setData({
                            options: {},
                        });
                    }, 1);
                    var order_id = res.data.order_id;

                    //获取支付数据
                    app.request({
                        url: api.group.pay_data,
                        data: {
                            order_id: order_id,
                            pay_type: 'WECHAT_PAY',
                        },
                        success: function (res) {
                            if (res.code == 0) {
                                //发起支付
                                wx.requestPayment({
                                    timeStamp: res.data.timeStamp,
                                    nonceStr: res.data.nonceStr,
                                    package: res.data.package,
                                    signType: res.data.signType,
                                    paySign: res.data.paySign,
                                    success: function (e) {
                                        
                                        if (page.data.type =='ONLY_BUY'){
                                            wx.redirectTo({
                                                url: "/pages/pt/order/order?status=2",
                                            });
                                        }else{
                                            wx.redirectTo({
                                                url: "/pages/pt/group/details?oid=" + order_id,
                                            });
                                        }
                                    },
                                    fail: function (e) {
                                    },
                                    complete: function (e) {
                                        if (e.errMsg == "requestPayment:fail" || e.errMsg == "requestPayment:fail cancel") {//支付失败转到待支付订单列表
                                            wx.showModal({
                                                title: "提示",
                                                content: "订单尚未支付",
                                                showCancel: false,
                                                confirmText: "确认",
                                                success: function (res) {
                                                    if (res.confirm) {
                                                        wx.redirectTo({
                                                            url: "/pages/pt/order/order?status=0",
                                                        });
                                                    }
                                                }
                                            });
                                            return;
                                        }
                                        if (e.errMsg == "requestPayment:ok") {
                                            return;
                                        }
                                        wx.redirectTo({
                                            url: "/pages/pt/order/order?status=-1",
                                        });
                                    },
                                });
                                return;
                            }
                            if (res.code == 1) {
                                wx.showToast({
                                    title: res.msg,
                                    image: "/images/icon-warning.png",
                                });
                                return;
                            }
                        }
                    });
                }
                if (res.code == 1) {
                    wx.hideLoading();
                    wx.showToast({
                        title: res.msg,
                        image: "/images/icon-warning.png",
                    });
                    return;
                }
            }
        });
    },
})