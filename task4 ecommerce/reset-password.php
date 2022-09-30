<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;
use App\Mail\ForgetPasswordCodeMail;

$title = "Forget Password";

include "layouts/header.php";
include "App/Http/Middlewares/Guest.php";

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST){
  $validation = new Validation;
  $validation->setValue($_POST['password'])->setValueName('password')
  ->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/',"Minimum 8 and maximum 32 characters, at least one uppercase letter, one lowercase letter, one number and one special character")->confirmed($_POST['password_confirmation']);
  $validation->setValue($_POST['password_confirmation'])->setValueName('password confirmation')
  ->required();
  if(empty($validation->getErrors())){
    // no validation error
    $user = new User;
    $user->setPassword($_POST['password'])
    ->setEmail($_SESSION['verification_email']);
    if($user->updatePassword()){
      unset($_SESSION['verification_email']);
      header('location:login.php');die; 
    }else{
        $error = "<div class='alert alert-danger'> Something went wrong </div>";
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
              <h4><?= $title ?></h4>
            </a>
           
          </div>
          <div class="tab-content">
            <div id="lg1" class="tab-pane active">
              <div class="login-form-container">
                <div class="login-register-form">
                  <?= $error ?? "" ?>
                  <?= $success ?? "" ?>
                  <form method="post">
                    <input type="password" name="password" placeholder="Password" />
                    <?= isset($validation) ? $validation->getMessage('password') : '' ?>
                    <input type="password" name="password_confirmation" placeholder="Password Confirmation" />
                    <?= isset($validation) ? $validation->getMessage('password confirmation') : '' ?>

                    <div class="button-box">
                      <button type="submit"><span>Change</span></button>
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
 include "layouts/scripts.php";
 ?>