<?php /* Smarty version 2.6.26, created on 2015-12-29 12:52:43
         compiled from simpla/statistics/sales.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/statistics/sales.html', 51, false),)), $this); ?>
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
  <p id="page-intro">进货统计。本统计使用的插件：<a href="http://www.jqplot.com" target="_blank">jqPlot</a></p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>进货数据统计</h3>
      <div class="clear"></div>
    </div>
<?php if ($this->_tpl_vars['line']): ?>
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/jqplot/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/jqplot/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/jqplot/plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/jqplot/plugins/jqplot.cursor.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/jqplot/jquery.jqplot.min.css" />
<script>
$(document).ready(function(){
  var line1=[<?php echo $this->_tpl_vars['line']; ?>
];
  var plot1 = $.jqplot('chart1', [line1], {
      title:'<?php echo $this->_tpl_vars['title']; ?>
',
      axes:{
        xaxis:{
          renderer:$.jqplot.DateAxisRenderer,
          tickOptions:{
            formatString:'%y-%m-%#d'
          }
        },
        yaxis:{
          tickOptions:{
            formatString:'￥%.2f'
            }
        }
      },
      highlighter: {
        show: true,
        sizeAdjust: 7.5
      },
      cursor: {
        show: false
      }
  });
});
</script>
<?php endif; ?>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
      	<div class="form">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/statistics/sales'), $this);?>
" method="post" id="js-form">
                <fieldset class="clearfix">
               	  <p>时间：<input type="text"  name="start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"  class="text-input min-input" value="<?php echo $this->_tpl_vars['start']; ?>
"/>--<input type="text"  name="end" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"  class="text-input min-input" value="<?php echo $this->_tpl_vars['end']; ?>
"/>&nbsp;<input type="submit" name="" class="button" id="button" value=" 查询 " /></p>
                </fieldset>
            </form>
        </div>
        <div id="chart1" style="height:400px; width:100%;"></div>
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