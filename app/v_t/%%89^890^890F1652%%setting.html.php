<?php /* Smarty version 2.6.26, created on 2015-12-29 12:52:59
         compiled from simpla/system/setting.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/system/setting.html', 15, false),)), $this); ?>
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
  <p id="page-intro">系统配置。注意：修改后需要重新登录</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>系统配置</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/system/setting'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <p>
                <label><font class="red"> * </font>系统名称</label>
                <span>
                <input type="text" value="<?php echo $this->_tpl_vars['system_name']; ?>
" class="text-input medium-input" name="system_name" />
                </span> </p><p>
                  <label><font class="red"> * </font>Cookie密匙</label>
                  <span>
                  <input type="text" value="<?php echo $this->_tpl_vars['cookie_key']; ?>
" class="text-input small-input" name="cookie_key" />
                  </span> </p>
              <p>
                <label><font class="red"> * </font>是否启用伪静态</label>
                <span>
                <input type="radio" value="1" name="rewrite" <?php if ($this->_tpl_vars['rewrite'] == 1): ?> checked="checked"<?php endif; ?>/>启用<input type="radio" value="0" name="rewrite" <?php if ($this->_tpl_vars['rewrite'] == 0): ?> checked="checked"<?php endif; ?>/>禁用
                </span> </p>
              <p><label>清空数据</label><input type="checkbox" name="cleartable" value="1" /><span>勾选将清空商品和会员所有数据。管理帐号不会清空。</span></p>
              <p>
                <input type="submit" name="" class="button" value=" 修改 " />
              </p>
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