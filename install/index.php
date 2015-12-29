<?php
header("Content-type: text/html; charset=utf-8");
if(isset($_REQUEST['ac']) && $_REQUEST['ac']=='db'){//异步创建数据库
	$host = $_REQUEST['h'];
	$user = $_REQUEST['u'];
	$password = $_REQUEST['p'];
	$database = $_REQUEST['d'];
	$state=0;
	$db = mysql_connect($host,$user,$password);
	if(mysql_query("CREATE DATABASE {$database}",$db)){
		$state=1;
		$msg="创建数据库成功！";
	}else{
		$msg="创建数据库失败！".mysql_error();
	}
	echo json_encode(array("state"=>$state,"msg"=>$msg));
	exit;
}
require_once("../global.php");
require_once(ROOT_APP."/base/Constant.class.php");
if (file_exists ( ROOT_APP . '/data/install.lock' )) {
	echo '已经安装过程序了！如果要重新安装请先手动删除app/data/install.lock 文件！<a href="../index.php">到首页</a>';
	exit ();
}
$title = base_Constant::DEFAULT_TITLE;
$ini_path = ROOT_CONFIG. "/db.ini.php";
if(!file_exists($ini_path)){
	die("读取配置错误，请检查app/config/db.ini.php 是否存在！");
}
if(!$_POST){
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
}else{
	$ini_content = file_get_contents($ini_path);
	$iniArr = parse_ini_file($ini_path);
	if($ini_content){
		$host = $_POST['host'];
		$user = $_POST['user'];
		$password = $_POST['password'];
		$database = $_POST['database'];
	}
	if(!$_POST['admin_name'] or !$_POST['admin_pwd']){
		die("管理员帐号和密码不能够为空！<a href='javascript:history.back()'>返回</a>");
	}
	$admin_name = htmlentities($_POST['admin_name']);
	$admin_pwd = md5(trim($_POST['admin_pwd']));
	$time = time();
	$adminsql = "INSERT INTO `smpss_admin` (`admin_name`, `admin_pwd`, `gid`, `createtime`, `lastlogintime`) VALUES('{$admin_name}', '$admin_pwd', 1, {$time}, 0)";
	$write_content = "host:{$host},user:{$user},database:{$database},password:{$password},charset:utf8";
	$res = str_replace(trim($iniArr['main']), $write_content, $ini_content);
	$res = str_replace(trim($iniArr['query']), $write_content, $res);
	$f = fopen($ini_path, 'r+');
	fwrite($f, $res);
	fclose($f);
	//导入数据库
	$db = mysql_connect($host,$user,$password);
	require_once("exe_sql.php");
	$exe = new exe_sql($database,$db);
	$rs = $exe->run(array("smpss.sql"),$adminsql);
	if(!$rs){
		die("导入数据库错误！原因：".$exe->geterr());
	}
	$fc = fopen(ROOT_APP . '/data/install.lock', 'a+');
	fwrite($fc, "\n");
	fclose($fc);
	die("安装成功!为了安全请删除install目录或者重命名为其他！ <a href='../index.php'>到首页</a>");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>安装-<?php echo $title ?></title>
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
    <h2>欢迎  安装使用 ”<?php echo $title ?>“
    </h2>
    <p id="page-intro">安装前,请检查<span class="red">app/cache,app/v_t,app/data,app/config</span> 有可写的权限。</p>
    <pre>特别注意 如果你的安装目录不是网站的根目录
请在 app/base/Constant.class.php中修改
const ROOT_DIR = "";
eg:你的访问路径是htttp://www.你的网站.com/smpss
const ROOT_DIR = "/smpss";
    </pre>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>安装配置</h3>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <div class="form">
            <form action="?" method="post" id="js-form">
              <fieldset class="clearfix">
                  <label><font class="red"> * </font>数据库地址</label>
                  <span>
                  <input type="text" value="<?php echo $iniArr['main']['host']; ?>" class="text-input small-input" name="host" id="host" />
                  </span> </p>
                <p>
                  <label><font class="red"> * </font>数据库用户名</label>
                  <span>
                  <input type="text" value="<?php echo $iniArr['main']['user']; ?>" class="text-input small-input" name="user" id="user" />
                  </span> </p>
                <p>
                  <label><font class="red"> * </font>数据库密码</label>
                  <span>
                  <input type="text" value="<?php echo $iniArr['main']['password']; ?>" class="text-input small-input" name="password" id="password" />
                  </span> </p>
                <p>
                  <label><font class="red"> * </font>数据库名称</label>
                  <span>
                  <input type="text" value="<?php echo $iniArr['main']['database']; ?>" class="text-input small-input" name="database" id="database" />
                  </span><input type="button" id="cdb" class="button" value="创建数据库" /><br /><small>可以选择一个已有的数据库</small> </p>
                <p>
                  <label><font class="red"> * </font>管理员帐号</label>
                  <span>
                  <input type="text" value="" class="text-input small-input" name="admin_name" />
                  </span> </p>
                <p>
                  <label><font class="red"> * </font>管理员密码</label>
                  <span>
                  <input type="password" value="" class="text-input small-input" name="admin_pwd" />
                  </span> </p>
                <p>
                  <input type="submit" name="" class="button" value=" 安装 " />
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
<script>
$(document).ready(function($){
	$("#cdb").click(function(){
		var host = $("#host").val();
		var user = $("#user").val();
		var password = $("#password").val();
		var database = $("#database").val();
		$.post("?ac=db",{h:host,u:user,p:password,d:database},function(result){
			alert(result.msg);
		},"json");
	});
})
</script>
</body>
</html>