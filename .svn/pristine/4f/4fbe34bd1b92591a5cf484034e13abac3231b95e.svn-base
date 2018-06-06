<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH)) : (include template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>resource/js/jquery.plugin.js"></script>
<link href="<?php echo MODULE_URL;?>resource/plugin/sweetjs/css/sweet-alert.css" rel="stylesheet">
<script src="<?php echo MODULE_URL;?>resource/plugin/sweetjs/js/sweet-alert.js" type="text/javascript" ></script>


<?php  if($pagediv=='list') { ?>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <form id="frm_main" action="" method="post" autocomplete="off">
  <input type="hidden" id="otid" name="otid">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
  <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
   <h4 class="modal-title" id="myModalLabel">标题</h4>
  </div>
  <div class="modal-body">

<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>新类型主类：</label>
<div class="col-sm-10">
 <select class="form-control" name="N_tid" id="N_tid" onchange="MtypeListChange(this);">
     <?php  if(is_array($list)) { foreach($list as $i => $m) { ?>    
     <option value="<?php  echo $m['id'];?>"><?php  echo $m['id'];?>)<?php  echo $m['tname'];?></option> 
     <?php  } } ?>
   </select>
</div></div>


<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>新类型子类：</label>
<div class="col-sm-10">
 <select class="form-control" name="N_parent_tid" id="N_parent_tid"></select>
</div></div>




</div>



  <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">
    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭</button>
   <button onclick="del_hebing()" type="button" id="btn_submit" class="btn btn-primary" >
    <span class="glyphicon glyphicon-floppy-disk" </span>保存</button>
  </div>
  </div>
 </div>
</form>
 </div>
<script type="text/javascript">

// href="" 
function del_tonewType(oid,oname){

$("#myModalLabel").text(oid+" "+oname+":分类删除合并");
$('#otid').val(oid);
$('#myModal').modal();
}
function del_hebing(){
var data=$("#frm_main").serializeObject();
if(data.otid==data.N_tid){
swal("提示", "删除分类和合并分类不能相同!", "error");
}else{

var url="<?php  echo $this->createWebUrl($h_name.'_action', array('op'=>'del','mlevel'=>'main'))?>";
url+="&oid="+data.otid+"&nid="+data.N_tid+"&n_parent_id="+(typeof(data.N_parent_tid)=='undefined'?'0':data.N_parent_tid);

console.log(url);
window.location.href=url;


}
console.log(data)

}
var tid="<?php  echo $list[0]['id'];?>";
function MtypeListChange(el){
load_mtype_list_bytid(el.value);
}


if(tid!=""){
  load_mtype_list_bytid(tid);
}
//console.log(tid)

function load_mtype_list_bytid(vl){
  
  $.ajax({
    url:"<?php  echo $this->createWebUrl('json_mtype_list')?>",  
    async:false,
    type:"get",
    dataType: "json",
    data:{attr:vl,tbname:'wys_tongcheng_store_mtype'},
    success:function(json){
           /// console.log(json)
           var nat = document.getElementById("N_parent_tid");
           $("#N_parent_tid").empty();
           var option = document.createElement ('option');
           option.value="0";
           var txt = document.createTextNode ("---请选择--");
           option.appendChild (txt);
           nat.appendChild (option);
           for(var i=0;i<json.length;i++){
             var option = document.createElement ('option');
             option.value=json[i].id;
            
             var txt = document.createTextNode (json[i].tname);
             option.appendChild (txt);
             nat.appendChild (option);
           }
          // window.location.href = json.url;
        },
        error:function(){
          alert('请求错误！');
        }
      });
}
</script>


<!-- 列表 -->
<div class="main">
<ul class="nav nav-tabs">
<li class="active"><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('op'=>'list'));?>">所有<?php  echo urldecode($h_title);?></a></li>
<li><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'add'));?>">添加<?php  echo urldecode($h_title);?></a></li>
</ul>

<div style="padding-top:5px;"></div>

<form action="" class="form-horizontal form" method="post" autocomplete="off">
<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
<input type="hidden" name="op" value="list">

<div class="panel panel-default">
<div class="panel-heading">
<input type="checkbox" name="" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">选择
<input type="submit" name="delete_selectd" class="btn btn-primary" value="选中删除">

