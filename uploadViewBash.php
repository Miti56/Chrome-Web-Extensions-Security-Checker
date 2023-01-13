<?php
session_start();


// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'extensions';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// fetch files
$sql = "select filename , description, manifestVersion, created from filesBash";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload View & Download file in PHP and MySQL | Demo</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<br/>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 well">
            <form action="uploadsBash.php" method="post" enctype="multipart/form-data">
                <legend>Select File to Upload:</legend>
                <div class="form-group">
                    <input type="file" name="file1" />
                </div>
                <label for="description"><b>Description</b></label>
                <input type="text" placeholder="Enter description " name="description" id = "description" >
                <div class="form-group">
                    <input type="submit" name="submit" value="Upload" class="btn btn-info"/>
                </div>
                <?php if(isset($_GET['st'])) { ?>
                    <div class="alert alert-danger text-center">
                        <?php if ($_GET['st'] == 'success') {
                            echo "File Uploaded Successfully!";
                        }
                        else
                        {
                            echo 'Invalid File Extension!';
                        } ?>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>File Name</th>
                    <th>Description</th>
                    <th>Manifest Version</th>
                    <th>Created</th>
                    <th>View Pretty</th>
                    <th>View Raw</th>
                    <th>Download</th>
                    <th>Analyze</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['filename']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['manifestVersion']; ?></td>
                        <td><?php echo $row['created']; ?></td>
                        <?php   $data = file_get_contents('uploadsBash/'.$row['filename']); ?>
                        <td><a href="https://codebeautify.org/json-parser-online?input=<?php echo htmlentities($data); ?>" target="_blank">View Pretty</a></td>
                        <td><a href="uploads/<?php echo $row['filename']; ?>" target="_blank">View </a></td>
                        <td><a href="uploads/<?php echo $row['filename']; ?>" download>Download</td>
                        <td><form method="post" action="analyzeBash.php">
                                <input type="hidden" value= "<?php
                                echo $row['filename'];
                                ?>" name="fileName">
                                <input type="Submit" class="Analyze" value="Analyze">
                            </form></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
        <a href="welcome.php">
            <button2>Go back</button2>
    </div>
</div>
</body>
</html>