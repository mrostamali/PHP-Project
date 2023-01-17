<form class="card card-sm body" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="get">
    <div class="card-body row no-gutters align-items-center">
        <div class="col-auto">
            <!-- <i class="fas fa-search h4 text-body"></i> -->
            <i class="bi bi-search h4 text-body"></i>
        </div>
        <!--end of col-->
        <div class="col">
            <input class="form-control form-control-lg form-control-borderless" type="text" name="searchterm" value="<?php echo $searchterm; ?>" placeholder="Search topics or keywords">
        </div>
        <!--end of col-->
        <div class="col-auto">
            <!-- <button class="btn btn-lg btn-success" type="submit">Search</button> -->
            <input type="submit" name="mysubmit" class="btn btn-lg btn-success" value="Search">
        </div>
        <!--end of col-->
    </div>
</form>

<div class="card mt-4">
    <div class="card-header">
        <h5>Search by Faculties</h5>
    </div>
    <div class="card-body d-flex">
        <div class="col-6">
            <p class="card-text">Arts & Humanities</p>
        </div>
        <div class="col-6">
            <p class="card-text">MBA</p>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5>Search by Minumum required IELTS Mark</h5>
    </div>
    <div class="card-body d-flex">
        <div class="col-4">
            <p class="card-text">6+</p>
            <p class="card-text">6.5+</p>
        </div>
        <div class="col-4">
            <p class="card-text">7+</p>
            <p class="card-text">7.5+</p>
        </div>
        <div class="col-4">
            <p class="card-text">8+</p>
            <p class="card-text">8.5+</p>
        </div>
    </div>
</div>