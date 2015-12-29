<?php 
/**
 * 登录
 * @author loid  email:loid@163.com
 *
 */
class c_main extends base_c {
	
	function pageindex($inPath){
		if(!$this->isLogin())
			return $this->pagelogin($inPath);
		$this->redirect($this->createUrl("/system/index"));
		//return $this->render('main/index.html',$this->params);
	}
	
	function pagelogin($inPath) {
		$kv = new SaeKV();
    	$ret = $kv->init();
		if(!$ret) $this->ShowMsg("你没有初始化KVDB！");
		if (!file_exists ( 'saekv://'.$_SERVER['HTTP_APPVERSION'] . '/install.lock' )) {
			$this->ShowMsg("你还没有安装smpss！",base_Constant::ROOT_DIR.'/install/index.php');
		}
		$urlParams = $this->getUrlParams($inPath);
		if(!$_POST){
			$this->params['head_title'] = "管理登录-".$this->params['head_title'];
			return $this->render("main/login.html",$this->params);
		}else{
			$_POST = base_Utils::shtmlspecialchars($_POST);
			//session_start();
                  //if(!SCaptcha::check($_POST['captcha'])){
				$modelAdmin = new m_admin();
				$loginInfo = $modelAdmin->checkLogin($_POST['username'],$_POST['pwd'],(int)$_POST['timeout']);
				if($loginInfo){
					$this->redirect($this->createUrl('/'));
				}else{
					$this->ShowMsg("用户名或者密码错误！");
				}
                          //}else{
                          //$this->ShowMsg("验证码错误！");
                          //}
		}
	}
	
	function pagelogout($inPath) {
		$cookie['key'] = '';
		base_Utils::ssetcookie($cookie,-1);
		return $this->ShowMsg("成功退出！",$this->createUrl('/main/index'),2,1);
	}
	
	function pagecaptcha(){
          //session_start();
          //$cap = new SCaptcha();
          //$code = $cap->CreateImage();
	}
	function pageTest(){
		
	}
}
?>