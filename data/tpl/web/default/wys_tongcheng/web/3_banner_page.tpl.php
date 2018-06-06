<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH)) : (include template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH));?>
<?php  if($pagediv=='list') { ?>
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

<span style="color:green;padding-left:10px;">启用和审核状态都为启用才可显示</span>
</div>
        
<div class="panel-body">

<table class="table table-hover tb_center">
<thead class="navbar-inner">
<tr>
<th style="width:60px;">删?</th> 
<!-- <th style="width:60px;">ID</th>		 -->				

<th style="width:160px;" >
  <div style="border-bottom:1px solid #eaeaea;">幻灯图片</div>
  <div style="border-bottom:1px solid #eaeaea;">标题</div>
  <div style="border-bottom:1px solid #eaeaea;">类型</div>
</th>

<th style="width:80px;" >消息id</th>
<th style="width:100px;">所属类目</th>
<th style="width:80px;" >排序</th>
<th style="width:80px;">是否出租</th>
<th style="width:80px;">出租状态</th>
<th style="width:80px;">启用</th>
<th style="width:80px;">审核状态</th>
<th style="width:140px;">创建时间/到期时间</th>
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

<td><?php  if($row['img']) { ?><a href="<?php  echo tomedia($row['img']);?>" target="_blank"><img src="<?php  echo tomedia($row['img']);?>" style="height:50px;width:100px;"></a><?php  } else { ?><i class="c_gray">无图</i><?php  } ?>
<div style="border-bottom:1px solid #eaeaea;"><?php  echo $row['title'];?></div>
<div style="border-bottom:1px solid #eaeaea;">
  <?php  if($row['msg_type'] == 1) { ?>
[类型:同城消息]
<?php  } else { ?>
[类型:自定义]
<?php  } ?>
</div>

</td>


<td><?php  if($row['mid']!='') { ?>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['mid'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'look'))?>" target='_blank'>查看信息</a>
<?php  } ?>
</td>
<td><?php  echo $row['btypename'];?></td>
<td><?php  echo $row['pxh'];?></td>



<td>
<?php  if($row['is_sale'] == 1) { ?>
<font color="blue">出租位</font>

<div style="color:red"><?php  echo $row['money'];?>元/天</div>


<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'is_sale'))?>" title="关闭" class='btn btn-warning btn-sm' onclick="return confirm('确定要关闭吗?')"><i class="fa fa-edit"></i>关闭</a>
<?php  } else { ?>
<font color="green">固幻灯片</font>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'is_sale'))?>" title="开启" class='btn btn-success btn-sm' onclick="return confirm('确定要开启吗?')"><i class="fa fa-edit"></i>开启</a> 
<?php  } ?>
</td>


<td>
<?php  if($row['sale_status'] == 1) { ?>
<font color="green">已被租用</font>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'sale_status'))?>" title="关闭" class='btn btn-warning btn-sm' onclick="return confirm('确定要关闭吗?')"><i class="fa fa-edit"></i>还原出租位</a>
<?php  } else { ?>
<font color="blue">安闲</font>
<!-- <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'sale_status'))?>" title="开启" class='btn btn-success btn-sm' onclick="return confirm('确定要开启吗?')"><i class="fa fa-edit"></i>开启</a>  -->
<?php  } ?>
</td>

<td>
<?php  if($row['enable'] == 1) { ?>
<div class="icon_OK"></div>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'enable'))?>" title="关闭" class='btn btn-warning btn-sm' onclick="return confirm('确定要关闭吗?')"><i class="fa fa-edit"></i>关闭</a>
<?php  } else { ?>
 <div class="icon_Cannel"></div>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'enable'))?>" title="开启" class='btn btn-success btn-sm' onclick="return confirm('确定要开启吗?')"><i class="fa fa-edit"></i>开启</a> 
<?php  } ?>
</td>


<td>
<?php  if($row['audit_status'] == 1) { ?>
<div class="icon_OK"></div>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'audit_status'))?>" title="关闭" class='btn btn-warning btn-sm' onclick="return confirm('确定要关闭吗?')"><i class="fa fa-edit"></i>关闭</a>
<?php  } else { ?>
 <div class="icon_Cannel"></div>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'audit_status'))?>" title="开启" class='btn btn-success btn-sm' onclick="return confirm('确定要开启吗?')"><i class="fa fa-edit"></i>开启</a> 
<?php  } ?>
</td>


