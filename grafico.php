<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>example-SUM()- php MySQL examples | w3resource</title>
<meta name="description" content="example-SUM()- php MySQL examples | w3resource">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>Sum of total costs of purchases:</h2>
<table class='table table-bordered'>
<tr>
<th>Sum of total costs of purchases</th>
</tr>
<?php
$hostname="localhost:3307";
$username="root";
$password="Gravidade";
$db = "tutocrudphp";
$dbh = new PDO("MySQL:host=$hostname;dbname=$db", $username, $password);
foreach($dbh->query('SELECT COUNT(*) FROM servidor') as $row) {
echo '<tr>';
echo '<td>' .$row['SUM(Id)'].'</td>';
echo '</tr>'; 
}
?>
</tbody></table>
</div>
</div>
</div>
</body>
</html>