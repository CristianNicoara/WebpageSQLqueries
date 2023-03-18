<html>
<head>
	<title><center>Exercitiul 6(b)</center></title>
</head>
<body background = "image.jpg">
<h1 style = "font-family:Monaco"><center>Exercitiul 6(b)</center></h1>
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
	$query = "SELECT id_client AS clientul, MIN(valoare) valoare_minima, ROUND(AVG(valoare),2) valoarea_medie, MAX(valoare) valoarea_maxima FROM Bilete GROUP BY id_client;";
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
	 <th>Clientul</th>
	 <th>Valoarea Minima</th>
	 <th>Valoarea Medie</th>
	 <th>Valoarea Maxima</th>
	</tr>'; 
		for ($i=0; $i <$num_results; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		echo '<tr><td align = "center">'.htmlspecialchars(stripslashes($row['clientul'])).'</td>';
		echo '<td align = "center">'.stripslashes($row['valoare_minima']).'</td>';
		echo '<td align = "center">'.stripslashes($row['valoarea_medie']).'</td>';
		echo '<td align = "center">'.stripslashes($row['valoarea_maxima']).'</td>';
	}
	echo '</table>';
	// deconectarea de la BD
	mysqli_close($dsn);
?>
</body>
</html>