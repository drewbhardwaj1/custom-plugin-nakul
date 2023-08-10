<?php

// echo 'hello';
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'first_plugin_db';

$mysqli = @new mysqli(
  $db_host,
  $db_user,
  $db_password,
  $db_db
);
if ($mysqli->connect_error) {
    echo 'Errno: ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error: ' . $mysqli->connect_error;
    exit();
}



$id = $_REQUEST['id'];
// $id = $_GET['id'];
$sql ="DELETE FROM `plugin_data` WHERE `id`='$id'";
$data = mysqli_query($mysqli, $sql);
if ($data) {
	echo "deleted";
    // wp_redirect(add_query_arg('form_success', '1', wp_get_referer()));
    wp_redirect(wp_get_referer(). '?form_success=1');
    exit();
}else
{
	echo "error";
}

?>
<script>
 window.history.back();
    </script>