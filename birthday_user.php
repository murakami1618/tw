<?php
    $users = ["@ramennさんが誕生日です","@suguruさんが誕生日です","@shadovaさんが誕生日です","@gatennさんが誕生日です"];

    foreach($users as $user){
?>

    <html>
        
        <head>
                <link href="css/bootstrap.min.css" rel="stylesheet">
                <meta charset="utf-8">
                <title>birthday</title>
        </head>


            <?php
               echo "<div class='row'>";
                echo "<div class='col-4'>";
                 echo "<div class='m-3'>";
                   echo "<div class='card text-senter'>";
                    echo "<div class='card-body'>";
                       echo "<h5 class='card-title text-center'>$user</h5>";
                    echo "</div>";
                   echo "</div>";
                echo "</div>";
              echo  "</div>";
            echo "</div>";
             
            ?>

    </html>

<?php
    }

?>