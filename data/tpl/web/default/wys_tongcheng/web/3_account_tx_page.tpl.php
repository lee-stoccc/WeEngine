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
<input type="submit" name="delete_selectd" class="btn btn-primary" value="选中撤销订单">
<!-- 
<span style="color:green;padding-left:10px;">启用和审核状态都为启用才可显示</span> -->
</div>
        
<div class="panel-body">

<table class="table table-hover tb_center">
<thead class="navbar-inner">
<tr>
<th style="width:60px;">删?</th> 
<th style="width:160px;text-align:left;" >提现帐户</th>
<th style="width:190px;text-align:left;" >提现额度及手续费</th>

<th style="width:160px;" >提现操作</th>
<th style="width:180px;">提现反馈</th>
<th style="width:180px;">提现日期</th>
<!-- <th style="text-align:center;">操作</th> -->
</tr>
</thead>
<tbody>
<?php  if($list) { ?>
<?php  if(is_array($list)) { foreach($list as $index => $row) { ?>
<tr>
	<!-- <td><?php  if($row['thumb']) { ?><a href="<?php  echo tomedia($row['thumb']);?>" target="_blank"><img src="<?php  echo tomedia($row['thumb']);?>" style="height:40px;width:40px;"></a><?php  } else { ?><i class="c_gray">无图</i><?php  } ?></td> -->
<td>
  <?php  if($row['status_tx'] != '1') { ?>
  <input type="checkbox" name="ids[]" value="<?php  echo $row['id'];?>" class=""><?php  echo $row['id'];?>
  <?php  } ?>
</td>			
<!-- <td class="row-first"><?php  echo $row['id'];?></td> -->

<td style="text-align:left;">
<div class="div_text">
 <?php  if($row['u_avatarurl']) { ?>
  <a href="<?php  echo $row['u_avatarurl'];?>" target="_blank">
  <img src="<?php  echo $row['u_avatarurl'];?>" style="height:50px;width:50px;"></a><?php  } else { ?><i class="c_gray">无图</i>
  <?php  } ?>
</div>
<div class="div_text"><?php  echo $row['u_nickname'];?></div>
<div class="div_text"><?php  echo $row['u_phone'];?></div>
<!-- <div class="div_text"><?php  echo $row['u_openid'];?></div> -->
</td>


<td style="text-align:left;">
<div class="div_text" style="color:green">实际到帐:￥<?php  echo $row['money_sj'];?>元</div>


<div class="div_text" style="border:1px solid blue;padding:6px;margin-top:5px;margin-bottom:5px;">
<div class="div_text" style="color:blue">手续费率:<?php  echo $row['money_sxfl'];?>% </div>
<div class="div_text" style="color:blue">手续费:￥<?php  echo $row['money_sxf'];?>元</div>

</div>

<div class="div_text">本次提现额:￥<?php  echo $row['money'];?>元</div>
<div class="div_text">提现前 帐户:￥<?php  echo $row['accout'];?>元</div>
<div class="div_text">提现后 帐户:￥<?php  echo $row['accout']-$row['money'];?>元</div>

</td>



<td>
<?php  if($row['enable'] == 1) { ?>
<div style="color:green;">自动提现</div>
<?php  } else if($row['enable'] == 0) { ?>
<div style="color:blue;">手动提现</div>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'enable'))?>" title="开启" class='btn btn-success btn-sm' onclick="return confirm('确定要手动提现?')"><i class="fa fa-edit"></i>手动提现</a> 
<?php  } else if($row['enable'] == -1) { ?>
<div style="color:red;">提现失败,请手动提现</div>
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'isopen'=>1,'op'=>'enable'))?>" title="开启" class='btn btn-success btn-sm' onclick="return confirm('确定要手动提现?')"><i class="fa fa-edit"></i>手动提现</a> 
<?php  } ?>
</td>
<td>
<!-- <div class="div_text"><?php  echo $row['status_tx'];?></div>-->
<?php  if($row['status_tx'] == '1') { ?>
<div style="color:green;">提现成功</div>
<div class="div_text">订单号:<?php  echo $row['partner_trade_no'];?></div>
<div class="div_text"><?php  echo date('y-m-d H:i:s',$row['time_tx'])?></div>
<?php  } else if($row['status_tx'] == '0') { ?>
<div style="color:red;">提现失败</div>
<div class="div_text">提现反馈:<?php  echo $row['rmk_tx'];?></div>
<?php  } ?>

</td>

<td>
<?php  echo date('y-m-d H:i:s',$row['crtime'])?>
</td>


<!-- <td align="center">
<div class="btn-group">
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_title'=>$h_title,'h_name'=>$h_name,'h_tb'=>$h_tb,'op'=>'edit'))?>" title="编辑" class='btn btn-default btn-sm'><i class="fa fa-edit"></i>编辑</a> 
<a href="<?php  echo $this->createWebUrl($h_name.'_action', array('id'=>$row['id'],'h_tb'=>$h_tb,'op'=>'del'))?>" title="删除" class='btn btn-default btn-sm' onclick="return confirm('确定要删除吗?')"><i class="fa fa-remove"></i>删除</a>
</div>
</td> -->


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

<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<SCRIPT Language=VBScript><!--

//--></SCRIPT>