<?php

namespace Controllers\Landing;

use Controllers\PublicController;
use Dao\Productos\Preentrenos;
use Views\Renderer;

class PreEntreno extends PublicController{
    public function run():void
    {
        $viewData=array();
        $viewData["productos"]=Preentrenos::getPreentrenos();

        Renderer::render('Productos/preentreno',$viewData);
    }
}