<span style="color:green;margin-left:10px;">排序为升序</span>


 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'init'))?>" class='btn btn-success btn-sm' onclick="return confirm('确定初始化店铺类型?')"><i class="fa fa-cog"></i>初始化默认店铺类型</a>

<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('op'=>'del_all'))?>" title="删除" class='btn btn-warning btn-sm' onclick="return confirm('是否删除所有?')"><i class="fa fa-remove"></i>删除所有</a>

<span style="color:red;margin-left:10px;">不开二级分类不显示主类</span>

</div>
        
<div class="panel-body">

<table class="table table-hover tb_center">
<thead class="navbar-inner">
<tr>
<th style="width:60px;">删?</th>
<th style="width:100px;">
<div class="div_text">分类图标</div>
<div class="div_text">分类名称</div>
</th>

<th style="width:100px;" >跳转类型</th>
<!-- <th style="width:60px;">付费</th> -->
<th style="width:60px;" >排序</th>
<!-- <th style="width:60px;">审核</th>
 -->
 <th style="width:80px;">首页显示</th>
<th style="width:60px;">启用</th>
<th style="width:100;">分类二级开关</th>
<th style="width:120px;">创建时间</th>
<th style="text-align:center;">操作</th>
</tr>
</thead>
<tbody>
<?php  if($list) { ?>
<?php  if(is_array($list)) { foreach($list as $index => $row) { ?>
<tr>
	<!-- <td><?php  if($row['thumb']) { ?><a href="<?php  echo tomedia($row['thumb']);?>" target="_blank"><img src="<?php  echo tomedia($row['thumb']);?>" style="height:40px;width:40px;"></a><?php  } else { ?><i class="c_gray">无图</i><?php  } ?></td> -->
<td><input type="checkbox" name="ids[]" value="<?php  echo $row['id'];?>" class=""><?php  echo $row['id'];?></td>			
<!-- <td class="row-first"><?php  echo $row['id'];?></td> -->

<td>
<div class="div_text">
<?php  if($row['img']) { ?><a href="<?php  echo tomedia($row['img']);?>" target="_blank"><img src="<?php  echo tomedia($row['img']);?>" style="height:40px;width:40px;"></a><?php  } ?>
</div>
<div class="div_text"><?php  echo $row['tname'];?></div>
  <?php  if($row['alllookcnt']>0) { ?>
<div class="div_text" style="color:blue;">总入驻:<?php  echo $row['alllookcnt'];?></div>
<?php  } ?>
</td>

<td>

<?php  if($row['type']=='0') { ?>
<div class="div_text" style="color:green;">正常分类</div>

<?php  } else if($row['type']=='1') { ?>
<div class="div_text" style="color:red;">关联小程序跳转</div>
<?php  } else if($row['type']=='2') { ?>
<div class="div_text" style="color:blue;">内部图文</div>
<?php  } ?>
</td>
<!-- <td>
<?php  if($row['send_money']>0) { ?>
<?php  echo $row['send_money'];?>
<?php  } else { ?>
<font color="gray">无</font>
<?php  } ?>

</td> -->
<td><?php  echo $row['pxh'];?></td>


<!-- 
<td>
<?php  if($row['is_audit'] == 1) { ?>
<font color="green">无需审核</font>
 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'is_audit'))?>" class='btn btn-danger btn-sm' onclick="return confirm('确定需审核?')"><i class="fa fa-edit"></i>需审核</a> 
<?php  } else if($row['is_audit'] ==0) { ?>
<font color="gray">需审核</font>
 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'is_audit'))?>" class='btn btn-success btn-sm' onclick="return confirm('确定无需审核?')"><i class="fa fa-edit"></i>无需审核</a> 
<?php  } ?>
</td>
-->
<td >
<?php  if($row['show_index'] == 1) { ?>
 <font color="green">首页显示</font>

 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'show_index'))?>" class='btn btn-danger btn-sm' onclick="return confirm('确定首页不显示?')"><i class="fa fa-edit"></i>不显示</a> 
<?php  } else { ?>
<font color="gray">首页不显</font>
 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'show_index'))?>" class='btn btn-success btn-sm' onclick="return confirm('确定首页显示?')"><i class="fa fa-edit"></i>首页显示</a> 
<?php  } ?>
</td> 

