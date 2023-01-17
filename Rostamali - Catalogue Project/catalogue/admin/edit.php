<?php
// SECURE SITE: here, we make sure anyone accessing has been to login first. Else, we send them there
// This will go at the top of All YOUR SECURE PAGES.
// Generally, we may secure the /admin/ functions of an app (insert, edit, etc.), but not the public face (index.php)
session_start();
if(!isset( $_SESSION['your-random-session-helloyou'])){

	header("Location: login.php?refer=edit");
}
include("../includes/header.php");
?>
<main role="main" class="container">

<?php
include("../includes/variables.php"); 

$id = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];    
   
}if(!$id){
    $sql = "SELECT university_id FROM top_100_universities LIMIT 1 ";
    $result = mysqli_query($con, $sql) or die (mysqli_error($con));
    while($row = mysqli_fetch_array($result)){
        $id = $row['university_id'];  
    } 
}

$getcount = mysqli_query($con, "SELECT COUNT(*) FROM top_100_universities"); 
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

// MySQLi upgrade: we need this for mysql_result() equivalent
function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}


if(isset($_POST['submit'])){

    // FILE TYPE
    // if($_FILES['myfile']['type'] != "image/jpeg"){
    //     if($_FILES['myfile']['type'] == "image/png"){
    //         $filetype = "png";
    //         $valid = 1;
    //     }else{
    //         $valid = 0; 
    //         $picture_Msg  .= "<p>Not a JPG or PNG image</p>";
    //     }
    // }else{
    //     $filetype = "jpg";
    //     $valid = 1;
    // }

    // SIZE: here is set artificially low. Should be about 8 MB
    // if($_FILES['myfile']['size'] > (10000 * 1024)){ // Units here are KB
    //     $valid = 0;
    //     $picture_Msg  .= "<p>File is too large</p>";
    // }

    // if($filetype == ""){
    //     $valid = 0;  
    //     $picture_Msg = "<p>Please upload a photo.</p>";
    // }
    
    $valid = 1;
    //Post the inputs
    $university_name = strip_tags(trim($_POST['university_name'])); 
    isset($_POST['public']) ? $public = 1 : $public = 0;
    $nickname = strip_tags(trim($_POST['nickname']));
    $world_rank = strip_tags(trim($_POST['world_rank']));
    $year_founded = strip_tags(trim($_POST['year_founded']));
    $country = $_POST['country'];
    $province = strip_tags(trim($_POST['province']));
    $city = strip_tags(trim($_POST['city']));
    $toefl_mark = strip_tags(trim($_POST['toefl_mark']));
    isset($_POST['ielts_mark']) ? $ielts_mark = 1 : $ielts_mark = 0;
    isset($_POST['gre_mark']) ? $gre_mark = 1 : $gre_mark = 0;
    // $ielts_mark = strip_tags(trim($_POST['ielts_mark']));
    // $gre_mark = strip_tags(trim($_POST['gre_mark']));
    $average_tuition = strip_tags(trim($_POST['average_tuition']));
    $no_of_fulltime_student = strip_tags(trim($_POST['no_of_fulltime_student']));
    $no_of_international_student = strip_tags(trim($_POST['no_of_international_student']));
    $no_of_faculty_staff = strip_tags(trim($_POST['no_of_faculty_staff']));
    $website_url = strip_tags(trim($_POST['website_url']));
    $youtube_embed = strip_tags(trim($_POST['youtube_embed']));
    $description = strip_tags(trim($_POST['description']));

    //Programs
    isset($_POST['dentistry']) ? $dentistry = 1 : $dentistry = 0;
    isset($_POST['arts_humanities']) ? $arts_humanities = 1 : $arts_humanities = 0;
    isset($_POST['computerScience']) ? $computerScience = 1 : $computerScience = 0;
    isset($_POST['engineering_technology']) ? $engineering_technology = 1 : $engineering_technology = 0;
    isset($_POST['business_management']) ? $business_management = 1 : $business_management = 0;
    isset($_POST['lifeSciences_medicine']) ? $lifeSciences_medicine = 1 : $lifeSciences_medicine = 0;
    isset($_POST['medical_science']) ? $medical_science = 1 : $medical_science = 0;
    isset($_POST['natural_sciences']) ? $natural_sciences = 1 : $natural_sciences = 0;
    isset($_POST['socialSciences_management']) ? $socialSciences_management = 1 : $socialSciences_management = 0;
    isset($_POST['MBA']) ? $MBA = 1 : $MBA = 0;


    //Validate form inputs!!

    // University Name
    if($university_name != ""){
        if ((strlen($university_name) < 5) || (strlen($university_name) > 150)) {
            $valid = 0;  
            $university_name_Msg = "<p>Please enter a university name from 5 to 150 characters.</p>";
        }
    }else{
        $valid = 0;  
        $university_name_Msg = "<p>Please enter a university name.</p>";
    }

    // Nickname
    if($nickname != ""){
        if ((strlen($nickname) < 3) || (strlen($nickname) > 100)) {
            $valid = 0;  
            $nickname_Msg = "<p>Please enter a nickname from 3 to 100 characters.</p>";
        }
    }

    // World Rank
    if($world_rank != ""){
        if ((strlen($world_rank) < 1) || (strlen($world_rank) > 5)) {
            $valid = 0;  
            $world_rank_Msg = "<p>Please enter a rank from 1 to 5 numbers.</p>";
        }
    }else{
        $valid = 0;  
        $world_rank_Msg = "<p>Please enter a world rank.</p>";
    }

    // Year Founded
    if($year_founded != ""){
        if ((strlen($year_founded) < 4) || (strlen($year_founded) > 4)) {
            $valid = 0;  
            $year_founded_Msg = "<p>Please enter a 4-digit year.</p>";
        }
    }else{
        $valid = 0;  
        $year_founded_Msg = "<p>Please enter the year founded.</p>";
    }

    // Country
    if($country == ""){
        $valid = 0;  
        $country_Msg = "<p>Please select a country.</p>";
    }

    // Province
    if($province != ""){
        if ((strlen($province) < 5) || (strlen($province) > 50)) {
            $valid = 0;  
            $province_Msg = "<p>Please enter between 5 to 50 characters.</p>";
        }
    }

    // City
    if($city != ""){
        if ((strlen($city) < 5) || (strlen($city) > 50)) {
            $valid = 0;  
            $city_Msg = "<p>Please enter between 5 to 50 characters.</p>";
        }
    }

    // Toefl Mark
    if($toefl_mark != ""){
        if ((strlen($toefl_mark) < 1) || (strlen($toefl_mark) > 3)) {
            $valid = 0;  
            $toefl_mark_Msg = "<p>Please enter a digit between 1 to 120.</p>";
        }if (($toefl_mark < 1) || ($toefl_mark > 120)) {
            $valid = 0;  
            $toefl_mark_Msg = "<p>Please enter a digit between 1 to 120.</p>";
        } 
    }else{
        $valid = 0;  
        $toefl_mark_Msg = "<p>Please enter miniumum TOEFL mark.</p>";
    }

    // IELTS Mark
    // if($ielts_mark != ""){
    //     if ((strlen($ielts_mark) < 1) || (strlen($ielts_mark) > 3)) {
    //         $valid = 0;  
    //         $ielts_mark_Msg = "<p>Please enter a digit between 1 to 9.</p>";
    //     }if (($ielts_mark < 1) || ($ielts_mark > 9)) {
    //         $valid = 0;  
    //         $ielts_mark_Msg = "<p>Please enter a digit between 1 to 9.</p>";
    //     }
    // }
    // else{
    //     $valid = 0;  
    //     $ielts_mark_Msg = "<p>Please enter miniumum IELTS mark.</p>";
    // }

    // GRE Mark
    // if($gre_mark != ""){
    //     if ((strlen($gre_mark) < 1) || (strlen($gre_mark) > 3)) {
    //         $valid = 0;  
    //         $gre_mark_Msg = "<p>Please enter a digit between 1 to 340.</p>";
    //     }if (($gre_mark < 1) || ($gre_mark > 340)) {
    //         $valid = 0;  
    //         $gre_mark_Msg = "<p>Please enter a digit between 1 to 340.</p>";
    //     }
    // }
    // else{
    //     $valid = 0;  
    //     $gre_mark_Msg = "<p>Please enter miniumum IELTS mark.</p>";
    // }

    // Tuition
    if($average_tuition != ""){
        if ((strlen($average_tuition) < 1) || (strlen($average_tuition) > 11)) {
            $valid = 0;  
            $average_tuition_Msg = "<p>Please enter less than 11 digits.</p>";
        }
    }else{
        $valid = 0;  
        $average_tuition_Msg = "<p>Please enter average tuition.</p>";
    }

    // Number of Fulltime Students
    if($no_of_fulltime_student != ""){
        if ((strlen($no_of_fulltime_student) < 1) || (strlen($no_of_fulltime_student) > 11)) {
            $valid = 0;  
            $no_of_fulltime_student_Msg = "<p>Please enter less than 11 digits.</p>";
        }
    }else{
        $valid = 0;  
        $no_of_fulltime_student_Msg = "<p>Please enter number of fulltime students.</p>";
    }

    // Number of International Students
    if($no_of_international_student != ""){
        if ((strlen($no_of_international_student) < 1) || (strlen($no_of_international_student) > 11)) {
            $valid = 0;  
            $no_of_international_student_Msg = "<p>Please enter less than 11 digits.</p>";
        }
    }else{
        $valid = 0;  
        $no_of_international_student_Msg = "<p>Please enter number of international students.</p>";
    }

    // Number of Faculty Staff
    if($no_of_faculty_staff != ""){
        if ((strlen($no_of_faculty_staff) < 1) || (strlen($no_of_faculty_staff) > 11)) {
            $valid = 0;  
            $no_of_faculty_staff_Msg = "<p>Please enter less than 11 digits.</p>";
        }
    }else{
        $valid = 0;  
        $no_of_faculty_staff_Msg = "<p>Please enter number of faculty staffs.</p>";
    }

    // Website Url
    if ($website_url != "") {
        $website_url = filter_var($website_url, FILTER_SANITIZE_URL); // Cleanse this var of any malicious strings
        if (!filter_var($website_url, FILTER_VALIDATE_URL)) {
            $valid = 0;
            $website_url_Msg = "<p>Please enter a correctly formatted URL.</p>";
        }
    } else {
        $valid = 0;
        $website_url_Msg = "<p>Please enter university website URL.</p>";
    }

    // YouTube Embed
    if($youtube_embed != ""){
        if(!preg_match('/^[A-Za-z0-9_\-]{11}$/', $youtube_embed)){
            $youtube_embed_Msg = "<p>Please enter a valid 11 characters youtube embed video code (ex. eLSEC7SfWmA).</p>";
            $valid = 0; 
        }        
    }
    
    // Description
    if($description != ""){
        if ((strlen($description) < 30) || (strlen($description) > 2000)) {
            $valid = 0;  
            $description_Msg = "<p>Please enter a description from 30 to 2000 characters.</p>";
        }
    }

    //$filename = $_FILES['myfile']['name'];

    if($valid == 1 ){ 
        mysqli_query($con, "UPDATE top_100_universities set country_id = '$country', university_name = '$university_name', nickname ='$nickname', year_founded = '$year_founded', world_rank = '$world_rank', province = '$province', city = '$city', toefl_mark = '$toefl_mark', ielts_mark =  '$ielts_mark', gre_mark = '$gre_mark', public = '$public', tuition = '$average_tuition', dentistry = '$dentistry', art_humanities = '$arts_humanities', computer_science = '$computerScience', engineering_technology = '$engineering_technology', business_management ='$business_management', life_sciences_medicine = '$lifeSciences_medicine',  medical_science = '$medical_science', natural_sciences = '$natural_sciences', social_sciences_management = '$socialSciences_management', mba = '$MBA', fulltime_student = '$no_of_fulltime_student', international_student = '$no_of_international_student', faculty_staff = '$no_of_faculty_staff',  website = '$website_url', description = '$description', youtube_video = '$youtube_embed' WHERE university_id = '$id'") or die(mysqli_error($con));
        $msgSuccess = "<h3>Update Successful</h3>";
        // if(move_uploaded_file($_FILES['myfile']['tmp_name'], "originals/". $_FILES['myfile']['name'])){
        //     $thisFile = "originals/". basename($_FILES['myfile']['name']);
        //     //createThumbnail($thisFile, "thumbs/", 250);
        //     createSquareImageCopy($thisFile, "thumbs/", 100); // To creat square images (Was 250)
        //     createThumbnail($thisFile, "display/", 800); // Was (1000)


        //     // Add to DB
        //     //$title = strip_tags(trim($_POST['title']));  // all form elements values (except for file)
        //     //$filename = $_FILES['myfile']['name'];
        //     // I moved these outside of the if statement

        //     //Do a DB INSERT ... and test, test,test! Look in Filezilla (Don't forget to refresh) and phpMyAdmin


        //     mysqli_query($con, "UPDATE gallery_prep set title = '$title' , description = '$description' WHERE id = '$id'") or die(mysqli_error($con));
        //     $msgSuccess = "<h3>Update Successful</h3>";
        // }else{
        //     $msg = "<h3>Error</h3>";
        // }
    }

    //custom function to create thumbnail images (copies of originals); can be used for thumbnails (small copies) and display size as well.
    
}

