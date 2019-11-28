<?php
// connect to MySQL DB
$conn = mysqli_connect('localhost', 'gvoropayev', 'fifa21rus', 'C354_gvoropayev');

function insert_new_user($username, $password, $fname, $lname, $email, $dr_license)
{
    global $conn;
    $hashed_password = hash('SHA256', $password);

    if (does_exist($username))
        return false;
    else {
        $sql = "insert into Customers values (NULL, '$username', 'hashed_password', '$fname', '$lname', '$email', '$dr_license')";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}

function is_valid($username, $password)
{
    global $conn;

    $algorithm = 'SHA256';
    $hashed_password = hash($algorithm, $password);

    $sql = "select * from Customers where (Username = '$username' and Password = 'hashed_password')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function does_exist($username)
{
    global $conn;

    $sql = "select * from Customers where (Username = '$username')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function reset_password($username, $new_password)
{
    global $conn;
    $hashed_password = hash('SHA256', $new_password);

    $sql = "update Customers set password = 'hashed_password' where username = '$username'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function buy_rifle($fname, $lname, $dr_license, $address, $city, $rifle)
{
  global $conn;
  $sql = "insert into Buyers values ('$fname', '$lname', '$dr_license', '$address', '$city', '$rifle')";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function sell_rifle($fname, $lname, $dr_license, $address, $city, $make, $model, $caliber, $sin, $comment)
{
  global $conn;
  $sql = "insert into Sellers values ('$fname', '$lname', '$dr_license', '$address', '$city', '$make', '$model', '$caliber', '$sin', '$comment')";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function unsubscribe($username)
{
  global $conn;

  $sql = "delete from Customers where username = '$username'";
  $result = mysqli_query($conn, $sql);
  return $result;

}

function post_comment($post, $username)
{
  global $conn;

  $sql = "select username from Customers where (username = '$username')";
  $result = mysqli_query($conn, $sql);
  $data = array();
  $i = 0;
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
        $data[$i++] = $row;
        $u = $row['username'];
      }
  }
  else {
      echo "Posting failed! You must be signed in to post. ";
      return;
  }

  $sql = "insert into Posts values ($u, '$post')";
  //echo($sql);
  mysqli_query($conn, $sql);
  echo json_encode($data);
}


function search_rifle($rifle){
  global $conn;

  $sql = "select * from Rifles where (make like '%$rifle%')";
  $result = mysqli_query($conn, $sql);
  $data = array();
  $i = 0;
  //echo($sql);
  //echo(mysqli_num_rows($result));
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $data[$i++] = $row;
  }
  //echo($data);
  echo json_encode($data);
  }
  return;
}
?>
