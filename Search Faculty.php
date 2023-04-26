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
    <form action="search.php" method="post">
        Client <input type="text" id="client" name="client"><br>
        Name of Project <input type="text" id="PName" name="PName"><br>
        Year <input type="number" id="year" name="year"><br>
        Course <input type="text" id="coruse" name="course"><br>
        // maybe a dropdown
        Student <input type="text" id="sname" name="sname"><br>
        //TODO: add dropdown for archived or not
        <div class="checkbox-grid">
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Algorithms</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">CMS</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Communication</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Contest</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Database</label>

            <label><input type="checkbox" name="checkbox[]" id="/" value="/">e-Commerce</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Education</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Events</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">External</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">External - For Profit</label>

            <label><input type="checkbox" name="checkbox[]" id="/" value="/">File Storage</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Internal</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">KMS</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Marketing</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Networks</label>

            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Open Source</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Procedures</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Programming</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Queries</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Resources</label>

            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Security</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Social</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Web</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Website</label>
            <label><input type="checkbox" name="checkbox[]" id="/" value="/">Workshop</label>
        </div>
        <input type="submit">
    </form>
    <?php
    $client=$_REQUEST["client"];
    $name=$_REQUEST["PName"];
    $year=$_REQUEST["year"];
    $course=$_REQUEST["course"];
    $student=$_REQUEST["sname"];
    // need checkbox request as well
    $conn = new mysqli("localhost", "kmkelmo1", "vYV7v[66(kX9lD", "kmkelmo1_capstone_database");
    //main search is proj name
    if ($name == null) {
        $stmt = $conn->prepare("SELECT * FROM Project");
        $stmt->execute();
        $stmt->bind_result($col1,$col2,$col3,$col4,$col5);
        echo "<div id=divid><table id=result><tr><th>Recipe Name</th><th>Recipe Description</th><th>Category</th><th>Prep Time</th><th>Cook Time</th></tr>";
        while ($stmt->fetch()) {
            echo "<tr><td>$col1</td><td width=800>$col2</td><td>$col3</td><td>$col4</td><td>$col5</td>";} 
        echo "</table></div>";
    } else if ($name != null) {
        $query = "SELECT ProjectName,ProjectDescription,Course,ProjectYear,Archive,Client.ClientName,Student.FirstName,Student.LastName FROM Project JOIN ProjectAndClient ON Project.ProjectID = ProjectAndClient.ProjectID JOIN Client ON ProjectAndClient.ClientID = Client.ClientID JOIN ProjectAndStudent ON Project.ProjectID = ProjectAndStudent.ProjectID JOIN Student ON ProjectAndStudent.StudentID = Student.StudentID WHERE ProjectName LIKE %$name%";
        //ADD KEYWORDS
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
        $query = $query . " AND Student.FirstName LIKE %$name% OR Student.LastName LIKE %$name%";
    }
    echo $query;
        ?>
</body>
</html>