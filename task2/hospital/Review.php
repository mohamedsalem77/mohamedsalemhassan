<?php
session_start();

if($_SERVER['REQUEST_METHOD']=='POST' && $_POST)
{
    $result=$_POST['q1']+$_POST['q2']+$_POST['q3']+$_POST['q4']+$_POST['q5'];
    if($result<25)
    {
        $msg="We will call you later on this phone : {$_SESSION['phone']}";
    }
    else
    {
        $msg="Thank You";
    }
    $_SESSION['msg']=$msg;

    function calcReview($review):string
    {
        if($review=='0')
            return "Bad";
        elseif($review=='3')
            return "Good";
        elseif($review=='5')
            return "Very Good";
        elseif($review=='10')
            return "Excellent";
    }

    if($result>=40)
        $_SESSION['totalReview']="Excellent";
    elseif($result>=35)
        $_SESSION['totalReview']="Very Good";
    elseif($result>=25)
        $_SESSION['totalReview']="Good";
    else
        $_SESSION['totalReview']="Bad";

    $_SESSION['q1']=calcReview($_POST['q1']);
    $_SESSION['q2']=calcReview($_POST['q2']);
    $_SESSION['q3']=calcReview($_POST['q3']);
    $_SESSION['q4']=calcReview($_POST['q4']);
    $_SESSION['q5']=calcReview($_POST['q5']);

    // print_r($_POST);
    print_r($_SESSION);

    header('location:Result.php');
    die;
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Review</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid col-10 border border-primary my-4 rounded">
        <div class="row">
            <div class="col-12 text-center text-primary mt-5 mb-4">
                <h1>Review</h1>
            </div>

            <div class="col-10 offset-1">
                <form method="POST">
                    <table class="table table-striped">
                        <thead class='table-dark'>
                            <tr>
                                <th scope="col">Question</th>
                                <th class='text-center align-middle' scope="col">Bad</th>
                                <th class='text-center align-middle' scope="col">Good</th>
                                <th class='text-center align-middle' scope="col">Very Good</th>
                                <th class='text-center align-middle' scope="col">Excellent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Are you satisfied with the level of cleanliness?</th>
                                <td class='text-center align-middle'><input type='radio' name='q1' id='q1_bad' value='0'></td>
                                <td class='text-center align-middle'><input type='radio' name='q1' id='q1_good' value='3'></td>
                                <td class='text-center align-middle'><input type='radio' name='q1' id='q1_verygood' value='5'></td>
                                <td class='text-center align-middle'><input type='radio' name='q1' id='q1_excellent' value='10'></td>
                            </tr>
                            <tr>
                                <th scope="row">Are you satisfied with the service prices?</th>
                                <td class='text-center align-middle'><input type='radio' name='q2' id='q2_bad' value='0'></td>
                                <td class='text-center align-middle'><input type='radio' name='q2' id='q2_good' value='3'></td>
                                <td class='text-center align-middle'><input type='radio' name='q2' id='q2_verygood' value='5'></td>
                                <td class='text-center align-middle'><input type='radio' name='q2' id='q2_excellent' value='10'></td>
                            </tr>
                            <tr>
                                <th scope="row">Are you satisfied with the nursing service?</th>
                                <td class='text-center align-middle'><input type='radio' name='q3' id='q3_bad' value='0'></td>
                                <td class='text-center align-middle'><input type='radio' name='q3' id='q3_good' value='3'></td>
                                <td class='text-center align-middle'><input type='radio' name='q3' id='q3_verygood' value='5'></td>
                                <td class='text-center align-middle'><input type='radio' name='q3' id='q3_excellent' value='10'></td>
                            </tr>
                            <tr>
                                <th scope="row">Are you satisfied with the level of the doctor?</th>
                                <td class='text-center align-middle'><input type='radio' name='q4' id='q4_bad' value='0'></td>
                                <td class='text-center align-middle'><input type='radio' name='q4' id='q4_good' value='3'></td>
                                <td class='text-center align-middle'><input type='radio' name='q4' id='q4_verygood' value='5'></td>
                                <td class='text-center align-middle'><input type='radio' name='q4' id='q4_excellent' value='10'></td>
                            </tr>
                            <tr>
                                <th scope="row">Are you satisfied with the calmness in the hospital?</th>
                                <td class='text-center align-middle'><input type='radio' name='q5' id='q5_bad' value='0'></td>
                                <td class='text-center align-middle'><input type='radio' name='q5' id='q5_good' value='3'></td>
                                <td class='text-center align-middle'><input type='radio' name='q5' id='q5_verygood' value='5'></td>
                                <td class='text-center align-middle'><input type='radio' name='q5' id='q5_excellent' value='10'></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" value="Result" name="result" id="result"
                            class="d-block btn btn-primary form-control col-12 mx-auto my-4">Result</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>