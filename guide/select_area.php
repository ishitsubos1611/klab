<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>STEP 1</title>

  <link rel="stylesheet" href="../css/bootstrap.css">
  <!--<link rel="stylesheet" href="../css/0-3-A1.css"> -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
<body>

<?php 
  session_start();
  $select_step = $_POST['step'];
  $uid = $_SESSION["USERID"];

 echo '<input name=uid' .' type=hidden value="' . $uid . '">';

 if($select_step == 1){
  $step = "./place_registration.php";
 }elseif($select_step == 2) {
  $step = "./select_date.php";
 }

?>
<form name="step1" action="select_date.php" method='post'>
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
	    </li>  -->
	    <li class="nav-item active">
	      <a class="nav-link disabled" href="guide/select_area_regist.php">ガイド登録</a>
	    </li>
	    <li class="nav-item">
              <a class="nav-link" href="guide/select_area.php">ガイド日程登録</a>
            </li>
	    <li class="nav-item">
              <a class="nav-link" href="guide/select_area4booking.php">ガイド予約確認</a>
            </li>
<!--	    <div class="dropdown-divider"></div>
	    <li class="nav-item">
              <a class="nav-link" href="#">ユーザログイン</a>
            </li>
	    <li class="nav-item">
              <a class="nav-link" href="user/user_select_area.php">ユーザ希望登録</a>
            </li>
	    <div class="dropdown-divider"></div>
	    <li class="nav-item">
              <a class="nav-link" href="realtime/realtime_place_registration.php">今すぐ登録</a>
            </li>   -->
	  </ul>
	</div>
      </nav>

    
    <div class="container-fluid">
      <div class="text-center">
<<<<<<< HEAD
	<br><br><br>
        <div class="select-wrapper">
	  
=======
	<br><br>
        <div class="btn-wrapper">
<!-- 
>>>>>>> 3a15403ecccdf6ada3561e95faa2fdd078b366c0
          <p>IDを入力して下さい</p>
	<div class="form-group form-check">
          <input name = "gid" style=text value="1">
        </div>
<<<<<<< HEAD
	<br>
       
	<div class="row">
	  <div class="col-sm-2"></div>
          <div class="col-sm-5"><p>エリアを選択してください</p></div>
	  <div class="col-sm-3">
	    <div class="form-group">
              <div class="selsect-btn">
		<select name="area" class="form-control">
                  <option value="kyoto" >近畿（京都）</option>
                  <option value="kanto" >関東</option>
=======
-->
        <p>エリアを選択してください</p>
	<div class="row">
           <div class="col-sm-2"></div>
           <div class="col-sm-8">
             <div class="select-btn guide-select">
	       <select name="area" class="form-control">
                 <option value="kyoto" >近畿（京都）</option>
                 <option value="kanto" >関東</option>
>>>>>>> 3a15403ecccdf6ada3561e95faa2fdd078b366c0
		</select>
	      </div>
	    </div>
	  </div>
        </div>
	<br>
	
	<div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-5"><p>名所か道案内か選択してください</p></div>
	  <div class="col-sm-3">
	    <div class="form-group">
              <div class="select-btn guide-select">
		<select name="style" class="form-control">
		  <option value="1" >名所ガイド</option>
		  <option value="2" >道案内ガイド</option>
		</select>
              </div>
	    </div>
	  </div>
	</div>
	
        <br>

	<div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-4">
	    <input class="btn btn-outline-info btn-lg btn-block" type="reset" value="Reset">
	  </div>
          <div class="col-sm-4">
	    <input class="btn btn-outline-info btn-lg btn-block" type="submit" value="Next">
	  </div>
	</div>

	<br><br>
	
	</div>
      </div>
    </div>
 </div>
 </form> 


 </body>
</html>
