<?php 
include('../templates/Header.php'); 
if (isset($_POST['submit1'])) {
    if (isset($_FILES['image'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['title']);
        $lastname = mysqli_real_escape_string($conn, $_POST['subtitle']);
        $email = mysqli_real_escape_string($conn, $_POST['body']);
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'notif_images/' . $image; 

        // Check if file was uploaded successfully
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Insert data into the database
            $insert = mysqli_query($conn, "INSERT INTO notiftable(header, subheader, body) VALUES('$firstname','$lastname', '$email')");
            if ($insert) {
                // Get the ID of the newly inserted record
                $notification_id = mysqli_insert_id($conn);
                // Save the image file
                if (move_uploaded_file($image_tmp_name, $image_folder)) {
                    // Update the image path in the database
                    mysqli_query($conn, "UPDATE notif_table SET image_path='$image' WHERE id='$notification_id'");
                    $message[] = 'Registered successfully!'; 
                  
                } else {
                    echo "Error: " . mysqli_error($conn); // Display MySQL error, if any
                }
            } else {
                echo "Error: " . mysqli_error($conn); // Display MySQL error, if any
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File 'image' not found in the uploaded files.";
    }
}
?>

<link rel="stylesheet" href="./css/child-reg.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

<body>
<div class="container1">
        <div class="column1">
          <?php include('../templates/Admin-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/Notification.png">
            <div class="dashboard-text">
                    
                <h1>NOTIFICATIONS</h1>
               
            </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
           
           <div class="child-reg" >
           <?php
                  if(isset($message)){
                    foreach($message as $message){
                     echo "<script>
                             swal({
                             title: '$message',
                             html: '$message',
                             icon: 'success',
                             confirmButtonText: 'Okay'
            })
        </script>";
         }
      }
      ?>
           <div class="user-details" >
           
                    <div class="userdetails1">
                    <div class="input-box">
                        <span class="details">Header/Title</span>
                        <input type="text" name="title" placeholder="Enter your child's first name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Subheader</span>
                        <input type="text" name="subtitle" placeholder="Enter your child's last name" required>
                    </div>
                
                    </div>
                    <div class="userdetails2">  
                        <div class="input-box">
                        <span class="details">Public Material/Poster/Image</span>
                        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png"placeholder="Enter child's mother's name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Body</span>
                        <input type="text" name="body" placeholder="Enter child's father's name" required>
                    </div>
                  
                    </div>
                    </div>
                    <button type="submit" style="   width: 50%;
                                                    justify-content: center;
                                                    height: 80%;
                                                    margin-left:260px;
                                                    background:#8860D0 ;
                                                    border: none;
                                                    outline: none;
                                                    border: 1px solid #8860D0;
                                                    border-radius: 10px;
                                                    font-size: 14px;
                                                    color: white;
                                                    padding: 10px 20px;
                                                    transition: color 0.3s, border-color 0.3s;" name="submit1"class="btn1">Post Announcement</button>
                </div>
            </form>
                     </div>                    
               </div>
        </div>
</div>
           
                    
  
    
   

</body>
</html>