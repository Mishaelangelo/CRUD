<?php session_start();?>
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
					
					$result = mysql_query("SHOW COLUMNS FROM `{$table_name}`");
					$array=$_GET;
					$sum=0;
					$value=array();
					
					foreach($array as $v)
					{
						$value[]=$v;
					}
					$table_name=$value[0];
					$first_column=$value[1];
					$get_value=$value[2];				
					
					$output_table=mysql_query("SELECT * FROM ".$table_name." WHERE `".$first_column."`='".$get_value."'");
					$number=mysql_num_fields($output_table);
					$old_values=array();
					
					while ($row = mysql_fetch_array($output_table))
							{							
									for($i=0;$i<$number;$i++)
									{
											$old_values[]=$row[$i];
									}
							}
					?>
					<form action='edit_form.php'>
					<?php while($col = mysql_fetch_row($result)) { ?>
						<input name='<?= $col[0]; ?>' placeholder='<?= $col[0]; ?>' value='<?=$old_values[$sum]; ?>'> <br> <!--делаем подсказку и выводим поля-->
					<?php $sum++; } ?>
					<input type='hidden' name='table_name' value='<?=$table_name?>'><!--передаем название таблицы-->
					<input type='hidden' name='first_column' value='<?=$first_column?>'><!--передаем название первой колонки-->
					<input type='hidden' name='get_value' value='<?=$get_value?>'><!--передаем название первого значение-->
					<input type="submit" value="Edit">
					</form>	
			</body>
	</html>		