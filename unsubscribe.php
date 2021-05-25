<?php
  
require_once 'config.php' ;
$eflag=true;
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $eflag=true;
      $sql = "SELECT * FROM users WHERE email='$email'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();

      if ($row['is_active'] == '0') {
        header('Location: unsubsuccess.php');
        exit();
      } 

      if ($row['is_active'] == '1') {
          $usql = "UPDATE users SET is_active = '0' WHERE email = '$email'";
          $uresult = $conn->query($usql);
          header('Location: unsubsuccess.php');
          exit();
      } 
      
  }
  else{
    $eflag=false;
  }
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
  margin: 0;
}

td, 
.groups p {
  font-size: 13px;
  color: #878787;
}

.unsubscribed-page h1, 
.unsubscribed-page h2 {
  color: black;
}

.unsubscribed-page h1 {
  font-size: 25px;
}

.unsubscribed-page h2 {
  font-size: 20px;
}

.unsubscribed-page a {
  color: #2F82DE;
  font-weight: bold;
  text-decoration: none;
}

.unsubscribed-page {
  background: #C7C7C7;
  width: 100%;
  padding: 20px 0;
  font-family: 'Nunito', sans-serif;
  line-height: 1.5;
}

.email-body {
  max-width: 600px;
  min-width: 320px;
  margin: 0 auto;
  background: white;
  border-collapse: collapse;
}
.email-body img {
  max-width: 100%;
}

.email-header {
  background: #34ade38f;
  padding: 30px;
}

.news-section {
  padding: 20px 30px;
}


.groups ul {
  margin: 0 0 10px 25px;
  padding: 0;
  display: block;
  padding: 0;
  margin: 0;
  list-style: none;
}
.groups li {
  margin: 0 0 3px 0;
}

.required {
  display: none;
  width: 100%;
  height: 150px;
  color: #5d5d5d;
  text-align: left;
  font-size: 12px;
  overflow: auto;
}
.formEmailButton {
  color: #fff;
  background-color: #34ade3;
  padding: 10px 20px;
  margin: 10px 0;
  outline: none;
  border: 1px solid #34ade3;
  border-radius: 7px;
  margin-left:31%;
}
#btn{
      cursor: pointer;
    }


</style>
</head>
<body>
<?php if($eflag){ ?>
<table class="unsubscribed-page">
      <tr>
        <td>
          <table class="email-body">
            <tr>
              <td class="email-header" align="center">
                  <h1>Unsubscribe</h1>
              </td>
            </tr>
            <tr>
              <td class="news-section">
                <div id="templateBody" class="bodyContent rounded6">
                  <form method="POST">
                    <input type="hidden" name="email" value="<?php echo $_GET["email"]; ?>">
                  	<div class="groups">
                  		<h3>Are you sure, you want to unsubscribe?</h3>
                  		<ul>
                  			<li>
                          <input class="formEmailButton" id="btn" type="submit" name="submit" value="Unsubscribe">
                        </li>
                  		</ul>
                  	</div>
                  </form>
                  <br>
                  <a href="https://<?php echo $_SERVER["HTTP_HOST"]; ?>">« Return to our website</a>
                </div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <?php } else{ ?>
      <table class="unsubscribed-page">
      <tr>
        <td>
          <table class="email-body">
            <tr>
              <td class="email-header" align="center">
                  <h1>Unsubscribe</h1>
              </td>
            </tr>
            <tr>
              <td class="news-section">
                <div id="templateBody" class="bodyContent rounded6">
                  <input type="hidden" name="email" value="<?php echo $_GET["email"]; ?>">
                  <div class="groups">
                    <h3>Some error occured! Please try again</h3>
                  </div>
                  <br>
                  <a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>">« Return to our website</a>
                </div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <?php } ?>
</body>
</html>