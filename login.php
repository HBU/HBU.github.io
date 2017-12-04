<?php  
/*
*用户登录，服务器进行的处理
*/
	include("conn.php");
    mysql_select_db("lbs");  
	$getid=$_POST['uid'];//客户端post过来的用户名
	$getpwd=$_POST['pwd'];//客户端post过来的密码
    $sql=mysql_query("SELECT * FROM user WHERE userid ='$getid'"); 
	$result=mysql_fetch_assoc($sql);
	if(!empty($result)){
		//存在该用户
		if($getpwd==$result['password']){
			//用户名密码匹配正确
			mysql_query("UPDATE user SET status='1' WHERE id =$result[id]");/*这里的数组不需要加单引号*/
			$back['status']="1";
			$back['info']="login success";
			$back['sex']=$result['sex'];
			$back['nicename']=$result['nicename'];
			echo(json_encode($back)); 
		}else{/*密码错误*/
			$back['status']="-2";
			$back['info']="password error";
			echo(json_encode($back)); 
		}

	}else{
		//不存在该用户
		$back['status']="-1";
		$back['info']="user not exist";
		echo(json_encode($back)); 
	}
         
    mysql_close();  
?> 