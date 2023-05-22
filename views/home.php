
<div class = "container mt-3 px-5">   
    <div class="row align-items-center">
        <!-- header text -->
        <div class="col">
            <h1 class="ms-2">Product List</h1>
        </div>
        <!-- buttons -->
        <div class="col">
            <!-- ADD BUTTON -->
            <!--Link with (add product page) by clicking (ADD button)-->
            <button onclick=" window.location.href = 'product/add' " type="button" class="btn btn-light  float-end me-2" >ADD</button>
            <!--DELETE BUTTON -->
            <button type="submit" form= "products" class="btn btn-danger float-end me-2" id ="delete-product-btn">MASS DELETE</button>                      
        </div>
    </div>
    <hr>


    <form id = "products" action="product/delete" method="post">
        <div class="row">
            


        </div>
    </form>

</div>

