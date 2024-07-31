<?php

namespace Controllers\Landing;

use Controllers\PublicController;
use Dao\Productos\Usuarios;
use Views\Renderer;

class Usuario extends PublicController{
    public function run():void
    {
        $viewData=array();
        $viewData["usuarios"]=Usuarios::getUsuarios();

        Renderer::render('Productos/usuario',$viewData);
    }
}