<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 23:48
 */

return array(
    'templates/delete' => 'pageManage/deleteTemplate',
    'templates/add' => 'pageManage/addTemplate',
    'templates/edit/([a-zA-Z]+)' => 'pageManage/editTemplate/$1',
    'templates' => 'pageManage/viewTemplates/$1',
    'pages/delete/id([0-9]+)' => 'pageManage/deletePage/$1',
    'pages/edit/id([0-9]+)' => 'pageManage/editPage/$1',
    'pages/add' => 'pageManage/addNewPage',
    'pages/page-([0-9]+)' => 'pageManage/index/$1',
    'pages' => 'pageManage/index',

    'files/(scripts)' => 'optionManage/filesView/$1',
    'files/(styles)' => 'optionManage/filesView/$1',
    'files/images' => 'optionManage/galleryView/$1',
    'files/allImages' => 'optionManage/getAllImages/$1',
    'files/delete' => 'optionManage/deleteFile',
    'files/add/(styles)' => 'optionManage/addFile/$1',
    'files/add/(scripts)' => 'optionManage/addFile/$1',
    'files/edit/(scripts)/([a-zA-Z]+)' => 'optionManage/editFile/$1/$2',
    'files/edit/(styles)/([a-zA-Z]+)' => 'optionManage/editFile/$1/$2',
    'options' => 'optionManage/index',

    'users/delete/id([0-9]+)' => 'userManage/deleteUser/$1',
    'users/edit/id([0-9]+)' => 'userManage/editUser/$1',
    'users/addnew' => 'userManage/addNew',
    'users/page-([0-9]+)' => 'userManage/index/$1',
    'users' => 'userManage/index',

    'addcomment' => 'index/saveComment',
    'checkcomment' => 'index/checkComment',
    'getnewcomments' => 'index/getNewComments',
    '' => 'index/index'
);