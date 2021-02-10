<?php session_start();

if (empty($where_i_am)) { 
  $where_i_am = dirname(__FILE__);
}

include($where_i_am ."/data/settings.php");
include($where_i_am ."/engine/functions.php");

$c = "<script language = 'javascript'>
  var delay = 3000;
  setTimeout(\"document.location.href='".actual_link()."/index.php'\", delay);</script>
</br><center><p><h1 style=\"color:green;\"></br>

Через 3 секунд Вы будете перенаправлены. 

</br>

Вход прошел успешно!</h1>
</p></center>";

$email = "";	
$username = "";
$password = ""; 
$confirm_password = "";
$username_err = "";
$email_err = "";
$password_err = ""; 
$confirm_password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	
if(!empty($_GET["logout"])){	
session_unset();
session_destroy();
die($c);
}
	

    if(empty(trim($_POST["username"]))){
        $username_err = "Пожалуйста введите имя пользователя.";
    } 
	else if(strlen(trim($_POST["username"])) < 5){
        $password_err = "Имя пользователя должно содержать не менее 5 символов.";
    } 
	else if(empty(trim($_POST["password"]))){
        $password_err = "Пожалуйста, введите пароль.";     
    }
	else if(strlen(trim($_POST["password"])) < 5){
        $password_err = "Пароль должен содержать не менее 5 символов.";
    } 
	else
	{
		
$param_password = sha1(trim($_POST["password"])); 

$query = "select `name`, `password`, `datereg`, `email`, `status` from `users` where `name` = '".trim($_POST["username"])."' and `password` = '".$param_password."' limit 1";
$x = db($query);
 
if(empty($x))
$password_err = "Имя пользователя или пароль не верный.";
else
{
	$_SESSION["log_session"] = md5($param_password);
	$_SESSION['my_browser'] = $_SERVER['HTTP_USER_AGENT'];
	//конечно статус с бд через цикл foreach..........
	$_SESSION['my_status']  = '2';
}	

	}	
  
    
if(empty($username_err) && empty($password_err)){      
 echo $c;
	}  	
}
?>
 
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="<?php echo actual_link(); ?>/inc/css/s.css">
</head>
<body>
    <div class="wrapper">
        <h2>Вход</h2>
        <p>Пожалуйста, заполните эти формы, чтобы войти.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
			<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Имя пользователя</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div> 

			
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Пароль</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
			
            <p>Нету аккаунта? <a href="index.php" class="login">Регистрация</a>.</p>
        </form>
    </div>    
</body>
</html>

 