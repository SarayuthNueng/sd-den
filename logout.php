<?php
    session_start();
    session_destroy();

    echo '
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <script>
             setTimeout(function() {
              swal({
                  title: "ออกจากระบบสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
    </script>';
exit;
?>
