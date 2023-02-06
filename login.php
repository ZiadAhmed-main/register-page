
<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli =  require __DIR__ . "/database.php";
    $sql_command = sprintf("SELECT * FROM user WHERE email = '%s'" , $_POST["email"]);
    $result = $mysqli->query($sql_command);
    $user = $result->fetch_assoc();

    if ($user) {
        
        if (password_verify($_POST["pass"], $user["password_hash"])) {


            header("Location: index/index.html");
            exit;
        }
    }
    
    $is_invalid = true;
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
        <?php if ($is_invalid): ?>
        <em>Email or Password are Invalid , please try again!</em>
        <?php endif; ?>
        
    <div class="parent">
        <form class="form"  method="post">
            <h1>Login</h1>
            <div>
                <input type="email" name="email" placeholder="Email">
            </div>

            <div>
                <input type="password" name="pass" placeholder="Password">
            </div>

            <button>Login</button>
        </form>
    </div>
</body>
</html>