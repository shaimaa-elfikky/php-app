

    <?php if (app()->session->hasFlash('success')); { ?>
        <p class="has-text-success">
            <?= app()->session->getFlash('success'); ?>
        </p>
    <?php } ?>

    <h1>Add a New Product</h1>
    <form method="post" action="/product">
    <div class="columns">
    <div class="column">
    <div class="field">
		<label class="label" for="sku">SKU:</label>
		<input class="input"  type="text" name="sku" id="sku">
        <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['sku'][0]; ?>
            </p>
            <?php endif; ?><br><br>
		<label class="label" for="name">Name:</label>
		<input  class="input"type="text" name="name" id="name">
        <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['name'][0]; ?>
            </p>
            <?php endif; ?><br><br>
		<label class="label" for="price">Price:</label>
		<input class="input" type="text" name="price" id="price"><br><br>
        <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['price'][0]; ?>
            </p>
            <?php endif; ?>
        </div>
        </div>
        <div class="column">
		<label class="label"for="type">Type:</label>
		<select class="dropdown-content" name="type" id="type" onchange="changeForm()">
            <option value="">type switcher</option>
			<option value="book">Book</option>
			<option value="dvd">DVD</option>
			<option value="furniture">Furniture</option>
		</select>
        <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['type'][0]; ?>
            </p>
            <?php endif; ?><br><br>
        <div id="extraFields"></div>
        </div>
        <div id="errorContainer">
            <?php if (app()->session->hasFlash('errors')): ?>
                <p class="has-text-danger">
                    <?= app()->session->getFlash('errors')['type'][0]; ?>
                </p>
            <?php endif; ?>
        </div>

        </div>
		
		<!-- <button type="submit">Create Product</button> -->
        <button class="button is-link">Submit</button>
        <button type="button" class="button is-danger" onclick="cancelForm()">Cancel</button>
        
	
	</form>

    <script>
		function changeForm() {
			var type = document.getElementById("type").value;
			var extraFields = document.getElementById("extraFields");
            var extraFields = document.getElementById("extraFields");
            var errorContainer = document.getElementById("errorContainer");
			if (type == "book") {
				extraFields.innerHTML = '<label for="weight">Weight:</label>  <input type="text" name="weight" id="weight"><br><br><p>“Please, provide weight”</p>';
			} else if (type == "dvd") {
				extraFields.innerHTML = '<label for="size">Size:</label>  <input type="text" name="size" id="size"><br><br><p>“Please, provide size”</p>';
			} else if (type == "furniture") {
				extraFields.innerHTML = '<label for="height">Height:</label>  <input type="text" name="height" id="height"><br><br><label for="width">Width:</label>  <input type="text" name="width" id="width"><br><br><label for="length">Length:</label> <input type="text" name="length" id="length"><br><br><p>“Please, provide height, width and length”  </p>';
			}

                    // Check if error flash message exists
            if (errorContainer && errorContainer.innerHTML.trim() !== "") {
                // Display error message
                errorContainer.style.display = "block";
            } else {
                // Hide error message
                errorContainer.style.display = "none";
            }
		}

        function cancelForm() {
			document.getElementById("sku").value = "";
			document.getElementById("name").value = "";
			document.getElementById("price").value = "";
			document.getElementById("type").selectedIndex = 0;
			document.getElementById("extraFields").innerHTML = "";
		}
	</script>
    <!-- <script>

        document.getElementById('create-product-form').addEventListener('submit', function(event) {
        event.preventDefault(); // prevent the form from submitting normally

        // Retrieve the form data
        const formData = new FormData(event.target);

        // Send a POST request to the API endpoint
        fetch('/insertProduct', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Display a success message to the user
            alert(data.message);
        })
        .catch(error => {
            // Display an error message to the user
            alert('An error occurred while creating the product: ' + error.message);
        });
        });
</script> -->