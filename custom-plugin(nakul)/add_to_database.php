<?php
echo 'running';

$sql = "INSERT INTO `plugin_data`(`name`, `email`, `mobile`) VALUES ('nakul','gmail.com@webninjaz',6395)";

if(mysqli_query($mysqli, $sql)){
    echo 'success';
}
else{
    echo "ERROR: $sql syntax error"
        . mysqli_error($mysqli);
}


$mysqli->close();
