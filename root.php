<?php
class data
{
  
  function __construct()
		{
			mysql_connect("localhost","root","");
			mysql_select_db("user_database");
			}

  function login($username,$password)
		{
			$query=mysql_query("select * from users where username='$username' and password='$password' and status='active'");
			$check=mysql_num_rows($query);
			$data=mysql_fetch_array($query);

			if($check>0) {
				session_start();
				$_SESSION['user']=$data['username'];
				$_SESSION['user_id']=$data['user_id'];
				//header("location:index.php");
				echo json_encode([
					'error' => false,
					'msg' => 'Log In Successful'
				]);
			} else {
					echo json_encode([
						'error' => false,
						'msg' => 'Your Account Hasn't Been Registered or Hasn't Verified Yet'
					]);
			}
            die;
            /*<script>
                alert("Log In Failed, Maybe Your Username or Password Is Wrong or Status Inactive");
                window.location.href = "login.php";
            </script>*/
        
    }
