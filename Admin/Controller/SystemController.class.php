<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends Controller {
	//检查是否登录
	public function _initialize(){
		if ($_SESSION['a_user']['id']=="") {
			$this->redirect('admin.php/login/index');
		}
	}
	public function index(){
		//基础查询
		$id=(int)$_SESSION['a_user']['id'];
		$at=M('m_admin')->where("id=$id")->find();
		$this->assign('at',$at);
		$elist=M('m_loginep')->order("id DESC")->select();
		$this->assign('elist',$elist);
		$re=M('m_system')->where("id=1")->find();
		$this->assign('re',$re);
		if(!IS_AJAX){
			$this->display();
		}else{
			$token=I('post.t','','strip_tags');
            $salt = "mspasswordsystem";
            $crypt=crypt($token, $salt);
            $token_one=md5($crypt);
            $re=M('m_config')->where(array('id'=>1,'token'=>$token_one))->find();
            if(!empty($re)){
            	$sys['title']=I('post.title','','strip_tags');
				$sys['keywords']=I('post.key','','strip_tags');
				$sys['descc']=I('post.desc','','strip_tags');
				$sys['ftitle']=I('post.bq','','strip_tags');
				$sys['beian']=I('post.beian','','strip_tags');
				$sys['is_inex']=(int)I('post.cid','','strip_tags');
				$data=M('m_system')->where("id=1")->save($sys);
				if (!empty($data)) {
						# code...
					$this->success("修改成功");
				}else{
					$this->error("修改失败");
					}
				
            }else{
                $this->error("TOKEN值不正确");
            }
		}
	}
	public function token(){
		//基础查询
		$id=(int)$_SESSION['a_user']['id'];
		$at=M('m_admin')->where("id=$id")->find();
		if($at['is_all']==1){
			$this->success("没有权限");
		}
		$this->assign('at',$at);
		$elist=M('m_loginep')->order("id DESC")->select();
		$this->assign('elist',$elist);
		$re=M('m_system')->where("id=1")->find();
		$this->assign('re',$re);
		if(!IS_AJAX){
			$this->display();
		}else{
			$token=I('post.t','','strip_tags');
            $salt = "mspasswordsystem";
            $crypt=crypt($token, $salt);
            $token_one=md5($crypt);
			$data['token']=$token_one;
			$re=M('m_config')->where("id=1")->save($data);
			if(!empty($re)){
				$this->success("修改成功");
			}else{
				$this->error("修改失败");
			}
		}
	}
}

