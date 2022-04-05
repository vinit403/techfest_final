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

            <div class="container">
            <?php
              require "database_connection.php";
              $sql = "SELECT * FROM `user`";
              $result = mysqli_query($connect, $sql);

              $rows = mysqli_num_rows($result);

              echo '<h3> Total Users : '.$rows.' </h3><br>';

              $sql = "SELECT * FROM `package_purchased`";
              $result = mysqli_query($connect, $sql);
              $sql = "SELECT * FROM `package_purchased_on_cash`";
              $result2 = mysqli_query($connect, $sql);

              $row_package = mysqli_num_rows($result);
              $row_package2 = mysqli_num_rows($result2);

              $row_package = $row_package + $row_package2;

              echo '<h3>Total Selling Of Packages ...</h3><p> package : '.$row_package.'</p>';

              $sql = "SELECT * FROM `premium_package_purchased`";
              $result = mysqli_query($connect, $sql);
              $sql = "SELECT * FROM `premium_package_purchased_on_cash`";
              $result2 = mysqli_query($connect, $sql);

              $row_premium_package = mysqli_num_rows($result);
              $row_premium_package2 = mysqli_num_rows($result2);

              $row_premium_package = $row_premium_package + $row_premium_package2;

              echo '<p> premium package : '.$row_premium_package.'</p>';


              $sql = "SELECT * FROM `workshop_purchased`";
              $result = mysqli_query($connect, $sql);
              $sql = "SELECT * FROM `workshop_purchased_on_cash`";
              $result2 = mysqli_query($connect, $sql);

              $row_ws = mysqli_num_rows($result);
              $row_ws2 = mysqli_num_rows($result2);

              $row_ws = $row_ws + $row_ws2;

              echo '<br><h3>Total Workshop Selling </h3> <p>workshops : '.$row_ws.'</p>';

              $sql = "SELECT * FROM `event_purchased`";
              $result = mysqli_query($connect, $sql);

              $sql2 = "SELECT * FROM `event_purchased_on_cash`";
              $result2 = mysqli_query($connect, $sql2);

              $row_eve = mysqli_num_rows($result);
              $row_eve2 = mysqli_num_rows($result2);

              $row_eve = $row_eve + $row_eve2;
              echo '<br><h3>Total Selling Of Add on events ...</h3><p> events : '.$row_eve.'</p>';

              echo '<br><h3>Number Of Students In Events</h3>';

              $sql = "SELECT * FROM `events`";
              $result = mysqli_query($connect, $sql);

              while($r = mysqli_fetch_assoc($result))
              {
                $event = $r['event_name'];
                $eve = $event.'_register';

                $sql2 = "SELECT * FROM `$eve`";
                $result2 = mysqli_query($connect, $sql2);

                $row = mysqli_num_rows($result2);

                echo '<p>'.$event.' : '.$row.'</p>';
              }


              echo '<br><h3>Number Of Students In Workshops</h3>';
              $sql = "SELECT * FROM `workshop`";
              $result = mysqli_query($connect, $sql);

              while($r = mysqli_fetch_assoc($result))
              {
                $event = $r['workshop_name'];
                $eve = $event.'_register';

                $sql2 = "SELECT * FROM `$eve`";
                $result2 = mysqli_query($connect, $sql2);

                $row = mysqli_num_rows($result2);

                echo '<p>'.$event.' : '.$row.'</p>';
              }

              echo '<br><h3>Cash Collected By Promotion Teams.</h3>';

              $sql = "SELECT * FROM `promotion_team_code`";
              $result = mysqli_query($connect, $sql);

              while($i = mysqli_fetch_assoc($result))
              {
                $team_code = $i['team_code'];

                $sql2 = "SELECT * FROM `event_purchased_on_cash` WHERE promotion_team_code='$team_code'";
                $result2 = mysqli_query($connect, $sql2);

                $row_event = mysqli_num_rows($result2);
                $amount_event = $row_event*149;

                $sql3 = "SELECT * FROM `package_purchased_on_cash` WHERE promotion_team_code='$team_code'";
                $result3 = mysqli_query($connect, $sql3);

                $row_package = mysqli_num_rows($result3);
                $amount_package = $row_package*399;

                $sql4 = "SELECT * FROM `premium_package_purchased_on_cash` WHERE promotion_team_code='$team_code'";
                $result4 = mysqli_query($connect, $sql4);

                $row_premium = mysqli_num_rows($result4);
                $amount_premium = $row_premium*899;

                $sql5 = "SELECT * FROM `workshop_purchased_on_cash` WHERE promotion_team_code='$team_code'";
                $result5 = mysqli_query($connect, $sql5);

                $row_workshop = mysqli_num_rows($result5);
                $amount_workshop = $row_workshop*499;

                echo '<br><h4>'.$team_code.'</h4>';
                echo '<p>add on events : '.$amount_event.'</p>';
                echo '<p>package : '.$amount_package.'</p>';
                echo '<p>premium package : '.$amount_premium.'</p>';
                echo '<p>workshop : '.$amount_workshop.'</p>';

                $total = $amount_event+$amount_package+$amount_premium+$amount_workshop;

                echo '<h5>Total : '.$total.'</h5>';

              }
              echo '<br><h3>Accomodation information</h3>';

                $sql = "SELECT * FROM `accomodation_person2_1day`";
                $result = mysqli_query($connect, $sql);

                $rows = mysqli_num_rows($result);

                echo '2 persons in a room for 1 day : '.$rows.'<br>';

                $sql = "SELECT * FROM `accomodation_person2_2days`";
                $result = mysqli_query($connect, $sql);

                $rows = mysqli_num_rows($result);

                echo '2 persons in a room for 2 days : '.$rows.'<br>';

                $sql = "SELECT * FROM `accomodation_person4_1day`";
                $result = mysqli_query($connect, $sql);

                $rows = mysqli_num_rows($result);

                echo '4 persons in a room for 1 day : '.$rows.'<br>';

                $sql = "SELECT * FROM `accomodation_person4_2days`";
                $result = mysqli_query($connect, $sql);

                $rows = mysqli_num_rows($result);

                echo '4 persons in a room for 2 days : '.$rows.'<br><br>';


            ?>
                          
            </div>
              <!--- iuisdiadbc8 --->
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