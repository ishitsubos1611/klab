<?php
// セッション開始
session_start();

$host = "localhost";  // DBサーバのURL
$dbuser = "ishi";  // ユーザー名
$dbpass = "asdf1611";  // ユーザー名のパスワード
$dbname = "account_db";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
  // １．ユーザIDの入力チェック

  if (empty($_POST["userid"])) {
    $errorMessage = "ユーザIDが未入力です。";
  }

  if (empty($_POST["password"])) {
    $errorMessage = "パスワードが未入力です。";
  }

  // ２．ユーザIDとパスワードが入力されていたら認証する
  if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
      try {
      $dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass, [PDO::ATTR_EMULATE_PREPARES => false]);

    } catch (PDOException $e) {
      var_dump($e->getMessage());
      echo '接続失敗';
      exit;
    }

    // 入力したユーザIDを格納
    $userid = $_POST["userid"];

    $stmt = $dbh->prepare('SELECT * FROM G_account WHERE Gname = ?');
    $stmt->execute(array($userid));


    if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      // パスワード(暗号化済み）の取り出し
      $db_hashed_pwd = $row['password'];
    }

    // ３．画面から入力されたパスワードとデータベースから取得したパスワードのハッシュを比較します。
    if (password_verify($_POST["password"], $db_hashed_pwd)) {
      // ４．認証成功なら、セッションIDを新規に発行する
      session_regenerate_id(true);
      $_SESSION["USERID"] = $_POST["userid"];
      header("Location: ../user_top.php");
      exit;
    }else {
      // 認証失敗
      $errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
    }
  }
}

?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ログイン画面</title>
  
  <link rel="stylesheet" href="../css/bootstrap.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script>
  history.pushState(null, null, null);
  $(window).on("popstate", function (event) {
  if (!event.originalEvent.state) {
    history.pushState(null, null, null);
    return;
    } 
  });
  </script>


</head>
<body>
  <div class="main">
  <nav class="navbar navbar-dark bg-dark fixed-top">			
    <a class="navbar-brand" href="../top.html">シェアリングツアーガイド</a>				
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <!--  <span class="navbar-toggler-icon"></span> -->
    </button>
  </nav>

    <div class="container-fluid">
      <div class="text-center">
        <br><br><br>
	<div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
	    <div><a href="#"  class = "btn btn-danger disabled btn-lg btn-block" >ユーザログイン画面</a></div>
          </div>
        </div>
	<br>

	<form id="loginForm" name="loginForm" action="" method="POST">
        <div><?php echo $errorMessage ?></div>

	<br>

	<div class="form-group row">
          <div class="col-sm-3"></div>
          <div class="col-sm-2">
	    <p>ユーザID</p>
	  </div>
	  <div class="col-sm-5">
	    <input type="text" class="form-control" id="userid" name="userid" value="<?php echo htmlspecialchars($_POST["userid"], ENT_QUOTES); ?>" placeholder="ユーザIDを入力">
	   <!-- <input type=hidden name="uid" value="<?php echo $_POST['userid']; ?>" > -->
<!--            <p>ユーザID<input type="text" id="userid" name="userid" value="<?php echo htmlspecialchars($_POST["userid"], ENT_QUOTES); ?>"></p>  -->
	  </div>
	</div>
	<!--<input name = uid' .' type=hidden value="<?php echo $userid ?>">-->    
	<div class="form-group row">
          <div class="col-sm-3"></div>
          <div class="col-sm-2">
	    <p>パスワード</p>
	  </div>
	  <div class="col-sm-5">
	  <input type="password" class="form-control" id="password" name="password" value="" placeholder="パスワードを入力">
           <!-- <p>パスワード<input type="password" id="password" name="password" value=""></p> -->
	  </div>
        </div>
        <br>
	<div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
	    <a href="user_signup.php" class="btn btn-outline-info btn-lg btn-block" >ユーザ情報登録ページへ</a>
	  </div>
	</div>
	<br>
	<div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <input class="btn btn-outline-info btn-lg btn-block" type="submit" id="login" name="login" value="ログイン">
	  </div>
	</div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
