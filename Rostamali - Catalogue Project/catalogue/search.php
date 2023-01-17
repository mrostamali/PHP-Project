<?php 

include ("includes/header.php"); 
 
function truncate($text) {
    //specify number for characters to shorten by
    $chars = 21;
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text."...";
    return $text;
}

$searchterm ="";
$x = "";
$y = "";
$displayby ="";
$min = "";
$max = "";
$minvalue = "";
$maxvalue = "";

$searchterm = $_GET['searchterm']?? "";
if(isset($_GET['x'])){
    $x = $_GET['x'];
}

if(isset($_GET['y'])){
	$y = $_GET['y'];
}
if(isset($_GET['displayby'])){
	$displayby = $_GET['displayby'];
}
if(isset($_GET['min'])){
	$min = $_GET['min'];
}
if(isset($_GET['max'])){
	$max = $_GET['max'];
}
if (isset($_POST['submit'])){
    $minvalue = $_POST['minvalue'];
    $maxvalue = $_POST['maxvalue'];
}


$getcount = mysqli_query($con, "SELECT COUNT(*) FROM top_100_universities"); 

if(isset($_GET['searchterm'])){
	$getcount = mysqli_query($con, "SELECT COUNT(*) FROM top_100_universities
    inner join countries on top_100_universities.country_id = countries.country_id  WHERE university_name LIKE '%$searchterm%'
        OR nickname LIKE '%$searchterm%'
        OR description LIKE '%$searchterm%'
        OR year_founded LIKE '%$searchterm%'
        OR province LIKE '%$searchterm%'
        OR city LIKE '%$searchterm%'
        OR world_rank LIKE '%$searchterm%'
        OR country_name LIKE '%$searchterm%'
        ");
}
else if(isset($_GET['x']) && isset($_GET['y'])){
    $getcount =  mysqli_query($con, "SELECT COUNT(*) FROM top_100_universities inner join countries on top_100_universities.country_id = countries.country_id WHERE $x LIKE '$y' ");
}
else if(isset($_GET['displayby']) && isset($_GET['min']) && isset($_GET['max'])){
	$getcount = mysqli_query($con, "SELECT COUNT(*) FROM top_100_universities INNER JOIN countries ON top_100_universities.country_id = countries.country_id WHERE $displayby BETWEEN '$min' AND '$max'");
}
else if(isset($_POST['minvalue']) && isset($_POST['maxvalue'])){
    $getcount = mysqli_query($con, "SELECT COUNT(*) FROM top_100_universities inner join countries on top_100_universities.country_id = countries.country_id WHERE tuition BETWEEN '$minvalue' AND '$maxvalue' ");
}else{
    $getcount = mysqli_query($con, "SELECT COUNT(*) FROM top_100_universities"); 
}

$postnum = mysqli_result($getcount, 0);
$limit = 12;
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

// MySQLi upgrade: we need this for mysql_result() equivalent
function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

$sql = "SELECT university_id, university_name,city, world_rank,file_name, top_100_universities.country_id,public, country_name from top_100_universities inner join countries on top_100_universities.country_id = countries.country_id $limstring";

if(strlen($searchterm) > 1 ){
    $sql = "SELECT university_id, university_name, nickname,year_founded,public, description, province, city, world_rank, tuition, file_name,top_100_universities.country_id, country_name FROM top_100_universities
    inner join countries on top_100_universities.country_id = countries.country_id  WHERE
        university_name LIKE '%$searchterm%'
        OR nickname LIKE '%$searchterm%'
        OR description LIKE '%$searchterm%'
        OR year_founded LIKE '%$searchterm%'
        OR province LIKE '%$searchterm%'
        OR city LIKE '%$searchterm%'
        OR world_rank LIKE '%$searchterm%'
        OR country_name LIKE '%$searchterm%'
        $limstring";}

if(isset($_GET['x']) && isset($_GET['y'])){
    $sql =  "SELECT university_id, university_name,city, world_rank,file_name,top_100_universities.country_id,public, country_name from top_100_universities inner join countries on top_100_universities.country_id = countries.country_id WHERE $x LIKE '$y' $limstring";
}

if( $min && $max){
    $sql = "SELECT toefl_mark, university_id, university_name, city, world_rank, file_name, top_100_universities.country_id, public, country_name FROM top_100_universities INNER JOIN countries ON top_100_universities.country_id = countries.country_id WHERE $displayby BETWEEN '$min' AND '$max' $limstring";
}

if($minvalue && $maxvalue){
    $sql = "SELECT university_id, university_name,city, world_rank,file_name,top_100_universities.country_id,public, country_name from top_100_universities inner join countries on top_100_universities.country_id = countries.country_id WHERE tuition BETWEEN '$minvalue' AND '$maxvalue' $limstring";
}



?>

<style>

    .body{
        background:#ddd;
    }

    .form-control-borderless {
        border: none;
    }

    .form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
        border: none;
        outline: none;
        box-shadow: none;
    }

    .a {
        text-decoration: none;
        color: #006E90;
    }

    #slider-range{
        width: 300px;
        font-size: 10px;		
    }

    .alert {
        padding: 0.6rem !important;
        margin-bottom: 1rem !important;
    }

