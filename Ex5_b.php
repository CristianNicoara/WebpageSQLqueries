<html>
<head>
	<title><center>Exercitiul 5(b)</center></title>
</head>
<body background = "image.jpg">
<h1 style = "font-family:Monaco"><center>Exercitiul 5(b)</center></h1>
<?php
	//creare variabile cu nume scurte
	$ora_plecare=$_POST['ora_plecare'];
	$ora_plecare= trim($ora_plecare);
	$oras_plecare=$_POST['oras_plecare'];
	$oras_plecare= trim($oras_plecare);
	if (!$ora_plecare or !$oras_plecare)
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
	$query = "SELECT* FROM Zboruri WHERE sosire IN (SELECT zb.sosire FROM Zboruri zb
								WHERE zb.plecare = '".$ora_plecare."' AND zb.de_la = '".$oras_plecare."');";
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
	 <th>Numarul zborului</th>
	 <th>Ora Plecare</th>
	 <th>Ora Sosire</th>
	 <th>Oras Plecare</th>
	 <th>Oras Sosire</th>
	 <th>Aparat Zbor</th>
	 <th>Numarul de locuri</th>
	</tr>'; 
	for ($i=0; $i <$num_results; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		echo '<tr><td align = "center">'.($i+1).'</td>';
		echo '<td align = "center">'.htmlspecialchars(stripslashes($row['nr_zbor'])).'</td>';
		echo '<td align = "center">'.stripslashes($row['plecare']).'</td>';
		echo '<td align = "center">'.stripslashes($row['sosire']).'</td>';
		echo '<td align = "center">'.stripslashes($row['de_la']).'</td>';
		echo '<td align = "center">'.stripslashes($row['la']).'</td>';
		echo '<td align = "center">'.stripslashes($row['aparat_zbor']).'</td>';
		echo '<td align = "center">'.stripslashes($row['nr_locuri']).'</td>';
	}
	echo '</table>';
	// deconectarea de la BD
	mysqli_close($dsn);
?>
</body>
</html>