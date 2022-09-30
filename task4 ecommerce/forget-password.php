<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;
use App\Mail\ForgetPasswordCodeMail;

$title = "Forget Password";

include "layouts/header.php";
include "App/Http/Middlewares/Guest.php";

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST){
  $validation = new Validation;
  $validation->setValue($_POST['email'])->setValueName('email')
  ->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')
  ->exists('users','email');
  if(empty($validation->getErrors())){
    // no validation error
    $forgetPasswordCode = rand(100000,999999);
    $user = new User;
    $user->setVerification_code($forgetPasswordCode)
    ->setEmail($_POST['email']);
    if($user->updateCode()){
      // send mail
      $body = "<p> Hello {$_POST['email']}.</p>
      <p> Your Forget Password Code:<b style='color:blue;'>{$forgetPasswordCode}</b></p>
      <p> Thank You</p>";
      $forgetPasswordMail = new ForgetPasswordCodeMail;
      if($forgetPasswordMail->send($_POST['email'],"Forget Password",$body)){
        $_SESSION['verification_email'] = $_POST['email'];
        header('location:verification-code.php?redirect=2');
      }else{
        $error = "<div class='alert alert-danger'> Please Try Agian </div>";
      }
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
                    <input type="email" name="email" placeholder="Email Address" />
                    <?= isset($validation) ? $validation->getMessage('email') : '' ?>
                    <div class="button-box">
                      <button type="submit"><span>Find My Account</span></button>
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