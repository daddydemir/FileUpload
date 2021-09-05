<?php
error_reporting(0);
ini_set('display_errors', 0);

$id = $_GET['id'];

if($id == null){
    $id = 0;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top:30px;">
        <div class="row d-flex flex-wrap" >
            <div class="col-sm-4 bg-dark text-white" style="background:gray;">
                <h2>NOTE TITLES</h2>
                <p>Your notes appear here .</p>

                <div class="overflow-auto" style="height:270px;">
                    <ul class="nav nav-pills flex-column">
                        <?php
                        $servername = "127.0.0.1";
                        $username = "root";
                        $password = "";
                        $db = "notes";
                        $mysqli = new mysqli($servername, $username, $password, $db);

                        if ($mysqli->connect_errno) {
                            echo "DB connection error . ";
                        }
                        $sql = "select * from note";
                        $result = $mysqli->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="?id=<?= $row['id'] ?>"> <?= $row['title'] ?> </a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <hr class="d-sm-none">
            </div>
            <div class="col-sm-8 bg-warning text-dark overflow-auto" style="background-color:lightblue; height:400px;">
                <h5 style="text-align: center;">
                    <?php
                    $q = "select * from note where id=$id";
                    $baslik = $mysqli->query($q);
                    $title = $baslik->fetch_assoc();
                    echo $title['title'];
                    ?>
                </h5>
                <hr>
                <p> <?= $title['content'] ?> </p>
                <br>
                <hr>
                <a href="<?= $title['path']  ?>" target="_blank"> File </a>
                <hr>
                <form action="delete.php?id=<?= $title['id'] ?>" method="GET">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-12 bg-secondary text-white">
                <h2> ADD NOTE </h2>
                <form action="update.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"> Title </span>
                            </div>
                            <input type="text" class="form-control" name="baslik">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Content</span>
                            <textarea class="form-control" aria-label="With textarea" name="icerik"></textarea>
                        </div>
                    </div>
                    <br />
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile02" name="dosya">
                    </div>
                    <button type="submit" class="btn btn-primary form-control">Upload</button>
                    <p></p>
                </form>
            </div>
        </div>
    </div>
    <div class="right"></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</html>