$sql = "SELECT * FROM top_100_universities ORDER BY world_rank Asc $limstring";
$result_edit = mysqli_query($con, $sql) or die (mysqli_error($con));
// while($row = mysqli_fetch_array($result)){
// 	$title = $row['title'];
//     $file_id = $row['id'];
// 	$description = $row['description'];
//     $file_name = $row['file_name'];
// 	//echo $company_name;  //Just for testing 

// 	if($file_id  == $id) {
// 		$contactLink = "<a href=\"edit.php?id=$file_id \" style=\"font-weight:bold; font-size:18px;\">$title</a><br>";
// 	} else {
// 		$contactLink = "<a href=\"edit.php?id=$file_id\">$title</a><br>";
// 	} 
	
// 	//$contactLink = "<a href=\"edit.php?id=$file_id\">$title</a><br>";
// 	$allLinks .= $contactLink;
// }



//Step 2 
$sql = "SELECT * FROM top_100_universities where university_id = '$id' ";
$result = mysqli_query($con, $sql) or die (mysqli_error($con));
while($row = mysqli_fetch_array($result)){  
    
    $university_id = $row['university_id'];
    $university_name = $row['university_name']; 
    $public = $row['public'];
    $nickname = $row['nickname'];
    $world_rank = $row['world_rank'];
    $year_founded = $row['year_founded'];
    $country = $row['country_id'];
    $province = $row['province'];
    $city = $row['city'];
    $toefl_mark = $row['toefl_mark'];
    $ielts_mark = $row['ielts_mark'];
    $gre_mark = $row['gre_mark'];
    $average_tuition = $row['tuition'];
    $no_of_fulltime_student = $row['fulltime_student'];
    $no_of_international_student = $row['international_student'];
    $no_of_faculty_staff = $row['faculty_staff'];
    $website_url = $row['website'];
    $description = $row['description'];
    $youtube_embed = $row['youtube_video'];
    $file_name = $row['file_name'];

    //Programs
    $dentistry = $row['dentistry'];
    $arts_humanities = $row['art_humanities'];
    $computerScience = $row['computer_science'] ;
    $engineering_technology = $row['engineering_technology'];
    $business_management = $row['business_management'];
    $lifeSciences_medicine = $row['life_sciences_medicine'];
    $medical_science = $row['medical_science'];
    $natural_sciences = $row['natural_sciences'];
    $socialSciences_management = $row['social_sciences_management'];
    $MBA = $row['mba'];

} 


