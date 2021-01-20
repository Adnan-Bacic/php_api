<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JSON and XML API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
        <div class="col-12">
            <button class="btn btn-info" id="toggle">Toggle</button>
        </div>
        </div>
    </div>
    <?php
    require 'xml.php';
    require 'json.php';
    ?>
    <script>
        const xml = document.querySelector('#xml')
        const json = document.querySelector('#json')
        const toggle = document.querySelector('#toggle')

        toggle.addEventListener('click', () => {
            xml.classList.toggle('d-none')
            json.classList.toggle('d-none')
        })
    </script>
</body>
</html>