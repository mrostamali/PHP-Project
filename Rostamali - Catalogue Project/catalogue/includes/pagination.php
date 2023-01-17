<?php 
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
