<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 
  <title>Test Task</title>

  <style>
    .box {
    padding: 1rem;
    border-radius: 5px;
    background-color: #f0e9e9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    margin-bottom: 1rem;
    border: 1px solid black;
    width: 30%;
    display: inline-block;
    vertical-align: top;
    margin-right: 2%;
    margin-bottom: 2%;
}

/* Define box title styles */
.box-title {
	font-size: 1.5rem;
	font-weight: bold;
	margin-bottom: 0.5rem;
}

/* Define box detail styles */
.box-detail {
	font-size: 1rem;
	line-height: 1.5;
}

/* Define checkbox styles */
input[type=checkbox] {
	margin-right: 0.5rem;
}
  </style>
</head>

<body>
  <?php include view_path() . '/partials/navbar.php'; ?>

  <div class="container">
    {{content}}
  </div>

  <footer class="my-3 fixed-bottom">
    <!-- <div class="container">
      <hr>
      <h5 class="text-center"> Test Task</h5>
    </div> -->
  </footer>

</body>

</html>