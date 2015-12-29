<?php /* Smarty version 2.6.26, created on 2015-12-29 12:49:19
         compiled from simpla/common/left.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/common/left.html', 8, false),)), $this); ?>
<div id="sidebar">
  <div id="sidebar-wrapper">
    <h1 id="sidebar-title"><a href="<?php echo $this->_tpl_vars['root_dir']; ?>
/"><?php echo $this->_tpl_vars['head_title']; ?>
</a></h1>
    <a href="<?php echo $this->_tpl_vars['root_dir']; ?>
/"><img id="logo" src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/logo.png" alt="<?php echo $this->_tpl_vars['head_title']; ?>
" /></a> 
    <!-- Sidebar Profile links -->
    <div id="profile-links"> 您好, <a href="#" title="编辑资料"><?php echo $this->_tpl_vars['_adminname']; ?>
</a><br />
      <br />
      <a href="<?php echo smarty_function_get_url(array('rule' => "/system/index"), $this);?>
" title="管理首页">管理首页</a> | <a href="<?php echo smarty_function_get_url(array('rule' => "/main/logout"), $this);?>
" title="退出系统">退出系统</a> </div>
    <ul id="main-nav">
	<?php if ($this->_tpl_vars['menu']['category']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'category'): ?>current<?php endif; ?>">分类管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/category/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['menu']['goods']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'goods'): ?>current<?php endif; ?>">商品管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/goods/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['menu']['purchase']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'purchase'): ?>current<?php endif; ?>">进货管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['purchase']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/purchase/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['menu']['sales']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'sales'): ?>current<?php endif; ?>">出货管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['sales']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/sales/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['menu']['statistics']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'statistics'): ?>current<?php endif; ?>">统计管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['statistics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/statistics/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['menu']['account']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'account'): ?>current<?php endif; ?>">帐号管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['account']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/account/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['menu']['member']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'member'): ?>current<?php endif; ?>">会员管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['member']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/member/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['menu']['system']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'system'): ?>current<?php endif; ?>">系统</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['system']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/system/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
    </ul>
  </div>
</div>