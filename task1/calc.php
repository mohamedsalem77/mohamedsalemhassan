<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST) {
    
    // print_r($_POST);
    if ($_POST['operator'] == '+') {
        $_POST['result']  = $_POST['number1'] + $_POST['number2'] ;
        $result = $_POST['result'];
    } elseif ($_POST['operator'] == '-') {
        $_POST['result'] = $_POST['number1']  - $_POST['number2'];
        $result = $_POST['result'];
    } elseif ($_POST['operator'] == '*') {
        $_POST['result'] = $_POST['number1']  * $_POST['number2'];
        $result = $_POST['result'];
    } else {
        $_POST['result'] = $_POST['number1'] / $_POST['number2'] ;
        $result = $_POST['result'];
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>calculator</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid col-4 border border-danger mt-4">
        <div class="row">

            <div class="col-12 text-center text-danger my-5">
                <h1>Calculator</h1>
            </div>
            <div class="col-10 offset-1">
                <form method="post">
                    <div class="form-group">
                        <label for="number1">Number 1:</label>
                        <input type="number" name="number1" id="number1" class="form-control"
                            value=<?= $_POST['number1']?? "" ?> placeholder="">
                        <label for="number2">Number 2:</label>
                        <input type="number" name="number2" id="number2" class="form-control"
                            value=<?= $_POST['number2']?? "" ?> placeholder="">
                        <h2 class="text-danger mt-2">Result: <?= $result ?? "?"; ?></h2>
                        <div class="row justify-content-center">
                            <button type="submit" value="+" name="operator" id="operator"
                                class="btn btn-outline-danger form-control m-2 col-2 my-3"> + </button>
                            <button value="-" name="operator" id="operator"
                                class="btn btn-outline-danger form-control m-2 col-2 my-3"> - </button>
                            <button value="*" name="operator" id="operator"
                                class="btn btn-outline-danger form-control m-2 col-2 my-3"> * </button>
                            <button value="/" name="operator" id="operator"
                                class="btn btn-outline-danger form-control m-2 col-2 my-3"> / </button>
                        </div>
                    </div>
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