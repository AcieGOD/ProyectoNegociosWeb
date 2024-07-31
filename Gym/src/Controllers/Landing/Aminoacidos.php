<?php

namespace Controllers\Landing;

use Controllers\PublicController;
use Dao\Productos\Aminoacido;
use Views\Renderer;

class Aminoacidos extends PublicController{
    public function run():void
    {
        $viewData=array();
        $viewData["productos"]=Aminoacido::getAminoacido();

        Renderer::render('Productos/aminoacido',$viewData);
    }
}
