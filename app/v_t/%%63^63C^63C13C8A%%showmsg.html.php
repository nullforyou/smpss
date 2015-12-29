<?php /* Smarty version 2.6.26, created on 2015-12-29 12:52:32
         compiled from simpla/common/showmsg.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统提示</title>
<style>
.alert{background-color:#f1f1f1; width:495px;margin:60px auto; font-size:12px; line-height:24px;}
.alert .alert_body{ border:1px solid #cbcbcb;background-color:#fff; width:475px; height:143px; position:relative; top:-5px; left:-5px; padding:10px;}
.alert .alert_body h3{font-size:14px; font-weight:bold; margin:0;}
.alert .alert_body .alertcont{margin:15px 0 0 85px; background:url(<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/images/m_alert.png) left center no-repeat; padding:5px 50px; line-height:18px; color:#666; min-height:30px; _height:30px;}
.alert .alert_body .alertcont a{color:#000; text-decoration:none;}
.alert .alert_body .alertcont span{font-size:12px; font-weight:bold; color:#000;}
.alert .alert_body .btn{text-align:center; padding-top:0px;}
.alert .alert_body .btn img{border:0;}
.alert .alert_body .pi2{background:url(<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/images/m_err.png) left center no-repeat;}
.alert .alert_body .pi1{background:url(<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/images/m_acc.png) left center no-repeat; padding-left:55px;}
</style>
<?php if ($this->_tpl_vars['second'] && $this->_tpl_vars['url']): ?>
<meta http-equiv="refresh" content="<?php echo $this->_tpl_vars['second']; ?>
;URL=<?php echo $this->_tpl_vars['url']; ?>
" />
<?php endif; ?>
</head>
<body>
<div class="alert">
 <div class="alert_body">
  <h3>系统提示</h3>
  <p class="alertcont <?php if ($this->_tpl_vars['state'] == 1): ?>pi1<?php elseif ($this->_tpl_vars['state'] == 2): ?>pi2<?php endif; ?>">
  <span><?php if ($this->_tpl_vars['url']): ?><a href="<?php echo $this->_tpl_vars['url']; ?>
"><?php echo $this->_tpl_vars['msg']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['msg']; ?>
<?php endif; ?></span>
  </p>
	  <p class="btn"><?php if ($this->_tpl_vars['url'] == ''): ?><a href="javascript:history.go(-1);"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/images/return.gif" /> </a><?php else: ?><?php if ($this->_tpl_vars['second']): ?>系统会在<?php echo $this->_tpl_vars['second']; ?>
秒内自动跳转，<a href="<?php echo $this->_tpl_vars['url']; ?>
">如果没有响应请点击此处</a><?php else: ?><a href="<?php echo $this->_tpl_vars['url']; ?>
">转向到目标页面!</a><?php endif; ?><?php endif; ?></p>
 </div>
</div>
</body>
</html>