<?php session_start(); ?>
<html>
<head>
<meta charset="utf-8">
</head>
	<body>
		<h1>Big City Life</h1>
		<?php  
        // Параметры подключения
        $db_host = "localhost"; 
        $db_user = "root"; 
        $db_password =""; 
        $db_table = "login"; 

        // Подключение к базе данных
        $db = mysql_connect($db_host,$db_user,$db_password) OR DIE("NO CONNECTION!!!");

        // Выборка базы
        mysql_select_db("City_life",$db);
		 
		$result = mysql_list_tables("City_life");
		 
		if (!$result) {
			echo "Ошибка базы, не удалось получить список таблиц\n";
			exit;
		}
		 
		while($row = mysql_fetch_row($result))
		{
		?>
				<?php $table_name=$row[0]; ?>
			<p> <a href="table_show.php?table_name=<?= $row[0]; ?>"]><?php echo $table_name ?></a></p>
			<?php } ?>
	</body>
</html>