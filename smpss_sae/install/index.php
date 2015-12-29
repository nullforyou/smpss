<?php
header("Content-type: text/html; charset=utf-8");
require_once("../global.php");
require_once(ROOT_APP."/base/Constant.class.php");
if (file_exists ( 'saekv://'.$_SERVER['HTTP_APPVERSION'] . '/install.lock' )) {
	echo '已经安装过程序了！<a href="../index.php">到首页</a>';
	exit ();
}
$title = base_Constant::DEFAULT_TITLE;
if(!$_POST){
	
}else{
	@mkdir("saemc://".$_SERVER['HTTP_APPVERSION'] ."/v_t/");//创建缓存目录
	if(!$_POST['admin_name'] or !$_POST['admin_pwd']){
		die("管理员帐号和密码不能够为空！<a href='javascript:history.back()'>返回</a>");
	}
	$admin_name = htmlentities($_POST['admin_name']);
	$admin_pwd = md5(trim($_POST['admin_pwd']));
	$time = time();
	$adminsql = "INSERT INTO `smpss_admin` (`admin_name`, `admin_pwd`, `gid`, `createtime`, `lastlogintime`) VALUES('{$admin_name}', '$admin_pwd', 1, {$time}, 0)";
	//导入数据库
	$db = mysql_connect(SAE_MYSQL_HOST_M.":".SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
	require_once("exe_sql.php");
	$exe = new exe_sql(SAE_MYSQL_DB,$db);
	$rs = $exe->run(array("smpss.sql"),$adminsql);
	if(!$rs){
		die("导入数据库错误！原因：".$exe->geterr());
	}
	$fc = fopen('saekv://'.$_SERVER['HTTP_APPVERSION'] . '/install.lock', 'a+');
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
</head>
<body>
<div id="body-wrapper">
  <div id="sidebar">
    <div id="sidebar-wrapper"></div>
  </div>
  <div id="main-content">
    <h2>欢迎  安装使用 "<?php echo $title ?>"
    </h2>
    <p id="page-intro">SAE版本安装。</p>
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
</body>
</html>