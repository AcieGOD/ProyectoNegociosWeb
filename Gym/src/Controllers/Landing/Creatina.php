<?php

namespace Controllers\Landing;

use Controllers\PublicController;
use Dao\Productos\Creatinas;
use Views\Renderer;

class Creatina extends PublicController{
    public function run():void
    {
        $viewData=array();
        $viewData["productos"]=Creatinas::getCreatinas();

        Renderer::render('Productos/creatina',$viewData);
    }
}