<td >
<?php  if($row['enable'] == 1) { ?>
 <font color="green">启用</font>
 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'enable'))?>" class='btn btn-danger btn-sm' onclick="return confirm('确定禁用?')"><i class="fa fa-edit"></i>禁用</a> 
<?php  } else { ?>
 <font color="gray">禁用</font>
 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'enable'))?>" class='btn btn-success btn-sm' onclick="return confirm('确定直启用?')"><i class="fa fa-edit"></i>启用</a> 
<?php  } ?>
</td>
<td>
<?php  if($row['type']=='0') { ?>
<?php  if($row['is_parent_open'] == 1) { ?>
<div class="div_text" style="color:blue;"><font color="green">已开启</font></div>
 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'is_parent_open'))?>" class='btn btn-danger btn-sm' onclick="return confirm('确定关闭?')"><i class="fa fa-edit"></i>关闭二级</a>
<?php  } else { ?>
<div class="div_text" style="color:blue;"><font color="gray">关闭</font></div>

 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'is_parent_open'))?>" class='btn btn-success btn-sm' onclick="return confirm('确定开启?')"><i class="fa fa-edit"></i>开启二级</a> 
<?php  } ?>
<?php  } ?>
</td>



<td><?php  echo date('Y-m-d',$row['crtime'])?></td>


<td align="center">
<div class="btn-group">
<?php  if($row['type']=='0') { ?>

<?php  if($row['is_parent_open'] == 1) { ?>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'tname'=>$row['tname'],'op'=>'parent_add'))?>" title="编辑" class='btn btn-success btn-sm'><i class="fa fa-edit"></i>增加二级</a>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'tname'=>$row['tname'],'op'=>'parent_list'))?>" title="编辑" class='btn btn-success btn-sm'><i class="fa fa-list"></i>二级列表</a> 
<?php  } ?>

<?php  } ?>



<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'edit'))?>" title="编辑" class='btn btn-default btn-sm'><i class="fa fa-edit"></i>编辑分类</a> 
<a href="javascript:del_tonewType('<?php  echo $row['id'];?>','<?php  echo $row['tname'];?>')" title="删除" class='btn btn-default btn-sm'><i class="fa fa-remove"></i>删除合并</a>
</div>
</td>
</tr>
<?php  } } ?>
<?php  } else { ?>
<tr>
<td colspan="5" align='center'>暂无数据</td>
</tr>
<?php  } ?>
</tbody>
</table>
<?php  echo $result['pager'];?> 
        </div>
    </div>
</form>
</div>

<?php  } else if($pagediv=='parent_list') { ?>
<!-- 列表 -->


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <form id="frm_main" action="" method="post" autocomplete="off">
  <input type="hidden" id="otid" name="otid">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
  <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
   <h4 class="modal-title" id="myModalLabel">标题</h4>
  </div>
  <div class="modal-body">

<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>新类型主类：</label>
<div class="col-sm-10">
 <select class="form-control" name="N_tid" id="N_tid" onchange="MtypeListChange(this);">
     <?php  if(is_array($list)) { foreach($list as $i => $m) { ?>    
     <option value="<?php  echo $m['id'];?>"><?php  echo $m['id'];?>)<?php  echo $m['tname'];?></option> 
     <?php  } } ?>
   </select>
</div></div>




</div>



  <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">
    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭</button>
   <button onclick="del_hebing()" type="button" id="btn_submit" class="btn btn-primary" >
    <span class="glyphicon glyphicon-floppy-disk" </span>保存</button>
  </div>
  </div>
 </div>
</form>
 </div>
<script type="text/javascript">

// href="" 
function del_tonewType(oid,oname){

$("#myModalLabel").text(oid+" "+oname+":分类删除合并");
$('#otid').val(oid);
$('#myModal').modal();
}
function del_hebing(){
var data=$("#frm_main").serializeObject();
if(data.otid==data.N_tid){
swal("提示", "删除分类和合并分类不能相同!", "error");
}else{

var url="<?php  echo $this->createWebUrl($h_name.'_action', array('op'=>'del','mlevel'=>'parent'))?>";
url+="&oid="+data.otid+"&nid="+data.N_tid;

console.log(url);
window.location.href=url;


}
console.log(data)

}
// var tid="<?php  echo $list[0]['id'];?>";
// function MtypeListChange(el){
// load_mtype_list_bytid(el.value);
// }


