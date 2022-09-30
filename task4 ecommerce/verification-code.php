<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;

$title = "Verification Code";

include "layouts/header.php";
include "App/Http/Middlewares/Guest.php";
define('FORGETPASSWORDPAGE',2);
define('REGISTERPAGE',1);

if(!($_GET && isset($_GET['redirect']) && is_numeric($_GET['redirect']) && ($_GET['redirect'] == FORGETPASSWORDPAGE || $_GET['redirect'] == REGISTERPAGE))){
  header('location:layouts/errors/404.php');die;
}

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST){
  $validation = new Validation;
  $validation->setValue($_POST['verification_code'])->setValueName('verification code')
  ->required()->digits(6);
  if(empty($validation->getErrors())){
    // no validation error
    $user = new User;
    $user->setVerification_code($_POST['verification_code'])
    ->setEmail($_SESSION['verification_email']);
    $result = $user->verifyCode();
      if($result == false){
        $error = "<div class='alert alert-danger'> Something went wrong </div>";
      }else{
        if($result->num_rows == 1){
          if($_GET['redirect'] == REGISTERPAGE){
            $user->setEmail_verified_at(date('Y-m-d H:i:s'));
            if($user->makeUserVerified()){
              unset($_SESSION['verification_email']);
              $success = "<div class='alert alert-success text-center'> Correct Code You Will be redirected to login page shotrly ... </div>";
              header('refresh:3;url=login.php');
            }else{
              $error = "<div class='alert alert-danger'> Something went wrong </div>";
            }
          }elseif($_GET['redirect'] == FORGETPASSWORDPAGE){
            header('location:reset-password.php');die;
          }
        }else{
          $error = "<div class='alert alert-danger'> Wrong Code </div>";
        }
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
                  <form action="#" method="post">
                    <input type="number" name="verification_code" placeholder="Verification Code" />
                    <?= isset($validation) ? $validation->getMessage('verification code') : '' ?>
                    <div class="button-box">
                      <button type="submit"><span>Verify</span></button>
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