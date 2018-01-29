<?php session_start(); ?>
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
			
			if (!$result) 
			{
				echo "Ошибка базы, не удалось получить список таблиц\n";
				exit;
			} ?>
			<!--вывести таблицу-->
			<?php 
				$column=mysql_query("SHOW COLUMNS FROM ".$table_name);
				$output_table=mysql_query("SELECT * FROM ".$table_name);
				$number=mysql_num_fields($output_table);
				$first_column=0;
				$sum=0;
				
			?>
	
				<!--вывод таблицы-->
				<?php 
				if(mysql_num_rows($output_table))	
				{
					echo '<table padding="4" border="1">';
						echo '<tr>';
							while ($title = mysql_fetch_array($column))
							{
								echo '<td>'.$title[0].'</td>';
								if($sum==0)
								{
									$first_column=$title[0];
								}
								$sum++;
							}
							echo '<td>'."action".'</td>';
							echo '<td>'."change".'</td>';
						echo '</tr>';
						
							$sum=0;
							while ($row = mysql_fetch_array($output_table))
							{	
								echo'<tr>';						
									for($i=0;$i<$number;$i++)
									{
											echo'<td>'.$row[$i].'</td>';
									}
									
								
					?>
							 <td><a href="delete.php?table_name=<?= $table_name ?>&first_column=<?=$first_column ?>&get_column=<?=$row[0]?>"><?php echo "delete"; ?></a></td>
							 <td><a href="edit.php?table_name=<?= $table_name ?>&first_column=<?=$first_column ?>&get_column=<?=$row[0]?>&show_colums=<?=$result?>"><?php echo "edit"; ?></a></td>
							<?php 
							echo'</tr>';
							}								
					echo '</table>';
				}
				?>	
				
				<?php if($_GET['action'] == 'send') { ?>
				<?php  
					$array=$_GET;
					$last=array_pop($array);
					$last=array_pop($array);
					
					$key=array();
					$var=array();
					foreach($array as $k=>$v)
					{
						$key[]=$k;
						$var[]=$v;
					}
					$new_key =implode(", ",$key);
					$new_var =implode("', '",$var);
					$add=mysql_query("INSERT INTO ".$table_name." (".$new_key.") VALUES ('".$new_var."');");
					echo "success!";
				?>
			<?php } else { ?>		
				<form action='table_show.php'>
					<?php while($col = mysql_fetch_row($result)) { ?>
						<input name='<?= $col[0]; ?>' placeholder='<?= $col[0]; ?>'><br><!--делаем подсказку и выводим поля-->
					<?php } ?>
					<input type='hidden' name='table_name' value='<?= $_GET['table_name']; ?>'><!--передаем название таблицы-->
					<input type='hidden' name='action' value='send'><!--пишем для отслеживания действия-->
					<input type="submit" value="Add">
				</form>
			<?php } ?>
		</body>
	</head>
</html>