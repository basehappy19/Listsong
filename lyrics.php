<?php require("helper/db.php"); ?>

<?php
function getLyrics($connection, $id) {
    $id = mysqli_real_escape_string($connection, $id); // ป้องกัน SQL injection
    $sql = "SELECT * FROM songs WHERE id = $id;";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        // Handle error, return an error message, or redirect to an error page.
        return false;
    }
}

// Check if 'id' parameter is set in the URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $data = getLyrics($connection, $id);
    if ($data) {
        $title = $data["title"];
        $lyrics = $data["lyrics"];
    } else {
        // Handle case when data is not found. You may redirect or display an error message.
        $title = "Lyrics not found";
        $lyrics = "Lyrics not found";
    }
} else {
    // Handle case when 'id' is not set. You may redirect or display an error message.
    $title = "Lyrics not found";
    $lyrics = "Lyrics not found";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="helper/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>เนื้อเพลง <?php echo htmlspecialchars($title); ?></title>
</head>
<body>
    <div class="container">
        <br>
        <div class="content">
            <h3 class="my-6">เนื้อเพลง <?php echo htmlspecialchars($title); ?></h3>
            <h6 class="lyrics" style="font-weight: 300; line-height: 30px;">
                <?php echo nl2br($lyrics); // Use nl2br to preserve line breaks in lyrics ?>
            </h6>
        </div>
        <div class="text-end" style="margin-top: 15px; margin-bottom: 15px;">
            <a href="./" class="btn" style="background-color: rgb(236, 166, 255);"><i class="bi bi-arrow-left" style="color: #000;"></i></a>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>
