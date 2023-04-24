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
    $client=$_REQUEST["client"];
    $name=$_REQUEST["PName"];
    $year=$_REQUEST["year"];
    $course=$_REQUEST["course"];
    $student=$_REQUEST["sname"];
    // need checkbox request as well
    $conn = new mysqli("localhost", "root", "", "recipedatabase");
    //rework conn with data from actual DB
    if ($recipevar == 'All') {
        $stmt = $conn->prepare("SELECT * FROM Recipe");
        $stmt->execute();
        $stmt->bind_result($col1,$col2,$col3,$col4,$col5,$col6);
        echo "<div id=divid><table id=result><tr><th>Recipe Name</th><th>Recipe Description</th><th>Category</th><th>Prep Time</th><th>Cook Time</th><th>RecipeID</th></tr>";
        while ($stmt->fetch()) {
            echo "<tr><td>$col1</td><td width=800>$col2</td><td>$col3</td><td>$col4</td><td>$col5</td><td>$col6</td>";} 
        echo "</table></div>";
    } else if ($recipevar != null) {
        $stmt = $conn->prepare("SELECT * FROM Recipe WHERE RecipeName=?");
        $stmt->bind_param("s",$recipevar);
        $stmt->execute();
        $stmt->bind_result($col1,$col2,$col3,$col4,$col5,$col6);
        $sql = "SELECT i.IngredientName FROM Ingredients i
        JOIN RecipeIngredient ri on ri.IngredientID = i.IngredientID
        JOIN Recipe r on r.RecipeID = ri.RecipeID
        WHERE r.RecipeName = '$recipevar'";
        $conn1 = new mysqli("localhost", "root", "", "recipedatabase");
        $result = $conn1->query($sql);

        echo "<div id=divid><table id=result><tr><th>Recipe Name</th><th>Recipe Description</th><th>Category</th><th>Prep Time</th><th>Cook Time</th><th>RecipeID</th></tr>";
        while ($stmt->fetch()) {
            echo "<tr><td>$col1</td><td>$col2</td><td>$col3</td><td>$col4</td><td>$col5</td><td>$col6</td></tr>";
            echo "<div id=ingdiv><tr><td>Ingredients: </td><td>";
            while ($row = $result->fetch_assoc()) {
                $data = $row['IngredientName'];
                echo " | ";
                echo $data;
            }} 
        
        echo " |";
        echo "</td></div>";
        $stmt->close();
        echo "</table></div>";
        /?>
</body>
</html>
