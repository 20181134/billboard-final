<html>
    <head>
        <meta charset="utf-8">
        <title>Billboard</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <header>
            <div class="logo">
                <div class="links">
                    <a href=""></a>
                    <?php
                    session_start();
                    if (isset($_SESSION['user'])) {
                        echo '<a href="./signout.php">'.$_SESSION['user']['username'].'</a>';
                    } else {
                        echo '<a href="./signin.php">Sign In</a>';
                    }
                    ?>
                </div>
            </div>
        </header>
        <main>
            <div class="timeline">
                <?php
                if (isset($_SESSION['user'])) {
                    echo "<form action='' method='post'>
                        <textarea name='tweet'></textarea>
                        <input type='submit' value='Tweet'>
                    </form>";
                } else {
                    echo '<a href="./signin">Sign In</a> or <a href="./createaccount.php">Create a new account</a> to send a tweet!';
                }
                ?>
                <?php
                // add a tweet
                $pdo = new PDO('mysql:host=localhost;dbname=board;charset=utf8', 'admin', 'password');
                $stmt = $pdo->prepare('INSERT INTO tweets values(?, ?, ?, ?, ?)');
                if ($stmt->execute([null, $_REQUEST['tweet'], $_SESSION['user']['username'], null, $_SESSION['user']['avatar']])) {
                    foreach ($pdo->query('SELECT * FROM tweets') as $row) {
                        echo '<img src="', $row['avatar'], '" class="tweetavatar">';
                        echo '<p class="uploader">', $row['uploader'], '</p>';
                        echo '<p class="tweets">', $row['tweets'], '</p>';
                    }
                }
                ?>
            </div>
            <div class="userinfo">
                <?php
                echo '<img src="', $_SESSION['user']['avatar'], '" class="useravatar">';
                echo '<p class="loginname">', $_SESSION['user']['username'], '</p>';
                $stmt2=$pdo->prepare('SELECT * FROM following where from=?');
                if ($stmt2->execute([$_SESSION['user']['usernum']])) {
                    echo '<a href="', $row['page'], '"></a><br>';
                }
                ?>
            </div>
        </main>
        <footer></footer>
    </body>
</html>