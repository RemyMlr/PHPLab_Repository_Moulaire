<!DOCTYPE html>

<html>
    <body>
        <?php $nav="index.php"; ?>
        <?php include 'header.php'; ?>
        <?php
        if (isset($_COOKIE['counter']))
            $count = $_COOKIE['counter'];
        else
            $count = 0;


        
        $count = $count + 1;
        setcookie('counter', $count, time() + 24 * 3600);
        ?>
        <br />
        <br />
        <FORM action="counter-cookie.php" method="GET">
            <INPUT type="submit" name="Count" value="Count">
            <?php
            echo "count is $count";
            ?>
        </FORM>
        <br />
        <br />
        <?php include 'footer.php';  ?>
    </body>
</html>