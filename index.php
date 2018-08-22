<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_start();
    }
    
    date_default_timezone_set('America/Denver');
    require 'inc/page-begin.php';

?>
    
    <div class="container">
        

<?php
    if(isset($_POST['firstname'], $_POST['lastname'])) {
        $_SESSION['FIRSTNAME'] = ucfirst(strtolower(strip_tags($_POST['firstname'])));
        $_SESSION['LASTNAME'] = ucfirst(strtolower(strip_tags($_POST['lastname'])));
        $firstname = $_SESSION['FIRSTNAME'];
        $lastname = $_SESSION['LASTNAME'];
        $_SESSION['TIME'] = time();
        $time = date('g:ia - e', $_SESSION['TIME']);
        
    }
        
    $errormessage = ""; // define variable and initialize with empty value
        
    if(empty($_SESSION['FIRSTNAME']) || empty($_SESSION['LASTNAME'])) { 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(empty($_POST['firstname']) || empty($_POST['lastname'])) {
                $errormessage = 'Please enter a first and last name';
            }
        }
?>
        <div class="container">
            <form action="index.php" method="post">
                <div>
                    <label for="first-name">First Name:</label>
                    <input id="first-name" type="text" name="firstname">
                </div>
                <div>
                    <label for="last-name">Last Name:</label>
                    <input id="last-name" type="text" name="lastname">
                </div>
                <button type="submit" class="btn">Login</button>
                <span class="error"><?php echo $errormessage; ?></span>
            </form>
        </div>
<?php } else { // end if start else ?>
        
        <h2>Howdy, <?php echo $firstname . ' ' . $lastname  ?></h2>
        <p>You've been logged in since <?php echo $time ?></p>
        <a href="logout.php" class="btn logout">Logout</a>
    </div>
        
<?php } // end if/else 
    require 'inc/page-end.php';
?>
