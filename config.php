<?php
$conn = new mysqli('remotemysql.com', 'qGNCPDYwWb', '9OlCyEROxy', 'qGNCPDYwWb');
 
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}

$from_email = 'mayuragarwalrtcampassignment@gmail.com';
$email_pass = '8879493968';

?>