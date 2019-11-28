<!DOCTYPE html>

<?php
  session_start();
?>

<html>
<head>
    <title>Big Caliber</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
      #header{
        background-image: url("wood.jpg");
        width: 100%;
        height: 100%;
      }
      #hamburger{
        position: fixed;
        top: 0;
        right: 30px;
      }
      #hamburger li, #hamburger ul {
          list-style: none;
          padding: 0;
          background-color: Gray;
          cursor:pointer;
      }
      #hamburger ul {
          border:1px solid black;
      }
      #hamburger > li {
          position: relative;
      }
      #hamburger > li > ul {
          display: none;
          position: absolute;
          top: 100%;
          right: 0;
      }
      #hamburger > li > ul > li { padding: 5px; }
      #hamburger li:hover {
          background-color: #eee;
      }
      #hamburger > li:hover > ul {
          display: block;
      }
      #blanket {
          display:none;
          width:100%;
          height:100%;
          position:fixed;
          top:0;
          left:0;
          opacity:0.5;
          background-color:SaddleBrown;
          z-index:998;
      }
      .modal-window {
          display: none;
          width: 400px;
          height: 710px;
          position: absolute;
          top: 150px;
          left: calc(50% - 201px);
          border: 1px solid black;
          background-image: url("wood_modal.jpg");
          padding: 10px 50px 0;
          z-index:999;
          text-decoration-color: white;
      }
      .modal-label {
          display:inline-block;
          width:80px;
      }
      h1{
        color:white;
      }
      label{
        color: white;
      }
    </style>

    <script>
      window.addEventListener('load', function() {
        document.getElementById('menu-signin').addEventListener('click', signin);
        document.getElementById('menu-join').addEventListener('click', join);
        document.getElementById('menu-forgot-password').addEventListener('click', reset);
        document.getElementById('menu-signout').addEventListener('click', signout);
        document.getElementById('menu-unsubscribe').addEventListener('click', unsub);
        document.getElementById('blanket').addEventListener('click', hide_all);
        document.getElementById('cancel-signin').addEventListener('click', hide_all);
        document.getElementById('cancel-join').addEventListener('click', hide_all);

        document.getElementById('shop').addEventListener('click', open_shop);
        document.getElementById('sell').addEventListener('click', open_sell);
        document.getElementById('forum').addEventListener('click', open_forum);

        <?php
            if (isset($display_type))
                if ($display_type == 'signin')
                    echo 'signin();';
                else if ($display_type == 'join')
                    echo 'join();';
                else if ($display_type == 'reset')
                    echo 'reset();';
                else
                    ;
        ?>
    });
    function signin() {
        document.getElementById('blanket').style.display = 'block';
        document.getElementById('signin').style.display = 'block';
    }
    function signout() {
        document.getElementById('form-signout').submit();
    }
    function join() {
        document.getElementById('blanket').style.display = 'block';
        document.getElementById('join').style.display = 'block';
    }
    function reset() {
        document.getElementById('blanket').style.display = 'block';
        document.getElementById('reset').style.display = 'block';
    }
    function unsub() {
        //document.getElementById('form-unsubscribe').submit();
        var url = 'caliber_controller.php';
        var query = {page: 'StartPage', command: 'Unsubscribe',
                      username: $('#username').val()};
        $.post(url, query,
                function(data, status){
                  //alert("Data: " + data + "\nStatus: " + status);
              });
    }
    function hide_all() {
        document.getElementById('blanket').style.display = 'none';
        document.getElementById('signin').style.display = 'none';
        document.getElementById('join').style.display = 'none';
        document.getElementById('reset').style.display = 'none';
    }
    function open_shop(){
      window.open("caliber_shop.php", "_self");
    }
    function open_sell(){
        window.open("caliber_sell_page.php", "_self");
    }
    function open_forum(){
        window.open("caliber_forumpage.php", "_self");
    }
    </script>
