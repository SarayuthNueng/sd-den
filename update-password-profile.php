<?php 

    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
    <h1>Change Password</h1>
    
    <form action="change_p.php" method="post">
        
        <!-- ดัก error -->
        <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>
     	<label>Old Password</label>
     	<input type="text" 
     	       name="op" 
     	       placeholder="Old Password" class="form-label">
     	       <br>

     	<label>New Password</label>
     	<input type="text" 
     	       name="np" 
     	       placeholder="New Password" class="form-label">
     	       <br>

     	<label>Confirm New Password</label>
     	<input type="text" 
     	       name="c_np" 
     	       placeholder="Confirm New Password" class="form-label">
     	       <br>

     	<button class="btn btn-success" type="submit">CHANGE</button>
        
     </form>

     <a class="mt-5" href="add-calendar.php">back</a>
    </div>
    
    <?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>
   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>