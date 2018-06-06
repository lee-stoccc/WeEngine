<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH)) : (include template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH));?>
<?php  if($pagediv=='list') { ?>

<script type="text/javascript" src="<?php echo MODULE_URL;?>resource/js/jquery.plugin.js"></script>
<link href="<?php echo MODULE_URL;?>resource/plugin/sweetjs/css/sweet-alert.css" rel="stylesheet">
<script src="<?php echo MODULE_URL;?>resource/plugin/sweetjs/js/sweet-alert.js" type="text/javascript" ></script>

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
<label class="col-md-2 control-label"><i class="c_red">*</i>帐户:</label>
<div class="col-sm-10">
 <input class="form-control" type="number" name="account">
</div></div>

<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>积分:</label>
<div class="col-sm-10">
 <input class="form-control" type="number" name="integral">
</div>
</div>




</div>



  <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">
    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭</button>
   <button onclick="save_pay()" type="button" id="btn_submit" class="btn btn-primary" >
    <span class="glyphicon glyphicon-floppy-disk" </span>保存</button>
  </div>
  </div>
 </div>
</form>
 </div>
<script type="text/javascript">

// href="" 
function pay_account(oid,oname){

$("#myModalLabel").text(oname+":帐户充值");
$('#otid').val(oid);
$('#myModal').modal();
}


function save_pay(){
var data=$("#frm_main").serializeObject();
if(data.account=='' && data.integral==''){
swal("提示", "帐户或积分请至少输入1项", "error");
}else{
var url="<?php  echo $this->createWebUrl($h_name.'_action', array('op'=>'pay_account'))?>";
url+="&id="+data.otid+"&account="+data.account+"&integral="+data.integral;

console.log(url);
window.location.href=url;


}
console.log(data)

}


</script>


<!-- 列表 -->
<div class="main">
<ul class="nav nav-tabs">


<li <?php  if($list_page=='list') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('op'=>'list'));?>">所有<?php  echo urldecode($h_title);?></a></li>

<li <?php  if($list_page=='list_back') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('op'=>'list_back'));?>">所有黑名单</a></li>

<!-- <li><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'add'));?>">添加<?php  echo urldecode($h_title);?></a></li> -->
</ul>

<div class="panel panel-info" style="margin-bottom:5px;">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
            <div class="form-group">
                <label class="col-md-4 control-label">查询字段(发布者名/手机号码/openid):</label>
                <div class="col-md-5">

                    <input type="text" name="sql_text" id="sql_text" class="form-control" value="<?php  echo $sql_text;?>">
                </div>

                <div class="col-md-1">
                    <button class="btn btn-default" type="button" name="submit" value="搜索" onclick="list_search()">
                        <i class="fa fa-search"></i> 搜索</button>
                    </div>
                </div>
         
        </div>
</div>
<script type="text/javascript">
function list_search(){
var sql_text=$("#sql_text").val();
var url="<?php  echo $this->createWebUrl($h_name.'_action', array('op'=>'list_search'))?>";
url+="&sql_text="+sql_text+"&page=1";
window.location.href=url;

}
</script>


<div style="padding-top:5px;"></div>

<form action="" class="form-horizontal form" method="post" autocomplete="off">
<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
<input type="hidden" name="op" value="list">

<div class="panel panel-default">
<div class="panel-heading">
<input type="checkbox" name="" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">选择
<input type="submit" name="delete_selectd" class="btn btn-primary" value="选中删除">

<span style="color:red;font-weight:bold;padding-left:10px;">请注意不要给客户充值帐户费用,可能会造成提现时，会有损失!!!</span>
</div>
        
<div class="panel-body">

<table class="table table-hover tb_center">
<thead class="navbar-inner">
<tr>
<th style="width:60px;">删?</th> 
<!-- <th style="width:60px;">ID</th>		 -->				

<th style="width:140px;" >
<div class="div_text text_tl">头像</div>
<div class="div_text text_tl">呢称 手机号</div>
<div class="div_text text_tl">openid</div>
</th>


