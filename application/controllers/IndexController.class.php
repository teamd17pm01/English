<?php

// application/controllers/admin/IndexController.class.php


class IndexController extends BaseController{

    public function mainAction(){

        include CURR_VIEW_PATH . "main.html";

    }

    public function indexAction(){

        // $userModel = new UserModel("user");

        // $users = $userModel->getUsers();

        // Load View template
        // echo CURR_VIEW_PATH . "index.php";
        $data = array(
            'name' => 'Hưng',
            'age' => 22
        );
        $this->Render('index',$data);
    }

    public function menuAction(){

        include CURR_VIEW_PATH . "menu.html";

    }

    public function dragAction(){

        include CURR_VIEW_PATH . "drag.html";

    }

    public function topAction(){

        include CURR_VIEW_PATH . "top.html";

    }

}