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

        <div class="row justify-content-center justify-content-sm-start" id="product-list">
            <?php foreach ($products as $product) : ?>
                <div class="col-10 col-sm-6 col-md-4 col-lg-3 my-3">

                    <div class="card border border-secondary rounded-lg">
                        <div class="card-body text-center">

                            <!-- checkbox -->
                            <div class="form-check">
                                <input class="form-check-input delete-checkbox" name="<?php echo $product['product_id'] ?>" type="checkbox" value="<?php echo $product['type'] ?>" id="flexCheckDefault">
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
      <button onclick="window.location.href = '/product/create'" type="button" class="btn btn-success my-2 my-sm-0 mx-lg-1">ADD</button>

      <button type="submit" form="products" class="btn btn-danger my-2 my-sm-0 mx-1" id="delete-product-btn">MASS DELETE
      </button>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-btn').click(function() {
            var sku = $('#search-input').val();

            // Make the AJAX request
            $.ajax({
                url: '/api/product/' + sku,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        // Product not found
                        $('#product-list').empty().append('<p>' + response.error + '</p>');
                    } else {
                        // Product found, update the product card
                        var productHtml = '<div class="col-10 col-sm-6 col-md-4 col-lg-3 my-3">' +
                            '<div class="card border border-secondary rounded-lg">' +
                            '<div class="card-body text-center">' +
                            '<div class="form-check">' +
                            '<input class="form-check-input delete-checkbox DVD" name="' + response.product_id + '" type="checkbox" value="' + response.type + '" id="flexCheckDefault">' +
                            '</div>' +
                            '<h6>' + response.sku + '</h6>' +
                            '<h6>' + response.name + '</h6>' +
                            '<h6>' + parseFloat(response.price).toFixed(2) + ' $</h6>' +
                            '<h6>' + response.details_title + ': ' + response.details + '</h6>' +
                            '</div></div></div>';

                        $('#product-list').empty().append(productHtml);
                    }
                },
                error: function() {
                    $('#product-list').empty().append('<p>Error occurred while retrieving the product.</p>');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#search-btn').click(function() {
            var sku = $('#search-input').val();

            // Make the AJAX request
            $.ajax({
                url: '/api/product/' + sku,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        // Product not found
                        $('#product-list').empty().append('<p>' + response.error + '</p>');
                    } else {
                        // Product found, update the product card
                        var productHtml = '<div class="col-10 col-sm-6 col-md-4 col-lg-3 my-3">' +
                            '<div class="card border border-secondary rounded-lg">' +
                            '<div class="card-body text-center">' +
                            '<div class="form-check">' +
                            '<input class="form-check-input delete-checkbox DVD" name="' + response.product_id + '" type="checkbox" value="' + response.type + '" id="flexCheckDefault">' +
                            '</div>' +
                            '<h6>' + response.sku + '</h6>' +
                            '<h6>' + response.name + '</h6>' +
                            '<h6>' + parseFloat(response.price).toFixed(2) + ' $</h6>' +
                            '<h6>' + response.details_title + ': ' + response.details + '</h6>' +
                            '</div></div></div>';

                        $('#product-list').empty().append(productHtml);
                    }
                },
                error: function() {
                    $('#product-list').empty().append('<p>NO PRODUCT FOUND.</p>');
                }
            });
        });
    });
</script>


<script>

       
        $('#products').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get the selected product checkboxes
            var productIds = [];
            var types = [];
            $('input.delete-checkbox:checked').each(function() {
            productIds.push($(this).attr('name'));
            types.push($(this).attr('value'));
            });

            // Create the data object to be sent in the request
            var data = {
            types: types,
            productIds: productIds
            };

            // Send the AJAX request
            $.ajax({
            url: '/product/mass-delete',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
               // console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
            });

            return false; 
        });
     
</script>




