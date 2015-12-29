<?php /* Smarty version 2.6.26, created on 2015-12-29 12:52:09
         compiled from simpla/purchase/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/purchase/index.html', 12, false),array('modifier', 'cat', 'simpla/purchase/index.html', 65, false),)), $this); ?>
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
  <p id="page-intro">查看和管理商品库存。</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>库存管理</h3>
      <ul class="content-box-tabs">
        <li><a href="#tab1" class="default-tab">库存情况</a></li>
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/purchase/purchase"), $this);?>
">添加库存</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/purchase/index'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <p>分类： <span>
                <select id="one" name="cat_id">
                  <option value="0">-----选择分类-----</option>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['catelist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                          <option value="<?php echo $this->_tpl_vars['catelist'][$this->_sections['i']['index']]['cat_id']; ?>
" <?php if ($this->_tpl_vars['catelist'][$this->_sections['i']['index']]['cat_id'] == $this->_tpl_vars['cat_id']): ?>selected="selected"<?php endif; ?>>
                          <?php echo $this->_tpl_vars['catelist'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['catelist'][$this->_sections['i']['index']]['cat_name']; ?>

                          </option>
                        <?php endfor; endif; ?>
                </select>
                </span>&nbsp;关键字： <span>
                <input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" />
                （商品名称，条形码）
                <input type="submit" name="" id="button" class="button" value="查询" />
                </span> </p>
            </fieldset>
          </form>
        </div>
        <hr />
        <table>
          <thead>
            <tr>
              <th>商品条形码</th>
              <th>商品名称</th>
              <th>进价(元)</th>
              <th>入库</th>
              <th>库存</th>
              <th>已售</th>
              <th>管理</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td colspan="6"><?php echo $this->_tpl_vars['pagebar']; ?>
</td>
            </tr>
          </tfoot>
          <tbody>
          <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['purchase']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          <tr>
            <td><?php echo $this->_tpl_vars['purchase'][$this->_sections['i']['index']]['goods_sn']; ?>
</td>
            <td><?php echo $this->_tpl_vars['purchase'][$this->_sections['i']['index']]['goods_name']; ?>
</td>
            <td><span class="red"><?php echo $this->_tpl_vars['purchase'][$this->_sections['i']['index']]['in_price']; ?>
</span></td>
            <td><?php echo $this->_tpl_vars['purchase'][$this->_sections['i']['index']]['in_num']; ?>
</td>
            <td><span class="red fb"><?php echo $this->_tpl_vars['purchase'][$this->_sections['i']['index']]['in_num']-$this->_tpl_vars['purchase'][$this->_sections['i']['index']]['out_num']; ?>
</span></td>
            <td><?php echo $this->_tpl_vars['purchase'][$this->_sections['i']['index']]['out_num']; ?>
</td>
            <td><?php if ($this->_tpl_vars['purchase'][$this->_sections['i']['index']]['out_num'] == 0): ?><a onclick="return(confirm('只有入库错误的时候才使用，你确认入库错误?'))" href="<?php echo smarty_function_get_url(array('rule' => '/purchase/purchase','data' => ((is_array($_tmp='ac=del&gid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['purchase'][$this->_sections['i']['index']]['id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['purchase'][$this->_sections['i']['index']]['id']))), $this);?>
" title="删除"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/cross.png" alt="删除" /></a>&nbsp;<?php endif; ?><a href="<?php echo smarty_function_get_url(array('rule' => '/purchase/purchase','data' => ((is_array($_tmp='gid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['purchase'][$this->_sections['i']['index']]['goods_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['purchase'][$this->_sections['i']['index']]['goods_id']))), $this);?>
" title="入库"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/hammer_screwdriver.png" alt="入库" /></a></td>
          </tr>
          <?php endfor; endif; ?>
            </tbody>
        </table>
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