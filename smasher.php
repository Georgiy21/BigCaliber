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
    img{
      max-width: 100%;
    }
    .form-style-9{
	      max-width: 600px;
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
                    if ($display_type == 'submit_purchase')
                        echo 'submit();';
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
            window.open("caliber_sellpage.php", "_self");
        }
        function open_startpage(){
            window.open("caliber_startpage.php", "_self");
        }
        function submit(){
          alert("You successfully purchased Small-Plot Smasher Ambush 300 Blackout!");
        }
        function signout() {
            document.getElementById('form-signout').submit();
        }

</script>
    <script>
        $('#submitForm').click(function(){

          var url = "caliber_controller.php";
          var query = { page: "BuySmasher", command: "SubmitForm", rifle: "Beanfield Sniper Remington Sendero SF II" ,
                        fname: $('#fname').val(), lname: $('#lname').val(), dr_license: $('#dr_license').val(), address: $('#address').val(), city: $('#city').val() };

          $.post(url, query,
            function(data, status){
                alert("Data: " + data + "\nStatus: " + status);
          });
        });
    </script>
</head>
<body>
  <div class="containerTab">
    <h1 style='text-align:center; padding-top: 10px'>Big Caliber</h1>
    <h3 style='text-align:center; padding-bottom: 10px;'>
      <?php
      if(empty($_SESSION['username'])){
        echo "You forgot to sign in! Please go back to main page and sign in.";
      } else
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

<div id="smasher-page">
  <h1 style="text-align: center">Buy Small-Plot Smasher Ambush 300 Blackout</h1>
  <div class="padding">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <img src="smasher.jpg">
            <p ><b>Type Model:</b> Realtree XTRA</p>
            <p><b>Price:</b> $1889</p>
            <p><b>Caliber:</b> 300 BLK</p>
          </div>
          <div class="col-sm-6">
            <p style="text-align: center">Accurate, tough, and hard-hitting,
              Daniel Defense Ambush hunting rifles take the best aspects of
               Daniel’s battle proven designs and tailor fit them to the modern
               sportsman. Built around a 16” Cold Hammer Forged barrel, the Ambush
               300 BLK offers precision and accuracy with a wide variety of projectiles.
               Shielding the barrel and Carbine gas system is the Daniel Defense MFR 15.0
               free-floating handguard. With a continuous picatinny rail on top and M-Lok
               attachment on the sides and bottom, there is plenty of room for any accessory
                that your hunt may require. The barrel is threaded in 5/8x24 TPI and capped
                with a knurled thread protector which can be easily removed should you want
                to attach a suppressor or other muzzle device. Like all DD Ambush hunting rifles,
                it comes from the factory with a Geissele Super Semi-Automatic, 2-stage trigger
                 and an ambidextrous safety selector. A BCMGUNFIGHTER Charging Handle further
                 enhances operating the rifle. The platform is finished off in a vivid
                 hydro-dipped Kryptek Highlander camo pattern.</p>
          </div>
          </div>
          <div class="container" id="inputform">
            <form method="post" class="form-style-9" name="myForm" action="caliber_controller.php">
                  <input type='hidden' name='page' value='BuySmasher'></input>
                  <input type='hidden' name='command' value='SubmitForm'></input>
                  <input type="hidden" name="rifle" value="Small-Plot Smasher Ambush 300 Blackout"></input>
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
                  Credit Card Number:
                  <input type="text" name="card_num" class="field-style field-split align-none" placeholder="optional"/><br><br>
                  Expiration Date:
                  <input type="text" name="mm" class="field-style field-split align-none" placeholder="MM (optional)" maxlength="2" />  <input type="text" name="yyyy" class="field-style field-split align-none" placeholder="YYYY (optional)" maxlength="4" /><br><br>
                  Security Code:
                  <input type="text" name="s_code" class="field-style field-split align-none" placeholder="optional"/><br><br>
                  <button type="submit" value="Submit" id="submitForm">Submit</button>
            </form>
          </div>
      </div>
  </div>
</div>

</body>
