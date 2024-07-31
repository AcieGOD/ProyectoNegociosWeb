<?php

namespace Controllers\Mantenimientos;
use \DAO\Productos\Inventarios as DAOInventario;

class MantenimientoInventario extends \Controllers\PublicController
{

    public function run(): void
    {
        $viewData=array();
        $viewData["productos"]=DAOInventario::readAllProductos();
        $viewData["total"]=count($viewData["productos"]);
        \Views\Renderer::render("Mantenimientos/listaProductos",$viewData);
    }

}
