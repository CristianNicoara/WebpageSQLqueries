<html>
<head>
	<title><center>Exercitiul 3(a)</center></title>
</head>
<body background = "image.jpg">
<h1 style = "font-family:Monaco"><center>Exercitiul 3(a)</center></h1>
<?php
	// se precizează că se foloseşte PEAR DB
	require_once('PEAR.php');
	$user = 'student';
	$pass = 'student123';
	$host = 'localhost';
	$db_name = 'aeroport';
	// se stabileşte şirul pentru conexiune universală sau DSN
	$dsn= new mysqli( $host, $user, $pass, $db_name);
	// se verifică dacă a funcţionat conectarea
	if ($dsn->connect_error)
	{
		die('Eroare la conectare:'. $dsn->connect_error);
	}
	// se emite interogarea
	$query = 'CALL Ex3a()';
	$result = mysqli_query($dsn, $query);
	if (!$result)
	{
		die('Interogare gresita :'.mysqli_error($dsn));
	}
	// se obţine numărul tuplelor returnate
	$num_results = mysqli_num_rows($result);
	// se afişează fiecare tuplă returnată
	echo ' <Table style = "width:75%" border = 1>
	<tr>
	 <th>Nr. row</th>
	 <th>Clasa</th>
	 <th>Sursa</th>
	 <th>Destinatia</th>
	</tr>'; 
		for ($i=0; $i <$num_results; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		echo '<tr><td align = "center">'.($i+1).'</td>';
		echo '<td align = "center">'.htmlspecialchars(stripslashes($row['clasa'])).'</td>';
		echo '<td align = "center">'.stripslashes($row['sursa']).'</td>';
		echo '<td align = "center">'.stripslashes($row['destinatia']).'</td>';
		//echo '<td>'.stripslashes($row['nota']).'</td>';
	}
	echo '</table>';
	// deconectarea de la BD
	mysqli_close($dsn);
?>
</body>
</html>