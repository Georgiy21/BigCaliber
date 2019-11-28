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
        #background{
          background:url('deer-background.jpg') no-repeat center center fixed;

          display: table;
          height:100%;
          position: relative;
          width: 100%;
          background-size: cover;
        }
        img{
          max-width: 100%;
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
        .form-style-9{
    	      max-width: 600px;
    	      background: #FAFAFA;
      	    padding: 30px;
    	      margin: 50px auto;
    	      border-radius: 10px;
    	      border: 6px solid #305A72;
        }
        .search-container {
            float: right;
            padding-top: 10px;
        }
        #content{
          position: relative;
          padding: 50px 50px;
        }
    </style>

    <script>
        window.addEventListener('load', function() {
            //Navigation Bar
            document.getElementById('startpage').addEventListener('click', open_startpage);
            document.getElementById('sell').addEventListener('click', open_sell);
            document.getElementById('shop').addEventListener('click', open_shop);
            document.getElementById('forum').addEventListener('click', open_forum);
            document.getElementById('menu-signout').addEventListener('click', signout);

            //Purchase buttons
            document.getElementById('buy-m700').addEventListener('click', m700);
            document.getElementById('buy-sako85').addEventListener('click', sako85);
            document.getElementById('buy-smasher').addEventListener('click', smasher);
            function m700(){
                document.getElementById('shop-page').style.display = 'none';
                document.getElementById('sako85-page').style.display = 'none';
                document.getElementById('smasher-page').style.display = 'none';
                document.getElementById('m700-page').style.display = 'block';
                document.getElementById('content').style.display = 'none';
            }
            function sako85(){
              document.getElementById('shop-page').style.display = 'none';
              document.getElementById('smasher-page').style.display = 'none';
              document.getElementById('m700-page').style.display = 'none';
              document.getElementById('sako85-page').style.display = 'block';
              document.getElementById('content').style.display = 'none';
            }
            function smasher(){
              document.getElementById('shop-page').style.display = 'none';
              document.getElementById('smasher-page').style.display = 'block';
              document.getElementById('m700-page').style.display = 'none';
              document.getElementById('sako85-page').style.display = 'none';
              document.getElementById('content').style.display = 'none';
            }
        });

        function open_sell(){
            window.open("caliber_sell_page.php", "_self");
        }
        function open_forum(){
            window.open("caliber_forumpage.php", "_self");
        }
        function open_startpage(){
            window.open("caliber_startpage.php", "_self");
        }
        function signout() {
            document.getElementById('form-signout').submit();
        }
        function open_shop(){
          document.getElementById('shop-page').style.display = 'block';
          document.getElementById('m700-page').style.display = 'none';
          document.getElementById('sako85-page').style.display = 'none';
          document.getElementById('smasher-page').style.display = 'none';

        }
    </script>

  <script>  //Script for purchasing Remington m700
  $('#submit-m700-form').click(function(){

    var url = "caliber_controller.php";
    var query = { page: "ShopPage", command: "submit-m700-form", rifle: "Beanfield Sniper Remington Sendero SF II" ,
                  fname: $('#fname').val(), lname: $('#lname').val(), dr_license: $('#dr_license').val(), address: $('#address').val(), city: $('#city').val() };

    $.post(url, query,
      function(data, status){
          alert("Data: " + data + "\nStatus: " + status);
    });
  });
  </script>
  <script>  //Script for purchasing Sako85
      $('#submit-sako85-form').click(function(){

        var url = "caliber_controller.php";
        var query = { page: "ShopPage", command: "submit-sako85-form", rifle: "Sako 85 Finnlight Bolt-Action" ,
                      fname: $('#fname').val(), lname: $('#lname').val(), dr_license: $('#dr_license').val(), address: $('#address').val(), city: $('#city').val() };

        $.post(url, query,
          function(data, status){
              alert("Data: " + data + "\nStatus: " + status);
        });
      });
  </script>
  <script>  //Script for purchasing Smasher Ambush
      $('#submit-smasher-form').click(function(){

        var url = "caliber_controller.php";
        var query = { page: "ShopPage", command: "submit-smasher-form", rifle: "Small-Plot Smasher Ambush 300 Blackout" ,
                      fname: $('#fname').val(), lname: $('#lname').val(), dr_license: $('#dr_license').val(), address: $('#address').val(), city: $('#city').val() };

        $.post(url, query,
          function(data, status){
              alert("Data: " + data + "\nStatus: " + status);
        });
      });
  </script>
  <script> //Search a rifle

  $(document).ready(function(){
    $('#search-button').click(function(){
      var url = "caliber_controller.php";
      var query = { page:"ShopPage", command:"Search",
                    rifle: $('#search-bar').val() };
        console.log(query);
      $.post(url, query, function(data) {

        document.getElementById('shop-page').style.display = 'none';
        document.getElementById('m700-page').style.display = 'none';
        document.getElementById('sako85-page').style.display = 'none';
        document.getElementById('smasher-page').style.display = 'none';

        console.log(data);
        alert(data);
      var rows = JSON.parse(data);
      var str = '<table>';
      str += '<tr>';
      for (var p in rows[0])
          str += '<th>' + p + "</th>";
      str += '<tr>';
      for (var i = 0; i < rows.length; i++) {
        str += '<tr>';
        var r = 0;
        for (var p in rows[i]){
          if(r++ > 5){
              if(rows[i][p] == "Beanfield Sniper Remington Sendero SF II")
                str += '<td>' + ' | ' + " <button type='submit' id='buy-m700'>Purcha</button> " + ' | ' + '</td>';
              else if (rows[i][p] == "Sako 85 Finnlight Bolt-Action")
                str += '<td>'+ " | " + "<button type='button' id='sako85'/>"+ " | " + '</td>';
              else
                str += '<td>'+ " | " + "<button type='button' id='smasher'/>" + " | " + '</td>';
        } else
              str += '<td>' + " | " + rows[i][p] + " | " + '</td>';
        }
        str += '</tr>';
      }
      str += '</table>';
                  $('#content').html(str);
          });
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


  <div class="topnav" style="background-color:black">
    <div class="collapse navbar-collapse" id="navbar-collapse-main">
      <ul class='nav navbar-nav navbar-center'>
        <li><a id="startpage" href="#">Main Page</a></li>
        <li><a id="shop" href="#">Shop</a></li>
        <li><a id="sell" href="#">Sell Rifle</a></li>
        <li><a id="forum" href="#">Forum</a></li>
      </ul>
      <div class="search-container">
    <form action="caliber_controller.php">
      <input type='hidden' name='page' value='ShopPage'>
      <input type='hidden' name='command' value='Search'>
      <input type="text" placeholder="Search.." id='search-bar' name="search">
      <button type="button" id="search-button">Submit</button>
    </form>
      </div>
    </div>
  </div>

  <div id="content">
  </div>

  <div id="background">

    <div id='shop-page'>
      <h1 style="text-align: center">Hunting Rifles</h1>
      <div class="padding">
        <div class="container">
          <div class="row">
            <h2>Beanfield Sniper Remington Sendero SF II</h2>
          </div>
        <div class="row">
          <img src="m700.png">
        </div>
        <div class="row">
          <div id="m700des" class="collapse">With a heavy 26-inch barrel, the Sendero is built to squeeze as much
             velocity as possible out of flat-­shooting cartridges for long,accurate shots. The
             rifle is heavy—with a scope, it is going to weigh 10 pounds or more—but if you’ve
              got a short hike to your stand or don’t mind humping a beefy rig, the Sendero is
              ideal. The rigid HS Precision stock helps with accuracy. Currently it’s offered
              in 7mm Rem. Mag., .300 Win. Mag., and .300 Rem. Ultramag., though if you search
             for used guns, you might find one in the underappreciated .264 Win.</div>
          <button data-toggle="collapse" data-target="#m700des">Read Description</button>
          <button id="buy-m700">Purchase</button>
        </div>

          <div class="row">
            <h2>Sako 85 Finnlight Bolt-Action</h2>
          </div>
          <div class="row">
            <img src="sako85.png">
          </div>
          <div class="row">
            <div id="sako85" class="collapse">The Sako Finnlight won Outdoor Life’s Editor’s
              Choice award a few years back due to its superb accuracy and reliability,
              which are not a given for rifles that have thin barrels and other weight-saving
              features. Light weight often comes at the expense of performance, but that’s not
              so with the 6-pound Finnlight. I’ve shot this rifle until it’s hot enough to fry
              an egg on its fluted barrel, but it still manages tight groups. It comes in a wide
              range of great calibers—.260 Rem., .270 WSM, 6.5x55 SE, 7mm Rem. Mag., to name a
              few—but I think it would be hard to top the .308, given the cartridge’s mild recoil,
              proven killing power, and broad selection of accurate loads.</div>
              <button data-toggle="collapse" data-target="#sako85">Read Description</button>
              <button id="buy-sako85">Purchase</button>
            </div>

          <div class="row">
            <h2>Small-Plot Smasher Ambush 300 Blackout</h2>
          </div>
          <div class="row">
            <img src="smasher.jpg">
          </div>
          <div class="row">
            <div id="smasher" class="collapse">Hunters on small parcels of private ground need a
              rifle with the ability to put an animal down quickly. This is a scenario where a
              large-caliber AR shines. A deer that makes it to land where the hunter doesn’t
              have permission to search can be a nightmare to recover. The Ambush 300 Blackout is
              well suited for this kind of work. Most hunters will probably opt for the supersonic
              .30-caliber loads that launch bullets weighing around 115 to 125 grains at 2,200 fps
              or more. For shots out to 200 yards, these rounds are deadly, and given the moderate
              recoil and semi-automatic operation of the Ambush, fast follow-up shots are possible
              if needed. The Ambush comes with a threaded 16-inch barrel, so attaching a sound
              suppressor to lessen the muzzle blast is easy to do, should the hunter want to save
              his hearing and be less of a nuisance to whoever might live nearby. </div>
              <button data-toggle="collapse" data-target="#smasher">Read Description</button>
              <button id="buy-smasher">Purchase</button>
          </div>
        </div>
      </div>
    </div>

      <div id='m700-page' style="display: none">
        <h1 style="text-align: center">Buy Beanfield Sniper Remington Sendero SF II</h1>
        <div class="padding">
            <div class="container">
              <div class="row">
                <div class="col-sm-6">
                  <img src="m700.png">
                  <p ><b>Type Model:</b> Model 700</p>
                  <p><b>Price:</b> $1502</p>
                  <p><b>Caliber:</b> 7mm Remington Mag</p>
                </div>
                <div class="col-sm-6">
                  <p style="text-align: center">Built on the famous Model 700™
                    cylindrical action, Remington Sendero rifles are the most
                    accurate we produce for over-the-counter sale. You’ll be stunned
                    by the degree of precision you get straight out of the box.
                    Big game won’t be so lucky. The Model 700 Sendero SF II is a
                    finely tuned tack-driver created using input from serious shooters
                    across America. The HS Precision stock is reinforced with aramid
                    fibers and features contoured beavertail fore-end with ambidextrous
                    finger grooves and palm swell. Twin front swivel studs accommodate a
                    sling and a bi-pod. Full-length aluminum bedding blocks create
                    accuracy-enhancing platforms for the barreled actions. The 26" heavy-contour
                    barrels are fluted for rapid cooling.</p>
                </div>
                </div>
                <div class="container" id="m700-inputform">
                  <form method="post" class="form-style-9" name="myForm" action="caliber_controller.php">
                        <input type='hidden' name='page' value='ShopPage'></input>
                        <input type='hidden' name='command' value='submit-m700-form'></input>
                        <input type="hidden" name="rifle" value="Beanfield Sniper Remington Sendero SF II"></input>
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
                        <button type="submit" value="Submit" id="submit-m700-form">Submit</button>
                  </form>
                </div>
            </div>
        </div>
      </div>

      <div id="sako85-page" style="display: none">
        <h1 style="text-align: center">Buy Sako 85 Finnlight Bolt-Action</h1>
        <div class="padding">
            <div class="container">
              <div class="row">
                <div class="col-sm-6">
                  <img src="sako85.png">
                  <p ><b>Type Model:</b> 85 Finnlight</p>
                  <p><b>Price:</b> $2250</p>
                  <p><b>Caliber:</b> .243 Winchester</p>
                </div>
                <div class="col-sm-6">
                  <p style="text-align: center">This rifle was designed
                     for the nastiest weather imaginable and light enough
                     to take anywhere. All metal parts are made of stainless
                     steel or are specially coated to fight wear and corrosion.
                     The specially engineered hammer-forged stainless steel barrel
                     is fluted and the magazine and trigger guard are constructed
                     of hard anodized aluminum for reduced weight. The Soft Touch
                     stock with overmoulded grips offers a sure grip in wet conditions.
                      The detachable magazine can be loaded while in the rifle through
                      the ejection port and has a unique patent-pending release that
                      prevents from accidental drop outs. The controlled feed action is
                       designed in 4 caliber size-specific lengths to ensure utmost reliability.</p>
                </div>
                </div>
                <div class="container" id="inputform">
                  <form method="post" class="form-style-9" name="myForm" action="caliber_controller.php">
                        <input type='hidden' name='page' value='ShopPage'></input>
                        <input type='hidden' name='command' value='submit-sako85-form'></input>
                        <input type="hidden" name="rifle" value="Sako 85 Finnlight Bolt-Action"></input>
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
                        <button type="submit" value="Submit" id="submit-sako85-form">Submit</button>
                  </form>
                </div>
            </div>
        </div>
      </div>

      <div id="smasher-page" style="display: none">
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
                        <input type='hidden' name='page' value='ShopPage'></input>
                        <input type='hidden' name='command' value='submit-smasher-form'></input>
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
                        <button type="submit" value="Submit" id="submit-smasher-form">Submit</button>
                  </form>
                </div>
            </div>
        </div>
      </div>

  <form id='form-signout' method='post' action='caliber_controller.php' style='display:none'>
      <input type='hidden' name='page' value='StartPage'>
      <input type='hidden' name='command' value='SignOut'>
  </form>
</body>