// if(tid!=""){
//   load_mtype_list_bytid(tid);
// }


//console.log(tid)

// function load_mtype_list_bytid(vl){
  
//   $.ajax({
//     url:"<?php  echo $this->createWebUrl('json_mtype_list')?>",  
//     async:false,
//     type:"get",
//     dataType: "json",
//     data:{attr:vl},
//     success:function(json){
//            /// console.log(json)
//            var nat = document.getElementById("N_parent_tid");
//            $("#N_parent_tid").empty();
//            var option = document.createElement ('option');
//            option.value="0";
//            var txt = document.createTextNode ("---请选择--");
//            option.appendChild (txt);
//            nat.appendChild (option);
//            for(var i=0;i<json.length;i++){
//              var option = document.createElement ('option');
//              option.value=json[i].id;
            
//              var txt = document.createTextNode (json[i].tname);
//              option.appendChild (txt);
//              nat.appendChild (option);
//            }
//           // window.location.href = json.url;
//         },
//         error:function(){
//           alert('请求错误！');
//         }
//       });
// }





</script>



<div class="main">
<ul class="nav nav-tabs">
<li ><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('op'=>'list'));?>">所有<?php  echo urldecode($h_title);?></a></li>
<li><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'add'));?>">添加<?php  echo urldecode($h_title);?></a></li>



<li class="active"><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('op'=>'list'));?>"><?php  echo $tname;?>>>子所有<?php  echo urldecode($h_title);?></a></li>
</ul>


<div style="padding-top:5px;"></div>

<form action="" class="form-horizontal form" method="post" autocomplete="off">
<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
<input type="hidden" name="op" value="list">

<div class="panel panel-default">
<div class="panel-heading">
<input type="checkbox" name="" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">选择
<input type="submit" name="delete_selectd" class="btn btn-primary" value="选中删除">

<span style="color:green;margin-left:10px;">排序为升序</span>

<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$attr,'h_name'=>$h_name,'h_tb'=>$h_tb,'tname'=>$tname,'op'=>'parent_add'))?>" title="编辑" class='btn btn-success btn-sm'><i class="fa fa-edit"></i>增加分类</a>
</div>
        
<div class="panel-body">

<table class="table table-hover tb_center">
<thead class="navbar-inner">
<tr>
<th style="width:60px;">删?</th>
<th style="width:100px;" >图片</th>
<th style="width:100px;" >分类名</th>
<th style="width:100px;" >跳转类型</th>
<th style="width:80px;" >入驻量</th>
<!-- <th style="width:60px;">付费</th> -->
<th style="width:60px;" >排序</th>
<!-- <th style="width:60px;">审核</th> -->
<!-- <th style="width:80px;">首页显示</th> -->
<th style="width:60px;">启用</th>
<th style="width:120px;">创建时间</th>
<th style="text-align:center;">操作</th>
</tr>
</thead>
<tbody>
<?php  if($list) { ?>
<?php  if(is_array($list)) { foreach($list as $index => $row) { ?>
<tr>
  <!-- <td><?php  if($row['thumb']) { ?><a href="<?php  echo tomedia($row['thumb']);?>" target="_blank"><img src="<?php  echo tomedia($row['thumb']);?>" style="height:40px;width:40px;"></a><?php  } else { ?><i class="c_gray">无图</i><?php  } ?></td> -->
<td><input type="checkbox" name="ids[]" value="<?php  echo $row['id'];?>" class=""><?php  echo $row['id'];?></td>     
<!-- <td class="row-first"><?php  echo $row['id'];?></td> -->

<td><?php  if($row['img']) { ?><a href="<?php  echo tomedia($row['img']);?>" target="_blank"><img src="<?php  echo tomedia($row['img']);?>" style="height:40px;width:40px;"></a><?php  } else { ?><i class="c_gray">无图</i><?php  } ?></td>

<td><?php  echo $row['tname'];?>

</td>

<td>

<?php  if($row['type']=='0') { ?>
<div class="div_text" style="color:green;">正常分类</div>

<?php  } else if($row['type']=='1') { ?>
<div class="div_text" style="color:red;">关联小程序跳转</div>
<?php  } else if($row['type']=='2') { ?>
<div class="div_text" style="color:blue;">内部图文</div>
<?php  } ?>
</td>
<td>
<?php  if($row['alllookcnt']>0) { ?>
<?php  echo $row['alllookcnt'];?>
<?php  } ?>
</td>
<!-- <td>
<?php  if($row['send_money']>0) { ?>
<?php  echo $row['send_money'];?>
<?php  } else { ?>
<font color="gray">无</font>
<?php  } ?>

</td> -->

<td><?php  echo $row['pxh'];?></td>



<!-- <td>
<?php  if($row['is_audit'] == 1) { ?>
<font color="green">无需审核</font>
 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'is_audit'))?>" class='btn btn-danger btn-sm' onclick="return confirm('确定需审核?')"><i class="fa fa-edit"></i>需审核</a> 
<?php  } else if($row['is_audit'] ==0) { ?>
<font color="gray">需审核</font>
 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'is_audit'))?>" class='btn btn-success btn-sm' onclick="return confirm('确定无需审核?')"><i class="fa fa-edit"></i>无需审核</a> 
