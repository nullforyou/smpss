<?php /* Smarty version 2.6.26, created on 2015-12-29 12:52:47
         compiled from simpla/account/addaccount.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/account/addaccount.html', 11, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="main-content">
  <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
  <p id="page-intro">添加管理员帐号。</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>添加管理员帐号</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/account/index"), $this);?>
">帐号管理</a></li>
        <li><a href="#tab1" class="default-tab">添加帐号</a></li>
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/account/modifypwd"), $this);?>
">密码修改</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/account/addaccount'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
                <p>
                  <label><font class="red"> * </font>用户名：</label>
                  <span>
                  <input type="text" value="" class="text-input small-input" name="admin_name" />
                  </span> </p>
                <p>
                  <label><font class="red"> * </font>密码：</label>
                  <span>
                  <input type="password" value="" class="text-input small-input" name="pwd" />
                  </span> </p>
                <p>
                  <label><font class="red"> * </font>确认密码：</label>
                  <span>
                  <input type="password" value="" class="text-input small-input" name="pwd2" />
                  </span> </p>
                <p>
                  <label><font class="red"> * </font>选择用户组：</label>
                  <span>
                  <select name="group">
                    <option value="0">选择用户组</option>
					<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['group']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                    <option value="<?php echo $this->_tpl_vars['group'][$this->_sections['i']['index']]['gid']; ?>
"><?php echo $this->_tpl_vars['group'][$this->_sections['i']['index']]['group_name']; ?>
</option>
                    <?php endfor; endif; ?>
                  </select>
                  </span> </p>
              <dt>
                <input type="submit" name="" class="button" id="button" value="添加" />
              </dt>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/copy.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>