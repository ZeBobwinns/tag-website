<!DOCTYPE html>
<html lang="en">

<head>
  	<meta charset="utf-8">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>	
  	<title>TAG</title>
  	<meta name="author" content="Zac">
  	<meta name="description" content="Fak u">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
table {
  border-spacing: 1vw 1vw;
  padding: 0 2em 1em 0;
  font-size: 3vw;
  width: 97vw;
  text-align: center;
  overflow: auto;
  table-layout: fixed;
}

td {
  width: 50%;
  height: 1.5em;
  background: #505050;
  text-align: center;
  vertical-align: middle;
  overflow: auto;
  padding: 0px;
  border: 0px;
  margin: 0px;
}

body {
    background: #262626;
    color: #a8a8a8;
    font-family: Sans-serif;
    overflow: hidden;
}

.container {
  height: 200px;
  position: relative;
}

.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
    </style>
	<link href="css/normalize.css" rel="stylesheet">
  	<link href="css/style.css" rel="stylesheet">
</head>

<body id = "body">
  	<h1 style="position: fixed; width: 90vw; left: 5%; top: 83%; font-size: 2.5rem; text-align: center; padding:0px; border:0px;">
    <?php
      $isSubset = true;
      $tagList = json_decode(include "readItList.php", true);
      echo $tagList[count($tagList)-1]["taggedU"]." is it!";
    ?>
  </h1>
    <h1 id = "loginDisplay" style="position: fixed; width: 95vw; left:2.5%; top: 48%; font-size: 1.5rem; text-align: center; padding:0px; border:0px; overflow: auto; display:none;"> </h1>
    <button id = "logoutButton" style="position: fixed; left:10%; top:58%; width: 80%; height: 10%; background-color: #505050; color: #b0b0b0; font-size: 4.25vw; display:none;" onclick="window.location.href = window.location.origin + '?noAutoLogin=true';"> Logout </button>
    <button id = "signupButton" style="position: fixed; left:10%; top:55%; width: 40%; height: 10%; background-color: #505050; color: #b0b0b0; font-size: 4.25vw;" onclick="redirect('/signup.php')">Signup</button>
    <button id = "loginButton" style="position: fixed; left:50%; top:55%; width: 40%; height: 10%; background-color: #505050; color: #b0b0b0; font-size: 4.25vw;" onclick="redirect('/login.php')">Login</button>
    <button id = "submitButton" style="position: fixed; left:10%; top:70%; width: 80%; height: 10%; background-color: #505050; color: #b0b0b0; font-size: 4.25vw;" onclick="redirect('/submit.php')" onmousedown="easterEggHunt()" onmouseup="easterEggHuntStop()">Submit a tag</button>
<div style="width:99vw; height:50vh; overflow: auto;">
<table>
  <thead>
    <tr>
      <th>Tagger</th>
      <th>Tagged</th>
      <th>Date</th>
      <th>Submitter</th>
    </tr>
   </thead>
   <tbody>
     <?php
      $isSubset = true;
	    try {$tagList = json_decode(include "readItList.php", true);}
      catch (Exception $e) {echo "<tr><td>Nobody has been tagged yet.</td></tr>"; return;}
      for($i=count($tagList)-1;$i>=0;$i--){
        echo "<tr>";
        echo "<td>".$tagList[$i]["taggerU"]."</td>";
        echo "<td>".$tagList[$i]["taggedU"]."</td>";
        echo "<td>".$tagList[$i]["date"]."</td>";
        echo "<td>".$tagList[$i]["submiterU"]."</td>";
        echo "</tr>";
      }
     ?>
  </tbody>
</table>
</div>

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  	<script src="js/script.js"></script>

    <script>
      var hasCookies = false;
      var signedIn = false;
      var url_string = window.location.href
      var url = new URL(url_string);
      var username = url.searchParams.get("username");
      var password = url.searchParams.get("password");
      var noAutoLogin = url.searchParams.get("noAutoLogin");
      if (username != null) {
        signedIn = true;
        document.getElementById("signupButton").style.display = "none";
        document.getElementById("loginButton").style.display = "none";
        document.getElementById("logoutButton").style.display = "inline";
        document.getElementById("loginDisplay").style.display = "inline";
        document.getElementById("loginDisplay").innerHTML = "Logged in as: "+username;
      }

      if (getCookie("username") != null && username == null && noAutoLogin != "true") {
        hasCookies = true;
        window.location.href = window.location.href + "?username=" + getCookie("username") + "&password=" + getCookie("password");
      }

      function redirect(subURL) {
        if (signedIn) {
        window.location.href = window.location.origin + subURL + "?username=" + username + "&password=" + password;
        }
        else {
        window.location.href = window.location.origin + subURL;
        }
      }

      function easterEggHunt() {
        console.log("hi")
        window.easterEggTimeout = setTimeout(function(){
 	        window.location.href = window.location.origin + "/leave.html"
        }, 3000);//wait 3 seconds
      }
      document.addEventListener("mouseup", function () { if (easterEggTimeout) {
        console.log("bye");
        clearTimeout(easterEggTimeout);
      }});


function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
    </script>
</body>
  
</html>