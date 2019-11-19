<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>STEP 1</title>

  <!-- <link rel="stylesheet" href="../css/0-3-A1.css"> -->
  <link rel="stylesheet" href="../css/bootstrap.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>
<body>

<?php 
  session_start();
  $select_step = $_POST['step'];
  $uid = $_SESSION["USERID"];

 if($select_step == 1){
  $step = "./place_registration.php";
 }elseif($select_step == 2) {
  $step = "./select_date.php";
 }

?>
<form name="step1" action="select_date4booking.php" method='post'>
  <div class="main">
    <div class="container-fluid">
      <div class="text-center">
	<div class="btn-wrapper">
	  <br><br>

     <input name=uid type=hidden value="<?php echo $uid; ?>">
	  <!-- 
          <p>IDを入力して下さい</p>
          <div class="select-btn guide-select">
            <input name = "gid" style=text value="1">
          </div>
	  -->
	  
	  <p></p>
          <p>エリアを選択してください</p>
	  <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="form-group">
		<div class="select-btn guide-select">
		  <select name="area" class="form-control">
		    <option value="kyoto" >近畿（京都）</option>
		    <option value="kanto" >関東</option>
		  </select>
		</div>
	      </div>
	    </div>
          </div>

          <p>名所か道案内か選択してください</p>
	  <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
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

          <p></p>
	  <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
	      <input class = "btn btn-info btn-lg btn-block" type="submit" value="Next">
	    </div>
	  </div>
	 
          <p></p>
	</div>
      </div>
    </div>
  </div>
</form> 


</body>
</html>
