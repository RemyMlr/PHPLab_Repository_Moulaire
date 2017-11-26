<html>
    <head>
        <title>Counting with the SESSION array</title>
    </head>
    <body>
        <?php include 'header.php' ?>
        <FORM action="counter-session.php" method="GET">
            <INPUT type="submit" name="Count" value="Count">
            <?php
            session_start();
            if (!isset($_SESSION['counter']))
                $count = 0;
            else
                $count = $_SESSION['counter'];
            $count = $count + 1;
            $_SESSION['counter'] = $count;
            echo "count is $count";
            ?>
        </FORM>
        <?php include 'footer.php' ?>

    </body>
</html>
