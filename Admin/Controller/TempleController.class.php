<?php
namespace Admin\Controller;
use Think\Controller;
class TempleController extends Controller {
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
		$class=M('m_temple');
		$count=$class->count();
		$Page=new \Think\Page($count,$count);
		$show=$Page->show();
		$list=$class->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();	
		
	}
	public function uptemple(){
		$data['temple']=I('post.u','','strip_tags');
		$res=M('m_config')->where("id=1")->save($data);
		if(!empty($res)){
			$this->success("主题切换成功!");
		}else{
			$this->error("主题切换失败！");
		}
	}
    
	
}





