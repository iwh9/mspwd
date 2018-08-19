<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller{
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
		//统计查询
		$class=M('m_admin');
		$count=$class->count();
		$Page=new \Think\Page($count,$count);
		$show=$Page->show();
		$list=$class->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
        $this->display();
		
	}
	public function upuser(){
		//基础查询
		$id=(int)$_SESSION['a_user']['id'];
		$uid=I('get.id','','strip_tags');
		//var_dump($uid);
		if ($uid!=$id) {
			$this->success('小伙子不要皮，给你跳到首页去',U('admin.php/index'));
		}
		$at=M('m_admin')->where("id=$id")->find();
		if($at['is_all']==1){
			$this->success("没有权限");
		}
		$this->assign('at',$at);

		$elist=M('m_loginep')->order("id DESC")->select();
		$this->assign('elist',$elist);
		$this->display();
		
	}
	public function upusers(){
		if(!IS_AJAX){
			$this->success("非法提交");
		}else{
			$id=I('post.id','','strip_tags');
			$token=I('post.t','','strip_tags');
            $salt = "mspasswordsystem";
            $crypt=crypt($token, $salt);
            $token_one=md5($crypt);
            $re=M('m_config')->where(array('id'=>1,'token'=>$token_one))->find();
            if(!empty($re)){
            	$password=I('post.pass','','md5');
            	$admin=M('m_admin')->where("id=$id")->find();
            	if ($password!=$admin['password']) {
					$this->error("原密码不正确");
				}
				$name=I('post.name','','strip_tags');
				if (!empty($name)) {
					# code...
					$user['username']=$admin['username'];
				}else{
					$user['username']=I('post.name','','strip_tags');
				}
				
				$user['username']=I('post.name','','strip_tags');
				$user['password']=I('post.npass','','md5');
				$user['nickname']=I('post.nname','','strip_tags');
				$data=M('m_admin')->where("id=$id")->save($user);
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
	public function add(){
		//基础查询
		$id=(int)$_SESSION['a_user']['id'];
		$at=M('m_admin')->where("id=$id")->find();

		$this->assign('at',$at);
		$elist=M('m_loginep')->order("id DESC")->select();
		$this->assign('elist',$elist);
		if(!IS_AJAX){
			$this->display();
		}else{
			$id=I('post.id','','strip_tags');
			$token=I('post.t','','strip_tags');
            $salt = "mspasswordsystem";
            $crypt=crypt($token, $salt);
            $token_one=md5($crypt);
            $re=M('m_config')->where(array('id'=>1,'token'=>$token_one))->find();
            if(!empty($re)){
            	$user['username']=I('post.name','','strip_tags');
				$user['password']=I('post.pass','','md5');
				$user['nickname']=I('post.nname','','strip_tags');
				$user['is_all']=I('post.cid','','strip_tags');
				$data=M('m_admin')->add($user);
				if (!empty($data)) {
						# code...
					$this->success("添加成功");
				}else{
					$this->error("添加失败");
					}
				
            }else{
                $this->error("TOKEN值不正确");
            }
		}
	}
	public function loginep(){
		//基础查询
		$id=(int)$_SESSION['a_user']['id'];
		$at=M('m_admin')->where("id=$id")->find();
		$this->assign('at',$at);
		$elist=M('m_loginep')->order("id DESC")->select();
		$this->assign('elist',$elist);
		//统计查询
		$class=M('m_loginep');
		$count=$class->count();
		$Page=new \Think\Page($count,$count);
		$show=$Page->show();
		$list=$class->order("id DESC")->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}

	public function clearloginep(){
		$id=(int)$_SESSION['a_user']['id'];
		$at=M('m_admin')->where("id=$id")->find();
		if($at['is_all']==1){
			
			$this->error("没有权限");
		}
		$clear=M('m_loginep');
		$row=$clear->query("truncate table m_loginep");
		if (!empty($row)) {
			$this->success("清除成功");
		}else{
			$this->error("清除失败");
		}
	}
}