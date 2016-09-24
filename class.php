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
						printf('Здравствуйте, %s!',
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
					if(!isset($_GET["id"]))
					{
						$id = 1;
					}
					else
					{
						$id = $_GET["id"];
					}
					$result = mysql_query("select * from classes where id='$id'")
						or die(mysql_error());
					$data = mysql_fetch_array($result);
					printf('
						<div class = "info">
							<div class = "name_class">%s</div>
							<div class = "teacher">%s</div>
							<div style = "clear: both;"></div>
						</div>
					',$data['name'],$data['teacher']);
					$result = mysql_query("select * from files where c_id='$id'")
						or die(mysql_error());
					$data = mysql_fetch_array($result);
					if ($data)
					{
						printf('<!--');
						do
						{
							printf(
								'--><a href="files/%s.%s" class = "folder" target = "_blank">
									<img src="img/%s.png">
									<span class>%s</span>
								</a><!--
							',$data["id"],$data["form"],$data["form"],$data["name"]);
						}
						while($data = mysql_fetch_array($result));
						printf('-->');
					}
				?>
			</div>
		</div>
	</body>
</html>