<?php
namespace Admin\Controller;
use Think\Controller;
class PassController extends Controller{
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
		$class=M('m_pass');
		$count=$class->count();
		$Page=new \Think\Page($count,$count);
		$show=$Page->show();
		$list=$class->order('date')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach ($list as $k => $v) {
			# code...
			$list[$k]['cid']=M('m_class')->where("id=".$v['cid'])->find();
		}
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
		$clist=M('m_class')->order("id")->select();
		$this->assign('clist',$clist);
		if(!IS_AJAX){
			$this->display();	
		}else{
			$token=I('post.token','','strip_tags');
            $salt = "mspasswordsystem";
            $crypt=crypt($token, $salt);
            $token_one=md5($crypt);
            $re=M('m_config')->where(array('id'=>1,'token'=>$token_one))->find();
            if(!empty($re)){
				$pass['cid']=I('post.cid','','strip_tags');
                $pass['username']=I('post.name','','strip_tags');
				$pass['password']=I('post.pass','','strip_tags');
				$pass['adress']=I('post.adress','','strip_tags');
				$pass['email']=I('post.email','','strip_tags');
				$pass['phone']=I('post.phone','','strip_tags');
				$pass['remark']=I('post.remark','','strip_tags');
                $pass['date']=time();
                $insert=M('m_pass')->add($pass);
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
	public function classdel(){
        //echo "<meta http-equiv='Content-Type' content='text/Html; charset=utf-8'>";
		$id=(int)$_POST['id'];
		$res=M('m_pass')->where("id=$id")->delete();
        if (!empty($res)) {
            $this->success('删除成功',U('admin.php/class'));
        }else{
            $this->error('删除失败');
        }
	}
	public function uppass(){
		 //基础查询
		$id=(int)$_SESSION['a_user']['id'];
		$at=M('m_admin')->where("id=$id")->find();
		if($at['is_all']==1){
			$this->success("没有权限");
		}
		$this->assign('at',$at);
		$elist=M('m_loginep')->order("id DESC")->select();
		$this->assign('elist',$elist);
		$clist=M('m_class')->order("id")->select();
		$this->assign('clist',$clist);
		$mid=(int)$_GET['id'];
		$re=M('m_pass')->where("id=$mid")->find();
		$this->assign('re',$re);
		if (!IS_AJAX) {
			# code...
			$this->display();
		}else{
			$pid=(int)I('post.id','','strip_tags');
			$pass['cid']=I('post.cid','','strip_tags');
            $pass['username']=I('post.name','','strip_tags');
			$pass['password']=I('post.pass','','strip_tags');
			$pass['adress']=I('post.adress','','strip_tags');
			$pass['email']=I('post.email','','strip_tags');
			$pass['phone']=I('post.phone','','strip_tags');
			$pass['remark']=I('post.remark','','strip_tags');
            
            $up=M('m_pass')->where("id=$pid")->save($pass);
            
            if(!empty($up)){
                    $this->success("修改成功");
            }else{
                    $this->error("修改失败");
                }
		}
		
	}
	public function export(){
		$id=(int)$_SESSION['a_user']['id'];
		$goods_list = M('m_pass')->order("id")->select();
		$this->goods_export($goods_list);

   }
   protected function goods_export($goods_list=array())
   {
	   //print_r($goods_list);exit;
	   $goods_list = $goods_list;
	   $data = array();
	   foreach ($goods_list as $k=>$goods_info){
		   $data[$k][id] = $goods_info['id'];
		   $data[$k][username] = $goods_info['username'];
		   $data[$k][password] = $goods_info['password'];
		   $data[$k][adress] = $goods_info['adress'];
		   $data[$k][remark]  = $goods_info['remark'];
		 
	   }

	   //print_r($goods_list);
	   //print_r($data);exit;

	   foreach ($data as $field=>$v){
		   if($field == 'id'){
			   $headArr[]='ID';
		   }

		   if($field == 'username'){
			   $headArr[]='账号';
		   }

		   if($field == 'password'){
			   $headArr[]='密码';
		   }

		   if($field == 'adress'){
			   $headArr[]='登录地址';
		   }
		   if($field == 'remark'){
			$headArr[]='备注';
		}

		  
	   }

	   $filename="goods_list";

	   $this->getExcel($filename,$headArr,$data);
   }


   private  function getExcel($fileName,$headArr,$data){
	   //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
	   import("Org.Util.PHPExcel");
	   import("Org.Util.PHPExcel.Writer.Excel5");
	   import("Org.Util.PHPExcel.IOFactory.php");

	   $date = date("Y_m_d",time());
	   $fileName .= "_{$date}.xls";

	   //创建PHPExcel对象，注意，不能少了\
	   $objPHPExcel = new \PHPExcel();
	   $objProps = $objPHPExcel->getProperties();

	   //设置表头
	   $key = ord("A");
	   //print_r($headArr);exit;
	   foreach($headArr as $v){
		   $colum = chr($key);
		   $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
		   $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
		   $key += 1;
	   }

	   $column = 2;
	   $objActSheet = $objPHPExcel->getActiveSheet();

	   //print_r($data);exit;
	   foreach($data as $key => $rows){ //行写入
		   $span = ord("A");
		   foreach($rows as $keyName=>$value){// 列写入
			   $j = chr($span);
			   $objActSheet->setCellValue($j.$column, $value);
			   $span++;
		   }
		   $column++;
	   }

	   $fileName = iconv("utf-8", "gb2312", $fileName);

	   //重命名表
	   //$objPHPExcel->getActiveSheet()->setTitle('test');
	   //设置活动单指数到第一个表,所以Excel打开这是第一个表
	   $objPHPExcel->setActiveSheetIndex(0);
	   ob_end_clean();//清除缓冲区,避免乱码
	   header('Content-Type: application/vnd.ms-excel');
	   header("Content-Disposition: attachment;filename=\"$fileName\"");
	   header('Cache-Control: max-age=0');

	   $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	   $objWriter->save('php://output'); //文件通过浏览器下载
	   exit;
   }
}