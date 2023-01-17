<?php
session_start();
include("includes/header.php");
$searchterm = "";
$searchterm = $_GET['searchterm'] ?? "";

$sql = "SELECT university_id FROM top_100_universities";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$getcount = mysqli_query($con, "SELECT COUNT(*) FROM top_100_universities");
if (strlen($searchterm) > 1) {
    $getcount = mysqli_query($con, "SELECT COUNT(*) FROM top_100_universities
     inner join countries on top_100_universities.country_id = countries.country_id  WHERE
    university_name LIKE '%$searchterm%'
    OR nickname LIKE '%$searchterm%'
    OR description LIKE '%$searchterm%'
    OR year_founded LIKE '%$searchterm%'
    OR province LIKE '%$searchterm%'
    OR city LIKE '%$searchterm%'
    OR world_rank LIKE '%$searchterm%'
    OR country_name LIKE '%$searchterm%'");
}

if (!function_exists('mysqli_result')) {
    function mysqli_result($res, $row, $field = 0)
    {
        $res->data_seek($row);
        $datarow = $res->fetch_array();
        return $datarow[$field];
    }
}

$postnum = mysqli_result($getcount, 0);
$limit = 10;
if ($postnum > $limit) {
    $tagend = round($postnum % $limit, 0);
    $splits = round(($postnum - $tagend) / $limit, 0);
    if ($tagend == 0) {
        $num_pages = $splits;
    } else {
        $num_pages = $splits + 1;
    }
    if (isset($_GET['pg'])) {
        $pg = $_GET['pg'];
    } else {
        $pg = 1;
    }
    $startpos = ($pg * $limit) - $limit;
    $limstring = "LIMIT $startpos,$limit";
} else {
    $limstring = "LIMIT 0,$limit";
}


?>
<style>
    .body {
        background: #ddd;
    }

    .form-control-borderless {
        border: none;
    }

    .form-control-borderless:hover,
    .form-control-borderless:active,
    .form-control-borderless:focus {
        border: none;
        outline: none;
        box-shadow: none;
    }
</style>
<main role="main" class="container-fluid">
    <div class="mt-5 row d-flex justify-content-between">
        <div class="col-lg-8 col-md-12 col-sm-12">

            <?php
            if (strlen($searchterm) > 1) :
                $sql = "SELECT university_name, nickname,year_founded, description, province, city, world_rank, tuition, file_name, country_name FROM top_100_universities
            inner join countries on top_100_universities.country_id = countries.country_id  WHERE
                university_name LIKE '%$searchterm%'
                OR nickname LIKE '%$searchterm%'
                OR description LIKE '%$searchterm%'
                OR year_founded LIKE '%$searchterm%'
                OR province LIKE '%$searchterm%'
                OR city LIKE '%$searchterm%'
                OR world_rank LIKE '%$searchterm%'
                OR country_name LIKE '%$searchterm%'
                $limstring";
                $result = mysqli_query($con, $sql);
            ?>
                <!-- Here we write the beginning of the while loop -->
                <?php if (mysqli_num_rows($result) > 0) : ?>
                    <div class="alert alert-info" style="width:400px; margin-top:25px; font-size:15px;">Results for <b><?php echo $searchterm; ?>:</b></div>
                    <table class="table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">World Rank</th>
                                <th scope="col">Universities Name</th>
                                <th scope="col">Average Tuition</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php while ($row = mysqli_fetch_array($result)) : ?>
                                <tr>
                                    <th scope="row"><?php echo $row['world_rank'] ?></th>
                                    <td><a href="detail.php?id=<?php echo $row['university_id'] ?>"><img class="rounded" style="width: 60px; max-height: 40px;" src="admin/thumbs/<?php echo $row['file_name'] ?>" alt="<?php echo $row['file_name'] ?>"></a><?php echo $row['university_name'] ?></td>
                                    <td>$<?php echo number_format($row['tuition']) ?></td>
                                    <td><a class="btn btn-outline-success" href="detail.php?id=<?php echo $row['university_id'] ?>">View</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="alert alert-danger" style="width:400px; margin-top:25px">No Results for <em><?php echo $searchterm; ?></em></div>
                <?php endif; ?>

            <?php else : ?>
                <?php
                $all_result = mysqli_query($con, "SELECT * FROM top_100_universities ORDER BY world_rank Asc $limstring");
                ?>
                <table class="table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">World Rank</th>
                            <th scope="col">Universities Name</th>
                            <th scope="col">Average Tuition</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($all_row = mysqli_fetch_array($all_result)) : ?>
                            <tr>
                                <th scope="row"><?php echo $all_row['world_rank'] ?></th>
                                <td><a href="detail.php?id=<?php echo $all_row['university_id'] ?>"><img class="rounded" style="width: 60px; max-height: 40px;" src="admin/thumbs/<?php echo $all_row['file_name'] ?>" alt="<?php echo $all_row['file_name'] ?>"><a /><?php echo $all_row['university_name'] ?></td>
                                <td>$<?php echo number_format($all_row['tuition']) ?></td>
                                <td><a class="btn btn-outline-success" href="detail.php?id=<?php echo $all_row['university_id'] ?>">View</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 mt-3">
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
            <div class="card card-sm body mt-4">
                <div class="card-body row no-gutters text-center">
                    <h3 class="text-muted mb-4">Lowest Tuition in Top Rank Universities</h3>
                    <?php $result = mysqli_query($con, "SELECT * FROM top_100_universities Order By tuition Asc limit 2"); ?>
                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                        <div style="margin-bottom:20px;" class="d-flex justify-content-center">
                            <!-- Card -->
                            <div class="bg-image card shadow-3-strong" style="background: url('admin/originals/<?php echo $row['file_name'] ?>') center / cover no-repeat; width: 20rem; height: 12rem;">
                            <div style="background-color: rgba(0,0,0,0.2); height:100%; position: relative;">
                                <div class="card-body text-white">
                                    <p class="card-text"><a style="text-decoration: none; color:white;" href="detail.php?id=<?php echo $row['university_id'] ?>"><?php echo $row['university_name'] ?></a></p>
                                    <p class="card-text fw-bold fs-3" style="color:white; position: absolute; left:5px; bottom:0;">$ <?php echo number_format($row['tuition']) ?></p>
                                    <a style="position: absolute; right:5px; bottom:5px;" href="detail.php?id=<?php echo $row['university_id'] ?>" class="btn btn-outline-light">View</a>
                                </div>
                            </div>
                            </div>
                            <!-- Card -->
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

    </div>
    <div class="mt-4" style="display:flex; justify-content:center; margin: auto;">
        <?php
        if (strlen($searchterm) > 1) { // Filtered result
            if ($postnum > $limit) {
                $n = $pg + 1;
                $p = $pg - 1;
                $thisroot = $_SERVER['REQUEST_URI'];
                echo "<ul class=\"pagination pagination-sm\">";
                if ($pg > 1) {
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$thisroot&pg=$p\"><< prev</a></li>";
                }
                for ($i = 1; $i <= $num_pages; $i++) {
                    if ($i != $pg) {
                        echo "<li class=\"page-item \"><a class=\"page-link\" href=\"$thisroot&pg=$i\">$i</a></li>";
                    } else {
                        echo "<li class=\"page-item active\"><a class=\"page-link\">$i</a></li>";
                    }
                }
                if ($pg < $num_pages) {
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$thisroot&pg=$n\">next >></a></li>";
                }
                echo "</ul>";
            }
        } else { //Unfiltered result; no query string or just the "pg=12" pagination 
            if ($postnum > $limit) {
                $n = $pg + 1;
                $p = $pg - 1;
                $thisroot = $_SERVER['PHP_SELF']; // the current file, WHITHOUT any query string
                echo "<ul class=\"pagination pagination-sm\">";
                if ($pg > 1) {
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$thisroot?pg=$p\"><< prev</a></li>";
                }
                for ($i = 1; $i <= $num_pages; $i++) {
                    if ($i != $pg) {
                        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$thisroot?pg=$i\">$i</a></li>";
                    } else {
                        echo "<li class=\"page-item active\"><a class=\"page-link\">$i</a></li>";
                    }
                }
                if ($pg < $num_pages) {
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$thisroot?pg=$n\">next >></a></li>";
                }
                echo "</ul>";
            }
        }
        ?>
    </div>

    <?php include("includes/footer.php"); ?>