<?php session_start();?>
<html>
		<head>
		<link rel="stylesheet" href="style.css" type="text/css"/>
			<meta charset="utf-8">
		</head>
			<body>
				<?php	
					$db_host = "localhost"; 
					$db_user = "root"; 
					$db_password =""; 
					$db_table = "login"; 

					// Подключение к базе данных
					$db = mysql_connect($db_host,$db_user,$db_password) OR DIE("NO CONNECTION!!!");
					// Выборка базы
					mysql_select_db("City_life",$db);
					$table_name= $_GET['table_name'];
					$first_column= $_GET['first_column'];
					$get_value=$_GET['get_value'];	
										
					$array=$_GET;
					$last=array_pop($array);
					$last=array_pop($array);
					$last=array_pop($array);
					
					$length=0;
					$key=array();
					$var=array();
					foreach($array as $k=>$v)
					{
						$key[]=$k;
						$var[]=$v;
						$length++;
					}
					
					var_dump($length);
					for($i=$length-1;$i>=0;$i--)
					{	
						$result=mysql_query("UPDATE ".$table_name." SET ".$key[$i]."= '".$var[$i]."' WHERE ".$first_column."=".$get_value);
						var_dump("UPDATE ".$table_name." SET ".$key[$i]."= '".$var[$i]."' WHERE ".$first_column."=".$get_value);
					}
				?>
			</body>
</html>