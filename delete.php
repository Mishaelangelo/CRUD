<?php session_start();?>
<?php header("location:".$_SERVER[HTTP_REFERER]); ?> 
	<html>
		<head>
		<link rel="stylesheet" href="style.css" type="text/css"/>
			<meta charset="utf-8">
		</head>
			<body>
				<?php	
					$table_name= $_GET['table_name'];//получение имени таблицы
			
					$db_host = "localhost"; 
					$db_user = "root"; 
					$db_password =""; 
					$db_table = "login"; 

					// Подключение к базе данных
					$db = mysql_connect($db_host,$db_user,$db_password) OR DIE("NO CONNECTION!!!");
					// Выборка базы
					mysql_select_db("City_life",$db);

					$array=$_GET;
					
					$value=array();
					
					foreach($array as $v)
					{
						$value[]=$v;
					}
					$table_name=$value[0];
					$first_column=$value[1];
					$get_value=$value[2];	
	
					$result=mysql_query("DELETE FROM ".$table_name." WHERE ".$first_column."=".$get_value);
				?>
			</body>
	</html>		
	