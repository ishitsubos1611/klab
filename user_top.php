<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>シェアリングツアーガイドサービス</title>

  <link rel="stylesheet" href="css/bootstrap.css"> 
  <!--    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->

<?php
  session_start();
  $id = $_SESSION["USERID"]; 
?>
    
<script>

history.pushState(null, null, null);
$(window).on("popstate", function (event) {
  if (!event.originalEvent.state) {
    history.pushState(null, null, null);
    return;
  }
});

</script>
<!--
<?php session_start(); $id = $_SESSION["USERID"];
      echo '<input name = area' .' type=hidden value="' . $id . '">';
?>
-->

  </head>
  <body>
  <!--  <form method='post' action="user/user_select_area.php"> -->
	    
    <div class="main">
      <nav class="navbar navbar-dark bg-dark fixed-top">			
	<a class="navbar-brand" href="#">シェアリングツアーガイド</a>				
	<!--レスポンシブの際のハンバーガーメニューのボタン-->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	  <span class="navbar-toggler-icon"></span>
	</button>		
	<!--ナビバー内のメニュー-->
	<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
	  <ul class="navbar-nav mr-auto">
	    <!--<li class="nav-item active">
	      <a class="nav-link" href="#"><span class="sr-only">(カレント)</span></a>
	    </li>-->
<!--	    <li class="nav-item">
	      <a class="nav-link" href="guide/guide_login.php">ガイドログイン</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="guide/select_area_regist.php">ガイド登録</a>
	    </li>
	    <li class="nav-item">
              <a class="nav-link" href="guide/select_area.php">ガイド日程登録</a>
            </li>
	    <li class="nav-item">
              <a class="nav-link" href="guide/select_area4booking.php">ガイド予約確認</a>
            </li>
	    <div class="dropdown-divider"></div>    
	    <li class="nav-item">
              <a class="nav-link" href="#">ユーザログイン</a>
            </li>               -->
	    <li class="nav-item">
              <a class="nav-link" href="user/user_select_area.php">ユーザ希望登録</a>
            </li>
	    <li class="nav-item">
              <a class="nav-link" href="realtime/realtime_place_registration.php">今すぐ登録</a>
            </li>
	  </ul>
	</div>
      </nav>
      
     <!-- <input name="uid" type=hidden value="<?php echo $id; ?>"> -->
      
      <div class="container-fluid">
      <div class="text-center">
        <!--<p class="message-wrapper">
	
          <p class="message-btn">シェアリングツアーガイドサービス</p>
        <p>
        </p>
        <div class="radio-btn-wrapper"> -->
	<br><br><br>
	<div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
	    <!--<div><p class="bg-danger text-info">シェアリングツアーガイドサービス</p></div></div>-->
	    <div><a href="#"  class = "btn btn-danger disabled btn-lg btn-block" >シェアリングツアーガイドサービス</a></div>
	  </div>
	</div>
        <br><br><br>

        <!--<a href="#"  class = "btn next-btn-guide" >ガイド　ログイン</a>-->

<!--	  <div class="row">
	    <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div><a href="guide/guide_login.php"  class = "btn btn-outline-info btn-lg btn-block" >ガイド　ログイン</a></div>
	    </div>
　　　　　</div>　　　
	  <br><br>
	  <div class="row">
	    <div class="col-sm-2"></div>
	    <div class="col-sm-8">  
              <div><a href="guide/select_area_regist.php"  class = "btn btn-outline-info btn-lg btn-block" >ガイド（スポット）登録・削除</a></div>
	    </div>
	  </div>
	  <br><br>
	  <div class="row">
	    <div class="col-sm-2"></div>
	    <div class="col-sm-8">
              <div><a href="guide/select_area.php"  class = "btn btn-outline-info btn-lg btn-block" >ガイド日程の登録・変更・削除</a></div>
	    </div>
	  </div>
	  <br><br>
	  <div class="row">
	    <div class="col-sm-2"></div>
	    <div class="col-sm-8">
              <div><a href="guide/select_area4booking.php"  class = "btn btn-outline-info btn-lg btn-block" >ガイド予約確認</a></div>
	    </div>
	  </div>
	  <br><br>    

	  <div class="row">
	    <div class="col-sm-2"></div>
	    <div class="col-sm-8">
              <div><a href="#"  class = "btn btn-outline-primary btn-lg btn-block" >ユーザログイン</a></div>
	    </div>
	  </div>
	    <br><br>     -->
	

<!--        <form name=step action="#" method='post'>
          <input class = "btn next-btn-user" type="submit" value="ユーザ ログイン">
        </form>
-->      

          <div class="row">
            <div class="col-sm-2"></div>
	    <div class="col-sm-8">
              <div><a href="user/user_select_area.php"  class = "btn btn-outline-primary btn-lg btn-block" >ユーザ希望登録</a></div>
	    </div>
          <!--</div>-->
          </div>
	  <br><br>

	  
	  <!-- <?php $id = $_SESSION["USERID"]; echo $id;  ?> -->
	  
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div><a href="realtime/realtime_place_registration.php"  class = "btn btn-outline-primary btn-lg btn-block" >今すぐ登録</a></div>
            </div>
          </div>
	  <br><br><br><br>

      </div>
      </div>
      </from>      
  </body>
</html>