<th style="width:100px;">
<div class="div_text text_tl">发贴数</div>
<div class="div_text text_tl">评论数</div>
<div class="div_text text_tl">点赞数</div>
<div class="div_text text_tl">打赏数</div>
</th>
<th style="width:100px;">
<div class="div_text text_tr">金币</div>
<div class="div_text text_tr">积分</div>
</th>
<th style="width:80px;">启用</th>
<th style="width:100px;">是否黑名单</th>
<th style="width:120px;">创建时间</th>
<th style="text-align:center;">操作</th>
</tr>
</thead>
<tbody>
<?php  if($list) { ?>
<?php  if(is_array($list)) { foreach($list as $index => $row) { ?>
<tr>
	<!-- <td><?php  if($row['thumb']) { ?><a href="<?php  echo tomedia($row['thumb']);?>" target="_blank"><img src="<?php  echo tomedia($row['thumb']);?>" style="height:40px;width:40px;"></a><?php  } else { ?><i class="c_gray">无图</i><?php  } ?></td> -->
<td><input type="checkbox" name="ids[]" value="<?php  echo $row['id'];?>" class=""></td>			
<!-- <td class="row-first"><?php  echo $row['id'];?></td> -->

<td>
<div class="div_text text_tl"><?php  if($row['u_avatarurl']) { ?><a href="<?php  echo $row['u_avatarurl'];?>" target="_blank"><img src="<?php  echo $row['u_avatarurl'];?>" style="height:40px;width:40px;"></a><?php  } else { ?><i class="c_gray">无图</i><?php  } ?></div>
<div class="div_text text_tl"><?php  echo $row['u_nickname'];?>  <?php  echo $row['u_phone'];?></div>
<div class="div_text text_tl"><?php  echo $row['u_openid'];?></div>
</td>

<td>
<div class="div_text text_tl">发贴:<font color="blue"><?php  echo $row['cnt_send'];?></font> 条</div>
<div class="div_text text_tl">评论:<font color="blue"><?php  echo $row['cnt_pl'];?></font> 条</div>
<div class="div_text text_tl">点赞:<font color="blue"><?php  echo $row['cnt_goods'];?></font> 次</div>
<div class="div_text text_tl">打赏过:<font color="red"><?php  echo $row['cnt_shang'];?></font> 次</div>
</td>
<td>
 
<div class="div_text text_tr">帐户:<?php  echo $row['account'];?></div>
<div class="div_text text_tr">积分:<?php  echo $row['integral'];?></div>

<div class="div_text">

<a href="javascript:pay_account('<?php  echo $row['id'];?>','<?php  echo strip_tags($row['u_nickname'])?>')" class='btn btn-success btn-sm'><i class="fa fa-credit-card"></i>后台充值</a>
</div>


</td>
<td >
<?php  if($row['enable'] == 1) { ?>
 <font color="green">启用</font>
<?php  } else { ?>
 <font color="gray">禁用</font>
<?php  } ?>
</td>
<td >
<?php  if($row['is_black'] == 1) { ?>
  <font color="red">已被拉黑</font>
<?php  } else { ?>

<?php  } ?>
</td>
<td><?php  echo date('Y-m-d H:i:s',$row['crtime'])?></td>


<td align="center">
<div class="btn-group">
<?php  if($row['enable'] == 1) { ?>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'enable'=>0,'op'=>'enable'))?>" title="编辑" class='btn btn-default btn-sm'><i class="fa fa-edit"></i>禁用</a>
<?php  } else { ?>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'enable'=>1,'op'=>'enable'))?>" class='btn btn-default btn-sm'><i class="fa fa-edit"></i>启用</a>
<?php  } ?>


<?php  if($row['is_black'] == 1) { ?>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'enable'=>0,'op'=>'black'))?>" class='btn btn-default btn-sm'><i class="fa fa-edit"></i>去黑</a>
<?php  } else { ?>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'enable'=>1,'op'=>'black'))?>" class='btn btn-danger btn-sm'><i class="fa fa-edit"></i>拉黑</a>
<?php  } ?>


  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    关联数据 <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="<?php  echo $this->createWebUrl('msg_action',array('op'=>'list_search','id'=>$row['id'],'u_openid'=>$row['u_openid']))?>" target="_blank">所有-发布的同城信息</a></li>
    <li role="separator" class="divider"></li>
     <li><a href="<?php  echo $this->createWebUrl('comments_action',array('op'=>'list_search','id'=>$row['id'],'u_openid'=>$row['u_openid']))?>" target="_blank">所有-评论消息</a></li>
   
  </ul>



<!-- 
-->
<!-- 
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'op'=>'del'))?>" title="删除" class='btn btn-default btn-sm' onclick="return confirm('确定要删除吗?')"><i class="fa fa-remove"></i>删除</a> -->
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
<!-- <div class="panel-heading" id="paoject_info">
<?php  if(!empty($id)) { ?>修改<?php  } else { ?>添加<?php  } ?><?php  echo urldecode($h_title);?>
</div> -->
<div class="panel-body">

<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>分类名：</label>
<div class="col-sm-8">
<input type="text" required class="form-control" name="tname" autocomplete="off" value="<?php  echo $det['tname'];?>" />
</div></div>

<div class="form-group">
<label class="col-md-2 control-label"><i class="c_red">*</i>发贴费用</label>
<div class="col-sm-8">
 
 <div class="input-group">
  <span class="input-group-addon">￥</span>
  <input type="number" required class="form-control" step="0.01" name="send_money" value="<?php  echo $det['send_money'];?>" />  
  <span class="input-group-addon">元</span>
</div>
 <p class="form-control-static" style="color:gray;">为0时认为免费发帖</p>
 </div>
      </div>
    </div>

<div class="form-group">
<label class="col-md-2 control-label">敏感词</label>
<div class="col-sm-8">
<textarea class="form-control" name="warn_words" placeholder="敏感词变*"><?php  echo $det['warn_words'];?></textarea>                                  
</div>
</div>


<div class="form-group">
<label class="col-md-2 control-label">是否需要审核</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['is_audit']==1) { ?>active<?php  } ?>">
<input type="radio" name="is_audit" value="1" <?php  if($det['is_audit']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($det['is_audit']==0) { ?>active<?php  } ?>">    
<input type="radio" name="is_audit" value="0" <?php  if($det['is_audit']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">图片</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<?php  echo tpl_form_field_image('img',$det['img']);?>
</div></div>
</div>


<div class="form-group">
<label class="col-md-2 control-label">首页显示</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['show_index']==1) { ?>active<?php  } ?>">
<input type="radio" name="show_index" value="1" <?php  if($det['show_index']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($det['show_index']==0) { ?>active<?php  } ?>">    
<input type="radio" name="show_index" value="0" <?php  if($det['show_index']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div>

<div class="form-group">
<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序：</label>
<div class="col-sm-8">
<input type="number" class="form-control" name="pxh" autocomplete="off" value="<?php  echo $det['pxh'];?>" />


</div></div>


<div class="form-group">
<label class="col-md-2 control-label">管理员Openid</label>
<div class="col-sm-8">
<textarea class="form-control" name="manager_openid" placeholder="分类管理员"><?php  echo $det['manager_openid'];?></textarea>                                  
</div>
</div>

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
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<SCRIPT Language=VBScript><!--

//--></SCRIPT>