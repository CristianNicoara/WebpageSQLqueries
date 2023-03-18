<html>
<head>
	<title><center>Exercitiul 6(a)</center></title>
</head>
<body background = "image.jpg">
<h1 style = "font-family:Monaco"><center>Exercitiul 6(a)</center></h1>
<?php
	$an=$_POST['an'];
	$an= trim($an);
	if (!$an)
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
	$query = "SELECT nr_zbor, COUNT(nr_bilet) numar_de_bilete FROM Cupoane WHERE SUBSTR(plecare,7,4) = '".$an."' GROUP BY nr_zbor;";
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
	 <th>Numarul Zborului</th>
	 <th>Numarul de Bilete</th>
	</tr>'; 
		for ($i=0; $i <$num_results; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		echo '<tr><td align = "center">'.($i+1).'</td>';
		echo '<td align = "center">'.htmlspecialchars(stripslashes($row['nr_zbor'])).'</td>';
		echo '<td align = "center">'.stripslashes($row['numar_de_bilete']).'</td>';
	}
	echo '</table>';
	// deconectarea de la BD
	mysqli_close($dsn);
?>
</body>
</html>