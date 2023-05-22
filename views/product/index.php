<div class="container mt-3 px-5">

    <?php if (app()->session->hasFlash('success')); { ?>
        <p class="has-text-success">
            <?= app()->session->getFlash('success'); ?>
        </p>
    <?php } ?>
    <form method="POST" action="/product/mass-delete" id="products">
    <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Search by SKU..." id="search-input">
    <button class="btn btn-primary" type="button" id="search-btn">Search</button>
    </div>

        <div class="row justify-content-center justify-content-sm-start">
            <?php foreach ($products as $product) : ?>
                <div class="col-10 col-sm-6 col-md-4 col-lg-3 my-3">

                    <div class="card border border-secondary rounded-lg">
                        <div class="card-body text-center">

                            <!-- checkbox -->
                            <div class="form-check">
                                <input class="form-check-input delete-checkbox DVD" name="<?php echo $product['product_id'] ?>" type="checkbox" value="<?php echo $product['type'] ?>" id="flexCheckDefault">
                            </div>
                            <!-- showing Product sku -->
                            <h6><?php echo $product['sku'] ?></h6>
                            <!-- showing Product name -->
                            <h6><?php echo $product['name'] ?></h6>
                            <!-- showing Product price -->
                            <h6><?php echo round($product['price'], 2) . ' $' ?></h6>
                            <!-- showing Product size -->
                            <h6><?php echo $product['details_title'] ?> : <?php echo $product['details'] ?></h6>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // handle click event on search button
    $('#search-btn').click(function() {
     // console.log(123);
        var sku = $('#search-input').val();
        
        // send AJAX request to server to get product data
        $.ajax({
            url: '/api/product/' + sku,
            type: 'GET',
            success: function(response) {
                // handle success response
                console.log(response);
            },
            error: function(error) {
                // handle error response
                console.log(error);
            }
        });
    });
});


</script>
 
<script>
    
    // Define function to handle mass delete action
    function handleMassDelete() {
        // Get all the checked checkboxes
        var checkboxes = document.querySelectorAll('#product-list input[type="checkbox"]:checked');
        // Loop through the checkboxes and get the product IDs
        var productIds = [];
        checkboxes.forEach(function(checkbox) {
            productIds.push(checkbox.value);
        });
        // Make an AJAX request to delete the selected products
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/product/mass-delete");
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Reload the page to show the updated product list
                location.reload();
            } else {
                console.error(xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error(xhr.statusText);
        };
        xhr.send(JSON.stringify(productIds));
    }
    
    // Add click event listener to mass delete button
    var massDeleteBtn = document.getElementById("mass-delete-btn");
    massDeleteBtn.addEventListener("click", handleMassDelete);
    
</script>