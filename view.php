<?php 
    session_start();
    require 'inc/page-begin.php';
    $db = mysqli_connect('localhost', 'root', 'password', 'myimages');
    $query = "SELECT * FROM imagedata";
 ?>

<div class="image-wrapper">
<?php if($images = mysqli_query($db, $query)) : if($images->num_rows > 0) : while($image_row = mysqli_fetch_array($images)) :
                echo "<div class='single-image'><h3>{$image_row['title']}</h3><img src='{$image_row['path']}' />";
                echo "<a href='delete-image.php?id={$image_row['id']}'>Delete Image</a></div>";
            endwhile;
        else : ?>
            <h2>You haven't uploaded any images yet!</h2>
    <?php endif; ?>
<?php endif; ?>
    
</div>
<?php mysqli_close($db); ?>
<?php require 'inc/page-end.php' ?>