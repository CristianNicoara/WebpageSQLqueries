<html>
<head>
	<title><center>Exercitiul 4(b)</center></title>
</head>
<body background = "image.jpg">
<h1 style = "font-family:Monaco"><center>Exercitiul 4(b)</center></h1>
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
	$query = "SELECT bl.nr_bilet as nr_bilet_unu, bl2.nr_bilet as nr_bilet_doi FROM Bilete bl INNER JOIN Bilete bl2 ON (bl.sursa = bl2.sursa)
WHERE bl.sursa = bl2.sursa AND bl.destinatia = bl2.destinatia AND bl.id_client != bl2.id_client AND bl.nr_bilet < bl2.nr_bilet
ORDER BY bl.nr_bilet;";
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
	 <th>Numar Bilet 1</th>
	 <th>Numar Bilet 2</th>
	</tr>'; 
		for ($i=0; $i <$num_results; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		echo '<tr><td align = "center">'.($i+1).'</td>';
		echo '<td align = "center">'.htmlspecialchars(stripslashes($row['nr_bilet_unu'])).'</td>';
		echo '<td align = "center">'.stripslashes($row['nr_bilet_doi']).'</td>';
	}
	echo '</table>';
	// deconectarea de la BD
	mysqli_close($dsn);
?>
</body>
</html>