
<?php
// Only a backup file for reference.
// session_start();
  
// require_once('config.php');
  
  
// if (isset($_POST['register'])) {
//     $error_message="";
//     $email = $_POST['email'];
//     $sql = "SELECT * FROM users WHERE email='$email'";
//     $result = $conn->query($sql);

    
//     if ($result->num_rows >= 1) {
//         $row = $result->fetch_assoc();
//         if($row['is_subscribed']=='1'){
//             $error_message="Email Id is already registered";
//         }
//         else{
//             $usql = "UPDATE users SET is_subscribed = '1' WHERE email = '$email'";
//             $uresult = $conn->query($usql);
//             $error_message = "Thank you, your account is reactivated again!";
//         }
//     } 

//     else {
//         $ins_sql = "INSERT INTO users(email, is_subscribed) VALUES ('$email','1')";
//         $ins_result = $conn->query($ins_sql);
//         $error_message="Thank you for registering";
//     }
//   }
?>
<!-- <html>
    <head>
        <title>Registartion Form</title>
        <link rel="stylesheet" href="style.css">
        
    </head>
    <body onload="myFunction()">
        <div class="container">
            <form method="post">
            <div class="container">
            <h1>Register</h1>
            <p>Registration for getting different Comics every 5 minutes.</p>
            <hr>
            <input type="email" placeholder="Enter Email" name="email" id="email" required>
            <hr>
            <button type="submit" class="registerbtn" name="register">Register</button>
            </form>
        </div>

        <p id="snackbar">
            <?php //if(!empty($error_message)) {
                //echo $error_message;
             //}
             ?>
        </p>

        <script>
            function myFunction() {
                // Get the snackbar DIV
                var x = document.getElementById("snackbar");
                if(x.textContent.length!=21){
                // Add the "show" class to DIV
                x.className = "show";

                // After 3 seconds, remove the show class from DIV
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                }
            }
        </script>

    </body>
</html> -->
