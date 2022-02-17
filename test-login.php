<?php 
    session_start();
    include_once('function/login-function.php'); 
    
    $userdata = new DB_con();

    if (isset($_POST['login'])) {
        $uname = $_POST['username'];
        $password = md5($_POST['password']);

        $result = $userdata->login($uname, $password);
        $num = mysqli_fetch_array($result);

        if ($num > 0) {
            $_SESSION['user_id'] = $num['user_id'];
            $_SESSION['firstname'] = $num['firstname'];
            $_SESSION['lastname'] = $num['lastname'];
            $_SESSION['username'] = $num['username'];
            $_SESSION['email'] = $num['email'];
            $_SESSION['phonenumber'] = $num['phonenumber'];
            $_SESSION['address'] = $num['address'];
            $_SESSION['user_level'] = $num['user_level'];

            if ($_SESSION['user_level'] == 'admin') {
                echo "<script>alert('Login Admin Successful!');</script>";
                echo "<script>window.location.href='list-den.php'</script>";
            }

            if ($_SESSION['user_level'] == 'user') {
                echo "<script>alert('Login User Successful!');</script>";
                echo "<script>window.location.href='add-calendar.php'</script>";
            }
            
        } else {
            echo "<script>alert('Something went wrong! Please try again.');</script>";
            echo "<script>window.location.href='login.php'</script>";
        }
    } 

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
            <h1>login</h1>
        <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input type="text" class="form-control" name="password" required>
                </div>
                
                <button type="submit" name="login" class="btn btn-success">login</button>
            </form>
        </div>
        


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>