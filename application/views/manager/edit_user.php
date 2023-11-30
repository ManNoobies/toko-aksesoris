<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="container">
        <div class="row">
            <div class="col-6">
            <h1>Edit user</h1>
            <?=isset($error) ?  $error : ''?>
            <?=validation_errors()?>
            <?=form_open_multipart(base_url('index.php/manager/edit_user/' . $user->id))?>
            <!-- source: https://getbootstrap.com/docs/4.0/components/forms/ -->
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" class="form-control" id="first_name" 
                        name="first_name" value="<?=set_value('first_name', $user->first_name)?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" class="form-control" id="last_name" 
                        name="last_name" value="<?=set_value('last_name', $user->last_name)?>">
                </div>
                <div class="form-group">
                    <label for="level">Level</label>
                    <input type="number" min="0" step="1" class="form-control" id="level" 
                        name="level" value="<?=set_value('level', $user->level)?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" 
                        name="email" value="<?=set_value('email', $user->email)?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" 
                        name="password" value="<?=set_value('password', $user->password)?>">
                </div>
                <!-- source: https://getbootstrap.com/docs/4.0/components/forms/ -->
                <button type="submit" class="btn btn-success">Save</button>
            <?=form_close()?>
            <!-- -->
            </div>
        </div>
    </div>
