<!DOCTYPE html>

<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.

?>
<html>
<script type="text/javascript">
function image() {
   window.location.href = 'home.php';
    
}</script>
<style>
input[type=text], select {
  width: 20%;
  padding: 12px 15px;
  margin: 8px 0	;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-sizing: border-box;

 
}
span{ 
         color: green; 
         text-decoration: underline; 
         font-style: italic; 
         font-weight: bold; 
         font-size: 26px; 
		 align=center;
         }
.card {
	width:100%;
	height:40%;
  box-shadow: 0 20px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
 background-image: linear-gradient(#00b09b, #96c93d);
 
  border-radius: 5px;
}
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  
}
.container {
  padding: 20px 400px;
	
 
     
}
	


.c1{
    width: 216px;
    min-height: 272px;
    background: #fff;
    padding: 0px;
    margin: 0 20px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    box-shadow: 1px 1px 4px 1px rgba(0, 0, 0, 0.2);
	
}
.c1:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  
}
.c2{
    width: 216px;
    min-height: 272px;
    background: #fff;
    padding: 0px;
    margin: -290px 300px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    box-shadow: 1px 1px 4px 1px rgba(0, 0, 0, 0.2);
	display:block;
	
	
}
.c2:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  
}
.lagbe{
	width:100%;
	    position: relative;
    display: block;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-touch-callout: none;
    -khtml-user-select: none;
    -ms-touch-action: pan-y;
    touch-action: pan-y;
    -webkit-tap-highlight-color: transparent;
}

.ic {
width: 1.125em;
	

     
}
.oita{
	width: 100%;
	height:40px;
    background-color: #fff;
    box-shadow: 3px 0 7px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 100;
    transition: all .3s ease-in-out;
    border-bottom: 3px solid red;

}
</style>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP Login using Google Account</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<body>
<div class="oita">
<img width="100" height="40" src="Mosta.png" >
</div>

<img src="Mosta.png"   width="150" height="50" onclick="image()" id="l1">

<div class="de">

 <a href = "input.php" target = "_self" align="center" >Register</a> | <a href = "fontpage.php" target = "_self" align="center" >Sign-in</a>

 
</div>

  

	
`
 
  <div class="container">
   <br />
   <h2 align="center">PHP Login using Google Account</h2>
   <br />
   <div class="panel panel-default">
   <?php
   if($login_button == '')
   {
    echo '<div class="panel-heading">Welcome '.$_SESSION['user_first_name'].' </div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="logout1.php">Logout</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   </div>
  </div>
</body>
</html>