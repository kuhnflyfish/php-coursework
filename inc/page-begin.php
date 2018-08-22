<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<title>Working with a Database</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
    <!--Page Begin-->
        <div class="container">
            <h1>Project 7: Working with a Database</h1>
            <nav>
                <ul>
                <?php if(session_status() == 1 || session_status() == PHP_SESSION_NONE) { ?>
                    <li>
                        <a href="index.php">Login</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                    <li>
                        <a href="upload.php">Upload</a>
                    </li>
                    <li>
                        <a href="view.php">View</a>
                    </li>
                <?php } // end else ?>
                </ul>
            </nav>
        </div>