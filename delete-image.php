<?php 
    session_start();
    require 'inc/page-begin.php';

    $db = mysqli_connect('localhost', 'root', 'milkfish818', 'myimages');
    
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $query = "SELECT path, title FROM imagedata WHERE id={$_GET['id']}";
        if($result = mysqli_query($db, $query)) {
            $row = mysqli_fetch_array($result);
            
            // Build the form to delete image file and data
            echo '<div class="delete-wrapper">
            <h2>Are you sure you want to delete this image?</h2>
            <form class="delete-form" action="delete-image.php" method="post">
            <h3>' . $row['title'] . '</h3>
            <div class="image-wrapper"><img src="' . $row['path'] . '" /></div><br>
            <input type="hidden" name="id" value="' . $_GET['id'] . '">
            <button type="submit" name="submit">Yes, Delete</button>
            </form></div>';
        } else {
            echo '<p class=\'red\'>Failed to query the database</p>';
        }
    } else if(isset($_POST['id']) && is_numeric($_POST['id'])) {
        $queryDelete = "DELETE FROM imagedata WHERE id={$_POST['id']} LIMIT 1";
        $queryPath = "SELECT path FROM imagedata WHERE id={$_POST['id']}";
        $selectResult = mysqli_query($db, $queryPath);
        $row = mysqli_fetch_array($selectResult);
        unlink($row['path']); // Delete image file from uploads folder
        $deleteResult = mysqli_query($db, $queryDelete);
        
        if(mysqli_affected_rows($db) == 1) {
            echo '<p class=\'red notify\'>Image successfully deleted</p>';
        } else {
            echo '<p class=\'red notify\'>Image could not be deleted</p>';
        }
    }
?>

<?php mysqli_close($db); ?>
<?php require 'inc/page-end.php' ?>