<?php
/**
 * Plugin Name: Custom Plugin(Nakul)
 * Description: My First Plugin
 * Version: 0.1
 * Author: Nakul
 **/


// register_activation_hook(
//     __FILE__,
//     'pluginprefix_function_to_run'
// );


// function wpb_follow_us_product($content) {
//     if ( is_product() ) {

//         $content .= '<p>Hey this line was added by a plugin</p>';
//     }

//     return $content;
// }

// add_filter('woocommerce_short_description', 'wpb_follow_us_product');
// add_filter('woocommerce_product_description_heading', 'wpb_follow_us_product');
// add_filter('woocommerce_product_description', 'wpb_follow_us_product');


// echo $_POST['name'];

function custom_theme_scripts()
  {
  wp_enqueue_style('my-custom-theme-style', get_stylesheet_uri());

  wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js');
  wp_register_style('first', get_template_directory_uri() . '/assets/style.css', array(), '1.1', 'all');
  wp_enqueue_style('first');

  // wp_enqueue_script('my-custom-theme-script', get_template_directory_uri() . '/assets/script.js');

  }

add_action('wp_enqueue_scripts', 'custom_theme_scripts');

?>

<style>
  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: rgba(185, 188, 191, 0.2) 0px 0px 24px 5px;
    border-radius: 5px;
    font-family: arial;
  }

  table thead th {
    padding: 10px 16px;
    text-align: left;
    background-color: #f3f3f5;
  }

  table tbody tr td {
    padding: 10px 16px;
    border-bottom: 1px solid #eee;
  }

  table tbody tr .action {
    display: flex;
  }

  table tbody tr .action button {
    margin-right: 10px;
    cursor: pointer;
    background-color: #f3f3f5;
    border: none;
    padding: 5px 10px;
    border-radius: 2px;
  }

  table tbody tr .action button:last-child {
    margin-right: 0;
  }

  table {
    overflow: auto;
  }

  .res-head {
    display: none;
  }

  .form-container {
    text-align: center;
  }

  section {
    display: flex;
    justify-content: space-evenly;
    margin-top: 40px;
  }

  .table-container {
    width: 1000px;
  }

  .form-container input {
    width: 300px;
    padding: 10px !important;
  }

  .form-container input[type="submit"] {
    cursor: pointer;
  }

  #tableBody a {
    border: 1px solid #000;
    border-radius: 3px;
    padding: 5px 13px;
    color: black;
    text-transform: capitalize;
    text-decoration: none;
  }

  #tableBody a:hover {
    background-color: #000 !important;
    color: #fff !important;
  }
</style>
<?php

function custom_plugin_menu()
  {
  add_menu_page(
    'My Custom Plugin',
    'Nakuls Plugin',
    'manage_options',
    'nakuls-plugin',
    'custom_plugin_page'
  );
  }

function custom_plugin_page()
  {
  echo '<div class="wrap">';
  echo '<h1>Communicating With Database</h1>';
  echo '<p>This is a page added by plugin.</p>';
  echo '</div>';

  echo custom_form_html();

  }

add_action('admin_menu', 'custom_plugin_menu');


function custom_form_html()
  {
  ob_start();
  ?>
  <section>
    <div class="form-container">
      <form action="" method="post">
        <input type="hidden" name="action" value="process_form_data">
        <input type="text" id="name" name="name" placeholder="Enter Name" required><br><br>
        <input type="email" id="email" name="email" placeholder="Enter Email" required><br><br>
        <input type="text" id="mobile" name="mobileno" placeholder="Enter Mobile" required><br><br>
        <input type="submit" value="Add" onclick="addToDatabase();">
      </form>
    </div>
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile No.</th>
            <th style="text-align:center;">Action</th>
          </tr>
        </thead>
        <tbody id="tableBody">

        </tbody>
      </table>
    </div>
  </section>
  <?php
  return ob_get_clean();
  }

function process_form_data()
  {
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'first_plugin_db';

  $mysqli = new mysqli(
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

  $name = $mysqli->real_escape_string($_POST['name']);
  $email = $mysqli->real_escape_string($_POST['email']);
  $mobile = $mysqli->real_escape_string($_POST['mobileno']);

  $sql = "INSERT INTO `plugin_data` (`name`, `email`, `mobile`) VALUES ('$name', '$email', '$mobile')";

  if ($mysqli->query($sql)) {
    echo 'Success';
    } else {
    echo 'Error: ' . $mysqli->error;
    }

  $mysqli->close();

  // wp_redirect(add_query_arg('form_success', '1', wp_get_referer()));
  // exit;
  }

add_action('admin_post_process_form_data', 'process_form_data');
add_action('admin_post_nopriv_process_form_data', 'process_form_data');


function perform_crud(){

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

  $id = $_POST['id'];
  $op =$_POST['op'];

  if($op=='edit'){
    
  }
  else if($op=='delete'){
    $sql = "DELETE FROM `plugin_data` WHERE `id`='$id'";
    $data = mysqli_query($mysqli, $sql);
    if ($data) {
      echo "deleted";
      // wp_redirect(add_query_arg('form_success', '1', wp_get_referer()));
      // wp_redirect(wp_get_referer(). '?form_success=1');
      // exit();
      } else {
      echo "error";
      }
  }

  }
add_action('admin_post_perform_crud', 'perform_crud');
add_action('admin_post_nopriv_perform_crud', 'perform_crud');


?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
  jQuery(document).ready(function ($) {
    function loadData() {
      var pluginDir = '<?php echo plugin_dir_url(__FILE__); ?>';
      console.log(pluginDir)
      $("#tableBody").load(pluginDir + 'load_data.php');
    }
    loadData();

  });

  function crudOP(id, op) {
    console.log(op);
    console.log(id);
    $.ajax({
      type: "POST",
      url: "<?php echo admin_url('admin-post.php'); ?>", // Use the current page URL
      data: {
        action: "perform_crud", // PHP function name
        id: id,
        op:op 
      },
      success: function (response) {
        var pluginDir = '<?php echo plugin_dir_url(__FILE__); ?>';
        $("#tableBody").load(pluginDir + 'load_data.php');
      }
    });
  }
  function addToDatabase(){
    console.log('hello');
    $.ajax({
      type: "POST",
      url: "<?php echo admin_url('admin-post.php'); ?>", // Use the current page URL
      data: {
        action: "process_form_data", // PHP function name
      },
      success: function (response) {
        var pluginDir = '<?php echo plugin_dir_url(__FILE__); ?>';
        $("#tableBody").load(pluginDir + 'load_data.php');
      }
    });
  }
</script>