<?php
  session_start();
  require("conection/connect.php");
  
  
  if(isset($_POST['btn_log'])){
     $id= mysqli_real_escape_string($link, $_POST['id']);
     $pwd=$_POST['pwd'];
  
     $result=mysqli_query($link,"SELECT * FROM student WHERE regno = '$id' AND pass = '$pwd' ");
  
     if($result === FALSE) { 
		       
     }
     else {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['id'] = $row['regno'];				   			
        header("location: student.php");
    }
  }else{
  }
  ?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>LICET</title>
    <link rel="stylesheet" href="css/normalize-login.css">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto+Slab'>
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="favicon.ico">
    <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      }
      html, body {
      height: 100%;
      background-color: #000000;//#F15A5C;
      font-family: "Roboto Slab", serif;
      color: white;
      }
      .preload * {
      transition: none !important;
      }
      label {
      display: block;
      font-weight: bold;
      font-size: small;
      text-transform: uppercase;
      font-size: 0.7em;
      margin-bottom: 0.35em;
      }
      input[type="text"], input[type="password"] {
      width: 100%;
      border: none;
      padding: 0.5em;
      border-radius: 2px;
      margin-bottom: 0.5em;
      color: #333;
      }
      input[type="text"]:focus, input[type="password"]:focus {
      outline: none;
      box-shadow: inset -1px -1px 3px rgba(0, 0, 0, 0.3);
      }
      button {
      padding-left: 1.5em;
      padding-right: 1.5em;
      padding-bottom: 0.5em;
      padding-top: 0.5em;
      border: none;
      border-radius: 2px;
      background-color: #7E5AF1;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.25);
      color: white;
      box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.45);
      }
      small {
      font-size: 1em;
      }
      .login--login-submit {
      float: right;
      }
      .login--container {
      width: 600px;
      background-color: #000000;
      margin: 0 auto;
      position: relative;
      top: 25%;
      }
      .login--toggle-container {
      position: absolute;
      background-color: #000000;
      right: 0;
      line-height: 2.5em;
      width: 50%;
      height: 150px;
      text-align: right;
      cursor: pointer;
      transform: perspective(1000px) translateZ(1px);
      transform-origin: 0% 0%;
      transition: all 1s cubic-bezier(0.06, 0.63, 0, 1);
      backface-visibility: hidden;
      }
      .login--toggle-container .js-toggle-login {
      font-size: 4em;
      text-decoration: underline;
      }
      .login--active .login--toggle-container {
      transform: perspective(1000px) rotateY(180deg);
      background-color: #323232;
      }
      .login--username-container, .login--password-container {
      float: left;
      background-color: #000000;
      width: 50%;
      height: 120px;
      padding: 0.5em;
      }
      .login--username-container {
      transform-origin: 100% 0%;
      transform: perspective(1000px) rotateY(180deg);
      transition: all 1s cubic-bezier(0.06, 0.63, 0, 1);
      background-color: #323232;
      backface-visibility: hidden;
      }
      .login--active .login--username-container {
      transform: perspective(1000px) rotateY(0deg);
      background-color: #000000;
      }
      footer {
      position: absolute;
      bottom: 12px;
      left: 20px;
      }
    </style>
    <script src="js/prefixfree-login.min.js"></script>
  </head>
  <body>
    <div class='preload login--container'>
      <form role="form" action="" method="post" class="login-form">
        <div class='login--form'>
          <div class='login--username-container'>
            <label style="font-size:20px;">Register Number</label>
            <input autofocus placeholder='3111...? (31111510501)' type='text' name='id'>
          </div>
          <div class='login--password-container'>
            <label style="font-size:20px;">Password</label>
            <input placeholder='Password (licet@123)' type='password' name='pwd'>
            <button type="submit" class="btn btn-default btn-sm" name="btn_log" ><span class="glyphicon glyphicon-log-in"></span> Log in</button>
          </div>
      </form>
      </div>
      <div class='login--toggle-container'>
        <small>Hey you,</small>
        <div class='js-toggle-login' > Login</div>
        <small>already</small><br/><br/><br/><br/><br/><br/>
      </div>
    </div>
    <footer>
    </footer>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index-login.js"></script>      
  </body>
</html>
