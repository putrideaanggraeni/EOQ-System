<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/style.css">
	
    <title>Kawan Ban </title>
	<link rel="shortcut icon" href="<?=base_url()?>assets/kawanbanlogo.png" type="image/x-icon" class="img-circle">
  </head>
<!--login-->
<div class="container">
<div class="login">
<div class="box">
<font color="#3498DB">
<h5><b> LOGIN  </b></h5>
</font>
<hr>
	<div class= "col">
	<form action="<?=site_url('auth/process')?>" method="post">
	  <div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" placeholder="Username" name="username">
	  </div>
	  <div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" placeholder="Password" name="password">
		<small class="form-text text-muted">We'll never share your password with anyone else.</small>
	  </div>
	  <div class="form-check">
		<input type="checkbox" class="form-check-input" id="exampleCheck1">
		<label class="form-check-label" for="exampleCheck1">Check me out</label>
	  </div>
	  <input type ="submit" class="btn btn-primary" value="Login" name="login">
	</form>
</div>
</div>
</div>
<!--end login-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>