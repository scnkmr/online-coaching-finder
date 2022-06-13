<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> INSTITUTE REGISTRATION PAGE</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<style>
  .navbar {
    margin-bottom: 0;
    background-color: #f4511e;
    z-index: 9999;
    border: 0;
    font-size: 12px !important;
    line-height: 1.42857143 !important;
    letter-spacing: 3px;
    border-radius: 0;
    font-family: Montserrat, sans-serif;
  }
    </style>
</head>
<body style="margin-top:100px">
    
    <nav class="navbar navbar-light bg-light navbar-expand-lg fixed-top">
        <a href="index.php" class="navbar-brand">My website</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">
            <li clas="navbar-item">
              <a href="index.php" class="nav-link">Home</a>
              </li>
              <li clas="navbar-item">
                <a href="#" class="nav-link"></a>
                </li>
              <li clas="navbar-item">
                <a href="#" class="nav-link">About</a>
            </li>  
            <li clas="navbar-item">
                <a href="#" class="nav-link">Contact</a>
            </li>
			<li>
				<a href="library.php" class="nav-link">Library</a>
			</li>
			<?php 
			if(isset($_SESSION["client_id"])){
				echo '<li>
				<a href="add-book.php" class="nav-link">Add Book</a>
			</li>
			<li><a href="dashboard.php" class="nav-link"><i class="fa fa-user"></i> '.$_SESSION["client_fullname"].'</a></li>
				<li>
				<a href="logout.php" class="nav-link" title="Logout"><i class="fa fa-power-off"></i></a>
			</li>
			';
			}
			else{
				echo '
				<li>
				<a href="login.php" class="nav-link" title="Login">Login</a>
			</li>
				<li>
				<a href="coaching-signup.php" class="nav-link" title="Logout">Register</a>
			</li>';
			}
			?>
          </ul>
        </div>
      </nav>