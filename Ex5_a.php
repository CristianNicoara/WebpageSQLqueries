<html>
<head>
	<title><center>Exercitiul 5(a)</center></title>
</head>
<body background = "image.jpg">
<h1 style = "font-family:Monaco"><center>Exercitiul 5(a)</center></h1>
<?php
	//creare variabile cu nume scurte
	$clasa=$_POST['clasa'];
	$clasa= trim($clasa);
	if (!$clasa)
	{
		echo 'Nu ati introdus criteriul de cautare. Va rog sa incercati din nou.';
		exit;
	}
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
	$query = "SELECT nume FROM Clienti cl JOIN Bilete bl ON (cl.id_client = bl.id_client) WHERE bl.valoare >= ALL(SELECT bl2.valoare FROM Bilete bl2 WHERE bl2.clasa = '".$clasa."') AND bl.clasa = '".$clasa."';";
	$result = mysqli_query($dsn, $query);
	if (!$result)
	{
		die('Interogare gresita :'.mysqli_error($dsn));
	}
	// se obţine numărul tuplelor returnate
	$num_results = mysqli_num_rows($result);
	if ($num_results == 0)
	{
		die( 'Nu s-au gasit rezultate pentru cautarea dumneavoastra');
	}
	// se afişează fiecare tuplă returnată
	echo ' <Table style = "width:75%" border = 1>
	<tr>
	 <th>Nr. row</th>
	 <th>Nume</th>
	</tr>'; 
	for ($i=0; $i <$num_results; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		echo '<tr><td align = "center">'.($i+1).'</td>';
		echo '<td align = "center">'.htmlspecialchars(stripslashes($row['nume'])).'</td>';
	}
	echo '</table>';
	// deconectarea de la BD
	mysqli_close($dsn);
?>
</body>
</html>