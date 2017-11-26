<!DOCTYPE html>


<html>

<?php $nav="gallery.php"; ?>
<?php include 'header.php'; ?>

<?php 

  if (isset($_FILES['upload']))
  {
    $allowedextensions = array('jpg', 'jpeg', 'gif', 'png');
    
    #now if the user uplaoded an allowed format, we want to know what format that was
    #the following variable will store the extension, all in lower-case
    #substr() is a function that takes only a portion of a string - we need only what comes after the dot
    #we need to get everything after the LAST dot, looking for the extension
    #strrpos returns the position of the last occurrence of a substring in a string
    #we use the file name and a dot to find the extension: strrpos($_FILES['upload']['name'], '.')
    #but we also need to add one space to ignore the dot, so we write +1 at the end.
    #strtolower function changes all capital letters to lower-string so JPG becomes jpg and it fits your whitelist
    #you should take the entire string and put it in 'strtolower'
   
    $extension = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') + 1));
    echo "Your file extension is: ".$extension;
    $error = array ();
    
    #here we do our first check, we basically want it to pass so we can upload.
    #if it does not pass, then we give an error.
    #we say, check to see if "extensions" can be found in our array "allowedextensions"
    #if the extension is NOT in the array, we return the error message (we actually add it into the array)
    
    if(in_array($extension, $allowedextensions) === false)
    {
        $error[] = 'This is not an image, upload is allowed only for images.';        
    }
    
    #this is in bytes, and 1000000 is actually 1 mb which is now our limit
    if($_FILES['upload']['size'] > 1000000)
    {
        
        $error[]='The file exceeded the upload limit';
    }
    
    $db = new mysqli('localhost','root','','database1');
    

    if(empty($error))
    {
        #this is our starding point, in order to upload we need to move the file (uploaded file)
        #all the way to the location we want to store it.
        #But, before we do so it will be good to do all of the ABOVE written first
        #We check for errors that might disturb our code, and try to avoid them
        #if there are no errrors move the file to the desired file location
        move_uploaded_file($_FILES['upload']['tmp_name'], "uploadedfiles/{$_FILES['upload']['name']}"); 
        $request = $db->prepare("INSERT into gallery(name) VALUES(?)");
        $request->bind_param('s',$name);
        $name = $_FILES['upload']['name'];
        $request->execute();
        $request->close();

    }


    
}


?>


<html>
    <head>
        <title>Security - Upload</title>
           </head>
           
           <body>
               <div>
                   <?php
                   if (isset($error))
                   {
                       if (empty($error))
                       {
                           
                           #here we give the user the chance to check the file right away. 
                           #this is just for testing purposes so we can see the file is there
                           #when the user clicks, it will open the folder "uploadedfiles" and look for filename
                           echo '<a href="uploadedfiles/' . $_FILES['upload']['name'] . '">Check file';
                           
                       } 
                       else 
                       {
                           #else, if there was an error, then it simply goes through the error array
                           #it prints out ALL errors in the array.
                           #you can have one or more errors. 
                           #e.g. File too big, AND not supported!
                           foreach ($error as $err){
                               echo $err;
                       }
                           
                       }
                   }
                   
                   ?>
               </div>

              <?php 

              $db = new mysqli('localhost','root','','database1');
                if ($db->connect_error) 
                {
                echo "could not connect: " . $db->connect_error;
                printf("<br><a href=index.php>Return to home page </a>");
                exit();
                }

              ?>
               <div>
                   
                   <form action="" method="POST" enctype="multipart/form-data">
                       <input type="file" name="upload" /></br>
                       <input  type="submit" value="submit" />
                   </form>                   
               </div>
           </body>
    
    
    
    
</html>