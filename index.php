<?php session_start();

if (empty($where_i_am)) { 
  $where_i_am = dirname(__FILE__);
}

include($where_i_am ."/data/settings.php");
include($where_i_am ."/engine/functions.php");

$c = "<script language = 'javascript'>
  var delay = 3000;
  setTimeout(\"document.location.href='".actual_link()."/login.php'\", delay);</script>
</br><center><p><h1 style=\"color:green;\"></br>

Через 3 секунд Вы будете перенаправлены. 

</br>

Все прошло успешно!</h1>
</p></center>";

$email = "";	
$username = "";
$password = ""; 
$confirm_password = "";
$username_err = "";
$email_err = "";
$password_err = ""; 
$confirm_password_err = "";
 
if(!empty($_GET["logout"])){
$q = 1;
session_unset();
session_destroy();
die($c);
}
 else 
	 $q = 0;
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
    if(empty(trim($_POST["email"]))){
        $email_err = "Пожалуйста введите имейл.";
    }
	//Очень примитивная проверка почты, тут больше рег нужен)
	else if(strpos($_POST["email"],"@") === false){
        $email_err = "Пожалуйста введите правильный имейл.";
    }
	else if(empty(trim($_POST["username"]))){
        $username_err = "Пожалуйста введите имя пользователя.";
    } 
	else if(strlen(trim($_POST["username"])) < 5){
        $password_err = "Имя пользователя должно содержать не менее 5 символов.";
    } 
	else
	{
$query = "select `name`, `password`, `datereg`, `email`, `status` from `users` where `name` = '".trim($_POST["username"])."' limit 1";
$x = db($query);

if(!empty($x))
$username_err = "This username is already taken.";
else
$username = trim($_POST["username"]);	
	}	
    // Проверка пароля
    if(empty(trim($_POST["password"]))){
        $password_err = "Пожалуйста, введите пароль.";     
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "Пароль должен содержать не менее 5 символов.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Проверка пароли
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Пожалуйста, подтвердите пароль.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Пароль не совпадает.";
        }
    }
if(empty($username_err) && empty($password_err) && empty($email_err) && empty($confirm_password_err)){

$param_password = sha1(trim($_POST["password"]));
            
$date  = date('Y-m-d H:i:s');	
$email = $_POST["email"];
 
$query = "INSERT INTO `users`(`name`, `password`, `datereg`, `email`, `status`) 
VALUES ('".trim($_POST["username"])."','".$param_password."','".$date."','".$email."','1')";
$x = db($query);
 echo $c;
	}  	
}
else
	$q = 0;


if (isset($_SESSION["log_session"]))
{
	if($_SESSION['my_browser'] == $_SERVER['HTTP_USER_AGENT'])
         $q = 1;	
}


if(empty($q)){	
?>
 
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="<?php echo actual_link(); ?>/inc/css/s.css">
</head>
<body>
    <div class="wrapper">
        <h2>Регистрация</h2>
        <p>Пожалуйста, заполните эти формы, чтобы создать учетную запись.</p>
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
			
			
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Подтвердить пароль</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
			
			
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 			
			
			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
			
            <p>Уже есть аккаунт? <a href="login.php" class="login">Войти здесь</a>.</p>
        </form>
    </div>    
</body>
</html>

<?php 
}
else
{
	$x = 1;
	include($where_i_am ."/tables.php");
}





 ?>

 