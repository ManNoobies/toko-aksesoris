<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-md-3 text-center  ">
                <h1 class="mb-3">Login</h1>
                <?php if(isset($error)):?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endif;?>
                <?=validation_errors()?>
                <?=form_open(base_url('index.php/home/login'))?>
                <!-- source: https://getbootstrap.com/docs/4.0/components/forms/ -->
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Type your email addresses" required name="email" value="<?=set_value('email')?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Type your email password" required name="password" value="<?=set_value('password')?>">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Enter</button>
                <?=form_close()?>
                <!-- -->
                <div class="row">
                    <div class="col-12">
                        <a class="btn btn-info mt-4" href="<?=base_url('index.php/home/register')?>">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
