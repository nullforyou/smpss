<?php /* Smarty version 2.6.26, created on 2015-12-29 12:51:49
         compiled from simpla/goods/addgoods.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/goods/addgoods.html', 12, false),)), $this); ?>
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
<style>.promote{display:none;}</style>
<div id="main-content">
  <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
  <p id="page-intro">1.你可以在这里添加新的商品或者编辑已有的商品。2.新添加商品的时候可以同时进行入库(入库必须有数量和进价)！3.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>添加商品</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/goods/index"), $this);?>
">商品管理</a></li>
        <li><a href="#tab1" class="default-tab">添加商品</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/goods/addgoods'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['goods']['goods_id']; ?>
" name="goods_id" />
              <p>
                <label><font class="red"> * </font>所属分类：</label>
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
" <?php if ($this->_tpl_vars['catelist'][$this->_sections['i']['index']]['cat_id'] == $this->_tpl_vars['goods']['cat_id']): ?>selected="selected"<?php endif; ?>>
                    <?php echo $this->_tpl_vars['catelist'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['catelist'][$this->_sections['i']['index']]['cat_name']; ?>

                  </option>
            <?php endfor; endif; ?>
                </select>
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>商品条形码：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['goods_sn']; ?>
" class="text-input small-input" name="goods_sn" id="goods_sn" />
                <span></span><input type="button" id="getbarcode" class="button" value="生成条形码" /> &nbsp;<a id="img" style="display:none" href="" target="_blank">查看条形码</a></p>
              <p>
                <label><font class="red"> * </font>商品名称：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['goods_name']; ?>
" class="text-input small-input" name="goods_name" id="goods_name" />
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>商品售价：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['out_price']; ?>
" class="text-input min-input" name="out_price" id="out_price" />
                元 <span></span> </p>
              <p>
                <label>市场价：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['market_price']; ?>
" class="text-input min-input" name="market_price" />
                <span>元</span><br /><small>默认市场价为售价的1.2倍</small> </p>
              <?php if ($this->_tpl_vars['goods']['goods_id'] == ""): ?>
              <p>
                <label>商品进价：</label>
                <input type="text" value="" class="text-input min-input" name="in_price" />
                 <span> 元</span></p>
              <p><label>入库数量：</label>
                <input type="text" value="" class="text-input min-input" name="in_num" />
               <span></span><br /><small>记重商品单位为千克</small> </p>
              <?php endif; ?>
              <p>
                <label>商品重量：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['weight']; ?>
" class="text-input min-input" name="weight" />
                <span> </span> </p>
              <p>
                <label>商品单位：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['unit']; ?>
" class="text-input min-input" name="unit" />
                <span> </span> </p>
              <p class="ftext">
                <label>会员优惠：</label>
                <input name="ismemberprice" type="radio" value="1" <?php if ($this->_tpl_vars['goods']['ismemberprice'] == 1 || $this->_tpl_vars['goods']['goods_id'] == ''): ?>checked="checked"<?php endif; ?>/>
                享受
                <input name="ismemberprice" type="radio" value="0" <?php if ($this->_tpl_vars['goods']['ismemberprice'] == 0 && $this->_tpl_vars['goods']['goods_id'] != ''): ?>checked="checked"<?php endif; ?>/>
                不享受 <span></span> </p>
              <p class="ftext">
                <label>是否促销：</label>
                <input name="ispromote" class="ispromote" type="radio" value="1" <?php if ($this->_tpl_vars['goods']['ispromote'] == 1): ?>checked="checked"<?php endif; ?>/>
                启用
                <input name="ispromote" class="ispromote" type="radio" value="0" <?php if ($this->_tpl_vars['goods']['ispromote'] == 0): ?>checked="checked"<?php endif; ?>/>
                禁用 <span></span> </p>
              <p class="promote">
                <label>促销价：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['promote_price']; ?>
" class="text-input min-input" name="promote_price" id="promote_price" />
                <span>元 </span> </p>
              <p class="promote">
                <label>开始时间：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['promote_start_date']; ?>
" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text-input min-input" name="promote_start_date" id="promote_start_date" />
                <span> </span> </p>
              <p class="promote">
                <label>结束时间：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['promote_end_date']; ?>
" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text-input min-input" name="promote_end_date" id="promote_end_date" />
                <span> </span> </p>
              <p>
                <label>商品简介：</label>
                <textarea name="goods_desc" class="text-input textarea"><?php echo $this->_tpl_vars['goods']['goods_desc']; ?>
</textarea>
                <span> </span> <br /><small>不超过200个汉字</small></p>
              <dt>
                <input type="submit" name="" id="button" class="button" value="<?php if ($this->_tpl_vars['goods']['goods_id']): ?>编辑<?php else: ?>添加<?php endif; ?>" />
              </dt>
            </fieldset>
          </form>
        </div>
      </div>
      <!-- End #tab1 --> 
    </div>
    <!-- End .content-box-content --> 
  </div>
  <!-- End .content-box --> 
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
<script type="text/javascript">
    $(function() { 
		e = $(".ispromote:checked").val();
		if(e==1) $(".promote").show();
        $(".ispromote").click (function(){
			if($(".ispromote").attr("checked")){
				$(".promote").show();
			}else{
				$(".promote").hide();
			}
		});
		$("#getbarcode").click(function(){
			$.post("<?php echo smarty_function_get_url(array('rule' => "/ajax/getbarcode"), $this);?>
",{},function(result){
				if(result){
					$("#goods_sn").val(result.code);
					$("#img").show();
					$("#img").attr("href",result.imgsrc);
				}else{
					alert("生成出错！");
				}
			},"json")
		})
    });
</script>