<?php  } ?>
</td> -->
<!-- 
<td >
<?php  if($row['show_index'] == 1) { ?>
 <font color="green">首页显示</font>

<?php  } ?>
</td> -->

<td >
<?php  if($row['enable'] == 1) { ?>
 <font color="green">启用</font>
 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'enable'))?>" class='btn btn-danger btn-sm' onclick="return confirm('确定禁用?')"><i class="fa fa-edit"></i>禁用</a> 
<?php  } else { ?>
 <font color="gray">禁用</font>
 <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'enable'))?>" class='btn btn-success btn-sm' onclick="return confirm('确定直启用?')"><i class="fa fa-edit"></i>启用</a> 
<?php  } ?>
</td>



<td><?php  echo date('Y-m-d H:i:s',$row['crtime'])?></td>


<td align="center">
<div class="btn-group">

<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'tname'=>$tname,'op'=>'parent_edit'))?>" title="编辑" class='btn btn-default btn-sm'><i class="fa fa-edit"></i>编辑</a> 
<!-- <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'op'=>'del'))?>" title="删除" class='btn btn-default btn-sm' onclick="return confirm('确定要删除吗?')"><i class="fa fa-remove"></i>删除</a> -->

<a href="javascript:del_tonewType('<?php  echo $row['id'];?>','<?php  echo $row['tname'];?>')" title="删除" class='btn btn-default btn-sm'><i class="fa fa-remove"></i>删除合并</a>

</div>
</td>
</tr>
<?php  } } ?>
<?php  } else { ?>
<tr>
<td colspan="5" align='center'>暂无数据</td>
</tr>
<?php  } ?>
</tbody>
</table>
<?php  echo $result['pager'];?> 
        </div>
    </div>
</form>
</div>
<?php  } else { ?>
<!-- 表单 -->
<div class="main">
<ul class="nav nav-tabs">
<li><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('op'=>'list'));?>">
所有<?php  echo urldecode($h_title);?></a></li>
<?php  if($det['attr']!='0') { ?>
<li ><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('op'=>'parent_list','tname'=>$tname,'id'=>$det['attr']));?>"><?php  echo $tname;?>>>子所有<?php  echo urldecode($h_title);?></a></li>
<?php  } ?>
<li class="active">
<a href="#">
<?php  if(!empty($id)) { ?>修改<?php  } else { ?>添加<?php  } ?>
<?php  if($det['attr']!='0') { ?>二级<?php  } else { ?>一级<?php  } ?>
<?php  echo urldecode($h_title);?>
<?php  if($tname!='') { ?>&nbsp;&nbsp;上级分类:<?php  echo $tname;?><?php  } ?>



</a></li>
</ul>
<div style="padding-top:5px;"></div>   
<div class="">
<form action="" class="form-horizontal form" method="post" autocomplete="off">
<input type="hidden" name="id" value="<?php  echo $det['id'];?>">
<input type="hidden" name="op" value="<?php  echo $_GPC['op'];?>">
<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
<input type="hidden" name="attr" value="<?php  echo $det['attr'];?>" /> 

