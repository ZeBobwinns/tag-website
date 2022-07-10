<?php
$itListRawJSON = file_get_contents("itList.json");
if ($isSubset) {
return $itListRawJSON;
}
else {
echo $itListRawJSON;
}
?>