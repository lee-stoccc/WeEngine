(function($) {
    $.fn.serializeObject = function() {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function() {
        if (o[this.name]) {
          if (!o[this.name].push) {
            o[this.name] = [ o[this.name] ];
          }
          o[this.name].push(this.value || '');
        } else {
          o[this.name] = this.value || '';
        }
      });
      return o;
    };
    $.fn.formSubmit = function(opts) {
      var defaults = {

      }
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


function httpurl_post(url, params) {
    var temp = document.createElement("form");
    temp.action = url;
    temp.method = "post";
    temp.style.display = "none";
    for (var x in params) {
        var opt = document.createElement("input");
        opt.name = x;
        opt.value = params[x];
        temp.appendChild(opt);
    }
    document.body.appendChild(temp);
    temp.submit();
    return temp;
}  
