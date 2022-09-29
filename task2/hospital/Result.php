<?php

    session_start();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Result</title>
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
                <h1>Result</h1>
            </div>

            <div class="col-10 offset-1">
                <form method="POST">
                    <table class="table table-striped">
                        <thead class='table-dark'>
                            <tr>
                                <th scope="col">Question</th>
                                <th class='text-center align-middle' scope="col">Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Are you satisfied with the level of cleanliness?</th>
                                <td class='text-center align-middle'><?= $_SESSION['q1'] ?? "" ?></td>

                            </tr>
                            <tr>
                                <th scope="row">Are you satisfied with the service prices?</th>
                                <td class='text-center align-middle'><?= $_SESSION['q2'] ?? "" ?></td>

                            </tr>
                            <tr>
                                <th scope="row">Are you satisfied with the nursing service?</th>
                                <td class='text-center align-middle'><?= $_SESSION['q3'] ?? "" ?></td>

                            </tr>
                            <tr>
                                <th scope="row">Are you satisfied with the level of the doctor?</th>
                                <td class='text-center align-middle'><?= $_SESSION['q4'] ?? "" ?></td>

                            </tr>
                            <tr>
                                <th scope="row">Are you satisfied with the calmness in the hospital?</th>
                                <td class='text-center align-middle'><?= $_SESSION['q5'] ?? "" ?></td>

                            </tr>
                            <tr>
                                <th class="table-dark" scope="row">Total Review</th>
                                <td class='table-dark text-center align-middle'><?= $_SESSION['totalReview']?? "" ?>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <p
                        class="bg-primary rounded text-center p-3 my-4 text-light font-weight-bold border border-primary text-sm">
                        <?= $_SESSION['msg'] ?? "" ?>
                    </p>
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