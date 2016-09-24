<?php
	include("connect.php");
	if(isset($_POST['enter']))
	{
		$period = 24*60*60;
		$login = $_POST['login'];
		$password = md5($_POST['password']);
		$query = mysql_query("select * from users where login = '$login'");
		$user_data = mysql_fetch_array($query);
		if($user_data['password'] == $password)
		{
			setcookie('login',$user_data['login'],time()+$period);
			setcookie('name',$user_data['name'],time()+$period);
			setcookie('group',$user_data['group'],time()+$period);
			header("Location: /index.php");
			exit;
		}
		else
			$mes = "<div class = 'mess'>Неверный логин и/или пароль</div>";
	}
	if(isset($_POST['exit']))
	{
		setcookie('login',$user_data['login'],time()-$period);
		setcookie('name',$user_data['name'],time()-$period);
		setcookie('group',$user_data['group'],time()-$period);
	}
	if(isset($_COOKIE['login']))
	{
		header("Location: /index.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
  		<title>Вход</title>
		<meta http-equiv = "Content-Type" content = "text/html; charset = utf-8" />
		<link rel = "stylesheet" type = "text/css" href = "css/style2.css" />
		<link rel = "shortcut icon" href = "favicon.ico" type="image/x-icon">
	</head>
	<body>
		<div class = "page">
			<div class = "login">
				<h1>Архив учебных материалов</h1>
				<form method = "post" action = "login.php">
					<input type = "text" placeholder = "| Логин |" name = "login" required>
					<input type = "password" placeholder = "| Пароль |" name = "password" required><br>
					<input type = "submit" class = "sub1" value = "Вход" name = "enter">
				</form>
				<?php echo $mes; ?>
			</div>
		</div>
	</body>
</html>