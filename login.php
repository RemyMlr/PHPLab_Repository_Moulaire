<!DOCTYPE html>

<html>
        <?php $nav="login.php"; ?>
        <?php include 'header.php'; ?>

        <?php

         $db = new mysqli('localhost','root','','database1');
                if ($db->connect_error) 
                {
                echo "could not connect: " . $db->connect_error;
                printf("<br><a href=index.php>Return to home page </a>");
                exit();
                }
        $uname ="";
        $upass ="";

        if (isset($_POST['username'], $_POST['password']))
        {
        	$uname = mysqli_escape_string($db, $_POST['username']);
        	$upass = sha1($_POST['password']);
        }

        $request = $db->prepare("SELECT username FROM login WHERE username='".$uname."'");
        $request->execute();

        $result=$request->fetch();

        if($result){
            echo '<h2> Correct username </h2>';
        }
        else{
            $query = "INSERT INTO login(username,password) VALUES ('$uname', '$upass')";
            $useradd = mysqli_query($db,$query);
            echo '<h2>Your account were unknown, so we created it.</h2>';
        }

        /*$query = ("SELECT * FROM login WHERE username = '{$uname}' "."AND password = '{$upass}'");

        $stmt = $db->prepare($query);
    	$stmt->execute();
    	$stmt->store_result();

    	$totalcount = $stmt->num_rows();


    	if (isset($totalcount)) 
    	{
            if ($totalcount == 0) 
            {
                echo '<h2>Your account were unknown, so we created it.</h2>';

            } 
            else 
            {
                echo '<h2>Welcome! Correct password.</h2>';
                header("location: gallery.php");
            }
        }*/
        ?>

         <form method="POST" action="">
            <input type="text" name="username">
            <input type="password" name="password">
            <input type="submit" value="Go">
        </form>

        <?php 


        session_start ();
        if (isset($_SESSION['userip']) === false)
        {
    	$_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];
		}

		echo $_SESSION['userip'];

		if ($_SESSION['userip'] !== $_SERVER['REMOTE_ADDR'])
		{
	    session_unset();
	    session_destroy(); 
		}

        ?>
        <?php include 'footer.php'; ?>
    </body>
</html>