<?php
$accountRawJSON = file_get_contents("accounts.json");
if ($accountRawJSON == "") {
    $accountRawJSON = "{}";
  }

  $accounts = json_decode($accountRawJSON, true);

$i = 0;
$numOfAccounts = count($accounts);
$returnString = "";

  foreach ($accounts as $key => $value) {
    $i = $i + 1;
    if ($i < $numOfAccounts) {
        $returnString = $returnString.$key.",";
    }
    else {
        $returnString = $returnString.$key;
    }
} 
return $returnString;
?>