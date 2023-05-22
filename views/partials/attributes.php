<!--Weight-->
<div id="productWeight" style="display:none">
    <div class="row mb-3 align-items-center">
        <!-- weight label -->
        <label class="col-sm-1 col-form-label me-5 ms-2">Weight (KG)</label>
        <!-- weight input -->
        <div class="col-sm-2">
            <input id="weight" step="0.001" name="weight" type="number" class="form-control" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="this.setCustomValidity('')">
            <!-- ALERT to show if there is wrong input or non valid ;) -->
            <div class="alert alert-danger" id="validationWeightAlert" role="alert" style="display:none">
            </div>
        </div>
    </div>
    <h6 class="me-5 ms-2 my-4">Please, provide Book weight in KG</h6>
</div>
<!--size-->
<div id="productSize" style="display:none">
    <div class="row mb-3 align-items-center">
        <!-- size label -->
        <label class="col-sm-1 col-form-label me-5 ms-2">Size (MB)</label>
        <!-- size input -->
        <div class="col-sm-2">
            <input id="size" name="size" type="number" step="0.001" class="form-control" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="this.setCustomValidity('')">
            <!-- ALERT to show if there is wrong input or non valid ;) -->
            <div class="alert alert-danger" id="validationSizeAlert" role="alert" style="display:none">
            </div>
        </div>
    </div>
    <h6 class="me-5 ms-2 my-4">Please, provide disc space in MB</h6>
</div>
<!--height-->
<div id="productHeight" style="display:none">
    <div class="row mb-3 align-items-center">
        <!-- height label -->
        <label class="col-sm-1 col-form-label me-5 ms-2">Height (CM)</label>
        <!-- height input -->
        <div class="col-sm-2">
            <input id="height" name="height" type="number" step="0.001" class="form-control" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="this.setCustomValidity('')">
            <!-- ALERT to show if there is wrong input or non valid ;) -->
            <div class="alert alert-danger" id="validationHeightAlert" role="alert" style="display:none">
            </div>
        </div>
    </div>
</div>
<!--width-->
<div id="productWidth" style="display:none">
    <div class="row mb-3 align-items-center">
        <!-- width label -->
        <label class="col-sm-1 col-form-label me-5 ms-2">Width (CM)</label>
        <!-- width input -->
        <div class="col-sm-2">
            <input id="width" name="width" type="number" step="0.001" class="form-control" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="this.setCustomValidity('')">
            <!-- ALERT to show if there is wrong input or non valid ;) -->
            <div class="alert alert-danger" id="validationWidthAlert" role="alert" style="display:none">
            </div>
        </div>
    </div>
</div>
<!--length-->
<div id="productLength" style="display:none">
    <div class="row mb-3 align-items-center">
        <!-- length label -->
        <label class="col-sm-1 col-form-label me-5 ms-2">Length (CM)</label>
        <!-- length input -->
        <div class="col-sm-2">
            <input id="length" name="length" type="number" step="0.001" class="form-control" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="this.setCustomValidity('')">
            <!-- ALERT to show if there is wrong input or non valid ;) -->
            <div class="alert alert-danger" id="validationLengthAlert" role="alert" style="display:none">
            </div>
        </div>
        <h6 class="me-5 ms-2 my-4">Please, provide dimensions in CM</h6>
    </div>
</div>