<?php require("helper/db.php"); ?>
<?php
function getSongs($connection) {
    $sql = "SELECT * FROM songs ";
                if (isset($_GET["search"])) {
                $search = mysqli_real_escape_string($connection, $_GET["search"]);
                $sql .= "WHERE title LIKE '%$search%' ";
            }            
                // $sql .= "ORDER BY id DESC;";
                $result = mysqli_query($connection, $sql);
                return mysqli_fetch_all($result, MYSQLI_ASSOC);

}

$searchTitle = "";
$searchValue = "";
if (isset($_GET["search"])) {
    $searchTitle = "ค้นหา \"$_GET[search]\" | ";
    $searchValue = $_GET["search"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $searchTitle;?>ลิสต์เพลงเปิดหมวก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="helper/css/style.css">
</head>
<body class="bg-dark">
    <br>
    <div class="container text-white">
        <div class="text-center content" style="margin-bottom: 30px;">
            <h1 class="h1list">ลิสต์เพลงเปิดหมวก</h1>
        </div>
        <div class="text-end my-3">
            <?php $rows = getSongs($connection); ?>
            <form class="form-inline">
                <div class="input-group">
                    <input type="search" class="form-control small-input content" name="search" value="<?php echo $searchValue; ?>" placeholder="ค้นหา..." style="background-color: #cfcfcf;">
                    <div class="input-group-append">
                        <button class="btn search-dark" style="border-radius: 0px 5px 5px 0px;" type="submit"><i class="bi bi-search"></i></button>
                        <a class="btn x-dark" href="index_dark.php"><i class="bi bi-x-lg"></i></a>
                        <a href="add_dark.php" class="btn add-dark"><i class="bi bi-plus-square"></i></a>
                        <a href="./" class="btn sun-dark"><i class="bi bi-brightness-high"></i></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="row content justify-content-center">
            <?php $rows = getSongs($connection); ?>
            <?php foreach ($rows as $row): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="text-center my-3 song-card">
                    <div>
                        <h3 class="mb-3 song-title"><?php echo $row["title"] ?></h3>
                        <p class="song-artist"><?php echo $row["band"] ?></p>
                        <p class="song-details"><?php echo $row["bpm"] ?> BPM <?php echo $row["time"];?></p>
                        <div>
                            <a href="<?php echo $row["link"]?>" class="btn" target="_blank" style="width: 84px; background-color: rgb(87, 93, 177); color: #fff;">คอร์ด</a>
                            <a href="lyrics_dark.php?id=<?php echo $row["id"]; ?>" class="btn" style="background-color: rgb(178, 111, 198); color: #fff;">เนื้อเพลง</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>