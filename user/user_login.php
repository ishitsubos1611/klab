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
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["userid"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn  = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $host, $dbname);

        // 3. エラー処理
        try {
	    $pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass, [PDO::ATTR_EMULATE_PREPARES => false]);

            $stmt = $pdo->prepare('SELECT * FROM U_account WHERE Uname = ?');
            $stmt->execute(array($userid));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['Uid'];
                    $sql = "SELECT * FROM U_account WHERE Uid = $id";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['Uname'];  // ユーザー名
                    }
                    $_SESSION["NAME"] = $row['Uname'];
                    header("Location: ../top.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ログイン</title>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <form id="loginForm" name="loginForm" action="" method="POST">
            <div>
                <div><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
                <p>ユーザーID</p>
		<input type="text" id="userid" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                <p>パスワード</p>
		<input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <p><input type="submit" id="login" name="login" value="ログイン"></p>
            </div>
        </form>
        <form action="user_signup.php">
            <div>
                <p>新規登録はこちらから<input type="submit" value="新規登録"></p>
            </div>
        </form>
    </body>
</html>