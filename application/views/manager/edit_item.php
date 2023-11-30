<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="container">
        <div class="row">
            <div class="col-6">
            <h1>Edit item</h1> 
            <?=isset($error) ?  $error : ''?>
            <?=validation_errors()?>
            <?=form_open_multipart(base_url('index.php/manager/edit_item/' . $item->id))?>
            <!-- source: https://getbootstrap.com/docs/4.0/components/forms/ -->
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" 
                        name="title" value="<?=set_value('title', $item->title)?>">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" min="0" step="0.01" id="price" 
                        name="price" value="<?=set_value('price', $item->price)?>">
                </div>
                <!-- source: https://getbootstrap.com/docs/4.0/components/forms/ -->
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>
                <div class="row">
                    <div class="col-12">
                        <img src="<?=base_url('uploads/' . $item->image)?>" class="img-thumbnail"/>
                    </div>
                </div>   
                <!-- -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" 
                        name="description"><?=set_value('description',$item->description)?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            <?=form_close()?>
            <!-- -->
            </div>
        </div>
    </div>
