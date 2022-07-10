<?php
 // error_reporting(0);
  $submiterU = strval($_GET['submiterU']);
  $submiterP = strval($_GET['submiterP']);
  $taggerU = strval($_GET['taggerU']);
  $taggedU = strval($_GET['taggedU']);

  $itListRawJSON = file_get_contents("itList.json");

  if ($itListRawJSON == "") {
    $itListRawJSON = "{}";
  }

  $itList = json_decode($itListRawJSON, true);
    
  $username = $submiterU;
  $password = $submiterP;
  $isSubset = true;
  $validationResponse = include 'validateAccount.php';

  if ($validationResponse == "FOUND") {

  $infoArray = array(
    "submiterU" => $submiterU,
    "submiterP" => $submiterP,
    "taggerU" => $taggerU,
    "taggedU" => $taggedU,
    "date" => date("Y/m/d|h:i:sa")
);

  array_push($itList, $infoArray);

  $itListEncoded = json_encode($itList);
  $itListResource = fopen("./itList.json", "w") or die("Unable to open file!");
  fwrite($itListResource, $itListEncoded);
  echo "SUCCESS";
}
  elseif ($validationResponse == "WRONGPASS") {
    echo "WRONGPASS";
  }
  elseif ($validationResponse == "NOTFOUND") {
    echo "NOTFOUND";
  }
  else {
    echo "UNKNOWNERROR";
  }
?>