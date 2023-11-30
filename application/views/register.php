<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-md-3 text-center  ">
                <h1 class="mb-3">Register</h1>
                <?php if(isset($success) && $success):?>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success">
                                Registration complete<br>
                                <a href="<?=base_url()?>">Home</a>
                            </div>
                        </div>
                    </div>
                <?php else:?>
                    <?=validation_errors()?>
                    <?=form_open(base_url('index.php/home/register'))?>
                    <!-- source: https://getbootstrap.com/docs/4.0/components/forms/ -->
                        <div class="form-group">
                            <input type="text" class="form-control" required
                                name="first_name" value="<?=set_value('first_name')?>" placeholder="Enter your first name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" required
                                name="last_name" value="<?=set_value('last_name')?>" placeholder="Enter your last name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" required
                                name="email" value="<?=set_value('email')?>" placeholder="Enter your email adresses">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" required
                                name="password" value="<?=set_value('password')?>" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" required 
                                name="passconf" value="<?=set_value('passconf')?>" placeholder="Confirm your password">
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Register</button>
                    <?=form_close()?>
                    <!-- -->
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-info mt-4" href="<?=base_url('index.php/home/login')?>">Back to Login</a>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