?>
<style>
    .card-body2{
        padding-right: 0 !important;
    }
</style>
    <div class="container mt-2">
		<h2 class="text-center mt-3 mb-3" style="color: #3C6E71;">Update Universities Information</h2>
        <div class="d-flex p-3">
            <div class="col-6">
            <?php 
                while ($row_edit = mysqli_fetch_array($result_edit)): ?>
                <div class="card mb-3" style="max-width: 540px; max-height: 110px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <a href="edit.php?id=<?php echo $row_edit['university_id'] ?>"><img class="img-fluid rounded-start" style="width: 200px; max-height: 110px;" src="thumbs/<?php echo $row_edit['file_name'] ?>" 
                        alt="<?php echo $row_edit['file_name'] ?>"></a>
                        </div>
                        <div class="col-md-8">
                        <div class="card-body card-body2">
                            <?php 
                            $university_id = $row_edit['university_id']; 
                	        if($university_id  == $id){?>
                                <h3 class="badge bg-info" style="font-style: italic; font-weight:bold; font-size:14px; padding-right:2px;"><a href="edit.php?id=<?php echo $row_edit['university_id'] ?>" style="text-decoration:none; color:black;"><?php echo $row_edit['university_name'] ?></a></h3>
                            <?php }else{?>
                                <h6 class="card-title" style="font-style: italic; font-size:14px;"><a style="text-decoration:none;" class="text-dark" href="edit.php?id=<?php echo $row_edit['university_id'] ?>"><?php echo $row_edit['university_name'] ?></a></h6>
                            <?php }?>
                            <?php 
                            $countryId = $row_edit['country_id'];
                            $sql_country = "SELECT * FROM countries where country_id = '$countryId' ";
                            $country_result = mysqli_query($con, $sql_country) or die (mysqli_error($con));
                            $country_row = mysqli_fetch_array($country_result);
                            $country_name = $country_row['country_name'];
                            ?>
                            <p class="card-text" style="margin-bottom: 0; font-size:13px;"><?php echo $country_name. ", " .$row_edit['city']?></p>
                            <p class="card-text" style="margin-bottom: 0; font-size:13px;"><small class="text-success fw-bold">World Rank: <?php echo $row_edit['world_rank']?></small></p>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- <div style="margin-right:20px; margin-bottom:20px;">
                <div class="card" style="width: 5rem;">
                    <a href="edit.php?id=<?php //echo $row_edit['university_id'] ?>"><img class="card-img-top" src="thumbs/<?php //echo $row_edit['file_name'] ?>" 
                    alt="<?php //echo $row_edit['file_name'] ?>"></a>
                    <div class="card-body p-1 pt-2" style="height: 4rem;">
                        <h5 class="text-center" style="font-style: italic; font-size:12px;"><a class="text-dark" href="edit.php?id=<?php //echo $row_edit['university_id'] ?>"><?php //echo $row_edit['university_name'] ?></a></h5>
                    </div>
                </div>
                </div> -->
            <?php endwhile; ?>
            <?php 
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
            ?>
            </div>
            <div class="col-6">
                <div class="card shadow-sm p-3 mb-2 mx-auto insert-page-link" style="background: url('<?php echo BASE_URL ?>/img/insert-page.jpg') center / cover no-repeat;">
                    <div class="card-body" style="background-color: rgba(0, 0, 0, 0.6);" >
                        <form class="p-2 w-100" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">

                            <div class="form-group input-group-sm required ">
                                <label class="color-white" for="university_name">University Name</label>
                                <input type="text" class="form-control" id="name" name="university_name" value="<?php if(isset($university_name)){echo $university_name;} ?>">
                                <?php if($university_name_Msg){echo $msgPreError.$university_name_Msg.$msgPost;} ?>
                            </div>
                            <div class="form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="public" name="public" <?php if(isset($public) && $public == "1"){ echo "checked";} ?>>
                                <label class="form-check-label color-white" for="public">Public</label>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="form-group input-group-sm col-md-4">
                                    <label class="color-white" for="nickname">Nickname</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname" value="<?php if($nickname){echo $nickname;} ?>">
                                    <?php if($nickname_Msg){echo $msgPreError.$nickname_Msg.$msgPost;} ?>
                                </div>

                                <div class="form-group input-group-sm col-md-4 required">
                                    <label class="color-white" for="world_rank">World Rank</label>
                                    <input type="number" class="form-control" id="world_rank" name="world_rank" value="<?php if($world_rank){echo $world_rank;} ?>">
                                    <?php if($world_rank_Msg){echo $msgPreError.$world_rank_Msg.$msgPost;} ?>
                                </div>

                                <div class="form-group input-group-sm col-md-4 required">
                                    <label class="color-white" for="year_founded">Year Founded</label>
                                    <input type="number" class="form-control" id="year_founded" name="year_founded" value="<?php if($year_founded){echo $year_founded;} ?>">
                                    <?php if($year_founded_Msg){echo $msgPreError.$year_founded_Msg.$msgPost;} ?>
                                </div>
                            </div>

                            <div class="form-group input-group-sm mt-3 required">
                                <label class="color-white" for="country">Country</label>
                                <select name="country" id="country" class="form-control">
                                    <option value= "">Select a country</option>
                                    <option value="1" <?php if(isset($country) && $country == "1"){echo "selected";} ?> >Argentina</option>
                                    <option value="2" <?php if(isset($country) && $country == "2"){echo "selected";} ?> >Australia</option>
                                    <option value="3" <?php if(isset($country) && $country == "3"){echo "selected";} ?> >Belgium</option>
                                    <option value="4" <?php if(isset($country) && $country == "4"){echo "selected";} ?> >Canada</option>
                                    <option value="5" <?php if(isset($country) && $country == "5"){echo "selected";} ?>>Denmark</option>
                                    <option value="6" <?php if(isset($country) && $country == "6"){echo "selected";} ?>>France</option>
                                    <option value="7" <?php if(isset($country) && $country == "7"){echo "selected";} ?>>Germany</option>
                                    <option value="8" <?php if(isset($country) && $country == "8"){echo "selected";} ?>>Hong Kong SAR</option>
                                    <option value="9" <?php if(isset($country) && $country == "9"){echo "selected";} ?>>Ireland</option>
                                    <option value="10" <?php if(isset($country) && $country == "10"){echo "selected";} ?>>Japan</option>
                                    <option value="11" <?php if(isset($country) && $country == "11"){echo "selected";} ?>>Mainland China</option>
                                    <option value="12" <?php if(isset($country) && $country == "12"){echo "selected";} ?> >Malaysia</option>
                                    <option value="13" <?php if(isset($country) && $country == "13"){echo "selected";} ?>>Netherlands</option>
                                    <option value="14" <?php if(isset($country) && $country == "14"){echo "selected";} ?>>New Zealand</option>
                                    <option value="15" <?php if(isset($country) && $country == "15"){echo "selected";} ?>>Russia</option>
                                    <option value="16" <?php if(isset($country) && $country == "16"){echo "selected";} ?>>Singapore</option>
                                    <option value="17" <?php if(isset($country) && $country == "17"){echo "selected";} ?>>South Korea</option>
                                    <option value="18" <?php if(isset($country) && $country == "18"){echo "selected";} ?>>Sweden</option>
                                    <option value="19" <?php if(isset($country) && $country == "19"){echo "selected";} ?>>Switzerland</option>
                                    <option value="20" <?php if(isset($country) && $country == "20"){echo "selected";} ?>>Taiwan</option>
                                    <option value="21" <?php if(isset($country) && $country == "21"){echo "selected";} ?>>United Kingdom</option>
                                    <option value="22" <?php if(isset($country) && $country == "22"){echo "selected";} ?>>United States</option>
                                </select>
                                <?php if ($country_Msg) { echo $msgPreError . $country_Msg . $msgPost; } ?>
                            </div>

                            <div class="row mt-3">
                                <div class="form-group input-group-sm col-md-6">
                                    <label class="color-white" for="province">Province/State/Region</label>
                                    <input type="text" class="form-control" id="province" name="province" value="<?php if(isset($province)){echo $province;} ?>">
                                    <?php if($province_Msg){echo $msgPreError.$province_Msg.$msgPost;} ?>
                                </div>

                                <div class="form-group input-group-sm col-md-6">
                                    <label class="color-white" for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="<?php if(isset($city)){echo $city;} ?>">
                                    <?php if($city_Msg){echo $msgPreError.$city_Msg.$msgPost;} ?>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="form-group input-group-sm col-md-6 required">
                                    <label class="color-white" for="toefl_mark">TOEFL Mark Required</label>
                                    <input type="number" class="form-control" id="toefl_mark" name="toefl_mark" value="<?php if(isset($toefl_mark)){echo $toefl_mark;} ?>">
                                    <?php if($toefl_mark_Msg){echo $msgPreError.$toefl_mark_Msg.$msgPost;} ?>
                                </div>

                                <div class="col-md-6 mt-4">
                                    <div class="form-check col-md-6">
                                        <input type="checkbox" class="form-check-input" id="ielts_mark" name="ielts_mark" <?php if(isset($ielts_mark) && $ielts_mark == "1"){ echo "checked";} ?>>
                                        <label class="form-check-label color-white" for="ielts_mark">Accept IELTS</label>
                                    </div>

                                    <div class="form-check col-md-6">
                                        <input type="checkbox" class="form-check-input" id="gre_mark" name="gre_mark" <?php if(isset($gre_mark) && $gre_mark == "1"){ echo "checked";} ?>>
                                        <label class="form-check-label color-white" for="gre_mark">Accept GRE</label>
                                    </div>
                                </div>
                                

                                <!-- <div class="form-group input-group-sm col-md-4">
                                    <label class="color-white" for="ielts_mark">IELTS Required</label>
                                    <input type="number" class="form-control" id="ielts_mark" name="ielts_mark" value="<?php //if(isset($ielts_mark)){echo $ielts_mark;} ?>">
                                    <?php //if($ielts_mark_Msg){echo $msgPreError.$ielts_mark_Msg.$msgPost;} ?>
                                </div> -->

                                <!-- <div class="form-group input-group-sm col-md-4">
                                    <label class="color-white" for="gre_mark">GRE Required</label>
                                    <input type="number" class="form-control" id="gre_mark" name="gre_mark" value="<?php //if(isset($gre_mark)){echo $gre_mark;} ?>">
                                    <?php //if($gre_mark_Msg){echo $msgPreError.$gre_mark_Msg.$msgPost;} ?>
                                </div> -->
                            </div>

                            
                            <label class="color-white mt-3" for="university_program">Choose the University's Programs</label>
                            <div class="row d-flex form-control bg-white ms-1">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="dentistry" name="dentistry" <?php if(isset($dentistry) && $dentistry == "1"){ echo "checked";} ?> >
                                        <label class="form-check-label" for="dentistry">Dentistry</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="arts_humanities" name="arts_humanities" <?php if(isset($arts_humanities) && $arts_humanities == "1"){ echo "checked";} ?> >
                                        <label class="form-check-label" for="arts_humanities">Arts & Humanities</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="computerScience" name="computerScience" <?php if(isset($computerScience) && $computerScience == "1"){ echo "checked";} ?> >
                                        <label class="form-check-label" for="computerScience">Computer Science</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="engineering_technology" name="engineering_technology" <?php if(isset($engineering_technology) && $engineering_technology == "1"){ echo "checked";} ?> >
                                        <label class="form-check-label" for="engineering_technology">Engineering Technology</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="business_management" name="business_management" <?php if(isset($business_management) && $business_management == "1"){ echo "checked";} ?> >
                                        <label class="form-check-label" for="business_management">Business Management</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="lifeSciences_medicine" name="lifeSciences_medicine" <?php if(isset($lifeSciences_medicine) && $lifeSciences_medicine == "1"){ echo "checked";} ?> >
                                        <label class="form-check-label" for="dentilifeSciences_medicinestry">Life Sciences & Medicine</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="medical_science" name="medical_science" <?php if(isset($medical_science) && $medical_science == "1"){ echo "checked";} ?> >
                                        <label class="form-check-label" for="medical_science">Medical Science</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="natural_sciences" name="natural_sciences" <?php if(isset($natural_sciences) && $natural_sciences == "1"){ echo "checked";} ?> >
                                        <label class="form-check-label" for="natural_sciences">Natural Sciences</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="socialSciences_management" name="socialSciences_management" <?php if(isset($socialSciences_management) && $socialSciences_management == "1"){ echo "checked";} ?> >
                                        <label class="form-check-label" for="socialSciences_management">Social Sciences & Management</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="MBA" name="MBA" <?php if(isset($MBA) && $MBA == "1"){ echo "checked";} ?> >
                                        <label class="form-check-label" for="MBA">MBA</label>
                                    </div>
                                </div>
                            </div>
                        

                            <div class="form-group input-group-sm mt-3 required">
                                <label class="color-white" for="average_tuition">Average Annual Tuition for Domestic Students</label>
                                <input type="number" class="form-control" id="average_tuition" name="average_tuition" value="<?php if(isset($average_tuition)){echo $average_tuition;} ?>">
                                <?php if($average_tuition_Msg){echo $msgPreError.$average_tuition_Msg.$msgPost;} ?>
                            </div>

                            <div class="row mt-3">
                                <div class="form-group input-group-sm col-md-6 required">
                                    <label class="color-white" for="no_of_fulltime_student">Number of Fulltime Students</label>
                                    <input type="number" class="form-control" id="no_of_fulltime_student" name="no_of_fulltime_student" value="<?php if(isset($no_of_fulltime_student)){echo $no_of_fulltime_student;} ?>">
                                    <?php if($no_of_fulltime_student_Msg){echo $msgPreError.$no_of_fulltime_student_Msg.$msgPost;} ?>
                                </div>

                                <div class="form-group input-group-sm col-md-6 required">
                                    <label class="color-white" for="no_of_international_student">Number of International Students</label>
                                    <input type="number" class="form-control" id="no_of_international_student" name="no_of_international_student" value="<?php if(isset($no_of_international_student)){echo $no_of_international_student;} ?>">
                                    <?php if($no_of_international_student_Msg){echo $msgPreError.$no_of_international_student_Msg.$msgPost;} ?>
                                </div>
                            </div>

                            <div class="form-group input-group-sm mt-3 required">
                                <label class="color-white" for="no_of_faculty_staff">Number of Faculty Staff</label>
                                <input type="number" class="form-control" id="no_of_faculty_staff" name="no_of_faculty_staff" value="<?php if(isset($no_of_faculty_staff)){echo $no_of_faculty_staff;} ?>">
                                <?php if($no_of_faculty_staff_Msg){echo $msgPreError.$no_of_faculty_staff_Msg.$msgPost;} ?>
                            </div>

                            <div class="form-group input-group-sm mt-3 required">
                                <label class="color-white" for="website_url">University Website url</label>
                                <input type="text" class="form-control" id="website_url" name="website_url" value="<?php if(isset($website_url)){echo $website_url;} ?>">
                                <?php if($website_url_Msg){echo $msgPreError.$website_url_Msg.$msgPost;} ?>
                            </div>

                            <div class="form-group mt-3">
                                <label class="color-white" for="youtube_embed">YouTube Video Embed Code</label>
                                <input type="text" class="form-control" id="youtube_embed" name="youtube_embed" value="<?php if(isset($youtube_embed)){echo $youtube_embed;} ?>">
                                <!-- <textarea class="form-control" id="youtube_embed" name="youtube_embed"><?php //if(isset($youtube_embed)) {echo $youtube_embed;} ?></textarea> -->
                                <?php if($youtube_embed_Msg){echo $msgPreError.$youtube_embed_Msg.$msgPost;} ?>
                            </div>
                                                
                            <div class="form-group mt-3">
                                <label class="color-white" for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"><?php if(isset($description)) {echo $description;} ?></textarea>
                                <?php if ($description_Msg) {echo $msgPreError . $description_Msg . $msgPost;} ?>
                            </div> 

                            <!-- <div class="mb-3 mt-3">
                                <label for="formFile" class="form-label color-white required">Upload a photo of University</label>
                                <input class="form-control" type="file" name="myfile" id="formFile">
                                <?php //if($picture_Msg){echo $msgPreError.$picture_Msg.$msgPost;} ?>
                            </div> -->

                            <div class="mt-2">
                                <button type="submit" name="submit" class="btn btn-primary w-100">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="d-flex">
                    <!-- Delete button  -->
                    <div class="col-7" style="margin-left:15px;">
                        <a href="delete.php?id=<?php echo $id ?>" class="btn w-25 btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this university?')">Delete</a>
                    </div>

                    <div class="mt-2 col-5">
                        <?php if($msgError){echo $msgPreError.$msgError.$msgPost;} ?>
                        <?php if($msgSuccess){echo $msgPreSuccess.$msgSuccess.$msgPost;} ?>
                    </div>
                </div>
                  
            </div>
        </div>
          
    </div> <!-- Container -->

<?php include("../includes/footer.php"); ?>