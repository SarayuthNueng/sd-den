<?php
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	// date_default_timezone_set("Asia/Bangkok");

	// $sToken = "Ui2p3IzK9mDrUIagxYwnhUqh1cOZrb8Ifegffbkje5S";
	// $sMessage = "มีการจองนัดทันตกรรม";

	
	// $chOne = curl_init(); 
	// curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	// curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	// curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	// curl_setopt( $chOne, CURLOPT_POST, 1); 
	// curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	// $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	// curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	// curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	// $result = curl_exec( $chOne ); 

	// //Result error 
	// if(curl_error($chOne)) 
	// { 
	// 	echo 'error:' . curl_error($chOne); 
	// } 
	// else { 
	// 	$result_ = json_decode($result, true); 
	// 	echo "status : ".$result_['status']; echo "message : ". $result_['message'];
	// } 
	// curl_close( $chOne );   
?>
<?php 

session_start(); 

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Line Notify</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h1>Line Notify</h1>
    <hr>
    <form action="sent-line.php" method="POST">
        <?php if (isset($_SESSION['success'])) {  ?>
            <div class="alert alert-success" role="alert">
              <?php 
                  echo $_SESSION['success']; 
                  unset($_SESSION['success']);
              ?>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION['error'])) {  ?>
            <div class="alert alert-danger" role="alert">
              <?php 
                  echo $_SESSION['error']; 
                  unset($_SESSION['error']);
              ?>
            </div>
        <?php } ?>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" aria-describedby="email">
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" name="fullname" aria-describedby="fullname">
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>