<input type="hidden" name="pattr" value="<?php  echo $det['attr'];?>" /> 
<input type="hidden" name="pattrname" value="<?php  echo $tname;?>" /> 
<div class="panel panel-default">
<!-- <div class="panel-heading" id="paoject_info">
<?php  if(!empty($id)) { ?>修改<?php  } else { ?>添加<?php  } ?><?php  echo urldecode($h_title);?>
</div> -->
<div class="panel-body">

<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>分类名：</label>
<div class="col-sm-8">
<input type="text" required class="form-control" name="tname" autocomplete="off" value="<?php  echo $det['tname'];?>" />
</div></div>

<!-- <div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>费用</label>
<div class="col-sm-8">
 
 <div class="input-group">
  <span class="input-group-addon">￥</span>
  <input type="number" required class="form-control" step="0.01" name="send_money" value="<?php  echo $det['send_money'];?>" />  
  <span class="input-group-addon">元</span>
</div>
 <p class="form-control-static" style="color:gray;">为0时认为免费发帖</p>
 </div>
      </div> -->
</div>

<!-- <div class="form-group">
<label class="col-md-2 control-label">敏感词</label>
<div class="col-sm-8">
<textarea class="form-control" name="warn_words" placeholder="敏感词变*"><?php  echo $det['warn_words'];?></textarea>                                  
</div>
</div> -->

<!-- 
<div class="form-group">
<label class="col-md-2 control-label">是否需要审核</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['is_audit']==1) { ?>active<?php  } ?>">
<input type="radio" name="is_audit" value="1" <?php  if($det['is_audit']==1) { ?>checked="true"<?php  } ?>>无需审核
</label>
<label class="btn btn-primary  <?php  if($det['is_audit']==0) { ?>active<?php  } ?>">    
<input type="radio" name="is_audit" value="0" <?php  if($det['is_audit']==0) { ?>checked="true"<?php  } ?>>需要审核
</label></div></div>
</div> -->

<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>图片</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<?php  echo tpl_form_field_image('img',$det['img']);?>
</div></div>
</div>

