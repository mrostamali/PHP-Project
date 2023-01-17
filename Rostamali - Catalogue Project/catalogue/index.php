<?php
include("includes/header.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<style>
	.pic{
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		align-items: center;
	}
	.first-pic{
		position: static;
		width: 80%;
		margin-top: 1rem;
		justify-content: center;
	}
	.second-pic{
		position: static;
		width: 80%;
		margin-top: 1rem;
	}

	.img-hover-zoom {
        /* [1.1] Set it as per your need */
        overflow: hidden;
        /* [1.2] Hide the overflowing of child elements */
    }

    .img-hover-zoom img {
        transition: transform 0.5s ease;
		min-height:281px;
    }

    .img-hover-zoom:hover img {
        transform: scale(1.5);
    }

	@media only screen and (min-width: 990px){

		.first-pic{
			width: 22.3125rem; height: 15rem; position: absolute; left: 20px; top: 50px; z-index: -1;
		}
		.second-pic{
			width: 20.375rem; height: 14rem; position: absolute; left: 180px; top: 250px;
		}
	}
	@media only screen and (min-width: 1400px){
		
		.first-pic{
			width: 22.3125rem; height: 15rem; position: absolute; left: 20px; top: 50px; z-index: -1;
		}
		.second-pic{
			width: 20.375rem; height: 14rem; position: absolute; left: 180px; top: 250px;
		}
	}
</style>


<div id="intro" class="bg-image shadow-2-strong">
	<div class="mask" style="background-color: rgba(0, 0, 0, 0.5);">

		<div id="carouselExampleCaptions" class="carousel slide shadow-2-strong" data-bs-ride="false">
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
			</div>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="<?php echo BASE_URL ?>/img/index1.png" class="d-block w-100" alt="..." style="height:60vh;">
					<div class="carousel-caption d-none d-md-block">
						<h5>Top Universities in The World</h5>
						<p>Find you future dream here</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="<?php echo BASE_URL ?>/img/index2.jpg" class="d-block w-100" alt="..." style="height:60vh;">
					<div class="carousel-caption d-none d-md-block">
						<h5>Best Researches around The World</h5>
						<p>Discover your options</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="<?php echo BASE_URL ?>/img/index3.jpg" class="d-block w-100" alt="..." style="height:60vh;">
					<div class="carousel-caption d-none d-md-block">
						<h5>Don't You Know about The Top Universities</h5>
						<p>Find the Information here</p>
					</div>
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
	<!-- Mask -->
</div>
<!-- intro -->


<main role="main">

	<div class="container" style="height: 100%;">
		<div class="d-flex row" style="margin-bottom: 6rem; margin-top:4rem;">

			<div class="">
				<section class="d-flex row justify-content-around">
					<div class="col-lg-6 col-sm-12">
						<h2 style="font-size:4rem;">Top</h2>
						<h2 class="ms-5" style="color: green; font-size:4rem;">Universities</h2>
						<p>I love to learn about top universities! I've collected top rank universities around the world for you. Check out some amazing universities here. </p>
						<p>This project is a catalogue of the world's top Universities. In the home page, you can see the top rank 3 universities. User can navigate to see the list of all universities in All Universities tab. User can search any keyword which goes through the Catalogue page where you can search by the variety of filters such as university's type(public/private), language proficiency(IELTS/TOFLE/GRE), faculties and tuition range along with the searchbar. <p>
						<p>This website is secured by an admin section that requires a username and password. It will allow the admin to add, edit, or delete Universities and prevent other users from making any changes to the database. </p>
						<?php 	$result = mysqli_query($con, "SELECT * FROM top_100_universities Order By world_rank Asc limit 1"); 
								$row = mysqli_fetch_array($result)
						?>
						<a class="btn btn-outline-secondary" href="detail.php?id=<?php echo $row['university_id'] ?>">First Rank University</a>
					</div>
					<div class="col-lg-6 col-sm-12">
						<div class="pic" style="position: relative;">
							<img class ="first-pic" style="" src="<?php echo BASE_URL ?>/img/index6.jpg" alt="Student looking into future">
							<img class="second-pic" style="" src="<?php echo BASE_URL ?>/img/index4.webp" alt="Students Graduation">
						</div>
					</div>	
				</section>
			</div>

		</div>
	</div>

	<div style="background-color: #f2f2f2; width:100%;" class="d-flex row justify-content-center align-item-center">
		<h3 class="col-12 mt-2 text-center text-muted text-success">Top Four Universities in The World</h3>
		<div class="col-12 d-flex flex-wrap justify-content-center align-item-center mt-2 container">
			<?php $result = mysqli_query($con, "SELECT * FROM top_100_universities Order By world_rank Asc limit 4"); ?>
			<?php while ($row = mysqli_fetch_array($result)) : ?>
				<div style="margin-right:25px; margin-bottom:20px;">
					<!-- Card -->
					<div class="bg-image card shadow-3-strong" style="background: url('admin/originals/<?php echo $row['file_name'] ?>') center / cover no-repeat; width: 16rem; height: 12rem;">
						<div style="background-color: rgba(0,0,0,0.2); height:100%; position: relative;">
							<div class="card-body text-white" >
								<p class="card-text"><a style="text-decoration: none; color:white;" href="detail.php?id=<?php echo $row['university_id'] ?>"><?php echo $row['university_name'] ?></a></p>
								<p class="card-text fw-bold fs-5" style="color:white; position: absolute; left:5px; bottom:0;">Rank: <?php echo $row['world_rank'] ?></p>
								<a style="position: absolute; right:5px; bottom:5px;" href="detail.php?id=<?php echo $row['university_id'] ?>" class="btn btn-outline-light">View</a>
							</div>
						</div>
					</div>
					<!-- Card -->
				</div>
			<?php endwhile; ?>
		</div>
	</div>

	<!-- Carousel  -->
    <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo BASE_URL ?>/img/index7.jpg" class="d-block w-100" alt="Carousel Image" style="height:50vh;"/>
                <div class="carousel-caption">
                    <h5 class="animate__animated animate__fadeInDown" style="animation-delay: 1s">
						Top universities around the world
                    </h5>
                    <p class="animate__animated animate__fadeInDown display-5 d-sm-none d-md-block d-none .d-sm-block" style="animation-delay: 2s">
                        Click here to view all
                    </p>
                    <a href="<?php echo BASE_URL ?>list.php" class="animate__animated animate__fadeInDown btn btn-success" style="animation-delay: 3s">
                        View More
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo BASE_URL ?>/img/index8.jpg" class="d-block w-100" alt="Carousel Image" style="height:50vh;"/>
                <div class="carousel-caption">
                    <h5 class="animate__animated animate__fadeInDown" style="animation-delay: 1s">
						Top universities around the world
                    </h5>
                    <p class="animate__animated animate__fadeInDown display-5 d-sm-none d-md-block d-none .d-sm-block" style="animation-delay: 2s">
                        Click here to search more
                    </p>
                    <a href="<?php echo BASE_URL ?>search.php" class="animate__animated animate__fadeInDown btn btn-success" style="animation-delay: 3s">
                        Search More
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo BASE_URL ?>/img/index9.jpg" class="d-block w-100" alt="Carousel Image" style="height:50vh;"/>
                <div class="carousel-caption">
                    <h5 class="animate__animated animate__fadeInDown" style="animation-delay: 1s">
						Top universities around the world
                    </h5>
                    <p class="animate__animated animate__fadeInDown display-5 d-sm-none d-md-block d-none .d-sm-block" style="animation-delay: 2s">
                        Click here to add more
                    </p>
                    <a href="<?php echo BASE_URL ?>admin/insert.php" class="animate__animated animate__fadeInDown btn btn-success" style="animation-delay: 3s">
                        Add More
                    </a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

	<div class="container">
        <h2 class="ft-bold text-center mt-5">Oldest Top <span style="color: #CE1A22 ;">Universities</span></h2>
        <div class="row row-cols-1 row-cols-md-3 g-4 pt-2 pb-5">
		<?php $result = mysqli_query($con, "SELECT * FROM top_100_universities Order By year_founded Asc limit 3"); ?>
			<?php while ($row = mysqli_fetch_array($result)) : ?>
            <div data-aos="zoom-in-down" class="col">
                <div class="card h-100">
                    <div class="img-hover-zoom">
                        <img src="admin/display/<?php echo $row['file_name'] ?>" class="card-img-top" alt="job-search" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title pt-2 pb-2" style="color:green;"><?php echo $row['university_name'] ?></h5>
                        <p class="card-text">
							<b>Year Founded:</b> <?php echo $row['year_founded'] ?>
                        </p>
                    </div>
                </div>
            </div>
			<?php endwhile; ?>
        </div>
    </div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        offset: 120,
        duration: 3000,
    });
</script>
<?php
	include("includes/footer.php");
?>