<?php 
/**
 * SmPSS1.0beta升级到SmPSS1.0Release
 * 
*/
if($_POST){
$file = $_POST['sql'];
require_once("../global.php");
require_once(ROOT_APP."/base/Constant.class.php");
$ini_path = ROOT_CONFIG. "/db.ini.php";
if(!file_exists($ini_path)){
	die("读取配置错误，请检查app/config/db.ini.php 是否存在！");
}
$iniArr = parse_ini_file($ini_path,true);
$iniArr = $iniArr['default'];
$iniArr = explode(",", $iniArr['main']);
if(is_array($iniArr)){
	foreach ($iniArr as $i){
		$iArr = explode(":", $i);
		if(is_array($iArr)){
			$iniArr['main'][$iArr[0]] = $iArr[1];
		}
	}
}
$db = mysql_connect($iniArr['main']['host'],$iniArr['main']['user'],$iniArr['main']['password']);
require_once("exe_sql.php");
$exe = new exe_sql($iniArr['main']['database'],$db);
$rs = $exe->run(array("{$file}.sql"));
if(!$rs){
	die("导入数据库错误！原因：".$exe->geterr());
}
echo "升级成功！为了安全建议删除本程序！ <a href='../index.php'>返回首页</a>";
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>升级</title>
<link rel="stylesheet" href="../assets/simpla/css/reset.css" type="text/css" />
<link rel="stylesheet" href="../assets/simpla/css/style.css" type="text/css" />
<link rel="stylesheet" href="../assets/simpla/css/invalid.css" type="text/css" />
<script src="../assets/js/jquery.js"></script>
</head>
<body>
<div id="body-wrapper">
  <div id="sidebar">
    <div id="sidebar-wrapper"></div>
  </div>
  <div id="main-content">
    <h2>欢迎  升级程序</h2>
    <p id="page-intro">升级程序，请根据你的版本进行升级。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>升级</h3>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <div class="form">
            <form action="?" method="post" id="js-form">
              <fieldset class="clearfix">
                <p>
                  <label><font class="red"> * </font>选择版本</label>
                  <span><select name="sql"><option value="upgradesmpss1.0">从1.0beta到1.0Release</option></select></span> </p>
                <p>
                  <input type="submit" name="" class="button" value=" 升级 " />
                </p>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div id="footer"></div>
  </div>
</div>
</body>
</html>
<?php 
}
?>