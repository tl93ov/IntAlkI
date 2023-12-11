<?php
session_start();

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// új rekord hozzáadása
if (isset($_POST['submit'])) {
    $data = $_POST['data'];
    $sql = "INSERT INTO records (nev) VALUES ('$data')";
    $conn->query($sql);
}

// létező rekord módosítása
if (isset($_POST['edit'])) {
    $editId = $_POST['editId'];
    $editedData = $_POST['editedData'];

    $updateSql = "UPDATE records SET nev='$editedData' WHERE id='$editId'";
    $conn->query($updateSql);
}

// minden rekord lekérése
$sql = "SELECT * FROM records ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
</head>
<body>
<h2>Üdv, <?php echo $_SESSION['user']; ?>!</h2>

<!-- új adat hozzáadása -->
<form method="post" action="">
    Új adat: <input type="text" name="data" required>
    <input type="submit" name="submit" value="Rögzít">
</form>

<h3>Rögzített rekordok:</h3>
<ul>
    <?php
    while($row = $result->fetch_assoc()) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Név</th><th>Actions</th></tr>";
        echo "<tr><td>{$row['id']}</td><td>{$row['nev']}</td>";
        echo "<td><form method='post' action=''>
                  <input type='hidden' name='editId' value='{$row['id']}'>
                  <input type='text' name='editedData' value='{$row['nev']}'>
                  <input type='submit' name='edit' value='Módosít'>
                  </form></td></tr>";
        echo "</table>";
    }
    ?>
</ul>
<a href="logout.php">Kilépés</a>
</body>
</html>
