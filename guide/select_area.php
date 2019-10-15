<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>STEP 1</title>

  <link rel="stylesheet" href="../css/bootstrap.css">
  <!--<link rel="stylesheet" href="../css/0-3-A1.css"> -->
  <!--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></\
script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"\
 crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" cr\
ossorigin="anonymous"></script>

</head>
<body>

<?php 
 $select_step = $_POST['step'];

 if($select_step == 1){
  $step = "./place_registration.php";
 }elseif($select_step == 2) {
  $step = "./select_date.php";
 }

?>
<form name="step1" action="select_date.php" method='post'>
  <div class="main">
    <div class="container-fluid">
      <div class="text-center">
        <div class="btn-wrapper">


        <p>IDを入力して下さい</p>
        <!--<div class="select-btn guide-select">
          <input name = "gid" style=text value="1">
        </div>-->
	<div class="form-group form-check">
          <input name = "gid" style=text value="1">
        </div>

        <p>エリアを選択してください</p>
	<div class="row">
	  <div class="form-group">
	    <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="selsect-btn">
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
          <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
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
	<div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
	    <input class = "btn btn-info btn-lg btn-block" type="reset" value="入力内容をリセットする">
	  </div>
	</div>
	
	</div>
      </div>
    </div>
 </div>
 </form> 


 </body>
</html>