<?php  if($show_index) { ?>
<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>首页显示</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['show_index']==1) { ?>active<?php  } ?>">
<input type="radio" name="show_index" value="1" <?php  if($det['show_index']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($det['show_index']==0) { ?>active<?php  } ?>">    
<input type="radio" name="show_index" value="0" <?php  if($det['show_index']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>
<?php  } else { ?>
<input type="hidden" name="show_index" value="0" /> 
<?php  } ?>

<div class="form-group">
<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序：</label>
<div class="col-sm-8">
<input type="number" class="form-control" name="pxh" autocomplete="off" value="<?php  echo $det['pxh'];?>" />
</div></div>


<!-- <div class="form-group">
<label class="col-md-2 control-label">管理员Openid</label>
<div class="col-sm-8">
<textarea class="form-control" name="manager_openid" placeholder="分类管理员"><?php  echo $det['manager_openid'];?></textarea>                                  
</div>
</div> -->

<div class="form-group">
<label class="col-md-2 control-label">启用状态</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['enable']==1) { ?>active<?php  } ?>">
<input type="radio" name="enable" value="1" <?php  if($det['enable']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($det['enable']==0) { ?>active<?php  } ?>">    
<input type="radio" name="enable" value="0" <?php  if($det['enable']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>







<div class="form-group">
<label class="col-md-2 control-label">跳转类型</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">

<label class="btn btn-primary  <?php  if($det['type']==0) { ?>active<?php  } ?>">    
<input type="radio" onChange="mtype_change(this.value)" name="type" value="0" <?php  if($det['type']==0) { ?>checked="true"<?php  } ?>>正常分类
</label>

<label class="btn btn-primary <?php  if($det['type']==1) { ?>active<?php  } ?>">
<input type="radio" onChange="mtype_change(this.value)" name="type" value="1" <?php  if($det['type']==1) { ?>checked="true"<?php  } ?>>跳转关联小程序
</label>

<label class="btn btn-primary <?php  if($det['type']==2) { ?>active<?php  } ?>">
<input type="radio" onChange="mtype_change(this.value)" name="type" value="2" <?php  if($det['type']==2) { ?>checked="true"<?php  } ?>>内部图文
</label>

</div></div>
</div>

<div id="div_wx_app" style="border:2px dashed #99CC66">

<div class="form-group"><label class="col-xs-12 col-sm-3 col-md-2 control-label">小程序id</label><div class="col-sm-8">
<input type="text" class="form-control" name="rd_wx_appid" autocomplete="off" value="<?php  echo $det['rd_wx_appid'];?>" />
<p class="form-control-static" style="color:gray;">要打开的小程序 appId</p>
</div></div>

<div class="form-group"><label class="col-xs-12 col-sm-3 col-md-2 control-label">小程序路径</label><div class="col-sm-8">
<input type="text" class="form-control" name="rd_wx_path" autocomplete="off" value="<?php  echo $det['rd_wx_path'];?>" />
<p class="form-control-static" style="color:gray;">打开的页面路径,如果为空则打开首页, 示例:pages/index/index?id=123</p>
</div></div>

<div class="form-group"><label class="col-xs-12 col-sm-3 col-md-2 control-label">小程序参数</label><div class="col-sm-8">
<input type="text" class="form-control" name="rd_wx_extradata"  id="rd_wx_extradata" autocomplete="off" value="<?php  echo $det['rd_wx_extradata'];?>" placeholder="请输入键值对　参考下方示例:" />
<p class="form-control-static" style="color:gray;"> <font color="red">请输入键值对:示例 {"test":1},键名带双引号,皱值文本也请带双引号</font>  ,需要传递给目标小程序的数据，目标小程序可在 App.onLaunch()，App.onShow() 中获取到这份数据</p>
</div></div>


<div class="form-group"><label class="col-xs-12 col-sm-3 col-md-2 control-label">小程序版本</label><div class="col-sm-8">
<select class="form-control" name="rd_wx_envversion">
<option value="release" <?php  if($det['rd_wx_envversion']=='release') { ?>selected<?php  } ?>>正式版</option>
<option value="trial" <?php  if($det['rd_wx_envversion']=='trial') { ?>selected<?php  } ?>>体验版</option>
<option value="develop" <?php  if($det['rd_wx_envversion']=='develop') { ?>selected<?php  } ?>>开发版</option>
</select>

<p class="form-control-static" style="color:gray;">要打开的小程序版本，有效值 develop（开发版），trial（体验版），release（正式版） ，仅在当前小程序为开发版或体验版时此参数有效；如果当前小程序是体验版或正式版，则打开的小程序必定是正式版。默认值 release</p>

</div></div>




</div>


<div id="div_tw" style="border:2px dashed #99CC66">

<div class="form-group"><label class="col-xs-12 col-sm-3 col-md-2 control-label">图文-标题:</label><div class="col-sm-8">
<input type="text" class="form-control" name="rd_tw_title" autocomplete="off" value="<?php  echo $det['rd_tw_title'];?>" />
</div></div>



<div class="form-group" >
<label class="col-md-2 control-label">图文-图片集</label>
<div class="col-sm-8">
<div class="input-group">
  <?php  echo tpl_form_field_multi_image('rd_tw_imglist',$det['rd_tw_imglist']);?>
</div>
</div>
</div>


<div class="form-group" >
<label class="col-md-2 control-label">图文-内容</label>
<div class="col-sm-8">
<div class="input-group">
<?php  echo tpl_ueditor('rd_tw_rmk',$det['rd_tw_rmk']);?>
</div>
</div>
</div>

</div>



<div class="form-group">
<label class="col-xs-12 col-sm-3 col-md-2 control-label">&nbsp;</label>
<div class="col-sm-9">
<button type="submit" class="btn btn-success col-lg-1" name="submit" value="提交">提交</button>
</div>
</div>

</div>
</div>
</form>
</div>

</div>


<script type="text/javascript">
function mtype_change(el){
if(el=='0'){
$("#div_wx_app").hide();
$("#div_tw").hide();
}else if(el=='1'){
$("#div_wx_app").show();
$("#div_tw").hide(); 
}else if(el=='2'){
$("#div_wx_app").hide();
$("#div_tw").show(); 
}

}


var mtype="<?php  echo $det['type'];?>";
mtype_change(mtype);



var test="<?php  echo $det['rd_wx_extradata'];?>";
var obj = eval('(' + test + ')');
console.log(JSON.stringify(obj));

$("#rd_wx_extradata").val(JSON.stringify(obj));

</script>




<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<SCRIPT Language=VBScript><!--

//--></SCRIPT>