<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
    header("location:admin_login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Admin</title>
  </head>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $heading = $_POST['heading'];
        $info = $_POST['info'];

        $heading = str_replace("<","&lt;","$heading");
        $heading = str_replace(">", "&gt;", "$heading");
        $info = str_replace("<","&lt;","$info");
        $info = str_replace(">", "&gt;", "$info");

        include "database_connection.php";
        $sql = "INSERT INTO `news_feed`(`heading`, `message`, `date`) VALUES ('$heading','$info', CURRENT_TIMESTAMP())";
        $result = mysqli_query($connect, $sql);
        if($result)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>successfull...!!</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
    ?>

  <body>
          <ul class="nav nav-pills my-3">
            <li class="nav-item mx-3">
                <h3>
                    Admin 
                </h3>
            </li>
            <li class="nav-item mx-5">
                    <button type="submit" class="btn btn-primary" onclick="location.href='logout.php'">
                    log out
                    </button>
            </li>
            </ul>
      <div class="container my-5">
        <h2 class="my-3">
            Share New Update Or News
        </h2>
      </div>
    <div class="container" id="d">
        <form action="/adminAccess.php" method="post">
            <div class="mb-3">
                <label for="heading" class="form-label">Enter Heading</label>
                <input type="text" name="heading" class="form-control" id="heading" aria-describedby="emailHelp" maxlength="500" required>
            </div>
            <div class="mb-3">
                <label for="info" class="form-label">Enter news or update</label>
                <input type="text" name="info" class="form-control" id="info" maxlength="5000" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
 
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>