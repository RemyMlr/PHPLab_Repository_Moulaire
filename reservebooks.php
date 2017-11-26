<!DOCTYPE html>

<html>

	<?php $nav="reservebooks.php"; ?>

	<?php include 'header.php'; ?> 

	<?php

	$db = new mysqli('localhost','root','','database1');
            if ($db->connect_error) 
            {
            echo "could not connect: " . $db->connect_error;
            printf("<br><a href=index.php>Return to home page </a>");
            exit();
            }

	$id = trim($_GET['id']);
	echo '<INPUT type="hidden" name="id" value=' . $id . '>';
	$id = trim($_GET['id']);
	$id = addslashes($id);

	

	echo "You are reserving book with the ID:".$id;

	$stmt = $db->prepare("UPDATE books_browser SET onloan=1 WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    printf("<br>Book Reserved!");
    printf("<br><a href=browser.php>Search and Book more Books </a>");
    printf("<br><a href=mybooks.php>Return to Reserved Books </a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;

	?>

	<?php include 'footer.php';  ?>
    </body>
</html>