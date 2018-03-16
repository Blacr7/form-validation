<?php include('inc/header.php');?>
	
<section class="content">
	<div class="logout">
	<?php if(isset($_SESSION['name'])){ echo '<p>Welcome ' . ucfirst($_SESSION['name']) . '</p>';} ?>
	 <form method="post" id="logoutForm">
   <input type="submit" name="logout" id="logoutButton" value="Logout">
</form>
	</div>
<?php // Check to see if actually logged in. If not, redirect to login page
	if(isset($_POST['logout'])){
    if (isset($_SESSION['name'])) {
	    session_destroy();
	    header('Location:index.php');
       
    }
    }
    ?>
	<div class="left-col">
<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" novalidate>
    <div class="form-group">
        <label for="upload">Upload Files</label>
        <input type="file" name="upload[]" id="upload" multiple accept="<?php echo $accept; ?>">
    </div>
		<div class="form-group">
        <input type="submit" name="upload" value="Upload">
        <span class="error"></span>
    </div>
    <?php
	  if(isset($_POST["upload"])) {
     $uploadOk = true;
     $upload ='';
     $file =  $tmp_name = '';
    $accept = array("doc", "txt", "log", "docx",  "xml", "rtf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    // convert an array of files into a string for the $_FILES superglobal to use and upload
    foreach ($_FILES["upload"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["upload"]["tmp_name"][$key];
            $file = basename($_FILES["upload"]["name"][$key]);
        }

        $FileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
				
        
	        if(empty($file)){
		        
		        echo "Please select files!";
		        
	        } else if($FileType != $accept[0] && $FileType != $accept[1] && $FileType != $accept[2] && $FileType != $accept[3] && $FileType != $accept[4] && $FileType != $accept[5] && $FileType != $accept[6] && $FileType != $accept[7]) {
                echo "That file is not supported";
                $uploadOk = false;
                
            } else if(file_exists($file)){
	        
            echo "This file is already uploaded";
            $uploadOk = false;
            
        } else if($uploadOk == false) {
            echo "Sorry something went from!";
        } else{
            move_uploaded_file($tmp_name, "storage/$file");
        }    
    }
   }
        
     
    ?>
</form>
	</div>
<div class="right-col">
	<form method="post" n>
			<h2>Available Files</h2>
			
			
			<?php 
            $dir = "storage";
            $files = scandir($dir);
            // remove the dots from the $files array
            array_shift($files);
            array_shift($files);
            echo '<div class="uploaded-File">';
            if(!isset($_REQUEST['delete'])){
                foreach($files as $key){
                    echo '<ul><li>' . $key . '</li><li><input name="delete[]" type="submit" id="delete" value="X"></li></ul>';
                    $key++;
                    
                }
            }
            if(isset($_REQUEST['delete'])){
                if(!empty($files)){
                    foreach($files as $key){
                        $fileName = $key;
                    }
                    // delete the file in the storage folder with the current fileName
                    unlink("storage/$fileName");
                    $files = scandir($dir);
                    // remove the dots from the $files array
                    array_shift($files);
                    array_shift($files);
                    foreach($files as $key){
                        echo '<ul><li>' . $key . '</li><li><input name="delete[]" type="submit" id="delete" value="X"></li></ul>';
                        $fileName = $key;
                        $key++;
                    }
                }else{
                    echo "<ul><li>";
                    echo "You havent uploaded any files!";
                    echo "</li></ul>";
                }
            }
            if(empty($files)){
                echo "<ul><li>";
                echo "You havent uploaded any files!";
                echo "</li></ul>";
            }
            
	   
	   	?>
	</form>
</div>

   <?php
    if (!isset($_SESSION['name'])) {
     	header('Location:index.php');
	exit();
}
    ?>
    
<?php include('inc/footer.php');?>


