<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH)) : (include template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH));?>
<?php  if($pagediv=='list') { ?>
<!-- 列表 -->
<div class="main">
<ul class="nav nav-tabs">
<li class="active"><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('op'=>'list'));?>">所有<?php  echo urldecode($h_title);?></a></li>

</ul>

<div style="padding-top:5px;"></div>

<form action="" class="form-horizontal form" method="post" autocomplete="off">
<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
<input type="hidden" name="op" value="list">

<div class="panel panel-default">
<div class="panel-heading">
<input type="checkbox" name="" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">选择
<input type="submit" name="delete_selectd" class="btn btn-primary" value="选中删除">
</div>
        
<div class="panel-body">

<table class="table table-hover tb_center">
<thead class="navbar-inner">
<tr>
<th style="width:60px;">删?</th> 
<!-- <th style="width:60px;">ID</th>		 -->				

<th style="width:100px;" >举报消息内容</th>
<th style="width:60px;" >举报内容</th>
<th style="width:80px;" >举报者头像</th>
<th style="width:100px;">举报名名称</th>
<th style="width:80px;">处理状态</th>
<th style="width:140px;">举报时间</th>
<th style="width:140px;">处理时间</th>
<th style="text-align:center;width:140px;">操作</th>
</tr>
</thead>
<tbody>
<?php  if($list) { ?>
<?php  if(is_array($list)) { foreach($list as $index => $row) { ?>
<tr>
<td><input type="checkbox" name="ids[]" value="<?php  echo $row['id'];?>" class=""></td>	
<td><?php  echo $row['msg_content'];?></td>
<td><?php  echo $row['jb_conent'];?></td>

<td><?php  if($row['u_avatarurl']) { ?><a href="<?php  echo $row['u_avatarurl'];?>" target="_blank"><img src="<?php  echo $row['u_avatarurl'];?>" style="height:40px;width:40px;"></a><?php  } else { ?><i class="c_gray">无图</i><?php  } ?></td>

<td><?php  echo $row['u_nickname'];?></td>
<td>
<?php  if($row['cl_state'] == 0) { ?>
<font color="blue">待处理</font>
<?php  } else if($row['cl_state'] == 1) { ?>
<font color="gray">下架</font>
<?php  } else if($row['cl_state'] == 2) { ?>
<font color="red">删除信息</font>
<?php  } ?>
</td>

<!-- <td><?php  if($row['mid']!='') { ?>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['mid'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'look'))?>" target='_blank'>查看信息</a>
<?php  } ?>
</td> -->
<!-- 
<td>
<?php  if($row['is_sale'] == 1) { ?>
 <div class="icon_OK"/>
<?php  } else { ?>
 <div class="icon_Cannel"/>
<?php  } ?>
</td> -->

<td><?php  echo date('y-m-d H:i:s',$row['crtime'])?></td>
<td><?php  if($row['cltime']!='') { ?> <?php  echo date('y-m-d H:i:s',$row['cltime'])?> <?php  } ?></td>


<td align="center">
<div class="btn-group">
<!-- <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'edit'))?>" title="编辑" class='btn btn-default btn-sm'><i class="fa fa-edit"></i>编辑</a> -->
<?php  if($row['cl_state'] == 0) { ?>

<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'mid'=>$row['mid'],'h_tb'=>$h_tb,'op'=>'xiajia'))?>" title="下架" class='btn btn-default btn-sm' onclick="return confirm('下架处理?')"><i class="fa fa-remove"></i>下架</a>
<?php  } else { ?>
已处理

<?php  } ?>

<!-- <a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'op'=>'del'))?>" title="删除" class='btn btn-default btn-sm' onclick="return confirm('确定要删除吗?')"><i class="fa fa-remove"></i>删除</a> -->


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
<label class="col-md-2 control-label"><i class="c_red">*</i>图片</label>
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
<?php  if(is_array($start_diqu)) { foreach($start_diqu as $index => $diqu) { ?>
<option <?php  if($diqu['id'] == $det['btype']) { ?> selected <?php  } ?> value="<?php  echo $diqu['id'];?>"><?php  echo $diqu['name'];?></option>
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
<label class="col-md-2 control-label"><i class="c_red">*</i>出租费用</label>
<div class="col-sm-8"> 
 <div class="input-group">
  <span class="input-group-addon">￥</span>
  <input type="number" required class="form-control" step="0.01" name="money" value="<?php  echo $det['money'];?>" />  
  <span class="input-group-addon">元/天</span>
</div></div></div></div>

<div class="form-group">
<label class="col-md-2 control-label">出租状态</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['sale_status']==1) { ?>active<?php  } ?>">
<input type="radio" name="sale_status" value="1" <?php  if($det['sale_status']==1) { ?>checked="true"<?php  } ?>>已租
</label>
<label class="btn btn-primary  <?php  if($det['sale_status']==0) { ?>active<?php  } ?>">    
<input type="radio" name="sale_status" value="0" <?php  if($det['sale_status']==0) { ?>checked="true"<?php  } ?>>未出租
</label></div></div>
</div>


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


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<SCRIPT Language=VBScript><!--

//--></SCRIPT>