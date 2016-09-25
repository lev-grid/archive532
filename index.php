<?php
	include("connect.php");
	if (!isset($_COOKIE['login']))
		header("Location: /login.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			Архив учебных материалов
		</title>
		<meta http-equiv = "Content-Type" content = "text/html; charset = utf-8" />
		<link rel = "stylesheet" type = "text/css" href = "css/style2.css" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
		<div class = "page">
			<div class = "header">
				<a href = "index.php" class = "title">
					Архив учебных материалов 532 группы факультета ПМ-ПУ СПбГУ
				</a>
				<a href = "add.php" class = "add" title = "Добавить материал"><b>+</b></a>
				<div style = "clear: both;"></div>
			</div>
			<div class = "p_header">
				<div class = "name">
					<?php
						printf('Здравствуй, %s!',
								$_COOKIE['name']);
					?></div><!--
					--><a href = "#" class = "set">Настройки</a><!--
					--><div class = "exit">
						<form method = "post" action = "login.php">
							<input type = "submit" class = "logout" value = "Выход" name = "exit">
						</form>
					</div>
					<div style = "clear: both;"></div>
			</div>
			<div class = "content">
				<?php
					$result = mysql_query("select * from classes")
						or die(mysql_error());
					$data = mysql_fetch_array($result);
					printf('<!--');
					do
					{
						printf(
							'--><a href="class.php?id=%s" class = "folder">
								<img src="img/folder.png">
								<span>%s</span>
							</a><!--
						',$data["id"],$data["name"]);
					}
					while($data = mysql_fetch_array($result));
					printf('-->');
				?>
			</div>
		</div>
	</body>
</html>
