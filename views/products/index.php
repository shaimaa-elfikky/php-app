<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
</head>
<title>test-task</title>
<body>
	<h1>Welcome to my website</h1>
	<p>Today is <?php echo date('l, F jS, Y'); ?></p>

    <div calss="container">
        {{content}}
    </div>
	<?php
		// $visitor_name = "John";
		// $visitor_age = 30;
		// echo "<p>My name is $visitor_name and I'm $visitor_age years old.</p>";
	?>
	<p>Thanks for visiting!</p>
</body>
</html>
