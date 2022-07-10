<!DOCTYPE html> <!-- proper HTML5 doctype -->
<html lang="en">

<head>
    <link rel="shortcut icon" href="favicon.ico?v=<?php echo time() ?>" />
  	<meta charset="utf-8">
  	<title>Tag Login</title>
  	<meta name="author" content="">
  	<meta name="description" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="css/normalize.css" rel="stylesheet">
  	<link href="css/style.css" rel="stylesheet">

      <style>
table {
  border-spacing: 1em .5em;
  padding: 0 2em 1em 0;
  font-size: 750%;
}

td {
  width: 1.5em;
  height: 1.5em;
  background: #505050;
  text-align: center;
  vertical-align: middle;
}

body {
    background: #262626;
    color: #a8a8a8;
    font-family: Sans-serif;
}
h1 {
    font-size: 500%;
    text-align: center;
}
p {
    font-size: 500%;
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
.container {
  margin: 0;
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

</head>

<body>
  	<h1>Login</h1>
    <div class="container">
    <div style = "left:48%" class="center">
    <input id = "usernameBox" type="text" placeholder="Username" style="font-size: 2em; text-align: center; width: 125%; height: 3.5em;"></input>
    </div>
    </div>
    <div class="container">
    <div style = "left:48%" class="center">
    <input id = "passwordBox" type="text" placeholder="Password" style="font-size: 2em; text-align: center; width: 125%; height: 3.5em;"></input>
    </div>
    </div>
    <div class="container">
    <div class="center">
    <button id = "loginButton" style="width: 5em" onclick="login();" >Login</button>
    </div>
    </div>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  	<script src="js/script.js"></script>

    <script> 

        var passwordBox = document.getElementById("passwordBox");
        passwordBox.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
              login();
            }
        });

        var usernameBox = document.getElementById("usernameBox");
        usernameBox.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
              document.getElementById("passwordBox").focus();
            }
        });

      function login() {

            try {
                document.getElementById("loading").remove();
            }catch (e) {/*ignore*/}
            var xhr = new XMLHttpRequest();
            xhr.open("GET", window.location.origin+"/validateAccount.php?username="+document.getElementById("usernameBox").value+"&password="+document.getElementById("passwordBox").value, true);
            xhr.onload = function (e) {
                 if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                       if (xhr.responseText == "NOTFOUND") {
                            document.getElementById("loading").innerHTML = "Account not found.  Try creating one.";
                            document.getElementById("loginButton").style.display="inline";
                           }
                         if (xhr.responseText == "WRONGPASS") {
                            document.getElementById("loading").innerHTML = "Wrong password.  Try again.";
                            document.getElementById("loginButton").style.display="inline";
                         }
                         if (xhr.responseText == "FOUND") {
                            document.getElementById("loading").innerHTML = "Success... Redirecting";
                            document.getElementById("loginButton").style.display="inline";
                            setTimeout(function(){
 	                           window.location.href = window.location.origin+"?username="+document.getElementById("usernameBox").value+"&password="+document.getElementById("passwordBox").value;
                            }, 1500);
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
        document.getElementById("loginButton").style.display="none"
        let loading = document.createElement("p");
        loading.innerText = 'Loading...';
        loading.style.color = 'orange';
        loading.style.textAlign = 'center';
        loading.id = 'loading';
        document.body.appendChild(loading);
         }

        </script>
</body>
  
</html>