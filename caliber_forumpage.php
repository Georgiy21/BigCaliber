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
function open_sell(){
  window.open("caliber_sell_page.php", "_self");
}
function open_startpage(){
    window.open("caliber_startpage.php", "_self");
}
function signout() {
    document.getElementById('form-signout').submit();
}
</script>
<script> //Script for Forum Page
  $(document).ready(function(){
    $('#submit-post').click(function(){

      //alert($('#comment').val());

      var url = 'caliber_controller.php';
      var query = { page: "ForumPage", command: "SubmitPost", post: $("#comment").val() };
      console.log(query);

      $.post(url, query, function(data){
            console.log(data);
            var rows = JSON.parse(data);

            alert(rows[0]);
            alert(rows[1]);

            var t = '<div class="container">';
            t += '<div class="row">';
            t += '<div class="col-sm-3">';
              for(var p in rows[0])
                t += '<p>' + p + '</p>';
              t += '<div class="col-sm-8">';
              for (var u in rows[1])
                t += '<h1>' + u + '</h1>';
            t += '</div>';
            t += '</div>';
            t += '</div>';
            t += '</div>';
            $('#posted-thoughts').html(t);


          /*var t = '<table>';
              t += '<tr>';
              for(var p in rows[0])
                t += '<th>' + p + '</th>';
              t += '</tr>';
              for(var i = 0; i < rows.length; i++){
                  t += '<tr>';
                  for(var p in rows[1])
                    t += '<td>' + rows[i][p] + '</td>';
                  t += '</tr>';
              }
          t += '</table>';
          //console.log(t);

          var d = row[0];
          $('#posted-thoughts').html(t);*/
      });
    });
  });
</script>
<body>
  <div class="containerTab">
    <h1 style='text-align:center; padding-top: 10px'>Big Caliber</h1>
    <h3 style='text-align:center; padding-bottom: 10px;'>
      <?php
      if(empty($_SESSION['username']))
        echo "You forgot to sign in! Please go back to main page and sign in otherwise you won't be able to post.";
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
      </ul>
    </div>
  </div>

  <div id="forum-page">
    <h1 style="text-align: center">Forum</h1>
      <div class="padding">
      <div class="container" id="posts">
        <div class="row" id="post-row">
          <div class="col-sm-3" id="lable-username">
            <h1 style="text-align: center; padding: 25px 25px">You</h1>
          </div>
          <div class="col-sm-8">
            <form action="caliber_controller.php" method="POST">
              <div class="form-group">
                <label for="post">Share your thoughts:</label>
                <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="type here..."></textarea>
              </div>
                <button type="button" id="submit-post" class="btn btn-primary">Post</button>
            </form>
          </div>
        </div>
      </div>
      </div>

      <div class="padding">
        <div class="container" id="posted-thoughts">
        </div>
      </div>

  </div>

  <form id='form-signout' method='post' action='caliber_controller.php' style='display:none'>
      <input type='hidden' name='page' value='StartPage'>
      <input type='hidden' name='command' value='SignOut'>
  </form>
</body>
