<?php require("helper/db.php"); ?>
<?php 
function createSong($connection) {
    $time = isset($_POST['time']) ? $_POST['time'] : '';
    $time = mysqli_real_escape_string($connection, $time);
    $title = mysqli_real_escape_string($connection, $_POST["title"]);
    $band = mysqli_real_escape_string($connection, $_POST["band"]);
    $bpm = mysqli_real_escape_string($connection, $_POST["bpm"]);
    $lyrics = mysqli_real_escape_string($connection, $_POST["lyrics"]);
    $link = mysqli_real_escape_string($connection, $_POST["link"]);
    $sql = "INSERT INTO songs (title, band, bpm, lyrics, link, time) VALUES ('$title', '$band', '$bpm', '$lyrics', '$link', '$time');";
    return mysqli_query($connection, $sql); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>เพิ่มเพลงใหม่ | ลิสต์เพลงเปิดหมวก</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="helper/css/style.css">
</head>
<body>
<div class="container">
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php $result = createSong($connection) ?>
        <?php if ($result): ?>
            <div class="text-center" style="font-family: 'IBM Plex Sans Thai', sans-serif; margin-top: 300px;">
                <h3>เพิ่มเพลงเรียบร้อย</h3>
                <p>
                    <a href="./" class="btn btn2">กลับหน้าแรก</a>
                </p>
            </div>
        <?php else: ?>
            <h3>เพิ่มเพลงไม่ได้</h3>
            <p>
                <a href="add.php">ลองใหม่</a>
            </p>
        <?php endif; ?>
        <?php else: ?>
            <div class="text-center content" style="margin-top: 30px;">
                <h1 class="h1list">เพิ่มเพลง</h1>
            </div>
            <form method="post">
            <div class="for-input" style="font-family: 'IBM Plex Sans Thai', sans-serif;">
            <p class="mb-3 form">
                <label class="form-label">ชื่อเพลง</label>
                <input class="form-control" type="text" name="title" required>
            </p>
            <p class="mb-3 form">
                <label class="form-label">ชื่อศิลปิน</label>
                <input class="form-control" type="text" name="band" required>
            </p>
            <p class="mb-3 form">
                <label class="form-label">ความเร็วเพลง</label>
                <input class="form-control" type="number" name="bpm" required>
            </p>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input form-add-input" id="exampleCheck1" name="time" value="6/8">
                <label class="form-check-label from-add-label">6/8</label>
            </div>
            <p class="mb-3 form">
                <label class="form-label">เนื้อเพลง</label>
                <textarea class="form-control" style="height: 150px;" name="lyrics" required placeholder="ดูเนื้อเพลงจาก siamzone.com จะเว้นให้เอง"></textarea>
            </p>
            <p class="mb-3 form">
                <label class="form-label">คอร์ด</label>
                <input class="form-control" type="url" name="link" required>
            </p>
            </div>
            <div>
                <button class="btn btn3" type="submit"><i class="bi bi-check-lg"></i></button>
                <button class="btn btn4" type="reset"><i class="bi bi-trash"></i></button>
                <a class="btn btn5" href="./"><i class="bi bi-x"></i></a>
            </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>