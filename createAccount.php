<?php
  error_reporting(0);
  $username = strval($_GET['username']);
  $password = strval($_GET['password']);

  $accountRawJSON = file_get_contents("accounts.json");

  if ($accountRawJSON == "") {
    $accountRawJSON = "{}";
  }

  $accounts = json_decode($accountRawJSON, true);
    if ($accounts[$username] != null) {
    echo "TAKEN";
    }
    else{
  $accounts = $accounts + [$username => $password];
  $accountsEncoded = json_encode($accounts);
  $accountsResource = fopen("./accounts.json", "w") or die("Unable to open file!");
  fwrite($accountsResource, $accountsEncoded);
  echo "SUCCESS";
     }
?>