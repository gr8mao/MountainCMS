<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 23:48
 */

return array(
    'options' => 'optionManage/index',

    'users/delete/id([0-9]+)' => 'userManage/deleteUser/$1',
    'users/edit/id([0-9]+)' => 'userManage/editUser/$1',
    'users/addnew' => 'userManage/addNew',
    'users/page-([0-9]+)' => 'userManage/index/$1',
    'users' => 'userManage/index/$1',
    '' => 'index/index'
);