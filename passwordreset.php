<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button id="trb" onclick="window.location.href='logout.html'">Log out</button>
    <h1>Modify Capstone</h1>
    <div id="modify">
          <form action="" method="post">
            <label for="projects">Select User:</label>
            <select id="users" name="userlist">

                <?php
                    //connect to the db schema
                    session_start();
                    ob_start();
                    $conn = new mysqli("localhost", "kmkelmo1", load_db_pass(), "kmkelmo1_student_showcase"); 
                    //needs changing for DB *******
                    function load_db_pass() {
                        $filename = "/home/kmkelmo1/kmkelm.org/kmkelmoftp/kmk.txt";
                        $handle = fopen($filename, "r");
                        $contents = fread($handle, filesize($filename));
                        fclose($handle);

                        return $contents;
                    }
                
                    // Check connection
                    if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    }  
                

                    $sql = "SELECT Username from SharedDB";
                    //change to actual sql query *******
                    $result = mysqli_query($conn,$lsql);
                    $row = mysqli_fetch_array($lresult,MYSQLI_ASSOC);
    
                    //display the sql result set in a dropdown
                    $table = $conn->query($sql);
                    if ($table->num_rows > 0) {
                    //output each result row
                    while($row = $result->fetch_assoc()){
                        echo "<option value=" . $row["Username"] . "</option>";
                    }
                    }
                ?>
            </select>
            <?php
                $sqladm = $conn->prepare("SELECT AdminEmail from SharedDB Limit 1");
                //change to actual sql query *******
                /* $sqlbook->bindParam("s","%" . $search . "%"); */
                $sqladm->execute();
                $result = $sqladm->get_result();
                $sqladm->close();

                if(!empty($_POST["userlist"])){
                    $selected = $_POST["userlist"];
                }
                $msg = "User " . "$selected" . " has forgotten their password.  Please reset it for them and email them.";
                $mail("$result","password reset",$msg);
            ?>
</body>
</html>