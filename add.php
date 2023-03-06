<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="nb">
        <button onclick="window.location.href='home.html'">Home</button>
        <button onclick="window.location.href='view.html'">View</button>
        <button onclick="window.location.href='add.html'">Add</button>
        <button onclick="window.location.href='modify.html'">Modify</button>
    </div>
    <button id="trb" onclick="window.location.href='logout.html'">Log out</button>
    <h1>Add Capstone</h1>
    <form action="" method="post">
        Client <input type="text" id="client" name="client"><br>
        Year<input type="number" id="year" name="year"><br>
        Title<input type="text" id="title" name="title"><br>
        Description<input type="text" id="desc" name="desc"><br>
        Key Words<br><br>
        <div class="checkbox-grid">
			<label><input type="checkbox" name="option1">Option 1</label>
			<label><input type="checkbox" name="option2">Option 2</label>
			<label><input type="checkbox" name="option3">Option 3</label>
			<label><input type="checkbox" name="option4">Option 4</label>
			<label><input type="checkbox" name="option5">Option 5</label>
			<label><input type="checkbox" name="option6">Option 6</label>
        </div>
        <input type="submit">
    </form>

    <?php
        //connect to the db schema
        session_start();
        ob_start();
        $conn = new mysqli("localhost", "kmkelmo1", load_db_pass(), "kmkelmo1_student_showcase");
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
    
        $client = isset($_POST['client']) ? $_POST['client'] : "";
        $year = isset($_POST['year']) ? $_POST['year'] : "";
        $title = isset($_POST['title']) ? $_POST['title'] : "";
        $desc = isset($_POST['desc']) ? $_POST['desc'] : "";
        // TODO Keywords
        $keywords = isset($_POST['']) ? $_POST[''] : "";



    
        if(isset($_POST['title']) && $title != ""){
            
            //insert into project table
            
            $sql = "INSERT INTO `project` (`pID`, `title`, `client`, `year`, `desc`, `keywords`) 
                                VALUES (NULL, '$title', '$client', '$year', '$desc', '$keywords')";

            if (mysqli_query($conn, $sql)) {
                $last_id = mysqli_insert_id($conn);
                echo "New record created successfully. Last inserted ID is: " . $last_id;
                header("Refresh:0");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }          

            }//end of isset if stmt
        
  $conn->close();      
    ?>
</body>
</html>
