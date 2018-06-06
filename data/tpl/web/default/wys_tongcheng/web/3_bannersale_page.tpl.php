<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH)) : (include template('web/AJcommonCssAndJs', TEMPLATE_INCLUDEPATH));?>
<?php  if($pagediv=='list') { ?>
<!-- 列表 -->
<div class="main">
<ul class="nav nav-tabs">
<li class="active"><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('op'=>'list'));?>">所有<?php  echo urldecode($h_title);?></a></li>
<!-- <li><a href="<?php  echo $this->createWebUrl($h_name.'_action',array('h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'add'));?>">添加<?php  echo urldecode($h_title);?></a></li> -->
</ul>

<div style="padding-top:5px;"></div>

<form action="" class="form-horizontal form" method="post" autocomplete="off">
<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
<input type="hidden" name="op" value="list">

<div class="panel panel-default">
<div class="panel-heading">
<input type="checkbox" name="" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">选择
<input type="submit" name="delete_selectd" class="btn btn-primary" value="选中删除">

<span style="color:green;padding-left:10px;">所有出租需要审核才有显示</span>
</div>
        
<div class="panel-body">

<table class="table table-hover tb_center">
<thead class="navbar-inner">
<tr>
<th style="width:60px;">删?</th> 

<th style="width:160px;" >
  <div style="border-bottom:1px solid #eaeaea;">幻灯上传图片</div>
  <div style="border-bottom:1px solid #eaeaea;">幻灯位置</div>

  <div style="border-bottom:1px solid #eaeaea;">幻灯排序</div>
</th>

<th style="width:120px;" >
  <div style="border-bottom:1px solid #eaeaea;">出租天数</div>
  <div style="border-bottom:1px solid #eaeaea;">出租天/单价</div>
  <div style="border-bottom:1px solid #eaeaea;">出租总价</div>
</th>
<th style="width:120px;">
<div style="border-bottom:1px solid #eaeaea;"> 查看消息</div>
<div style="border-bottom:1px solid #eaeaea;"> 租借人</div>
<div style="border-bottom:1px solid #eaeaea;"> 联系电话</div>
 </th>
<th style="width:120px;">支付状态</th>
<th style="width:120px;">审核状态</th>
<th style="width:140px;">创建时间/支付到期时间</th>
<th style="text-align:center;">操作</th>
</tr>
</thead>
<tbody>
<?php  if($list) { ?>
<?php  if(is_array($list)) { foreach($list as $index => $row) { ?>
<tr>
<td>

<?php  if($row['lasttime'] < $nowtime) { ?> 
<input type="checkbox" name="ids[]" value="<?php  echo $row['id'];?>" class="">
<?php  } ?>
</td>			


<td><?php  if($row['img']) { ?><a href="<?php  echo tomedia($row['img']);?>" target="_blank"><img src="<?php  echo tomedia($row['img']);?>" style="height:50px;width:100px;"></a><?php  } else { ?><i class="c_gray">无图</i><?php  } ?>
<div style="border-bottom:1px solid #eaeaea;"><?php  echo $row['title'];?></div>
<div style="border-bottom:1px solid #eaeaea;">分类:<?php  echo $row['bn_btypename'];?></div>
<div style="border-bottom:1px solid #eaeaea;">排序:<?php  echo $row['bn_pxh'];?></div>
</td>
<td>
 <div style="border-bottom:1px solid #eaeaea;"><?php  echo $row['bn_days'];?>天</div>
 <div style="border-bottom:1px solid #eaeaea;color:red;">￥:<?php  echo $row['bn_daymoney'];?>元</div>
 <div style="border-bottom:1px solid #eaeaea;color:red;font-weight:bold;">总价:￥:<?php  echo $row['bn_total_money'];?>元</div> 
</td>

<td><?php  if($row['m_id']!='') { ?>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['m_id'],'h_tb'=>$h_tb,'op'=>'look'))?>" target='_blank' style="color:blue;">查看信息</a>
<?php  } ?>
<div style="border-bottom:1px solid #eaeaea;"><?php  echo $row['u_nickname'];?></div>
<div style="border-bottom:1px solid #eaeaea;"><?php  echo $row['u_phone'];?></div>
</td>

<td>
<?php  if($row['paystate'] == 1) { ?>
<font color="green">已支付,待审核</font>

<?php  } else { ?>
<?php  if($row['lasttime'] < $nowtime) { ?>
<font color="gray">过期未支付,可删除</font>
<?php  } else { ?>
<font color="blue">未支付</font>
<?php  } ?>


<?php  } ?>
</td>




<td>
<?php  if($row['audit_status'] == 1) { ?>
<font color="green">已被租用</font>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>0,'op'=>'audit_status'))?>" title="关闭" class='btn btn-warning btn-sm' onclick="return confirm('确定要关闭吗?')"><i class="fa fa-edit"></i>恢复广告位</a>
<?php  } else { ?>
<font color="blue">支付后,才可审核</font>
<?php  if($row['paystate'] == 1) { ?>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'audit_status'))?>" title="开启" class='btn btn-success btn-sm' onclick="return confirm('确定要开启吗?')"><i class="fa fa-edit"></i>审核通过显示</a> 
<?php  } ?>
<?php  } ?>
</td>


<td><?php  echo date('y-m-d H:i:s',$row['crtime'])?><br/>到<br/>
  <?php  if($row['lasttime']!='') { ?> <?php  echo date('y-m-d H:i:s',$row['lasttime'])?> <?php  } ?>
</td>


<td align="center">
<div class="btn-group">
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'edit'))?>" title="编辑" class='btn btn-default btn-sm'><i class="fa fa-edit"></i>编辑</a>


<?php  if($row['lasttime'] < $nowtime) { ?> <?php  } ?>
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
<label class="col-md-2 control-label"><i class="c_red">*</i>图片(比例:16:9宽*高)</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<?php  echo tpl_form_field_image('img',$det['img']);?>
</div></div>
</div>

<div class="form-group">
<label class="col-xs-12 col-sm-3 col-md-2 control-label">总价：</label>
<div class="col-sm-8">
<input type="number" class="form-control" step="0.01" name="bn_total_money" autocomplete="off" value="<?php  echo $det['bn_total_money'];?>" />
</div></div>




<!-- <div class="form-group">
<label class="col-md-2 control-label">启用状态</label>
<div class="col-sm-7">
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-primary <?php  if($det['enable']==1) { ?>active<?php  } ?>">
<input type="radio" name="enable" value="1" <?php  if($det['enable']==1) { ?>checked="true"<?php  } ?>>是
</label>
<label class="btn btn-primary  <?php  if($det['enable']==0) { ?>active<?php  } ?>">    
<input type="radio" name="enable" value="0" <?php  if($det['enable']==0) { ?>checked="true"<?php  } ?>>否
</label></div></div>
</div> -->


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


<script type="text/javascript">
//设置归属栏目名
function getBtypeName(el){
$("#btypename").val($("#btype").find("option:selected").text());
}

if('<?php  echo $det['btype'];?>'!='0'){
  $("#btypename").val($("#btype").find("option:selected").text());
}

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<SCRIPT Language=VBScript><!--

//--></SCRIPT>