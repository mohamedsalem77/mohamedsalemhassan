<?php

if($_SERVER['REQUEST_METHOD']=="POST" && $_POST)
{
    // print_r($_POST);
    if(!$_POST['loanyears']||!$_POST['loanamount'])
    {
        die;
    }
    if($_POST['loanyears']<=3)
    {
        $interestrate=0.1*$_POST['loanamount'];
        $interestrate*=$_POST['loanyears'];
    }
    else
    {
        $interestrate=0.15*$_POST['loanamount'];
        $interestrate*=$_POST['loanyears'];
    }
    $totalloan=$_POST['loanamount']+$interestrate;
    $no_of_months=$_POST['loanyears']*12;
    $monthly=$totalloan/$no_of_months;

    $bank=[
        'Username'=>$_POST['username'],
        'Interest Rate'=>$interestrate,
        'Loan after Interest Rate'=>$totalloan,
        'Monthly'=>$monthly,
    ];

    if($bank){
    
        $table =    "<table class='table table-striped table-hover'>
                        <thead class='table-primary'>
                            <tr>";
                                foreach($bank AS $key=>$value){
                                    $table .= "<th scope='col' class='text-center align-middle'>{$key}</th>";
                                }
        $table .=           "</tr>
                        </thead>
                        <tbody><tr>";
                            foreach($bank AS $key=>$value){
                                $table.="<td class='text-center align-middle'>{$value}</td>";
                            }
        $table .=       "</tr></tbody>
                    </table>";}
                    else
                    {
                        $table=null;
                    }
        
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Bank</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid col-6 border border-primary my-4 rounded">
        <div class="row">
            <div class="col-12 text-center text-primary mt-5 mb-4">
                <h1>Bank</h1>
            </div>
            <div class="col-10 offset-1">
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value=<?= $_POST['username']?? "" ?>>
                        <label for="loanamount" class="mt-3">Loan Amount:</label>
                        <input type="number" name="loanamount" id="loanamount" class="form-control"
                            value=<?= $_POST['loanamount']?? "" ?>>
                        <label for="loanyears" class="mt-3">Loan Years:</label>
                        <input type="number" name="loanyears" id="loanyears" class="form-control"
                            value=<?= $_POST['loanyears']?? "" ?>>

                        <button type="submit" value="Calculate" name="calculate" id="calculate"
                            class="d-block btn btn-primary form-control col-4 mx-auto my-4">Calculate</button>
                    </div>
                </form>
                <?= $table??"" ?>
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