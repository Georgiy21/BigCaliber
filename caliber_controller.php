<?php
if(empty($_POST['page'])){
  $display_type = "no-signin";
  include('caliber_startpage.php');
  exit();
}

if(!isset($_SERVER['HTTPS'])){
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $url);
    exit;
}

session_start();

require('caliber_model.php');

if($_POST['page'] == 'StartPage'){
    $command = $_POST['command'];
    switch($command){
        case 'SignIn':
            if (!is_valid($_POST['username'], $_POST['password'])) {
              $error_msg_username = '* Invalid username';
              $error_msg_password = '* Invalid password';
              $display_type = 'signin';
              include('caliber_startpage.php');
            } else {
              $_SESSION['signedin'] = 'YES';
              $_SESSION['username'] = $_POST['username'];
              $username = $_POST['username'];
              include('caliber_startpage.php');
            }
            exit();

        case 'Join':
            if (does_exist($_POST['username'])) {
                $error_msg_username = '* The user exists.';
                $error_msg_password = '';
                $display_type = 'join';
                include('caliber_startpage.php');
            } else {
                insert_new_user($_POST['username'], $_POST['password'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['dr_license']);
                $display_type = 'signin';
                include('caliber_startpage.php');
            }
            exit();
        case 'Reset':
            if (!does_exist($_POST['username'])) {
                $error_msg_username = '* The user does not exist.';
                $display_type = 'reset';
                include('caliber_startpage.php');
            } else {
              if(strcmp($_POST['new_password'], $_POST['con_password']) == 0){
                reset_password($_POST['username'], $_POST['new_password']);
                $display_type = 'signin';
                include('caliber_startpage.php');
              } else {
                  $error_msg_password = '* Confirm password does not match. ';
                  $display_type = 'reset';
                  include('caliber_startpage.php');
              }
            }
            exit();
        case 'SignOut':
            session_unset();
            session_destroy();
            $display_type = 'no-signin';
            include('caliber_startpage.php');
            break;
        case 'Unsubscribe':
            unsubscribe($_POST['username']);
            session_unset();
            session_destroy();
            $display_type = 'no-signin';
            include('caliber_startpage.php');
            break;
    }

}
else if($_POST['page'] == 'ShopPage'){

    $command = $_POST['command'];

    switch ($command) {
        case 'submit-m700-form':
              buy_rifle($_POST['fname'], $_POST['lname'], $_POST['dr_license'], $_POST['address'], $_POST['city'], $_POST['rifle']);
              $display_type = 'submit_purchase';
              include('caliber_shop.php');
              //case...
              exit();
        case 'submit-sako85-form':
              buy_rifle($_POST['fname'], $_POST['lname'], $_POST['dr_license'], $_POST['address'], $_POST['city'], $_POST['rifle']);
              $display_type = 'submit_purchase';
              include('caliber_shop.php');
              //case...
              exit();
        case 'submit-smasher-form':
              buy_rifle($_POST['fname'], $_POST['lname'], $_POST['dr_license'], $_POST['address'], $_POST['city'], $_POST['rifle']);
              $display_type = 'submit_purchase';
              include('caliber_shop.php');
              //case...
              exit();
        case 'Search':
              search_rifle($_POST['rifle']);
              break;
        case 'SignOut':
              session_unset();
              session_destroy();
              $display_type = 'no-signin';
              include('caliber_startpage.php');
              break;
        default:
          echo 'Unknown command - ' . $command . '<br>';
    }
}
else if($_POST['page'] == 'SellPage'){

    $command = $_POST['command'];

    switch ($command) {
      case 'SubmitForm':
            sell_rifle($_POST['fname'], $_POST['lname'], $_POST['dr_license'], $_POST['address'], $_POST['city'], $_POST['make'], $_POST['model'], $_POST['caliber'], $_POST['sin'], $_POST['comment']);
            include('caliber_shop.php');
            break;
      case 'SignOut':
            session_unset();
            session_destroy();
            $display_type = 'no-signin';
            include('caliber_startpage.php');
            break;
      default:
          echo 'Unknown command - ' . $command . '<br>';
    }
}
else if($_POST['page'] == 'ForumPage'){

    $command = $_POST['command'];

    switch($command){
      case 'SubmitPost':
          post_comment($_POST['post'], $_SESSION['username']);
          //include('caliber_forumpage.php');
          break;
      case 'SignOut':
          session_unset();
          session_destroy();
          $display_type = 'no-signin';
          include('caliber_startpage.php');
          exit();
      default:
          echo 'Unknown command - ' . $command . '<br>';
    }
}
else {
  //..
}
 ?>
