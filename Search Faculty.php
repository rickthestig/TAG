<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="nb">
        <button onclick="window.location.href='NonAdminHP-TAG.php'">Home</button>
        <button onclick="window.location.href='TAGregularView.php'">View</button>
    </div>
    <button id="trb" onclick="window.location.href='logout.html'">Log out</button>
    <h1>Faculty Search</h1>
    <form action="TAG_Search Faculty.php" method="post">
        Client <input type="text" id="client" name="client"><br>
        Name of Project <input type="text" id="PName" name="PName"><br>
        Year <input type="number" id="year" name="year"><br>
        Course <input type="text" id="coruse" name="course"><br>
        Student <input type="text" id="sname" name="sname"><br>
        <label for="isarchived">Is Archived:</label>
        <select name="isarchived" id="isarchived">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
        <div class="checkbox-grid">
            <input type="checkbox" name="checkbox[]" value="1"><label>Algorithms</label>
            <input type="checkbox" name="checkbox[]" value="2"><label>CMS</label>
            <input type="checkbox" name="checkbox[]" value="3"><label>Communication</label>
            <input type="checkbox" name="checkbox[]" value="4"><label>Contest</label>
            <input type="checkbox" name="checkbox[]" value="5"><label>Database</label>

            <input type="checkbox" name="checkbox[]" value="6"><label>e-Commerce</label>
            <input type="checkbox" name="checkbox[]" value="7"><label>Education</label>
            <input type="checkbox" name="checkbox[]" value="8"><label>Events</label>
            <input type="checkbox" name="checkbox[]" value="9"><label>External</label>
            <input type="checkbox" name="checkbox[]" value="10"><label>External - For Profit</label>

            <input type="checkbox" name="checkbox[]" value="11"><label>File Storage</label>
            <input type="checkbox" name="checkbox[]" value="12"><label>Internal</label>
            <input type="checkbox" name="checkbox[]" value="13"><label>KMS</label>
            <input type="checkbox" name="checkbox[]" value="14"><label>Marketing</label>
            <input type="checkbox" name="checkbox[]" value="15"><label>Networks</label>

            <input type="checkbox" name="checkbox[]" value="16"><label>Open Source</label>
            <input type="checkbox" name="checkbox[]" value="17"><label>Procedures</label>
            <input type="checkbox" name="checkbox[]" value="18"><label>Programming</label>
            <input type="checkbox" name="checkbox[]" value="19"><label>Queries</label>
            <input type="checkbox" name="checkbox[]" value="20"><label>Resources</label>

            <input type="checkbox" name="checkbox[]" value="21"><label>Security</label>
            <input type="checkbox" name="checkbox[]" value="22"><label>Social</label>
            <input type="checkbox" name="checkbox[]" value="23"><label>Web</label>
            <input type="checkbox" name="checkbox[]" value="24"><label>Website</label>
            <input type="checkbox" name="checkbox[]" value="25"><label>Workshop</label>
        </div>
        <input type="submit">
    </form>
    <?php
    $first = 0;
    $client=$_POST["client"];
    $name=$_POST["PName"];
    $year=$_POST["year"];
    $course=$_POST["course"];
    $student=$_POST["sname"];
    $checkbox=$_POST["checkbox"];
    $isarchived = $_POST['isarchived'];
    // need checkbox request as well
    $conn = new mysqli("localhost", "kmkelmo1", "vYV7v[66(kX9lD", "kmkelmo1_capstone_database");
    //main search is proj name
    $query = "SELECT DISTINCT ProjectName,ProjectDescription,Course,ProjectYear,Archive,Client.ClientName FROM Project JOIN ProjectAndClient ON Project.ProjectID = ProjectAndClient.ProjectID JOIN Client ON ProjectAndClient.ClientID = Client.ClientID JOIN ProjectAndStudent ON Project.ProjectID = ProjectAndStudent.ProjectID JOIN Student ON ProjectAndStudent.StudentID = Student.StudentID JOIN ProjectAndKeyword ON ProjectAndKeyword.ProjectID = Project.ProjectID JOIN Keyword ON Keyword.KeywordID = ProjectAndKeyword.KeywordID";
    $query2 = "SELECT DISTINCT Keyword.Keyword FROM Project JOIN ProjectAndClient ON Project.ProjectID = ProjectAndClient.ProjectID JOIN Client ON ProjectAndClient.ClientID = Client.ClientID JOIN ProjectAndStudent ON Project.ProjectID = ProjectAndStudent.ProjectID JOIN Student ON ProjectAndStudent.StudentID = Student.StudentID JOIN ProjectAndKeyword ON ProjectAndKeyword.ProjectID = Project.ProjectID JOIN Keyword ON Keyword.KeywordID = ProjectAndKeyword.KeywordID";
    $query4 = "SELECT DISTINCT Student.FirstName FROM Project JOIN ProjectAndClient ON Project.ProjectID = ProjectAndClient.ProjectID JOIN Client ON ProjectAndClient.ClientID = Client.ClientID JOIN ProjectAndStudent ON Project.ProjectID = ProjectAndStudent.ProjectID JOIN Student ON ProjectAndStudent.StudentID = Student.StudentID JOIN ProjectAndKeyword ON ProjectAndKeyword.ProjectID = Project.ProjectID JOIN Keyword ON Keyword.KeywordID = ProjectAndKeyword.KeywordID";
    $query3 = "SELECT DISTINCT Student.LastName FROM Project JOIN ProjectAndClient ON Project.ProjectID = ProjectAndClient.ProjectID JOIN Client ON ProjectAndClient.ClientID = Client.ClientID JOIN ProjectAndStudent ON Project.ProjectID = ProjectAndStudent.ProjectID JOIN Student ON ProjectAndStudent.StudentID = Student.StudentID JOIN ProjectAndKeyword ON ProjectAndKeyword.ProjectID = Project.ProjectID JOIN Keyword ON Keyword.KeywordID = ProjectAndKeyword.KeywordID";
    if ($name != null) {
        if($first == 0){
            $query = $query . " WHERE ";
            $query2 = $query2 . " WHERE ";
            $query3 = $query3 . " WHERE ";
            $query4 = $query4 . " WHERE ";
            $first = 1;
        }
        else{
            $query = $query . " AND ";
            $query2 = $query2 . " AND ";
            $query3 = $query3 . " AND ";
            $query4 = $query4 . " AND ";
        }
        $query = $query . "ProjectName LIKE '%$name%'";
        $query2 = $query2 . "ProjectName LIKE '%$name%'";
        $query3 = $query3 . "ProjectName LIKE '%$name%'";
        $query4 = $query4 . "ProjectName LIKE '%$name%'";
    }

    if ($isarchived != null or $isarchived == null) {
        if($first == 0){
            $query = $query . " WHERE ";
            $query2 = $query2 . " WHERE ";
            $query3 = $query3 . " WHERE ";
            $query4 = $query4 . " WHERE ";
            $first = 1;
        }
        else{
            $query = $query . " AND ";
            $query2 = $query2 . " AND ";
            $query3 = $query3 . " AND ";
            $query4 = $query4 . " AND ";
        }
        $query = $query . "archive = '$isarchived'";
        $query2 = $query2 . "archive = '$isarchived'";
        $query3 = $query3 . "archive = '$isarchived'";
        $query4 = $query4 . "archive = '$isarchived'";
    }
    if($client != null){
        if($first == 0){
            $query = $query . " WHERE ";
            $query2 = $query2 . " WHERE ";
            $query3 = $query3 . " WHERE ";
            $query4 = $query4 . " WHERE ";
            $first = 1;
        }
        else{
            $query = $query . " AND ";
            $query2 = $query2 . " AND ";
            $query3 = $query3 . " AND ";
            $query4 = $query4 . " AND ";
        }
        $query = $query . "ClientName LIKE '%$client%'";
        $query2 = $query2 . "ClientName LIKE '%$client%'";
        $query3 = $query3 . "ClientName LIKE '%$client%'";
        $query4 = $query4 . "ClientName LIKE '%$client%'";
    }
    if($year != null){
        if($first == 0){
            $query = $query . " WHERE ";
            $query2 = $query2 . " WHERE ";
            $query3 = $query3 . " WHERE ";
            $query4 = $query4 . " WHERE ";
            $first = 1;
        }
        else{
            $query = $query . " AND ";
            $query2 = $query2 . " AND ";
            $query3 = $query3 . " AND ";
            $query4 = $query4 . " AND ";
        }
        $query = $query . "ProjectYear LIKE '%$year%'";
        $query2 = $query2 . "ProjectYear LIKE '%$year%'";
        $query3 = $query3 . "ProjectYear LIKE '%$year%'";
        $query4 = $query4 . "ProjectYear LIKE '%$year%'";
        
    }
    if($course != null){
        if($first == 0){
            $query = $query . " WHERE ";
            $query2 = $query2 . " WHERE ";
            $query3 = $query3 . " WHERE ";
            $query4 = $query4 . " WHERE ";
            $first = 1;
        }
        else{
            $query = $query . " AND ";
            $query2 = $query2 . " AND ";
            $query3 = $query3 . " AND ";
            $query4 = $query4 . " AND ";
        }
        $query = $query . "Course LIKE '%$course%'";
        $query2 = $query2 . "Course LIKE '%$course%'";
        $query3 = $query3 . "Course LIKE '%$course%'";
        $query4 = $query4 . "Course LIKE '%$course%'";
    }
    if($student != null){
        if($first == 0){
            $query = $query . " WHERE ";
            $query2 = $query2 . " WHERE ";
            $query3 = $query3 . " WHERE ";
            $query4 = $query4 . " WHERE ";
            $first = 1;
        }
        else{
            $query = $query . " AND ";
            $query2 = $query2 . " AND ";
            $query3 = $query3 . " AND ";
            $query4 = $query4 . " AND ";
        }
        $query = $query . "Student.FirstName LIKE '%$student%' OR Student.LastName LIKE '%$student%'";
        $query2 = $query2 . "Student.FirstName LIKE '%$student%' OR Student.LastName LIKE '%$student%'";
        $query3 = $query3 . "Student.FirstName LIKE '%$student%' OR Student.LastName LIKE '%$student%'";
        $query4 = $query4 . "Student.FirstName LIKE '%$student%' OR Student.LastName LIKE '%$student%'";
    }
    $first = 0;
    
    foreach($checkbox as $checkboxvalue){
        if(!empty($checkboxvalue)){
            echo $checkboxvalue;
            $keywordquery = "SELECT DISTINCT ProjectID,KeywordID FROM ProjectAndKeyword WHERE KeywordID = '$checkboxvalue'";
            //$stmt->bind_param('i', $checkboxvalue);
            $stmt = $conn->prepare($keywordquery);
            $stmt->execute();
            $stmt->bind_result($PID,$KID);
            $stmt->fetch();
            $stmt->close();
            echo $PID;
            $bindquery = "SELECT ProjectID FROM Project WHERE ProjectName LIKE '%$name%'";
            echo "<p>brug3</p>";
            $stmt2 = $conn->prepare($bindquery);
            $stmt2->execute();
            $stmt2->bind_result($BPID);
            $stmt2->fetch();
            if($BPID == $PID && $BPID != null){
                $query = $query . " AND Keyword.KeywordID LIKE '%$KID%'";
                $query2 = $query2 . " AND Keyword.KeywordID LIKE '%$KID%'";
                $query3 = $query3 . " AND Keyword.KeywordID LIKE '%$KID%'";
                $query4 = $query4 . " AND Keyword.KeywordID LIKE '%$KID%'";
            }
            $stmt2->close();
            //this is my unholy creation to find the keywords, and i have zero clue if this abombination will function, update: it does
        }
        
    }
        $lastname = "";
        $firstname = "";
        $keyword = "";
        if($client != null OR $name != null OR $year != null OR $course  != null OR $student  != null OR $checkbox  != null){
        $stmt4 = $conn->prepare($query3);
        $stmt4->execute();
        while($stmt4->fetch()){
            $stmt4->bind_result($col7);
            $lastname= $lastname . $col7 . ", ";
            }
        $stmt5 = $conn->prepare($query4);
        $stmt5->execute();
        while($stmt5->fetch()){
            $stmt5->bind_result($col8);
            $firstname= $firstname . $col8 . ", ";
        }
        $stmt6 = $conn->prepare($query2);
        $stmt6->execute();
        while($stmt6->fetch()){
            $stmt6->bind_result($col9);
            $keyword= $keyword . $col9 . ", ";
        }
        
        $stmt3 = $conn->prepare($query);
        $stmt3->execute();
        $stmt3->bind_result($col1,$col2,$col3,$col4,$col5,$col6);
        echo "<div id=divid><table id=result><tr><th>Project Name</th><th>Project Description</th><th>Course</th><th>Project Year</th><th>Archived or Not</th><th>Client Name</th><th>Student First Name</th><th>Student Last Name</th><th>Keyword</th></tr>";
        $result = implode(", ", $col7);
        while ($stmt3->fetch()) {
            echo "<tr><td>$col1</td><td>$col2</td><td>$col3</td><td>$col4</td><td>$col5</td><td>$col6</td><td>$lastname</td><td>$firstname</td><td>$keyword</td>";} 
        echo "</table></div>";
        //should bind data to table correctly based on column
        }
        ?>
</body>
</html>
