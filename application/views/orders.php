<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $item):?>
                    <tr>
                        <th scope="row"><?=$item->id?></th>
                        <td><?=$item->created?></td>
                        <td><?=$item->price?></td>
                        <td><?=$item->status?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-12">
            <?=$pagination?>
        </div>
    </div>
</div>