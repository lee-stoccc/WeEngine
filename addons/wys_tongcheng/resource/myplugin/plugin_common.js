/*
自插件组合
*/

(function($) {
    $.fn.serializeObject = function() {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function() {
        if (o[this.name]) {
          if(!o[this.name].push) {
            o[this.name] = [o[this.name]];
          }
          o[this.name].push(this.value || '');
        } else {
          o[this.name] = this.value || '';
        }
      });
      return o;
    };
    $.fn.formSubmit = function(opts) {
      var defaults = {};
      var opts = $.extend(defaults, opts);
      var $btn = $(this).find("input[type='button']");
      var form = $(this);
      $btn.bind("click", function() {
        var json = form.serializeObject();
        alert(JSON.stringify(json));
      });

    }
  })($);
//控件ID,1维数组,0显示数字1显示和文本相同
function loadSelectOpeionAuto(_inputid,_arr,_showType){
 var nat = document.getElementById(_inputid);
 for ( var i = 0; i < _arr.length; i++)
 {
  var option = document.createElement ('option');
  option.value=_showType=="0"?i:_arr[i];
  var txt = document.createTextNode (_arr[i]);
  option.appendChild (txt);
  nat.appendChild (option);
}
}


/**
 * 设置Local
 * localStorage保存数据
 * @param String key  保存数据的key值
 * @param String value  保存的数据
 */
function setLocVal(key, value) {window.localStorage[key] = value;};
//设置Json类型的本地缓存
function setStorJson(objName,json){if(json){setstorage(objName,JSON.stringify(json))}};
//设置字符串类型的本地缓存
function setstorage(objName,objValue){var sto=window.localStorage;if(sto){sto.setItem(objName,objValue)}};
/**根据key取localStorage的值 @param Stirng key 保存的key值*/
function getLocVal(key){if(window.localStorage[key]){return window.localStorage[key]}else{return""}};
//读取Json类型的本地缓存
function getStorJson(objName){var ret={};var str=getstorage(objName);if(str){ret=JSON.parse(str)}return ret};
//读取字符串类型的本地缓存
function getstorage(objName){var ret='';var sto=window.localStorage;if(sto){ret=sto.getItem(objName)}return ret};
/**清除缓存 @param Striong key  保存数据的key，如果不传清空所有缓存数据*/
function clearLocVal(key){if(key){window.localStorage.removeItem(key)}else{window.localStorage.clear()}};
 //清除本地缓存，如没指定名称则为清空所有缓存
function clearstorage(objName){var sto=window.localStorage;if(sto){if(objName)sto.removeItem(objName);else sto.clear()}};