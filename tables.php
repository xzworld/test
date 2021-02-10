<?php
 if(empty($x))
	 die('У тебя нет прав! ;)');
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель управления</title>
    <link rel="stylesheet" href="<?php echo actual_link(); ?>/inc/css/s.css">
</head>
<body>

    <div class="wrapper_table">
	<div class="section">
  Status: <?php echo status($_SESSION['my_status']);?>  <a href="index.php?logout=x" class="login something">Выход.</a>
	</div> 

	<div class="cpl">
        <h2 class="something">Панель управления</h2>
    </div> 

	<div class="cpl">
        <h3 class="somethingtwo">Список юзеров.</h3>
    </div> 	
        

<?php
if(!empty($_GET['delete']))
$quer = "delete from `users` where `id`='".$_GET['delete']."'";
else if((!empty($_GET['name']))&&(!empty($_GET['password']))&&(!empty($_GET['email']))&&(!empty($_GET['status'])))
{
$param_password = sha1(trim($_GET["password"]));
$quer = "INSERT INTO `users`(`name`, `password`, `datereg`, `email`, `status`) 
VALUES ('".trim($_GET['name'])."','".$param_password."','".date('Y-m-d H:i:s')."','".$_GET['email']."','".$_GET['status']."')";
}

if(!empty($quer))
{
if(db($quer))
	echo 'ok';
else echo 'Такая запись уже есть!';
}

$countView = 8; 

if(isset($_GET['page'])){
    $pageNum = (int)$_GET['page'];
}else{
    $pageNum = 1;
}
$startIndex = ($pageNum-1)*$countView; 
 
 
$query = "select count(`name`) as cnt FROM `users`";
$xl = db($query);

foreach($xl as $n => $v)
{
	$countAllNews = $v['cnt'];	
} 
  
$lastPage = ceil($countAllNews/$countView);


$query = "select `id`,`name`, `password`, `datereg`, `email`, `status` from `users` limit $startIndex, $countView";
$xl = db($query);

echo '<div class="wrapper_for">
<div class="divTable">
<div class="divTableBody">
';

	echo '<div class="divTableCell">';
	echo 'Del.';
	echo '</div>';

	echo '<div class="divTableCell">';
	echo 'Name';
	echo '</div>';
	
	echo '<div class="divTableCell">';
	echo 'Password';
	echo '</div>';
	
	echo '<div class="divTableCell">';
	echo 'Email';
	echo '</div>';	
	
	echo '<div class="divTableCell">';
	echo 'Date Register';
	echo '</div>';


	echo '<div class="divTableCell">';
	echo 'Status';
	echo '</div>';	

 $i = 0;
foreach($xl as $n => $v)
{  
	if($n == $i)
		echo '<div class="divTableRow">';
	
	
	echo '<div class="divTableCell">';
	echo '<a href="'.actual_link().'/index.php?delete='.$v['id'].'">❌</a>';
	echo '</div>';
	
	echo '<div class="divTableCell">';
	echo $v['name'];
	echo '</div>';
	
	echo '<div class="divTableCell">';
	echo $v['password'];
	echo '</div>';
	
	echo '<div class="divTableCell">';
	echo $v['email'];
	echo '</div>';	
	
	echo '<div class="divTableCell">';
	echo $v['datereg'];
	echo '</div>';


	echo '<div class="divTableCell">';
	echo $v['status'];
	echo '</div>';	
	
		if($n == $i)
		echo '</div>';
 
	++$i;
}

echo '</div></div>';

?>


 
 
</div></div> 

	
<div class="cpl">
        <h3 class="somethingtwo">Добавление новых юзеров.</h3>
</div> 


<div class="wrapper">
<form action="<?php echo actual_link();?>/index.php" method="get">

 <div class="form-group-new"> 
  <label>Name:</label>
  <input type="text" id="name" name="name" class="form-control-new">
  </div>

<div class="form-group-new">  
  <label>Password:</label>
  <input type="text" id="password" name="password" class="form-control-new">
</div>

<div class="form-group-new">  
  <label>Email:</label>
  <input type="text" id="email" name="email" class="form-control-new">
</div>

<div class="form-group-new">  
  <label>Status:</label>
  <input type="text" id="status" name="status" class="form-control-new">
</div>
  
  <input type="submit" value="Submit" class="btn btn-primary">
</form>
</div>	


<div class="wrapper"></div>


<div class="pagin">
<div class="pagination">
    <ul>
        <?php if($pageNum > 1) { ?>
            <li><a href="<?php echo actual_link();?>/index.php?page=1">&lt;&lt;</a></li>
            <li><a href="<?php echo actual_link();?>/index.php?page=<?=$pageNum-1;?>">&lt;</a></li>
        <?php } ?>
         
        <?php for($i = 1; $i<=$lastPage; $i++) { ?>
            <li <?=($i == $pageNum) ? 'class="current"' : '';?>> <a href="<?php echo actual_link();?>/index.php?page=<?=$i;?>"><?=$i;?></a> </li>
        <?php } ?>
         
        <?php if($pageNum < $lastPage) { ?>
            <li><a href="<?php echo actual_link();?>/index.php?page=<?=$pageNum+1;?>">&gt;</a></li>
            <li><a href="<?php echo actual_link();?>/index.php?page=<?=$lastPage;?>">&gt;&gt;</a></li>
        <?php } ?>
    </ul>
</div></div>

</body>
</html>