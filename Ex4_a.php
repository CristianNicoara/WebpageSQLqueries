<html>
<head>
	<title><center>Exercitiul 4(a)</center></title>
</head>
<body background = "image.jpg">
<h1 style = "font-family:Monaco"><center>Exercitiul 4(a)</center></h1>
<?php
	//creare variabile cu nume scurte
	$destinatia=$_POST['destinatia'];
	$destinatia= trim($destinatia);
	$nume=$_POST['nume'];
	$nume= trim($nume);
	if (!$destinatia or !$nume)
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
	$query = "SELECT cl.nume nume, cl.statut statut, bl.nr_bilet nr_bilet, bl.clasa clasa, bl.valoare valoare, bl.sursa sursa, bl.destinatia destinatia, zb.plecare plecare_unu, zb2.plecare plecare_doi, zb2.sosire sosire FROM Clienti cl JOIN Bilete bl ON(cl.id_client = bl.id_client) JOIN Cupoane cp ON (bl.nr_bilet = cp.nr_bilet) JOIN Zboruri zb ON (cp.plecare = zb.plecare) JOIN Zboruri zb2 ON (bl.destinatia = zb2.la AND zb.la = zb2.de_la) WHERE zb.la = '".$destinatia."' AND cl.nume = '".$nume."';";
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
	 <th>Statut</th>
	 <th>Nr. Bilet</th>
	 <th>Clasa</th>
	 <th>Vaoloare</th>
	 <th>Sursa</th>
	 <th>Destinatia</th>
	 <th>Plecare Zbor 1</th>
	 <th>Plecare Zbor 2</th>
	 <th>Sosirea finala</th>
	</tr>'; 
	for ($i=0; $i <$num_results; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		echo '<tr><td align = "center">'.($i+1).'</td>';
		echo '<td align = "center">'.htmlspecialchars(stripslashes($row['nume'])).'</td>';
		echo '<td align = "center">'.stripslashes($row['statut']).'</td>';
		echo '<td align = "center">'.stripslashes($row['nr_bilet']).'</td>';
		echo '<td align = "center">'.stripslashes($row['clasa']).'</td>';
		echo '<td align = "center">'.stripslashes($row['valoare']).'</td>';
		echo '<td align = "center">'.stripslashes($row['sursa']).'</td>';
		echo '<td align = "center">'.stripslashes($row['destinatia']).'</td>';
		echo '<td align = "center">'.stripslashes($row['plecare_unu']).'</td>';
		echo '<td align = "center">'.stripslashes($row['plecare_doi']).'</td>';
		echo '<td align = "center">'.stripslashes($row['sosire']).'</td>';
	}
	echo '</table>';
	// deconectarea de la BD
	mysqli_close($dsn);
?>
</body>
</html>