<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

//check thype of lookup
$lookupType = isset($_GET['lookup']) ? $_GET['lookup'] : 'countries';

// Check Country
if (isset($_GET['country']) && !empty($_GET['country'])) {
  $country = $_GET['country'];
  if ($lookupType === 'cities') {
    $stmt = $conn->query("SELECT cities.name as city_name, cities.district, cities.population 
                             FROM cities 
                             JOIN countries ON cities.country_code = countries.code 
                             WHERE countries.name LIKE '%$country%' 
                             ORDER BY cities.population DESC");

  }else{
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  }

 
}else {
  if ($lookupType === 'cities') {
    echo "Please enter a country name for city lookup.";
    exit;
  } else {
    $stmt = $conn->query("SELECT * FROM countries");
  }
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($lookupType === 'cities') {
  //display city
?>
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($results as $row): ?>
  <td><?= $row['city_name'] ?></td>
  <td><?= $row['district']; ?></td>
  <td><?= $row['population']; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php
} else {
//display country
?>
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Continent</th>
      <th>Independence</th>
      <th>Head of State</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($results as $row): ?>
  <td><?= $row['name'] ?></td>
  <td><?= $row['continent']; ?></td>
  <td><?= $row['independence_year']; ?></td>
  <td><?= $row['head_of_state']; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php
}
?>


