<?php
	include("connect.php");
	if (!isset($_COOKIE['login']))
		header("Location: /login.php");
	if($_FILES)
	{
		$mes = "<div class = 'mess'>";
		$query = mysql_query("select count(*) from files");
		$count = mysql_fetch_array($query);
		$id = $count[0]+1;
		$old_name = $_FILES['userfile']['name'];
		$name = $_POST['name'];
		$form = substr(strrchr($old_name, '.'), 1);
		$c_id = (int)$_POST['type'];
	
		$file="files/".$id.".".$form;
		$tempfile=$_FILES['userfile']['tmp_name'];
		if (is_uploaded_file($tempfile))
		{
			if (!copy($tempfile,$file))
			{
				$mes .= "Не удалось скопировать файл {$_FILES['userfile']['name']}";
			}
			else
			{
				$mes .= "Файл {$_FILES['userfile']['name']} ({$_FILES['userfile']['size']} байт) загружен успешно";
				$result = mysql_query ("INSERT INTO files VALUES ('$id','$old_name','$name','$form','$c_id')");
				if ($result == 'true')
				{
				    $mes .= "<br>Информация занесена в базу данных<br>";
				}
				else
				{
					
				    $mes .= "<br>".mysql_error()."<br>Информация не занесена в базу данных<br>";
				}
			}
		}
		elseif (!empty($_FILES['userfile']['name']))
		{
			$mes .= "Не удалось загрузить файл {$_FILES['userfile']['name']}";
		}
		$mes .= "</div>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
  		<title>Добавление материалов</title>
		<meta http-equiv = "Content-Type" content = "text/html; charset = utf-8" />
		<link rel = "stylesheet" type = "text/css" href = "css/style2.css" />
		<link rel = "shortcut icon" href = "favicon.ico" type="image/x-icon">
	</head>
	<body>
		<div class = "page">
			<a class = 'index' href = 'index.php'>Вернуться на главную страницу</a>
			<div class = "login">
				<h1>Добавление материалов</h1>
				<form method = "post" action = "add.php" enctype="multipart/form-data">
					<div class="fileform">
						<input id="upload" type="file" name="userfile" required />
						<div class="selectbutton">Выберите файл</div>
					</div>
					<input type = "text" id = "name_mat" placeholder = "| Название материала |" name = "name" required><br>
					<select class = "spisok" name = "type">
						<?php
							$result = mysql_query("select * from classes")
								or die(mysql_error());
							$data = mysql_fetch_array($result);
							do
							{
								printf('<option value = "%s">%s</option>',
									$data["id"],$data["name"]);
							}
							while($data = mysql_fetch_array($result));
						?>
					</select><br>
					<input type = "submit" class = "sub" value = "Добавить" name = "enter">					
				</form>
				<?php echo $mes; ?>
			</div>
		</div>
	</body>
</html>