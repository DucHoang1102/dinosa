<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test </title>
</head>
<body>
@php
	$var = ["CT1" => ["S" => 3, "M" => 0, "L" => 1], "CT2" => []];
	var_dump($var["CT1"]["S"]);

	$Size_S = $Size_M = $Size_L = $Size_XL = $Size_XXL = 0;
	$result = [];

	foreach ($orders_daXacNhan as $key => $order) {
		foreach ($order->products as $key => $product) {

			$embryo_tshirt = $product->name_embryo_tshirt;
			$size = $product->size;

			if (!array_key_exists($embryo_tshirt, $result)) { 
				$result[$embryo_tshirt] = ["S" => 0, "M" => 0, "L" => 0, "XL" => 0, "XXL" => 0];
				$result[$embryo_tshirt][$size] = $result[$embryo_tshirt][$size] + 1;
			}
			else {
				$result[$embryo_tshirt][$size] = $result[$embryo_tshirt][$size] + 1;
			}

		}
	}

	var_dump($result);

	
@endphp
</body>
</html>