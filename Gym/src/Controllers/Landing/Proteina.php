<?php

namespace Controllers\Landing;

use Controllers\PublicController;
use Dao\Productos\Proteinas;
use Views\Renderer;

class Proteina extends PublicController{
    public function run():void
    {
        $viewData=array();
        $viewData["productos"]=Proteinas::getProteinas();

        Renderer::render('Productos/proteina',$viewData);
    }
}
