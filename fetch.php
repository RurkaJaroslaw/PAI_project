<?php


$connect = new PDO("mysql:host=localhost; dbname=login", "root", "");

$query = "
	SELECT * FROM tbl_product WHERE ilosc BETWEEN '".$_POST["minimum_range"]."' AND '".$_POST["maximum_range"]."' ORDER BY ilosc ASC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '
<h4 align="center">Total Item - '.$total_row.'</h4>
<div class="row">
';

if($total_row > 0)
{
    foreach($result as $row)
    {
        $output .= '
		<div class="col-md-2">
			<img src="images/'.$row["image"].'" class="img-responsive img-thumnail img-circle" />
			<h4 align="center">'.$row["book"].'</h4>
			<h3 align="center" class="text-danger">'.$row["ilosc"].'</h3>
			<br />
		</div>
		';
    }
}
else
{
    $output .= '
		<h3 align="center">Nie znaleziono produktu</h3>
	';
}
$output .= '
</div>
';

echo $output;

?>