</style>

<script>
    $(function(){
        
    $("#slider-range").slider({
        range: true,
        min: 1000,
        max: 70000,
        values: [1000, 70000], // HINT: perhaps here is where we could prepopulate these values. You can go into a PHP block here in JS just like you can in HTML

        slide: function(event, ui) {
            $("#minvalue").val(ui.values[0]);
            $("#maxvalue").val(ui.values[1]);
            $("#amount").val(ui.values[0] + " - " + ui.values[1]);
        }

    });
    $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));});
</script>

<main role="main" class="container-fluid">
<div class="mt-5 row d-flex justify-content-between">

    <div class="col-lg-4 col-md-12 col-sm-12 me-5" >
    
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

            <div class="card mt-3">
                <div class="card-body">
                    <h4>Filter by:</h4>
                    <a href="search.php" class="a">ALL Universities</a><br>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <h5>Universities Type</h5> 
                    <a href="search.php?x=public&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "public" && isset($y) && $y == "1"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Public</a><br> 
                    <a href="search.php?x=public&y=0" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "public" && isset($y) && $y == "0"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Private</a><br>                 
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Language Proficiency</h5> 
                    <a href="search.php?x=ielts_mark&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "ielts_mark"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Accept IELTS</a><br>  
                    <a href="search.php?x=gre_mark&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "gre_mark"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Accept GRE</a><br>  
                    <a href="search.php?displayby=toefl_mark&min=60&max=80" style="text-decoration: none; color: #006E90;" <?php if(isset($min) && $min == "60"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Accept TOEFL Mark Between 60 - 80 </a><br>   
                    <a href="search.php?displayby=toefl_mark&min=80&max=90" style="text-decoration: none; color: #006E90;" <?php if(isset($min) && $min == "80"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Accept TOEFL Mark Between 80 - 90 </a><br>  
                    <a href="search.php?displayby=toefl_mark&min=90&max=100" style="text-decoration: none; color: #006E90;" <?php if(isset($min) && $min == "90"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Accept TOEFL Mark Between 90 - 100 </a><br> 
                    <a href="search.php?displayby=toefl_mark&min=100&max=110" style="text-decoration: none; color: #006E90;" <?php if(isset($min) && $min == "100"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Accept TOEFL Mark Between 100 - 110 </a><br> 
                    <a href="search.php?displayby=toefl_mark&min=110&max=120" style="text-decoration: none; color: #006E90;" <?php if(isset($min) && $min == "110"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Accept TOEFL Mark Between 110 - 120 </a><br>           
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Faculties</h5> 
                    <a href="search.php?x=dentistry&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "dentistry"){echo "class=\"badge bg-success text-white fs-6\" ";} ?> >Dentistry</a><br>  
                    <a href="search.php?x=art_humanities&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "art_humanities"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Art & Humanities</a><br>               
                    <a href="search.php?x=computer_science&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "computer_science"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Computer Science</a><br>  
                    <a href="search.php?x=engineering_technology&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "engineering_technology"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Engineering & Technology</a><br>  
                    <a href="search.php?x=business_management&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "business_management"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Business Management</a><br>  
                    <a href="search.php?x=life_sciences_medicine&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "life_sciences_medicine"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Life Sciences & Medicine</a><br>  
                    <a href="search.php?x=medical_science&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "medical_science"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Medical Science</a><br>  
                    <a href="search.php?x=natural_sciences&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "natural_sciences"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Natural Sciences</a><br>  
                    <a href="search.php?x=social_sciences_management&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "social_sciences_management"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>Social Sciences & Management</a><br>  
                    <a href="search.php?x=mba&y=1" style="text-decoration: none; color: #006E90;" <?php if(isset($x) && $x == "mba"){echo "class=\"badge bg-success text-white fs-6\" ";} ?>>MBA</a><br>  
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">

                <h5>Annual Tuition Range</h5>
                    <form name="myform" action="search.php" method="post">
                        <!-- <label for="amount">Price range:</label> -->
                        <input type="text" id="amount" style="border: 0; color: green; font-weight: bold;" /><br />
                        <input type="hidden" id="minvalue" name="minvalue"  value="1000"/>
                        <input type="hidden" id="maxvalue" name="maxvalue"  value="70000"/>
                        <div id="slider-range"></div>                     
                        <input class="btn btn-success mt-2" type="submit" name="submit" />
                    </form>
                    <?php if (isset($_POST['submit'])):?>
                    <div class="fw-bold mt-3"><p>Tuitions between $<?php echo number_format($minvalue) ?> and $<?php echo number_format($maxvalue) ?></p></div>
                    <?php endif; ?>

                </div>
            </div>

    </div>
	
    <div class="col-lg-7 col-md-12 col-sm-12">  
        <?php     
            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        ?>

        <?php if(strlen($searchterm) > 1  && mysqli_num_rows($result) > 0): ?>
            <div class="alert alert-info" style="width:400px; font-size:15px;">Results for <b><?php echo $searchterm; ?>:</b></div>
            <?php elseif(strlen($searchterm) > 1 && mysqli_num_rows($result) == 0): ?>
            <div class="alert alert-danger" style="width:400px; margin-top:25px">No Results for <em><?php echo $searchterm; ?></em></div>
        <?php endif; ?> 
            
        <div class="mb-5" style="display: flex; flex-wrap:wrap; gap:20px; justify-content: space-between;">	
            <?php if(mysqli_num_rows($result) == 0){echo "<h2>No results found</h2>";
                    }else{
                        while ($row = mysqli_fetch_array($result)): ?>
                            <?php 
                                $public = $row['public'];
                                $countryId = $row['country_id'];
                                $sql_country = "SELECT * FROM countries where country_id = '$countryId' ";
                                $country_result = mysqli_query($con, $sql_country) or die (mysqli_error($con));
                                $country_row = mysqli_fetch_array($country_result);
                                $country_name = $country_row['country_name'];
                            ?>
                            <div class="card" style="width: calc(100% / 4 - 1rem);" >
                                <a href="detail.php?id=<?php echo $row['university_id']?>" ><img src="admin/thumbs/<?php echo $row['file_name'] ?>" alt="<?php echo $row['file_name'] ?>" class="card-img-top"></a>
                                <div class="card-body">
                                    <h6 class="card-title"><a href="detail.php?id=<?php echo $row['university_id']?>" style="text-decoration:none; color:#034078;"><?php echo truncate($row['university_name'])?></a></h6>
                                    <p class="card-text mb-0"><?php echo $country_name. ", " .$row['city']?></p>
                                    <p class="card-text"><small class="text-muted">World Rank: <?php echo $row['world_rank']?></small></p>
                                </div>
                            </div>
                        <?php endwhile; 
                    }?>
        </div>


        <div class="d-flex justify-content-center">
        <?php
            if(strlen($searchterm) > 1 || $displayby || $min|| $minvalue || $x ){ // Filtered result
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
            }else{ //Unfiltered result; no query string or just the "pg=12" pagination 
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
                      
    </div>

   
    
</div>
        
<?php include ("includes/footer.php"); ?>