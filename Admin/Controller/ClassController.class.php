<?php
namespace Admin\Controller;
use Think\Controller;
class ClassController extends Controller {
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
		$class=M('m_class');
		$count=$class->count();
		$Page=new \Think\Page($count,$count);
		$show=$Page->show();
		$list=$class->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();	
		
	}
	public function add(){
		//基础查询
		$id=(int)$_SESSION['a_user']['id'];
		$at=M('m_admin')->where("id=$id")->find();
		$this->assign('at',$at);
		$elist=M('m_loginep')->order("id DESC")->select();
		$this->assign('elist',$elist);
		//end
		if(!IS_AJAX){
			$this->display();
		}else{
			$token=I('post.t','','strip_tags');
            $salt = "mspasswordsystem";
            $crypt=crypt($token, $salt);
            $token_one=md5($crypt);
            $re=M('m_config')->where(array('id'=>1,'token'=>$token_one))->find();
            if(!empty($re)){
				$data['cname']=I('post.p','','strip_tags');
				$data['create_time']=time();
                $insert=M('m_class')->add($data);
                if(!empty($insert)){
                    $this->success("添加成功");
                }else{
                    $this->error("添加失败");
                }  
            }else{
                $this->error("TOKEN值不正确");
            }
		}
		
	}
    public function update(){
		//基础查询
		$id=(int)$_SESSION['a_user']['id'];
		$at=M('m_admin')->where("id=$id")->find();
		$this->assign('at',$at);
		$elist=M('m_loginep')->order("id DESC")->select();
		$this->assign('elist',$elist);
		$cid=(int)$_GET['cid'];
		$re=M('m_class')->where("id=$cid")->find();
		$this->assign('re',$re);
		if(!IS_AJAX){
			$this->display();
		}else{
			$cid=I('post.id','','strip_tags');
			$data['cname']=I('post.p','','strip_tags');
			$res=M('m_class')->where("id=$cid")->save($data);
			if(!empty($res)){
				$this->success("修改成功",U('admin.php/class'));
			}else{
				$this->error("修改失败");
			}
		}
	}
	public function classdel(){
        //echo "<meta http-equiv='Content-Type' content='text/Html; charset=utf-8'>";
		$id=(int)$_POST['id'];
		if($id==1){
			$this->error('默认分类不允许被删除！');
		}
        $res=M('m_class')->where("id=$id")->delete();
        if (!empty($res)) {
            $this->success('删除成功',U('admin.php/class'));
        }else{
            $this->error('删除失败');
        }
    }
	
}





