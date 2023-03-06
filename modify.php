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
    <h1>Modify Capstone</h1>
    <div id="modify">
          <form action="" method="post">
            <label for="projects">Select Capstone:</label>
            <select id="projects" name="projlst">

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
              

              $sql = "SELECT * FROM project";
              $result = mysqli_query($conn,$lsql);
              $row = mysqli_fetch_array($lresult,MYSQLI_ASSOC);

              //display the sql result set in an html table
              $table = $conn->query($sql);
              if ($table->num_rows > 0) {
                //output each result row
                while($row = $result->fetch_assoc()){
                  echo "<option value ='" . $row['pID'] . "'>" . $row['title'] . "  </option>";
                }
              }     
            ?>
            </select><br>

            
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
            <input type="submit" id="deleteproj" name="deleteproj" value="Delete" style="width: 50%; float: left;">
            <input type="submit" id="modproj" name="modproj" value="Modify" style="width: 50%; float: left">
          </form>         
          </div>
</body>
</html>
