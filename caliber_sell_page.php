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

  .form-style-9{
      max-width: 700px;
      background: #FAFAFA;
      padding: 30px;
      margin: 50px auto;
      border-radius: 10px;
      border: 6px solid #305A72;
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
    .padding{
      padding: 25px 0;
    }
    #post-row{
      background-color: pink;
    }
    #lable-username{
      background-color: white;
      border: solid black;
      margin: 25px;
    }
    #posted-thoughts{
      background-color: pink;
    }
</style>
<script>

window.addEventListener('load', function() {
    document.getElementById('startpage').addEventListener('click', open_startpage);
    document.getElementById('shop').addEventListener('click', open_shop);
    document.getElementById('sell').addEventListener('click', open_sell);
    document.getElementById('forum').addEventListener('click', open_forum);
    document.getElementById('menu-signout').addEventListener('click', signout);

    <?php
        if (isset($display_type))
            if ($display_type == 'SubmitSale')
                echo 'submitSale();';
            else
                ;
    ?>
});

function open_shop(){
    window.open("caliber_shop.php", "_self");
}
function open_forum(){
    window.open("caliber_forumpage.php", "_self");
}
function open_sell(){
    window.open("caliber_sell_page.php", "_self");
}
function open_startpage(){
    window.open("caliber_startpage.php", "_self");
}
function signout() {
    document.getElementById('form-signout').submit();
}
function submitSale(){
  alert("You have successfully sold " + make + " " + model);
}
</script>
<script> // Script for submitting sale form

  $(document).ready(function(){
    console.log("test");
    $('#submit-sale-form').click(function(){

      var link = "caliber_controller.php";
      var q = { page: 'SellPage', command: 'SubmitForm',
                fname: $('#fname').val(), lname: $('#lname').val(),
                dr_license: $('#dr_license').val(), address: $('#address').val(),
                city: $('#city').val(), make: $('#make').val(),
                model: $('#model').val(), caliber: $('#caliber').val(),
                sin: $('#sin').val(), comment: $('#comment').val()};
      console.log(q);
      $.post(link, q,
        function(data, status){
          alert("Data: " + data + "\nStatus: " + status);
        });

        window.open('caliber_shop.php', '_self');
      });
  });
</script>
<body>
  <div class="containerTab">
    <h1 style='text-align:center; padding-top: 10px'>Big Caliber</h1>
    <h3 style='text-align:center; padding-bottom: 10px;'>
      <?php
      if(empty($_SESSION['username']))
        echo "You forgot to sign in! Please go back to main page and sign in.";
      else
        echo $_SESSION['username']; ?></h3>
    <ul id="hamburger">
      <li style='width: 50px;'><img src='menu-icon.jpg' width='50px' height='50px'></img>
        <ul style='width:120px'>
            <li id="menu-signout">Sign Out</li>
        </ul>
      </li>
    </ul>
  </div>

  <div class="containerTab" style="background-color:black">
    <div class="collapse navbar-collapse" id="navbar-collapse-main">
      <ul class='nav navbar-nav navbar-center'>
        <li><a id="startpage" class='active' href="#">Main Page</a></li>
        <li><a id="shop" href="#">Shop</a></li>
        <li><a id="sell" href="#">Sell Rifle</a></li>
        <li><a id="forum" href="#">Forum</a></li>
      </ul>
    </div>
  </div>

  <div id="sale-page">
    <h1 style="text-align: center">Firearm Bill Of Sale</h1>
    <div class="container">
      <form method="post" class="form-style-9" name="myForm" action="caliber_controller.php">
            <input type='hidden' name='page' value='SellPage'></input>
            <input type='hidden' name='command' value='SubmitForm'></input>
            <h4><b>1. Seller Information:</b></h4>
            First Name:
            <input type="text" name="fname" id="fname" class="field-style field-split align-left" required/>
            Last Name:
            <input type="text" name="lname" id="lname" class="field-style field-split align-right" required/><br><br>
            Driver's License:
            <input type="text" name="dr_license" id="dr_license" class="field-style field-split align-none" required/><br><br>
            Address:
            <input type="text" name="address" id="address" class="field-style field-split align-left" required/>
            City:
            <input type="text" name="city" id="city" class="field-style field-split align-right" required/><br><br>
            <h4><b>2. Firearm Information:</b></h4>
            Make:
            <input type="text" name="make" id="make" class="field-style field-split align-left" required/>
            Type Model:
            <input type="text" name="model" id="model" class="field-style field-split align-right"  required/><br><br>
            Caliber:
            <input type="text" name="caliber" id="caliber" class="field-style field-split align-left" required/>
            Serial Number:
            <input type="text" name="sin" id="sin" class="field-style field-split align-right" required/><br><br>
            Comments:
            <textarea type="text" name="comment" id="comment" class="field-style field-split align-none" placeholder="optional"></textarea><br><br>
            <button type="submit" id="submit-sale-form">Submit</button>
      </form>
    </div>
  </div>

  <form id='form-signout' method='post' action='caliber_controller.php' style='display:none'>
      <input type='hidden' name='page' value='StartPage'>
      <input type='hidden' name='command' value='SignOut'>
  </form>
</body>
