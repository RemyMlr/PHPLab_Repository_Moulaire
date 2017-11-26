<!DOCTYPE html>


<html>

		<?php $nav="displaygallery.php"; ?>
		<?php include 'header.php'; ?>

		<?php 

		$db = new PDO('mysql:host=localhost;dbname=database1;charset=utf8', 'root', '');

		$number = glob("uploadedfiles/*.*");
		$counter = count($number);

		while($counter > 0)
		{
			$result=$db->query("SELECT * from gallery where $counter = id");
			while($data = $result->fetch())
			{
				 ?> <img src="uploadedfiles\<?php echo $data['name']; ?>" alt="picture"/>;
				 <?php
			}
			$counter--;
		}

		?>

        
        <?php include 'footer.php';  ?>
    </body>
</html>
