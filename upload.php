<?php
    session_start();
    require 'inc/page-begin.php';   
?>

    <div class="container">
        <div class="upload-wrapper">
            <h2>Upload your images here:</h2>
            <form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                <label for="title">Title:</label>
                <input id="title" type="text" name="title" size="40" />
                <input type="file" name="image">
                <button type="submit" class="btn">Upload</button>
            </form>
            <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $path = "uploads/{$_FILES['image']['name']}";
                $db = mysqli_connect('localhost', 'root', 'password', 'myimages');
                $title = mysqli_real_escape_string($db, trim(strip_tags($_POST['title'])));
                $query = "INSERT INTO imagedata (id, path, title) VALUES (0, '$path', '$title')";
                $types = array('image/jpeg', 'image/gif', 'image/png');
    
                if(in_array($_FILES['image']['type'], $types)) {
                    if(move_uploaded_file($_FILES['image']['tmp_name'], "uploads/{$_FILES['image']['name']}") && @mysqli_query($db, $query)) {
                        echo '<p class=\'red\'>Your file has been uploaded and info added to the database!</p>';
                    } else {
                        if($_FILES['image']['error'] > 0) {
                            switch($_FILES['image']['error']) {
                                case 1:
                                    echo '<p class=\'red\'>The file exceeds the <span class=\'bold\'>upload_max_filesize</span> setting in <span class=\'bold\'>php.ini</span></p>';
                                    break;
                                case 2:
                                    echo '<p class=\'red\'>The file exceeds the <span class=\'bold\'>MAX_FILE_SIZE</span> setting in the HTML form</p>';
                                    break;
                                case 3:
                                    echo '<p class=\'red\'>The file was only partially uploaded</p>';
                                    break;
                                case 4:
                                    echo '<p class=\'red\'>No file was uploaded</p>';
                                    break;
                                case 6:
                                    echo '<p class=\'red\'>No temporary directory exists</p>';
                                    break;
                                case 7:
                                    echo '<p class=\'red\'>Failed to write file to disk</p>';
                                    break;
                                case 8:
                                    echo '<p class=\'red\'>A PHP extension stopped the file upload</p>';
                                    break;
                            }
                        } else {
                            echo "<p class=\'red\'>The image could not be added to the database because:<br>" . mysqli_error($db) . ".</p><p>The query was" . $query . "</p>";
                        }
                    }
                } else if ($_FILES['image']['error'] == 4) {
                    echo '<p class=\'red\'>Please select an image file to upload</p>';
                } else {
                    echo '<p class=\'red\'>Sorry, images only.  Your file is not a .jpg, .png, or .gif</p>';
                }
    
                mysqli_close($db);
           } // end request method if ?>
        </div>
    </div>

<?php require 'inc/page-end.php'; ?>
