<?php
include("mysql_connect.php");
include("functions.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="This website is a school project for showing top universities of the world. This website includes insert, edit and delete page authorized by an admin.">
	<meta name="author" content="Maria Rostamali">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<!-- Bootstrap Icon Library -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

	<title><?php echo APP_NAME; ?></title>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link href="<?php echo BASE_URL ?>css/styles.css" rel="stylesheet">
	<script src="<?php echo BASE_URL ?>js/jquery.js"></script>
	<script src="<?php echo BASE_URL ?>js/jquery-ui.js"></script>

	<style>
		/* .bg-image {
			background: url('<?php //echo BASE_URL ?>/img/header.png') center / cover no-repeat;
			height: 50vh;
		}

		.mask {
			height: 50vh;
		} */

		.navbar .nav-link {
			color: #fff !important;
		}

		.color-white {
			color: #F2FDFF !important;
		}

		.form-group.required label:before{
			color: red;
			content: "*";
			position: absolute;
			margin-left:  -15px;
			font-weight: bold;
		}

		.alert {
			padding: 0.4rem !important;
			margin-bottom: 0 !important;
		}

		.alert p {
			padding: 0 !important;
			margin-bottom: 0 !important;
			font-size: small;
		}

		textarea{
			height:140px;
		}
    </style>

</head>

<body>
	<header class="shadow">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
			<div class="container">
				<div class="text-success fs-3 me-auto-lg d-flex align-items-center py-2">
					<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
					<path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"/>
					</svg>
					<a class="navbar-brand text-success m-1" href="<?php echo BASE_URL ?>index.php">Top Universities of The World</a>
				</div>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<!-- <li class="nav-item dropdown ms-3">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Admin
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="<?php //echo BASE_URL ?>admin/insert.php">Insert University</a></li>
								<li><a class="dropdown-item" href="<?php //echo BASE_URL ?>admin/edit.php">Edit Universities</a></li>
							</ul>
						</li> -->
						<li class="nav-item ms-3">
							<a class="nav-link" href="<?php echo BASE_URL ?>list.php">All Universities</a>
						</li>
						<li class="nav-item ms-3">
							<a class="nav-link" href="<?php echo BASE_URL ?>admin/insert.php">Add University</a>
						</li>
						<li class="nav-item ms-3">
							<a class="nav-link" href="<?php echo BASE_URL ?>admin/edit.php">Update University</a>
						</li>
						<li class="nav-item ms-3">
							<a class="nav-link" href="<?php echo BASE_URL ?>search.php">Catalogue</a>
						</li>
					</ul>
					
					<span>
						<a class="nav-link text-white" href="<?php echo BASE_URL ?>admin/logout.php">Logout</a>
					</span>
					<!-- <form class="d-flex">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success" type="submit">Search</button>
					</form> -->
					<form class="form-inline mt-2 d-flex" action="<?php echo BASE_URL; ?>search.php" method="Search">
						<input class="form-control me-2 mr-sm-2" name="searchterm" type="text" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
				</div>
			</div>
			
		</nav>		
	</header>

	