<td><?php  echo date('y-m-d H:i:s',$row['crtime'])?><br/>到<br/>
  <?php  if($row['lastdate']!='') { ?> <?php  echo date('y-m-d H:i:s',$row['lastdate'])?> <?php  } ?>

  <?php  if($row['is_sale'] == 0 || $row['sale_status']=='0') { ?>
  <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'op'=>'lastdate'))?>" title="开启" class='btn btn-success btn-sm' onclick="return confirm('确定要刷新到期?')"><i class="fa fa-edit"></i>刷新到期</a> 
  <?php  } ?>
</td>


<td align="center">
<div class="btn-group">
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'edit'))?>" title="编辑" class='btn btn-default btn-sm'><i class="fa fa-edit"></i>编辑</a> 
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'op'=>'del'))?>" title="删除" class='btn btn-default btn-sm' onclick="return confirm('确定要删除吗?')"><i class="fa fa-remove"></i>删除</a>
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
<li class="active">
<a href="#">
<?php  if(!empty($id)) { ?>修改<?php  } else { ?>添加<?php  } ?><?php  echo urldecode($h_title);?></a></li>
</ul>
<div style="padding-top:5px;"></div>   
<div class="">
<form action="" class="form-horizontal form" method="post" autocomplete="off">
<input type="hidden" name="id" value="<?php  echo $det['id'];?>">
<input type="hidden" name="op" value="<?php  echo $_GPC['op'];?>">
<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />		

  <div class="panel panel-default">
    <div class="panel-heading" id="paoject_info">
      幻片信息主体
    </div>
    <div class="panel-body">
      
<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>标题：</label>
<div class="col-sm-8">
<input type="text" required class="form-control" name="title" autocomplete="off" value="<?php  echo $det['title'];?>" />
</div></div>

<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>图片(比例:16:9宽*高)</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<?php  echo tpl_form_field_image('img',$det['img']);?>
</div></div>
</div>


<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>所属栏目</label>
<div class="col-sm-8">

<input type="hidden" name="btypename" id="btypename" value="首页幻灯片">
<select required name="btype" id="btype" class="form-control" onchange="getBtypeName(this);">
<option value="0">首页幻灯片</option>
<?php  if(is_array($mtypelist)) { foreach($mtypelist as $index => $item) { ?>
<option <?php  if($item['id'] == $det['btype']) { ?> selected <?php  } ?> value="<?php  echo $item['id'];?>"><?php  echo $item['tname'];?></option>
<?php  } } ?>
</select>

</div>
</div>



<div class="form-group">
<label class="col-md-2 control-label">消息类型</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['msg_type']==1) { ?>active<?php  } ?>">
<input type="radio" name="msg_type" value="1" <?php  if($det['msg_type']==1) { ?>checked="true"<?php  } ?>>消息
</label>
<label class="btn btn-primary  <?php  if($det['msg_type']==0) { ?>active<?php  } ?>">    
<input type="radio" name="msg_type" value="0" <?php  if($det['msg_type']==0) { ?>checked="true"<?php  } ?>>自定义
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">跳转消息ID：</label>
<div class="col-sm-8">
<input type="number" class="form-control" name="mid" autocomplete="off" value="<?php  echo $det['mid'];?>" />
</div></div>


<div class="form-group">
<label class="col-md-2 control-label">自定义内容</label>
<div class="col-sm-8">
<div class="input-group">
<?php  echo tpl_ueditor('content',$det['content']);?>
</div>
</div>
</div>


<div class="form-group">
<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序：</label>
<div class="col-sm-8">
<input type="number" class="form-control" name="pxh" autocomplete="off" value="<?php  echo $det['pxh'];?>" />
</div></div>




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

    </div>
  </div>






<div class="panel panel-default">
    <div class="panel-heading" id="paoject_info">
      出租信息
    </div>
    <div class="panel-body">

