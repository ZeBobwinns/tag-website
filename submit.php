<!DOCTYPE html> <!-- proper HTML5 doctype -->
<html lang="en">

<head>
  	<meta charset="utf-8">
  	<title>Submit Who You Tagged!</title>
    <link rel="shortcut icon" href="favicon.ico?v=<?php echo time() ?>" />
  	<meta name="author" content="">
  	<meta name="description" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
body {
    background: #262626;
    color: #a8a8a8;
    font-family: Sans-serif;
    overflow: hidden;
    text-align:center;
}
button {
    float: right;
    vertical-align: top;
    width: 10%; 
    height: 200px;
    background-color: #505050; 
    color: #b0b0b0; 
    font-size: 400%;
}
.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
.container {
  height: 200px;
  position: relative;
}
    </style>

	<link href="css/normalize.css" rel="stylesheet">
  	<link href="css/style.css" rel="stylesheet">
</head>

<body>
<h1>Submit a tag request now</h1>
    <h1 id = "taggerBox" style="font-size: 400%; overflow: auto;"> <?php
      $isSubset = true;
	    $tagList = json_decode(include "readItList.php", true);
      echo $tagList[count($tagList)-1]["taggedU"];
    ?>
    </h1>
    <h1>Tagged</h1>
    <select name="tagged" id="tagged" style="
    vertical-align: top;
    width: 90vw; 
    height: 10vh;
    background-color: #505050; 
    color: #b0b0b0; 
    font-size: 400%;
    text-align: center;
    ">
        <?php
	    $accountList = explode(",", include "getAllAccountNames.php");
	    for($i=0;$i<count($accountList);$i++){
        echo "<option value='".$accountList[$i]."'>".$accountList[$i]."</option>"."<br>";
        }
         ?>
    </select>

    <button id = "submitButton" style="position: fixed; left:10vw; top:55vh; width: 80vw; height: 10vh; background-color: #505050; color: #b0b0b0; font-size: 4.25vw;" onclick="submit();" >Submit Request</button>
    <button id = "backButton" style="position: fixed; left:10vw; top:70vh; width: 80vw; height: 10vh; background-color: #505050; color: #b0b0b0; font-size: 4.25vw;" onclick="redirect('/')">Back</button>
    <h1 id = "statusText" style="position: fixed; left:0vw; top:0vh; font-size: 20vh; width: 100vw; height: 100vh; display: none; overflow: auto;">Status of request</h1>

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  	<script src="js/script.js"></script>
    <script>
      var signedIn = false;
      var url_string = window.location.href
      var url = new URL(url_string);
      var username = url.searchParams.get("username");
      var password = url.searchParams.get("password");
      if (username != null) {
        signedIn = true;
      }

      function redirect(subURL) {
        if (signedIn) {
        window.location.href = window.location.origin + subURL + "?username=" + username + "&password=" + password;
        }
        else {
        window.location.href = window.location.origin + subURL;
        }
      }

      function submit() {
        if (signedIn) {
          document.getElementById("statusText").innerHTML = "Loading...";
          document.getElementById("statusText").style.display="inline";
          var xhr = new XMLHttpRequest();
            xhr.open("GET", window.location.origin+"/addToItList.php?submiterU="+ username +"&submiterP="+ password +"&taggerU="+ document.getElementById("taggerBox").innerHTML+"&taggedU="+document.getElementById("tagged").value, true);
            xhr.onload = function (e) {
                 if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                       if (xhr.responseText == "NOTFOUND") {
                            alert("Account not found. Try createing one.");
                            setTimeout(() => {
                              redirect("/signup.php");
                            }, 1500);
                           }
                         if (xhr.responseText == "WRONGPASS") {
                          alert("Wrong password. Redirecting to login.");
                            setTimeout(() => {
                              redirect("/login.php");
                            }, 1500);
                         }
                         if (xhr.responseText == "SUCCESS") {
                            alert("Tag Submitted Succesfully.");
                            document.getElementById("statusText").style.display="none";
                            window.location.reload();
                         }
                    console.log(xhr.responseText);
                 } else {
                    console.error(xhr.statusText);
                }
                }
                };
                    xhr.onerror = function (e) {
                    console.error(xhr.statusText);
                };
                xhr.send();
        }
        else {
          alert("You need to sign in!");
          redirect("/login.php");
        }
      }
    </script>
</body>
  
</html>
