<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <div class="py-5 text-center">
        <h2>Checkout</h2>
    </div>

    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Billing address</h4>
            <?=form_open()?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstname">First name</label>
                        <input type="text" class="form-control" id="firstname" required
                            name="firstname" value="<?=set_value('firstname', $user['first_name'])?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastname">Last name</label>
                        <input type="text" class="form-control" id="lastname" required
                            name="lastname" value="<?=set_value('lastname', $user['last_name'])?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" required
                            name="address" value="<?=set_value('address')?>" placeholder="123 Main Str">
                </div>

                <div class="mb-3">
                    <label for="address_e">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address_e" 
                        name="address_e" value="<?=set_value('address_e')?>" placeholder="Apartement or suite ">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select name="country" id="country" class="custom-select d-block w-100">
                            <option value="">Choose a country...</option>
                            <?php foreach($country as $con):?>
                                <option value="<?=$con['code']?>"><?=$con['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" required value="<?=set_value('state')?>" name="state" id="state">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" required value="<?=set_value('zip')?>" name="zip" id="zip">
                    </div>
                </div>
                
                <hr class="mb-4">

                <h4 class="mb-3">Payment</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="cash" name="paymentmethod" class="custom-control-input" required>
                        <label class="custom-control-label" for="cash">Cash on delivery</label>
                    </div>
                </div>
                <hr class="mb-4">

                <button class="btn btn-primary btn-lg btn-block" type="submit">Confirm</button>
            <?=form_close()?>
        </div>
    </div>
</div>