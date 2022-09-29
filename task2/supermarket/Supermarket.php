<?php

if($_SERVER['REQUEST_METHOD']=="POST" && $_POST)
{
    print_r($_POST);
    $city=$_POST['city'];
    if($city=='Cairo')
        $delivery=0;
    elseif($city=='Giza')
        $delivery=30;
    elseif($city=='Alex')
        $delivery=50;
    elseif($city=='Other')
        $delivery=100;

    $total=0;
    $table =    "<table class='table table-striped '>
                        <thead class='table-primary'>
                            <tr>
                                <th scope='col' class='text-center align-middle'>Product Name</th>
                                <th scope='col' class='text-center align-middle'>Price</th>
                                <th scope='col' class='text-center align-middle'>Quantity</th>
                            </tr>
                        </thead> <tbody>";
                        for($i=0;$i<$_POST['no_of_products'];$i++)
                        {
                            $table .= "<tr>
                            <td class='text-center align-middle'><input type='text' value='"; 
                            $table .=($_POST["productName{$i}"]) ??'';
                             
                            $table .=" 'name='productName{$i}' id='productName{$i}' class='form-control'></td>
                            <td class='text-center align-middle'><input type='number' value='";
                            $table .=$_POST["price{$i}"] ??'';
                            $table .="'name='price{$i}' id='price{$i}' class='form-control'></td>
                            <td class='text-center align-middle'><input type='number'value='";
                            $table .=$_POST["quantity{$i}"] ??'';
                            $table .="'name='quantity{$i}' id='quantity{$i}' class='form-control'></td>
                            </tr>";
                        }
                        $table.="</tbody> </table>";
                        $table .="<button type='submit' value='Receipt' name='receipt' id='receipt'
                        class='d-block btn btn-primary form-control col-12 mx-auto my-4'>Receipt</button>";
    
    // for($i=0;$i<$_POST['no_of_products'];$i++)
    // {
    //     $subtotal["$i"]=$_POST["price{$i}"]*$_POST["quantity{$i}"];
    //     $total+=$subtotal["$i"];
    // }
    
    $receiptTable="<table class='table table-striped '>
                        <thead class='table-primary'>
                        <tr>
                            <th scope='col' class='text-center align-middle'>Product Name</th>
                            <th scope='col' class='text-center align-middle'>Price</th>
                            <th scope='col' class='text-center align-middle'>Quantity</th>
                            <th scope='col' class='text-center align-middle'>Sub Total</th>
                        </tr>
                        </thead> <tbody>";
                        for($i=0;$i<$_POST['no_of_products'];$i++)
                        {
                            $receiptTable .= "<tr>
                            <td class='text-center align-middle'>";
                            $receiptTable .= $_POST["productName{$i}"] ?? '';
                            $receiptTable .= "</td>";
                            $receiptTable .= "<td class='text-center align-middle'>";
                            $receiptTable .=$_POST["price{$i}"] ?? ''; 
                            $receiptTable .="</td>";
                            $receiptTable .="<td class='text-center align-middle'>";
                            $receiptTable .= $_POST["quantity{$i}"] ?? '';
                            $receiptTable .="</td>";
                            $receiptTable .="<td class='text-center align-middle'>";
                            
                            if(!empty($_POST["price{$i}"])&&!empty($_POST["quantity{$i}"])){
                                $receiptTable .=$_POST["price{$i}"]*$_POST["quantity{$i}"];
                                $total+=($_POST["price{$i}"]*$_POST["quantity{$i}"]);
                            }
                            
                            $receiptTable .= "</td></tr>";
                            
                        }
                        
                        $receiptTable.="</tbody> </table>";
                        if($total<1000)
                            $discount=0;
                        elseif($total<3000)
                            $discount=0.1*$total;
                        elseif($total<4500)
                            $discount=0.15*$total;
                        else
                            $discount=0.2*$total;

                        $afterDiscount=$total-$discount;
                        $netTotal=$afterDiscount+$delivery;
                        $receiptTable .="<table class='table table-bordered table-hover'>
                            <tbody >
                                <tr>
                                    <th class='table-active'>Client Name</th>
                                    <td>{$_POST['clientname']}</td>
                                </tr><tr>
                                    <th class='table-active'>City</th>
                                    <td>{$_POST['city']}</td>
                                </tr><tr>
                                    <th class='table-active'>Total</th>
                                    <td>{$total}</td>
                                </tr><tr>
                                    <th class='table-active'>Discount</th>
                                    <td>{$discount}</td>
                                </tr><tr>
                                    <th class='table-active'>Total after Discount</th>
                                    <td>{$afterDiscount}</td>
                                </tr><tr>
                                    <th class='table-active'>Delivery</th>
                                    <td>{$delivery}</td>
                                </tr><tr>
                                    <th class='table-active'>Net Total</th>
                                    <td>{$netTotal}</td>
                                </tr></tbody></table>";
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Supermarket</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid col-7 border border-primary my-4 rounded">
        <div class="row">
            <div class="col-12 text-center text-primary mt-5 mb-4">
                <h1>Supermarket</h1>
            </div>

            <div class="col-10 offset-1">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="clientname">Client Name:</label>
                        <input type="text" name="clientname" id="clientname" class="mb-3 form-control"
                            value=<?= $_POST['clientname']?? "" ?>>

                        <select name="city" class="mt-3 w-100 p-2 border rounded form-select form-select-lg mb-3"
                            aria-label=".form-select-lg example">
                            <option selected><?= $city ?? 'Select Your City' ?></option>
                            <option value="Cairo">Cairo</option>
                            <option value="Giza">Giza</option>
                            <option value="Alex">Alex</option>
                            <option value="Other">Other</option>
                        </select>

                        <label for="no_of_products" class="mt-1">Number Of Products:</label>
                        <input type="number" name="no_of_products" id="no_of_products" class="form-control"
                            value=<?= $_POST['no_of_products']?? "" ?>>

                        <button type="submit" value="Enter Products" name="enterProducts" id="enterProducts"
                            class="d-block btn btn-primary form-control col-12 mx-auto my-4">Enter Products</button>
                        <?= $table??"" ?>
                        <?php
                                if(!empty($_POST['receipt']))
                                    echo $receiptTable;
                                else
                                echo ""; ?>

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