</head>
<body>
  <div class="containerTab" id="header">
    <h1 style='text-align:center; padding-top: 10px'>Big Caliber</h1>
    <h3 style='text-align:center; padding-bottom: 10px;'>
      <?php
      if(empty($_SESSION['username']))
          echo " ";
      else
        echo "Welcome " . $_SESSION['username'] . " !";
      ?></h3>
    <ul id="hamburger">
      <li style='width: 50px;'><img src='menu-icon.jpg' width='50px' height='50px'></img>
        <ul style='width:120px'>
            <li id='menu-signin'>Sign In</li>
            <li id='menu-join'>Join</li>
            <li id='menu-forgot-password'>Forgot Password</li>
            <li id="menu-signout">Sign Out</li>
            <li id="menu-unsubscribe">Unsubscribe</li>
        </ul>
      </li>
    </ul>
  </div>

  <div id="blanket">
  </div>

  <div id='signin' class='modal-window'>
      <h1 style='text-align:center'>Sign In</h1>
      <br>
      <form name='signin-form' method='post' action='caliber_controller.php'>
          <input type='hidden' name='page' value='StartPage'></input>
          <input type='hidden' name='command' value='SignIn'></input>
          <label class='modal-label'>Username:</label>
          <input type='text' id='username' name='username' required></input>
          <?php if (!empty($error_msg_username)) echo $error_msg_username; ?>
          <br>
          <br>
          <label class='modal-label'>Password:</label>
          <input type='password' name='password' required></input>
          <?php if (!empty($error_msg_password)) echo $error_msg_password; ?>
          <br>
          <br>
          <button class="submit" type='submit' value='Submit'>Submit</button>
          <button class="submit" id='cancel-signin' type='button' value='Cancel'>Cancel</button>
      </form>
  </div>

  <div id='join' class='modal-window'>
      <h1 style='text-align:center'>Join</h1>
      <br>
      <form method='post' action='caliber_controller.php'>
          <input type='hidden' name='page' value='StartPage'></input>
          <input type='hidden' name='command' value='Join'></input>
          <lable class='modal-label'>First Name:</label>
          <input type='text' name="fname" required></input>
          <?php if (!empty($error_msg_fname)) echo $error_msg_fname; ?>
          <br>
          <br>
          <lable class='modal-label'>Last Name:</label>
          <input type='text' name="lname" required></input>
          <?php if (!empty($error_msg_lname)) echo $error_msg_lname; ?>
          <br>
          <br>
          <label class='modal-label'>Username:</label>
          <input type='text' name='username' required></input>
          <?php if (!empty($error_msg_username)) echo $error_msg_username; ?>
          <br>
          <br>
          <label class='modal-label'>Password:</label>
          <input type='password' name='password' required></input>
          <?php if (!empty($error_msg_password)) echo $error_msg_password; ?>
          <br>
          <br>
          <label class='modal-label'>Email:</label>
          <input type='text' name='email' required></input>
          <?php if (!empty($error_msg_email)) echo $error_msg_email; ?>
          <br>
          <br>
          <lable class='modal-label'>Driver's License:</label>
          <input type='text' name="dr_license" required></input>
          <?php if (!empty($error_msg_dr_license)) echo $error_msg_dr_license; ?>
          <br>
          <br>
          <button class="submit" type='submit' value='Submit'>Submit</button>
          <button class="submit" id='cancel-join' type='cancel' value='Cancel'>Cancel</button>
      </form>
  </div>

  <div id='reset' class='modal-window'>
      <h1 style='text-align:center'>Resent Password</h1>
      <br>
      <form method='post' action='caliber_controller.php'>
          <input type='hidden' name='page' value='StartPage'></input>
          <input type='hidden' name='command' value='Reset'></input>
          <lable class='modal-label'>Username:</label>
          <input type='text' name="username" required></input>
          <?php if (!empty($error_msg_username)) echo $error_msg_username; ?>
          <br>
          <br>
          <label class='modal-label'>New Password:</label>
          <input type='password' name='new_password' required></input>
          <?php if (!empty($error_msg_password)) echo $error_msg_password; ?>
          <br>
          <br>
          <label class='modal-label'>Confirm Password:</label>
          <input type='password' name='con_password' required></input>
          <?php if (!empty($error_msg_con_password)) echo $error_msg_con_password; ?>
          <br>
          <br>
          <button class="submit" type='submit' value='Submit'>Submit</button>
          <button class="submit" id='cancel-join' type='cancel' value='Cancel'>Cancel</button>
      </form>
  </div>

  <form id='form-signout' method='post' action='caliber_controller.php' style='display:none'>
      <input type='hidden' name='page' value='StartPage'>
      <input type='hidden' name='command' value='SignOut'>
  </form>

  <form id='form-unsubscribe' method='post' action='caliber_controller.php' style='display:none'>
      <input type='hidden' name='page' value='StartPage'>
      <input type='hidden' name='command' value='Unsubscribe'>
  </form>

  <div class="containerTab" style="background-color:black">
    <div class="collapse navbar-collapse" id="navbar-collapse-main">
      <ul class='nav navbar-nav navbar-center'>
        <li><a id="shop" href="#">Shop Page</a></li>
        <li><a id="sell" href="#">Sell Rifle</a></li>
        <li><a id="forum" href="#">Forum</a></li>
      </ul>
    </div>
  </div>

  <div class="padding">
    <div class="container">
      <div class="row">
        <img src="deer.jpg" class="img-responsive">
      </div>
    <div class="row">
        <h2><b>Stand Hunting</b></h2>
        <p>The vast majority of the country’s 13-million-plus whitetail hunters use permanent and portable treestands to ambush deer as they travel,
         feed, and interact. Hunters employ decoys, scents, lures, and calls to bring whitetails into range of their stands.</p>

         <h2><b>Stalking and Still-Hunting</b></h2>
         <p>The most skilled hunters among us can find, stalk, and kill whitetails in wooded terrain. The Benoit family of Vermont has made their
         living doggedly tracking big bucks through snow. Other hunters “still-hunt,” or ease through the woods while scanning ahead for deerlike
         shapes and movement. Damp, quiet ground and a favorable wind are important for still-hunting success.</p>

         <h2><b>Spot and Stalk</b></h2>
         <p>Western hunters employ this technique in which large expanses of country are scanned and scrutinized for desirable animals. Once they’re spotted,
         a stalk is made using available cover to creep within gun or bow range. Where the terrain allows, this is an active, highly enjoyable method of whitetail hunting.</p>
    </div>
    </div>
  </div>

  <div class="padding">
    <div class="container">
      <div class="row">
      <img src="rifle.png" class="img-responsive">
    </div>
    <div class="row">
        <h2><b>GUNS, AMMO AND ACCESSORIES: WHATS NEEDED FOR A SUCCESSFUL HUNT</b></h2>
        <p>Choosing the right deer hunting rifle isn't as simple as strolling into Academy Sports +
          Outdoors, picking up one that looks good and calling it a day. It's a lot more involved than that,
          and if you intend to become a regular hunter, it's essential that you get the basics right.

          The most successful deer hunters base their rifle choice on a combination of the technology necessary
           for the hunt and personal preference. Use this guide to figure out the best rifle, caliber, ammunition
            and firearm accessories for your needs.</p>
    </div>
  </div>

  <div id="fixed">
  </div>
</body>
</html>
