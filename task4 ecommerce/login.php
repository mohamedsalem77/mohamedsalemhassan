<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;

$title = "Login";

 include "layouts/header.php";
 include "App/Http/Middlewares/Guest.php";
 include "layouts/navbar.php";
 include "layouts/breadcrumb.php";
 $validation = new Validation;

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST){
    $validation->setValue($_POST['email'])->setValueName('email')->required()
    ->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/',"wrong email or password")
    ->exists('users','email');
    $validation->setValue($_POST['password'])->setValueName('password')
    ->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/',"wrong email or password");
    if(empty($validation->getErrors())){
      $user = new User;
      $databaseResult = $user->setEmail($_POST['email'])->get();
      if($databaseResult->num_rows == 1){
        $databaseUser = $databaseResult->fetch_object();
        if(password_verify($_POST['password'],$databaseUser->password)){
            if(is_null($databaseUser->email_verified_at)){
              $_SESSION['verication_email'] = $_POST['email'];
              header('location:verification-code.php');die;
            }else{
              if(isset($_POST['remember_me'])){
                setcookie('remember_me',$_POST['email'],time() + 86400 * 365,'/');
              }
              $_SESSION['user'] = $databaseUser;
              header('location:index.php');die;
            }
        }else{
          $error = "<p class='text-danger font-weight-bold'>wrong email or password</p>";
        }
      }else{
        $error = "<p class='text-danger font-weight-bold'>wrong email or password</p>";
      }
    }
}
 ?>
<div class="login-register-area ptb-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-12 ml-auto mr-auto">
        <div class="login-register-wrapper">
          <div class="login-register-tab-list nav">
            <a class="active" data-toggle="tab" href="#lg1">
              <h4>login</h4>
            </a>
           
          </div>
          <div class="tab-content">
            <div id="lg1" class="tab-pane active">
              <div class="login-form-container">
                <div class="login-register-form">
                  <?=  $error ?? "" ?>
                  <form action="#" method="post">
                    <input type="email" name="email" placeholder="Email Address" />
                    <input type="password" name="password" placeholder="Password" />
                    <?= $validation->getMessage('email') ?>
                    <?= $validation->getMessage('password') ?>
                    <div class="button-box">
                      <div class="login-toggle-btn">
                        <input name="remember_me" type="checkbox" />
                        <label>Remember me</label>
                        <a href="forget-password.php">Forgot Password?</a>
                      </div>
                      <button type="submit"><span>Login</span></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <?php 
 include "layouts/footer.php";
 include "layouts/scripts.php";
 ?>