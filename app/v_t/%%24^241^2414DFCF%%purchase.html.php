<?php /* Smarty version 2.6.26, created on 2015-12-29 12:52:26
         compiled from simpla/purchase/purchase.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/purchase/purchase.html', 11, false),)), $this); ?>
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
  <p id="page-intro">商品入库。带<font class="red"> * </font>为必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>商品入库</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/purchase/index"), $this);?>
">库存情况</a></li>
        <li><a href="#tab1" class="default-tab">添加库存</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/purchase/purchase','data' => "ac=".($this->_tpl_vars['ac'])), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
            <input type="hidden" name="goods_id" value="<?php echo $this->_tpl_vars['goods']['goods_id']; ?>
" />
                  <?php if ($this->_tpl_vars['goods']['goods_name']): ?><p><label>商品名称：<?php echo $this->_tpl_vars['goods']['goods_name']; ?>
</label></p><?php endif; ?>
                  <p><label><font class="red"> * </font>商品条形码：</label>
                    <input type="text" value="<?php echo $this->_tpl_vars['goods']['goods_sn']; ?>
" class="text-input small-input" name="goods_sn" id="goods_sn" /><span></span>
                    </p>
                  <p><label class="w80"><font class="red"> * </font>数量：</label>
                    <input type="text" value="" class="text-input min-input" name="in_num" id="in_num" /><span></span><br /><small>记重商品单位为千克</small>
                    </p>
                  <p><label class="w80"><font class="red"> * </font>进价：</label>
                    <span><input type="text" value="<?php echo $this->_tpl_vars['goods']['in_price']; ?>
" class="text-input min-input" name="in_price" id="in_price" />元</span>
                    </p>
              <dt>
                <input type="submit" name="" class="button" id="button" value="入库" />
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