<?php
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'first_plugin_db';
    // echo plugin_dir_url(__FILE__);
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

    $sql = "SELECT * FROM `plugin_data`";
    $result = $mysqli->query($sql);


  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
         ?>
         <tr>
          <td><?php echo $row["id"]?></td>
          <td><?php echo $row["name"]?></td>
          <td><?php echo $row["email"]?></td>
          <td><?php echo $row["mobile"]?></td>
          <td style="display: flex;justify-content: center;gap: 15px;">
          <a onclick="crudOP(<?php echo $row['id']; ?>, 'edit');">edit</a>
          <a onclick="crudOP(<?php echo $row['id']; ?>, 'delete');">delete</a>
        </td>
         </tr>

        <?php
      }
    } else {
    echo "No Data";
    }

    $mysqli->close();