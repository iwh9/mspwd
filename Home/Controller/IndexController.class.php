<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
        $result = M('m_system')->find();
        $this->assign('result',$result);
        $is_index=(int)$result['is_inex'];
        $passcount=M('m_pass')->count();
        $this->assign('passcount',$passcount);
        $tpl=M('m_config')->find();
        $tpl=$tpl['temple'];
        if($is_index==0){
            $this->display($tpl);
        }else{
            $this->redirect('admin.php/index');
        }
    }

    public function add(){
        if(!IS_AJAX){
            $data['ip']=$this->get_ip();
            $data['time']=time();
            $re=M('m_visit')->add($data);
            echo '<script type="text/javascript">alert("非法提交，你的IP已被记录！");window.location.href = "/index.php";</script>';
        }else{
            $token=I('post.token','','strip_tags');
            $salt = "mspasswordsystem";
            $crypt=crypt($token, $salt);
            $token_one=md5($crypt);
            $re=M('m_config')->where(array('id'=>1,'token'=>$token_one))->find();
            if(!empty($re)){
                $pass['cid']=1;
                $pass['username']=I('post.name','','strip_tags');
                $pass['password']=I('post.pwd','','strip_tags');
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