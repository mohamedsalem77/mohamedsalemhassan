<?php 
session_start();

$users=[
  [
    'id'=>1,
    'name'=>'mohamed',
    'email'=>'mohamed@gmail.com',
    'password'=>123456,
    'gender'=>'m',
    'image'=>'1.jpg'
  ],
  [
    'id'=>2,
    'name'=>'ahmed',
    'email'=>'ahmed@gmail.com',
    'password'=>123456,
    'gender'=>'m',
    'image'=>'2.jpg'
  ],
  [
    'id'=>3,
    'name'=>'aya',
    'email'=>'aya@gmail.com',
    'password'=>123456,
    'gender'=>'f',
    'image'=>'3.jpg'
  ]
  ];

if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $errors=[];
    if(empty($_POST['email'])){
      $errors['email']="<div class='font-weight-bold text-danger'>email is required</div>";
    }
    if(empty($_POST['password'])){
      $errors['password']="<div class='font-weight-bold text-danger'>password is required</div>";
      
    }
    // print_r($errors);die;
    if(empty($errors))
    {
      $authenticated=false;
      //login
      foreach($users AS $user)
      {
        if($user['email']==$_POST['email']&&$user['password']==$_POST['password'])
        {
          $authenticated=true;
          $_SESSION['user']=$user;
          header('location:profile.php');die;
        }
      }
      if($authenticated==false)
      {
      $errors['email']="<div class='font-weight-bold text-danger'>Wrong email or Password</div>";

      }
    }
  }

?>

<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12 h1 text-center text-dark mt-5">
        Login
      </div>
      <div class="col-4 offset-4 my-5">
        <form method="post">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId" >
            <?= $errors['email'] ?? "" ?>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder=""
              aria-describedby="helpId" >
              <?= $errors['password'] ?? "" ?>
            </div>

          <div class="form-group">
            <button class="btn btn-outline-dark btn-sm">
              Login
            </button>
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