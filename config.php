<?php
$conn = new mysqli('remotemysql.com', 'qGNCPDYwWb', '9OlCyEROxy', 'qGNCPDYwWb');
 
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}
?>