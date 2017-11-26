<!DOCTYPE html>


<html>
	<?php $nav="browser.php"; ?>
    <?php include 'header.php'; ?>

        <p class="browse_title"> Here you can scroll and search for a new book <p>
        	<form action="browser.php" method="POST">
    			<table class="searchtable" cellpadding="6">
        			<tbody>
            			<tr>
                			<td> Search a title:</td>
                			<td><INPUT type="text" name="searchtitle"></td>
            			</tr>
            			<tr>
                			<td> Search an author:</td>
                			<td><INPUT type="text" name="searchauthor"></td>
            			</tr>
            			<tr>
                			<td></td>
                			<td><INPUT type="submit" name="submit" value="Submit"></td>
            			</tr>
        			</tbody>
    			</table>
			</form>
			<h3>Book List</h3>


			

	        <?php 
				
	        	$db = new mysqli('localhost','root','','database1');
	        	if ($db->connect_error) 
	        	{
			    echo "could not connect: " . $db->connect_error;
			    printf("<br><a href=index.php>Return to home page </a>");
			    exit();
				}

				$query = "SELECT * from books_browser";

	        	$searchtitle = "";
				$searchauthor = "";

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

				$stmt = $db->prepare($query);
			    $stmt->bind_result($id, $book, $author, $onloan);
			    $stmt->execute();
			    ?>

			    <section>
			    <?php
			    echo '<table cellpadding="6">';
			    echo '<tr><b> <td>n°</td> <td>Title</td> <td>Author</td> <td>Reserve</td> </b> </tr>';
			    while ($stmt->fetch())
			    {
			        echo "<tr>";
			        echo "<td> $id </td><td> $book </td><td> $author </td>";
			        echo '<td><a href="reservebooks.php?id=' . urlencode($id) . '"> Reserve </a></td>';
			        echo "</tr>";
			    }
			    echo "</table>";
			    ?>
			    </section>

                <?php /*<form method="get" action="browser.php">
                <table class="searchtable" cellpadding="6">
                    <tbody>
                        <tr>
                            <td>Title:</td>
                            <td><INPUT type="text" name="searchtitle"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><INPUT type="submit" name="submit" value="Submit"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php 

            $books = array();
            $books[] = array( "title" => "L'étranger", "author" => "A. Camus");
            $books[] = array( "title" => "Caligula", "author" => "A. Camus");
            $books[] = array( "title" => "Voyage au bout de la nuit", "author" => "Louis Ferdinand Celine");
            $books[] = array( "title" => "Sad life of Remy Viniacourt", "author" => "R. Moulaire");
            $books[] = array( "title" => "Madame Bovary", "author" => "G. Flaubert");
            $books[] = array( "title" => "Une education sentimentale", "author" => "G. Flaubert");
            $books[] = array( "title" => "La condition humaine", "author" => "Andre malraux");

            $searchtitle = "";


            if (isset($_GET) && !empty($_GET)) 
                {
                    $searchtitle = trim($_GET['searchtitle']);
                    $searchtitle = addslashes($searchtitle);
                    $id = array_search($searchtitle, array_column($books, 'title'));
                    

            echo '<table cellpadding="6">';
            echo '<tr><b><td>Title</td> <td>Author</td> <td>Reserve</td> </b> </tr>';

            if ($id !== FALSE) {
                    $book = $books[$id];
                    $title = $book['title'];
                    $author = $book['author'];
                    echo "<tr>";
                    echo "<td> $title </td><td> $author </td>";
                    echo '<td><a class="reserve_button" href="reserve.php?reservation=' .  urlencode($title) . '"> Reserve </a></td>';
                    echo "</tr>";
                }
            
                echo "</table>";
                }

            else {

                        echo '<table cellpadding="6">';
            echo '<tr><b><td>Title</td> <td>Author</td> <td>Reserve</td> </b> </tr>';


            foreach ($books as $book) 
            {
                $title = $book['title'];
                $author = $book['author'];
                echo "<tr>";
                echo "<td> $title </td><td> $author </td>";
                echo '<td><a class="reserve_button" href="reserve.php?reservation=' .  urlencode($title) . '"> Reserve </a></td>';
                echo "</tr>";
            }
           }
            echo "</table>"; */
            ?>
        	
    <?php include 'footer.php' ?>
    </body>
</html>
