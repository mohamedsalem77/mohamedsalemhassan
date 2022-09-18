<?php

if($_SERVER['REQUEST_METHOD']=='POST' && $_POST)
{
    // print_r($_POST);
    $sum=$_POST['physics']+$_POST['chemistry']+$_POST['biology']+$_POST['mathematics']+$_POST['computer'];
    $percentage=($sum/500)*100;
    if($percentage>=90)
    {
        $grade='A';
    }
    elseif($percentage>=80)
    {
        $grade='B';
    }
    elseif($percentage>=70)
    {
        $grade='C';
    }
    elseif($percentage>=60)
    {
        $grade='D';
    }
    elseif($percentage>=40)
    {
        $grade='E';
    }
    else
    {
        $grade='F';
    }
    $percentage .="%";
}


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Grade</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <div class="container-fluid col-4 border border-primary my-4 rounded">
        <div class="row">
            <div class="col-12 text-center text-primary mt-5 mb-4">
                <h1>Calculate The Grade</h1>
            </div>
            <div class="col-10 offset-1">
                <form method="POST">
                    <div class="form-group">
                        <label for="physics">Physics:</label>
                        <input type="number" name="physics" id="physics" class="form-control"
                            value=<?= $_POST['physics']?? "" ?>>
                        <label for="chemistry" class="mt-3">Chemistry:</label>
                        <input type="number" name="chemistry" id="chemistry" class="form-control"
                            value=<?= $_POST['chemistry']?? "" ?>>
                        <label for="biology" class="mt-3">Biology:</label>
                        <input type="number" name="biology" id="biology" class="form-control"
                            value=<?= $_POST['biology']?? "" ?>>
                        <label for="mathematics" class="mt-3">Mathematics:</label>
                        <input type="number" name="mathematics" id="mathematics" class="form-control"
                            value=<?= $_POST['mathematics']?? "" ?>>
                        <label for="computer" class="mt-3">Computer:</label>
                        <input type="number" name="computer" id="computer" class="form-control"
                            value=<?= $_POST['computer']?? "" ?>>
                        
                        <button type="submit" value="calculate" name="calculate" id="calculate"
                            class="d-block btn btn-primary form-control col-3 mx-auto my-4">calculate</button>
                        <h3 class="text-primary mt-2">Total Percentage is: <?= $percentage ?? ""; ?></h2>
                        <h3 class="text-primary mt-2">Grade is: <?= $grade ?? ""; ?></h2>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>