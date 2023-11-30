<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Users</h1>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Level</th>
                    <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($items as $item):?>
                        <tr>
                        <th scope="row"><?=$item->id?></th>
                        <td><?=$item->email?></td>
                        <td><?=$item->first_name?> <?=$item->last_name?></td>
                        <td><?=$item->level?></td>
                        <td>
                            <a class="btn btn-danger delete" href="<?=base_url('index.php/manager/delete_user/' . $item->id)?>">
                                <span class="oi oi-trash"></span></a>
                            <a class="btn btn-primary" href="<?=base_url('index.php/manager/edit_user/' . $item->id)?>">
                                <span class="oi oi-pencil"></span></a>
                        </td>
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