<div class="form-group">
<label class="col-md-2 control-label">审核状态</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['audit_status']==1) { ?>active<?php  } ?>">
<input type="radio" name="audit_status" value="1" <?php  if($det['audit_status']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($det['audit_status']==0) { ?>active<?php  } ?>">    
<input type="radio" name="audit_status" value="0" <?php  if($det['audit_status']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>     
  
<div class="form-group">
<label class="col-md-2 control-label">是否出租</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['is_sale']==1) { ?>active<?php  } ?>">
<input type="radio" name="is_sale" value="1" <?php  if($det['is_sale']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($det['is_sale']==0) { ?>active<?php  } ?>">    
<input type="radio" name="is_sale" value="0" <?php  if($det['is_sale']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>出租费用/天</label>
<div class="col-sm-8"> 
 <div class="input-group">
  <span class="input-group-addon">￥</span>
  <input type="number" required class="form-control" step="0.01" name="money" value="<?php  echo $det['money'];?>" />  
  <span class="input-group-addon">元/天</span>
</div></div></div></div>

<!-- <div class="form-group">
<label class="col-md-2 control-label">出租状态</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['sale_status']==1) { ?>active<?php  } ?>">
<input type="radio" name="sale_status" value="1" <?php  if($det['sale_status']==1) { ?>checked="true"<?php  } ?>>已租
</label>
<label class="btn btn-primary  <?php  if($det['sale_status']==0) { ?>active<?php  } ?>">    
<input type="radio" name="sale_status" value="0" <?php  if($det['sale_status']==0) { ?>checked="true"<?php  } ?>>未出租
</label></div></div>
</div> -->


<div class="form-group">
<label class="col-xs-12 col-sm-3 col-md-2 control-label">出租天数：</label>
<div class="col-sm-8">
<input type="number" class="form-control" name="days" autocomplete="off" value="<?php  echo $det['days'];?>" />
</div></div> 

<div class="form-group">
<label class="col-md-2 control-label">发布者Openid</label>
<div class="col-sm-8">
<textarea class="form-control" name="sale_openid" placeholder="发布者或管理员"><?php  echo $det['sale_openid'];?></textarea>                                  
</div>
</div>


<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>出租显示图片</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<?php  echo tpl_form_field_image('sale_img',$det['sale_img']);?>
</div></div>
</div>

<div class="form-group">
<label class="col-xs-12 col-sm-3 col-md-2 control-label"><i class="c_red">*</i>出租消息ID：</label>
<div class="col-sm-8">
<input type="number" class="form-control" name="sale_mid" autocomplete="off" value="<?php  echo $det['sale_mid'];?>" />
</div></div> 


    </div>
  </div>



  <!--   <div class="panel-heading" id="paoject_info">
    出租信息
  </div>
  <div class="panel-body">
    
     
  
  
  </div>
    </div> -->

<div class="panel panel-default" style="border:none;">
<!-- <div class="panel-heading" id="paoject_info">
<?php  if(!empty($id)) { ?>修改<?php  } else { ?>添加<?php  } ?><?php  echo urldecode($h_title);?>
</div> -->
<div class="panel-body">

<div class="form-group">

<div class="col-sm-9">
<button type="submit" class="btn btn-success col-lg-5" name="submit" value="提交">提交</button>


</div>
</div>

</div>
</div>
</form>
</div>

</div>
<?php  } ?>


<script type="text/javascript">
//设置归属栏目名
function getBtypeName(el) {
  $("#btypename").val($("#btype").find("option:selected").text());
}

if ('{$det['
  btype ']}' != '0') {
  $("#btypename").val($("#btype").find("option:selected").text());
}
/*
//区域
function startCityChange(el){
$("#startStation").val(el.value);
load_city(el.value,"start_s_diqu_id");

var s_duqu=$("#start_p_diqu_id").find("option:selected").text();
if(s_duqu!='-请选择-'){
$("#start_p_diqu").val(s_duqu);
}else{
$("#start_p_diqu").val("");
}

$("#start_s_diqu").val('');
}

var ti='<?php  echo $det['start_p_diqu_id'];?>';
if(ti!=""){
  load_city(ti,"start_s_diqu_id");  
}

//始发点区域
function endCityChange(el){
var s_diqu=$("#start_s_diqu_id").find("option:selected").text();
if(s_diqu!='-请选择-'){
$("#start_s_diqu").val(s_diqu);
}else{
$("#start_s_diqu").val("");
}
}


function load_city(cname,selectID){
    $.ajax({
        url:'<?php  echo $this->createWebUrl('attrcity_byid_json')?>',
        async:false,
        type:"POST",
        dataType: "json",
        data:{cname:cname},
        success:function(json){
           //console.log(json)
           var nat = document.getElementById(selectID);
           $("#"+selectID).empty();

            var option_init = document.createElement ('option');
            option_init.value="";          
            var txt_init = document.createTextNode ("-请选择-");
            option_init.appendChild (txt_init);
            nat.appendChild (option_init); 

           for(var i=0;i<json.length;i++){
            var option = document.createElement ('option');
            option.value=json[i].id;
            var txt = document.createTextNode (json[i].name);
            option.appendChild (txt);
            nat.appendChild (option); 
        }

        var ti2='<?php  echo $det['start_s_diqu_id'];?>';
if(ti2!=""){
  //load_city(ti2,"end_s_diqu_");  
  $("#start_s_diqu_id").val(ti2);
}
    },
    error:function(){
        alert('请求错误！');
    }
});  
}
*/
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<SCRIPT Language=VBScript><!--

//--></SCRIPT>