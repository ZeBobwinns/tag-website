<?php
  error_reporting(0);
  if (!$username) {
  $username = strval($_GET['username']);
  $password = strval($_GET['password']);
  }

  $accountRawJSON = file_get_contents("accounts.json");

  if ($accountRawJSON == "") {
    $accountRawJSON = "{}";
  }

  $accounts = json_decode($accountRawJSON, true);
  
    if ($accounts[$username] != null) {
        if ($accounts[$username] == $password) {
            if ($isSubset) {
                return "FOUND";
                } else {
                    echo "FOUND";
                }
        }
        else {
            if ($isSubset) {
                return "WRONGPASS";
                } else {
                    echo "WRONGPASS";
                }
        }
    }
    else {
        if ($isSubset) {
            return "NOTFOUND";
            } else {
                echo "NOTFOUND";
            }
    }
?>