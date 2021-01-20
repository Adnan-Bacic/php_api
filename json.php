<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	$search = urlencode(filter_input(INPUT_GET, 'search'));
	$searchType = filter_input(INPUT_GET, 'searchtype');
	$submit = filter_input(INPUT_GET, 'submit');

	if(isset($submit)){
		if(!empty($search)){
			switch ($searchType){
				case 'stof':
				$url = "https://api.medicinpriser.dk/v1/produkter/virksomtstof/{$search}?format=json";
				break;
				
				default:
				$url = "https://api.medicinpriser.dk/v1/produkter/{$search}?format=json";
				break;
			};

			$data = file_get_contents($url);
			$json = json_decode($data);
		}
	}

	$urlDetails = "http://api.medicinpriser.dk/v1/produkter/detaljer/";

	$num = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JSON API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1>Search for medicine</h1>
				<form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET" autocomplete="off">
					<div class="form-group">
						<label for="search">Name</label>
						<input type="text" name="search" id="search" class="form-control">
					</div>
					<div class="form-group">
						<select class="custom-select" name="searchtype">
							<option value="product">Produkt</option>
							<option value="stof">Virksomtstof</option>
						</select>
					</div>
					<button type="submit" name="submit" class="btn btn-primary">Search</button>
				</form>
			</div>
		</div>

		<hr class="mt-3 mb-3">

		<?php
		if(empty($search)){
			echo "<h2>No search set</h2>";
		} else {
			?>
		<div class="row">
			<div class="col-12">
				<h2><?php echo "Results for {$search}" ?></h2>
				<table class="table table-striped">
					<thead class="thead bg-primary">
						<tr class="text-light">
						<th scope="col">#</th>
						<th scope="col">Navn</th>
						<th scope="col">Varenummer</th>
						<th scope="col">Firma</th>
						<th scope="col">Styrke</th>
						<th scope="col">Detaljer</th>
						<th scope="col">Pakning</th>
						</tr>
					</thead>
					<tbody>
					<?php
					//loop through data
					foreach($json as $product){
						?>
						<tr>
							<th><?php echo $num++ ?></th>
							<td><?php echo $product->Navn ?></td>
							<td><?php echo $product->Varenummer ?></td>
							<td><?php echo $product->Firma ?></td>
							<td><?php echo $product->Styrke ?></td>
							<td><a href="<?php echo $urlDetails . $product->Varenummer ?>" target="_blank">See details</a></td>
							<td><?php echo $product->Pakning ?></td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</body>
	
	
	
</html>