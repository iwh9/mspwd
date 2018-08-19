<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {


     public function login(){
        $result = M('m_system')->find();
        $this->assign('result',$result);
        $admin = M('m_admin'); // 实例化User对象
        $count = $admin->count();// 查询满足要求的总记录数
        if ($count=="0") {
            $this->error('请先创建管理员账号和密码后再使用本系统！',U('login/reg'));
            
        }
        if ($_SESSION['a_user']['id']=="") {

            $this->display();   
        }else{  
            $this->redirect('index/index');
        }
     }
	
    public function loging(){
    	if(!IS_AJAX){
            $this->error('提交方式错误!',U('login/index'));
        }else{


            $a= I('post.p','','strip_tags');
            $b= I('post.c','','md5');
            
            $user=M('m_admin')->where(array('username'=>$a,'password'=>$b))->find();

            if(!empty($user)){
					$_SESSION['a_user']['id']=$user['id'];
					$data['uid']=$user['id'];
					$data['name']=$user['nickname'];
					$data['ip']=$this->get_ip();
					$data['date']=time();
					$ep=M('m_loginep')->add($data);
                    $this->success('正在登陆',U('admin.php/index/index'),true,'2');
            }else{
                $this->error('账号密码错误!');
            }
            
            
        }
    }
    public function reg(){
        $result = M('m_system')->find();
        $this->assign('result',$result);
    	$admin = M('m_admin'); // 实例化User对象
        $count = $admin->count();// 查询满足要求的总记录数
         if ($count!="0") {
        	
        	$admin = M('m_visit');
        	if ($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"])
			{
			  $ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
			}
			elseif ($HTTP_SERVER_VARS["HTTP_CLIENT_IP"])
			{
			  $ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
			}
			elseif ($HTTP_SERVER_VARS["REMOTE_ADDR"])
			{
			  $ip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
			}
			elseif (getenv("HTTP_X_FORWARDED_FOR"))
			{
			  $ip = getenv("HTTP_X_FORWARDED_FOR");
			}
			elseif (getenv("HTTP_CLIENT_IP"))
			{
			  $ip = getenv("HTTP_CLIENT_IP");
			}
			elseif (getenv("REMOTE_ADDR"))
			{
			  $ip = getenv("REMOTE_ADDR");
			}
			else
			{
			  $ip = "Unknown";
			}
			$time=time();
			$data['ip'] = $ip;
			$data['time'] = $time;
			$admin->add($data);

        	$this->error('非法访问，如管理员密码忘记，请联系QQ：3494490，系统已将您IP记录并保存',U('login/index'));
        }
    	$this->display();
    }
    public function regist(){
    	
    	 if(!IS_AJAX){
            $this->error('提交方式错误!');
        }else{
        	//md5(md5($password))
            $User = M("m_admin"); // 实例化User对象
			$data['username'] = I('post.p','','md5');
			$data['password'] = I('post.c','','md5');
			$User->add($data);
			if(!empty($User)){
			   $this->success('账号密码创建成功',U('login/login'),true,'2');
            }else{
                $this->error('账号密码创建失败!');
            }
		}	
	
	}
	function get_ip(){
        //判断服务器是否允许$_SERVER
        if(isset($_SERVER)){    
            if(isset($_SERVER[HTTP_X_FORWARDED_FOR])){
                $realip = $_SERVER[HTTP_X_FORWARDED_FOR];
            }elseif(isset($_SERVER[HTTP_CLIENT_IP])) {
                $realip = $_SERVER[HTTP_CLIENT_IP];
            }else{
                $realip = $_SERVER[REMOTE_ADDR];
            }
        }else{
            //不允许就使用getenv获取  
            if(getenv("HTTP_X_FORWARDED_FOR")){
                  $realip = getenv( "HTTP_X_FORWARDED_FOR");
            }elseif(getenv("HTTP_CLIENT_IP")) {
                  $realip = getenv("HTTP_CLIENT_IP");
            }else{
                  $realip = getenv("REMOTE_ADDR");
            }
        }
    
        return $realip;
    }      
}