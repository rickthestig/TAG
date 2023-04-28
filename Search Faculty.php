<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="nb">
        <button onclick="window.location.href='home.html'">Home</button>
        <button onclick="window.location.href='view.html'">View</button>
    </div>
    <button id="trb" onclick="window.location.href='logout.html'">Log out</button>
    <h1>Faculty Search</h1>
    <form action="search faculty.php" method="post">
        Client <input type="text" id="client" name="client"><br>
        Name of Project <input type="text" id="PName" name="PName"><br>
        Year <input type="number" id="year" name="year"><br>
        Course <input type="text" id="coruse" name="course"><br>
        // maybe a dropdown
        Student <input type="text" id="sname" name="sname"><br>
        //TODO: add dropdown for archived or not
        <div class="checkbox-grid">
            <label><input type="checkbox" name="checkbox[]"  value="1">Algorithms</label>
            <label><input type="checkbox" name="checkbox[]"  value="2">CMS</label>
            <label><input type="checkbox" name="checkbox[]"  value="3">Communication</label>
            <label><input type="checkbox" name="checkbox[]"  value="4">Contest</label>
            <label><input type="checkbox" name="checkbox[]"  value="5">Database</label>

            <label><input type="checkbox" name="checkbox[]"  value="6">e-Commerce</label>
            <label><input type="checkbox" name="checkbox[]"  value="7">Education</label>
            <label><input type="checkbox" name="checkbox[]"  value="8">Events</label>
            <label><input type="checkbox" name="checkbox[]"  value="9">External</label>
            <label><input type="checkbox" name="checkbox[]"  value="10">External - For Profit</label>

            <label><input type="checkbox" name="checkbox[]"  value="11">File Storage</label>
            <label><input type="checkbox" name="checkbox[]"  value="12">Internal</label>
            <label><input type="checkbox" name="checkbox[]"  value="13">KMS</label>
            <label><input type="checkbox" name="checkbox[]"  value="14">Marketing</label>
            <label><input type="checkbox" name="checkbox[]"  value="15">Networks</label>

            <label><input type="checkbox" name="checkbox[]"  value="16">Open Source</label>
            <label><input type="checkbox" name="checkbox[]"  value="17">Procedures</label>
            <label><input type="checkbox" name="checkbox[]"  value="18">Programming</label>
            <label><input type="checkbox" name="checkbox[]"  value="19">Queries</label>
            <label><input type="checkbox" name="checkbox[]"  value="20">Resources</label>

            <label><input type="checkbox" name="checkbox[]"  value="21">Security</label>
            <label><input type="checkbox" name="checkbox[]"  value="22">Social</label>
            <label><input type="checkbox" name="checkbox[]"  value="23">Web</label>
            <label><input type="checkbox" name="checkbox[]"  value="24">Website</label>
            <label><input type="checkbox" name="checkbox[]"  value="25">Workshop</label>
        </div>
        <input type="submit">
    </form>
    <?php
    $client=$_POST["client"];
    $name=$_POST["PName"];
    $year=$_POST["year"];
    $course=$_POST["course"];
    $student=$_POST["sname"];
    $checkbox=$_POST["checkbox"];
    // need checkbox request as well
    $conn = new mysqli("localhost", "kmkelmo1", "vYV7v[66(kX9lD", "kmkelmo1_capstone_database");
    //main search is proj name
    if ($name != null) {
        $query = "SELECT ProjectName,ProjectDescription,Course,ProjectYear,Archive,Client.ClientName,Student.FirstName,Student.LastName, Keyword.Keyword FROM Project JOIN ProjectAndClient ON Project.ProjectID = ProjectAndClient.ProjectID JOIN Client ON ProjectAndClient.ClientID = Client.ClientID JOIN ProjectAndStudent ON Project.ProjectID = ProjectAndStudent.ProjectID JOIN Student ON ProjectAndStudent.StudentID = Student.StudentID JOIN ProjectAndKeyword ON ProjectAndKeyword.ProjectID = Project.ProjectID JOIN Keyword ON Keyword.KeywordID = ProjectAndKeyword.KeywordID WHERE ProjectName LIKE %$name%";
    }
    if($client != null){
        $query = $query . " AND ClientName LIKE %$client%";
    }
    if($year != null){
        $query = $query . " AND ProjectYear LIKE %$year%";
    }
    if($course != null){
        $query = $query . " AND Course LIKE %$course%";
    }
    if($name != null){
        $query = $query . " AND Student.FirstName LIKE %$student% OR Student.LastName LIKE %$student%";
    }
    echo $query;
    foreach($checkbox as $checkboxname=>$checkboxvalue){
        if(!is_null($checkboxvalue)){
            $keywordquery = "SELECT ProjectID,KeywordID FROM ProjectAndKeyword WHERE KeywordID LIKE %$checkboxvalue%";
            $stmt = $conn->prepare($keywordquery);
            $stmt->execute();
            $stmt->bind_result($PID,$KID);
            $bindquery = "SELECT ProjectID FROM Project WHERE ProjectName LIKE %$name%";
            $stmt = $conn->prepare($bindquery);
            $stmt->execute();
            $stmt->bind_result($BPID);
            if($BPID == $PID){
                $query = $query . " AND Keyword.KeywordID LIKE %$KID%";
            }
            //this is my unholy creation to find the keywords, and i have zero clue if this abombination will function
        }
    }
    $query = $query . ";";
    $stmt = $conn->prepare($query);
        $stmt->execute();
        $stmt->bind_result($col1,$col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9);
        echo "<div id=divid><table id=result><tr><th>Project Name</th><th>Project Description</th><th>Course</th><th>Project Year</th><th>Archived or Not</th><th>Client Name</th><th>Student First Name</th><th>Student Last Name</th><th>Keywords</th></tr>";
        while ($stmt->fetch()) {
            echo "<tr><td>$col1</td><td>$col2</td><td>$col3</td><td>$col4</td><td>$col5</td><td>$col6</td><td>$col7</td><td>$col8</td><td>$col9</td>";} 
        echo "</table></div>";
        //should bind data to table correctly based on column
        ?>
</body>
</html>
