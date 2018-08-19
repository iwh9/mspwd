<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	//检查是否登录
	public function _initialize(){
		if ($_SESSION['a_user']['id']=="") {

			
			$this->redirect('admin.php/login/index');
		}
	}
	
    public function index(){
		$id=(int)$_SESSION['a_user']['id'];
		$at=M('m_admin')->where("id=$id")->find();
		$this->assign('at',$at);
		//日志列表
		$elist=M('m_loginep')->limit(10)->order("id DESC")->select();
		$this->assign('elist',$elist);
		$passcount=M('m_pass')->count();
		$this->assign('passcount',$passcount);
		$classcount=M('m_class')->count();
		$this->assign('classcount',$classcount);
		$admincount=M('m_admin')->count();
		$this->assign('admincount',$admincount);
		$visitcount=M('m_visit')->count();
		$this->assign('visitcount',$visitcount);
		$plist=M('m_pass')->limit(10)->order("id DESC")->select();
		$this->assign('plist',$plist);
	    $this->display();	
		
	}
    public function logot(){

    	session_destroy();
		$this->success('退出成功',U('admin.php/login/index'));
		//$this->display();	
	}
	public function passdel(){
        //echo "<meta http-equiv='Content-Type' content='text/Html; charset=utf-8'>";
        if(!IS_AJAX){
        	$this->error('非法请求');
        }else{
        	$id=(int)$_POST['id'];
        	
			$res=M('m_pass')->where("id=$id")->delete();
        	if (!empty($res)) {
            	$this->success('删除成功',U('admin.php/index'));
        	}else{
            	$this->error('删除失败');
        	}
        }
		
	}
	
}





