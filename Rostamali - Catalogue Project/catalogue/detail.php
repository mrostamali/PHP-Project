<?php
include("includes/header.php");

// $url = "https://www.youtube.com/embed/0AWIAxqKeNY";
// $url = "0AWIAxqKeNY";
// echo "<iframe width='560' height='315' src=\"https://www.youtube.com/embed/$url\" title=\"YouTube video playe\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM top_100_universities Where university_id = '$id'");
?>

<main role="main" >
	<div style="background-color: #F6F4F5;">

		<div class="container mt-2">

			<?php while ($row = mysqli_fetch_array($result)) : ?>

				<div class="row col-lg-12 pt-3">

					<div class="col-lg-6 ">
						<div>
							<img class="rounded img-fluid" style="min-width:40rem; max-height:35rem;" src="admin/display/<?php echo $row['file_name'] ?>" alt="<?php echo $row['file_name'] ?>">
						</div>

						<?php if ($row['youtube_video'] != null) : ?>
							<div class="mt-3" style="width:40rem; max-height:35rem;">
								<iframe class="rounded" style="min-width:40rem;" height='315' src="https://www.youtube.com/embed/<?php echo $row['youtube_video'] ?>" title="YouTube video playe" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
						<?php endif; ?>
					</div>

					<?php
					$countryId = $row['country_id'];
					$sql_country = "SELECT * FROM countries where country_id = '$countryId' ";
					$country_result = mysqli_query($con, $sql_country) or die(mysqli_error($con));
					$country_row = mysqli_fetch_array($country_result);
					$country_name = $country_row['country_name'];
					?>

					<div class="container row col-md-12 d-md-flex justify-content-between col-lg-5 ms-1">
						<h3 style="color: #406345 ;"><?php echo $row['university_name'] ?></h3>
						<p style="color: #598860 ;"><?php echo $row['nickname'];
													// if ($row['public'] == "1") {
													// 	echo ", Public";
													// } ?></p>
						<p style="color: #598860 ;"><?php
						if ($row['public'] == "1") {
							echo "Public";
						} ?></p>

						<?php if ($row['description'] != null) : ?>
							<p style="color: #2D4E44 ;"><?php echo $row['description'] ?></p>
						<?php endif; ?>
						<p style="color: #2D4E44 ;"><b>Location: </b><?php echo $country_name;
																		if ($row['province'] != null) {
																			echo ", " . $row['province'];
																		}
																		if ($row['city'] != null) {
																			echo ", " . $row['city'];
																		} ?></p>

						<div class="d-flex">
							<div class="col-6">
								<p style="color: #2D4E44 ;"><b>World Rank: </b> <?php echo $row['world_rank'] ?></p>
							</div>
							<div class="col6">
								<p style="color: #2D4E44 ;"><b>Year Founded: </b> <?php echo $row['year_founded'] ?></p>
							</div>
						</div>

						<p style="color: #2D4E44 ;"><b>Required TOEFL Mark: </b> <?php echo $row['toefl_mark'] ?></p>
						<div class="d-flex">
							<div class="col-6">
								<p style="color: #2D4E44 ;"><b>Accept GRE: </b> <?php if ($row['gre_mark'] == "1") {
																						echo "Yes";
																					} else {
																						echo "No";
																					}; ?></p>
								<p style="color: #2D4E44 ;"><b>Fulltime Students: </b> <?php echo number_format($row['fulltime_student']) ?></p>
								<p style="color: #2D4E44 ;"><b>Faculty Staff: </b> <?php echo number_format($row['faculty_staff']) ?></p>
							</div>
							<div class="col6">
								<p style="color: #2D4E44 ;"><b>Accept IELTS: </b> <?php if ($row['ielts_mark'] == "1") {
																						echo "Yes";
																					} else {
																						echo "No";
																					}; ?></p>
								<p style="color: #2D4E44 ;"><b>International Students: </b> <?php echo number_format($row['international_student']) ?></p>
								<p style="color: #2D4E44 ;"><b>Average Tuition(Domestic): $</b><?php echo number_format($row['tuition']) ?></p>
							</div>
						</div>

						<p style="color: #2D4E44 ;"><b>Faculties: </b></p>
						<div class="d-flex">
							<div class="col-6">
								<?php if ($row['dentistry'] == "1") : ?>
									<p style="color: #188C7E ;"><?php echo "Dentistry" ?></p>
								<?php endif; ?>
								<?php if ($row['art_humanities'] == "1") : ?>
									<p style="color: #188C7E ;"><?php echo "Art & Humanities" ?></p>
								<?php endif; ?>
								<?php if ($row['computer_science'] == "1") : ?>
									<p style="color: #188C7E ;"><?php echo "Computer Science" ?></p>
								<?php endif; ?>
								<?php if ($row['engineering_technology'] == "1") : ?>
									<p style="color: #188C7E ;"><?php echo "Engineering Technology" ?></p>
								<?php endif; ?>
								<?php if ($row['business_management'] == "1") : ?>
									<p style="color: #188C7E ;"><?php echo "Business Management" ?></p>
								<?php endif; ?>
								<?php if ($row['life_sciences_medicine'] == "1") : ?>
									<p style="color: #188C7E ;"><?php echo "Life Sciences Medicine" ?></p>
								<?php endif; ?>
								<?php if ($row['medical_science'] == "1") : ?>
									<p style="color: #188C7E ;"><?php echo "Medical Science" ?></p>
								<?php endif; ?>
								<?php if ($row['natural_sciences'] == "1") : ?>
									<p style="color: #188C7E ;"><?php echo "Natural Sciences" ?></p>
								<?php endif; ?>
								<?php if ($row['social_sciences_management'] == "1") : ?>
									<p style="color: #188C7E ;"><?php echo "Social Sciences Management" ?></p>
								<?php endif; ?>
								<?php if ($row['mba'] == "1") : ?>
									<p style="color: #188C7E ;"><?php echo "MBA" ?></p>
								<?php endif; ?>
							</div>
						</div>
						<div>
							<a href="<?php echo $row['website'] ?>" class="btn btn-sm btn-success w-100" target="_blank">Visit website</a>
						</div>
					</div>

				</div>
			<?php endwhile; ?>

			<div class="d-flex mb-3 mt-3">
				<?php
				echo "<div>";
				// Next button 
				$next = "";
				$next = mysqli_query($con, "SELECT * FROM top_100_universities WHERE university_id > $id order by university_id ASC") or die(mysqli_error($con));
				if ($row = mysqli_fetch_array($next)) {
					echo '<a href="detail.php?id=' . $row['university_id'] . '"><button type="button" class="btn btn-outline-success" style="width:7rem; margin-right:1rem; margin-left:1rem; margin-bottom:1rem;">Next</button></a>';
				}
				echo "</div>";

				echo "<div>";
				// Previous button 
				$previous = "";
				$previous = mysqli_query($con, "SELECT * FROM top_100_universities WHERE university_id < $id order by university_id DESC") or die(mysqli_error($con));
				if ($row = mysqli_fetch_array($previous)) {
					echo '<a href="detail.php?id=' . $row['university_id'] . '"><button type="button" class="btn btn-outline-success" style="width:7rem; margin-left:1rem; margin-bottom:1rem;">Previous</button></a>';
				}
				echo "</div>";
				?>
			</div>

		</div>
		<!-- container -->

	</div>
	<?php
	include("includes/footer.php");
	?>