<?php /* Smarty version 2.6.26, created on 2015-12-29 12:52:02
         compiled from simpla/category/category.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/category/category.html', 11, false),)), $this); ?>
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
    <p id="page-intro">查看和管理所有分类。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>添加管理</h3>
        <ul class="content-box-tabs">
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/category/index"), $this);?>
">分类管理</a></li>
            <li><a href="#tab1" class="default-tab">添加分类</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<div class="form">
              <form action="<?php echo smarty_function_get_url(array('rule' => '/category/category'), $this);?>
" method="post" id="js-form">
                <fieldset class="clearfix">
                <input type="hidden" value="<?php echo $this->_tpl_vars['category']['cat_id']; ?>
" name="cat_id" />
                      <p><label>所属分类：</label>
                        <span><select id="one" name="pid">
                        <option value="0">-----顶级分类-----</option>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['categorylist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <option value="<?php echo $this->_tpl_vars['categorylist'][$this->_sections['i']['index']]['cat_id']; ?>
" <?php if ($this->_tpl_vars['categorylist'][$this->_sections['i']['index']]['cat_id'] == $this->_tpl_vars['category']['pid']): ?>selected="selected"<?php endif; ?> <?php if ($this->_tpl_vars['categorylist'][$this->_sections['i']['index']]['cat_id'] == $this->_tpl_vars['category']['cat_id']): ?>disabled="disabled"<?php endif; ?>><?php echo $this->_tpl_vars['categorylist'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['categorylist'][$this->_sections['i']['index']]['cat_name']; ?>
</option>
                        <?php endfor; endif; ?>
                        </select></span>
                        </p>
                        <p><label><font class="red"> * </font>分类名称：</label>
                        <span><input type="text" value="<?php echo $this->_tpl_vars['category']['cat_name']; ?>
" class="text-input small-input" name="cat_name" id="cat_name" /></span>
                        </p>
                      <p><label>状态：</label>
                        <span><input name="is_show" type="radio" value="1" <?php if ($this->_tpl_vars['category']['is_show'] == 1): ?>checked="checked"<?php endif; ?>/>启用<input name="is_show" type="radio" value="0" <?php if ($this->_tpl_vars['category']['is_show'] == 0): ?>checked="checked"<?php endif; ?>/>禁用</span>
                        </p>
                    </ul>
                  <dt>
                    <input type="submit" name="" id="button" class="button" value="<?php if ($this->_tpl_vars['category']['cat_id']): ?>编辑<?php else: ?>添加<?php endif; ?>" />
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