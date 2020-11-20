<?php
// header("Access-Control-Allow-Origin: *");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$country = $_GET['country'];
// $all = $_GET['all'];
// $stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$country = filter_var($country, FILTER_SANITIZE_STRING);


if(!isset($_GET['all']) && isset($country)){
	$countryContent = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
	$results = $countryContent->fetchAll(PDO::FETCH_ASSOC);
	if($results !== ""){
		echo "<table>";
		echo "<tr><th> Name </th>
			<th> Continent </th>
			<th> Independence </th>
			<th> Head of State </th></tr>";
		foreach ($results as $row){
			echo "<tr><td>".$row['name']."</td>
				<td>".$row['continent']."</td>
				<td>".$row['independence_year']."</td>
				<td>".$row['head_of_state']."</td></tr>";
		}
	}else{
		echo ("Country not found, please attempt again.");
	}
}

if(isset($_GET['all'])){
	$countryContent = $conn->query("SELECT * FROM countries WHERE name  = '{$country}'");
	$results = $countryContent->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($results as $row){
		$countryC = $row['code'];
		$cityContent = $conn->query("SELECT c.name, c.district, c.population FROM cities c
		INNER JOIN countries
		ON countries.code = c.country_code
		WHERE countries.code = '{$countryC}'");
	}
	
	if(!empty($cityContent)){
		echo "<table>";
		echo "<tr><th> Name </th>
			<th> District </th>
			<th> Population </th></tr>";
		foreach ($cityContent as $row){
			echo "<tr><td>".$row['name']."</td>
				<td>".$row['district']."</td>
				<td>".$row['population']."</td></tr>";
		}
	}else{
		echo ("Country not located, please search again.");
	}
}

?>
