<!DOCTYPE html>

<html>
        <?php $nav="mybooks.php"; ?>
        <?php include 'header.php'; ?>
        <nav class="mybooks">
        	<form action="showreservedbooks.php" method="POST">
                <table  cellpadding="6">
                    <tbody>
                        <tr>
                            <td>Title:</td>
                            <td><INPUT type="text" name="searchtitle"></td>
                        </tr>
                        <tr>
                            <td>Author:</td>
                            <td><INPUT type="text" name="searchauthor"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><INPUT type="submit" name="submit" value="Submit"></td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <?php
            
            $searchtitle = "";
            $searchauthor = "";
            $searchtitle = addslashes($searchtitle);
            $searchauthor = addslashes($searchauthor);

            $db = new mysqli('localhost','root','','database1');
                if ($db->connect_error) 
                {
                echo "could not connect: " . $db->connect_error;
                printf("<br><a href=index.php>Return to home page </a>");
                exit();
                }

                $query = "SELECT id, book, author, onloan from books_browser where onloan is true";

            if (isset($_POST) && !empty($_POST)) 
                {
                    $searchtitle = trim($_POST['searchtitle']);
                    $searchauthor = trim($_POST['searchauthor']);
                }

                if ($searchtitle && !$searchauthor) { // Title search only
                    $query = $query . " where book like '%" . $searchtitle . "%'";
                }
                if (!$searchtitle && $searchauthor) { // Author search only
                    $query = $query . " where author like '%" . $searchauthor . "%'";
                }
                if ($searchtitle && $searchauthor) { // Title and Author search
                    $query = $query . " where book like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
                }

                echo '<table cellpadding="6">';
                echo '<tr><b><td>id</td><b> <td>Title</td> <td>Author</td> <td>Reserved?</td> </b> <td>Return</td> </b></tr>';

                $stmt = $db->prepare($query);
                $stmt->bind_result($id, $book, $author, $onloan);
                $stmt->execute();

                while ($stmt->fetch()) {
                    if($onloan==1)
                        $onloan="Yes";
                   
                    echo "<tr>";
                    echo "<td> $id </td><td> $book </td><td> $author </td><td> $onloan </td>";
                    echo '<td><a href="returnbooks.php?id=' . urlencode($id) . '">Return</a></td>';
                    echo "</tr>";
                }
                echo "</table>";

            ?>
        	<form method="POST" action="traitement.php">
   				<p>
       				<label for="Comment">Tell us what you think about your books : </label><br />
      				<p><textarea class="textarea_mybooks" name="Comment" id="Comment"> How awesome are your books ?</textarea></p>

   				</p>
			</form>
        </nav>
    <?php include 'footer.php';  ?>
    </body>
</html>
