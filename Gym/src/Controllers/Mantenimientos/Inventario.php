<?php
namespace Controllers\Mantenimientos;

use \DAO\Productos\Inventarios as DAOInventarios;
use \Utilities\Validators as Validators; 
use \Utilities\Site as Site;

class Inventario extends \Controllers\PublicController
{
    private $mode="NAN";
    private $modeDscArr=[
        "INS"=>"Nuevo Producto",
        "UPD"=>"Actualizando Producto %s",
        "DSP"=>"Detalle de %s",
        "DEL"=>"Eliminando %s",
    ];
    private $modeDsc="";

    private $id=0;
    private $NombreProducto="";
    private $Descripcion="";
    private $Categoria="";
    private $Cantidad=0;
    private $Precio=0;
    private $imagen="";
    private $estado=1;

    private $error=array();
    private $xsrftk="";

   public function run(): void
    {
        $this->obtenerDatosDelGet();
        $this->getDatosFromDB();
        if ($this->isPostBack()) {
            $this->obtenerDatosDePost();
            if (count($this->errors) === 0) {
                $this->procesarAccion();
            }
        }
        $this->showView();
    }

    public function obtenerDatosDelGet()
    {
        if(isset($_GET["mode"])){
            $this->mode = $_GET["mode"];
        }

        if(!isset($this->modeDscArr[$this->mode])){
           throw new \Exception("MODO NO VALIDO");
        }

        if(isset($_GET["id"])){
            $this->id =intval($_GET["id"]);
        }

        if($this->mode !="INS" && $this->id<=0){
            throw new \Exception("ID NO VALIDO");
        }
    }

    public function getDatosFromDB()
    {
        if($this->id >0){
            $inventario=DAOInventarios::readProductos($this->id);
            if(!$inventario){
                throw new \Exception("PRODUCTO NO ENCONTRADO");
            }
            $this->NombreProducto =$inventario["NombreProducto"];
            $this->Descripcion =$inventario["descripcion"];
            $this->Categoria= $inventario["Categoria"];
            $this->Cantidad =$inventario["cantidad"];
            $this->Precio= $inventario["precio"];
            $this->imagen =$inventario["imagen"];
            $this->Estado= $inventario["estado"];
        }
    }

    private function obtenerDatosDePost()
    {
        $tmpNombreProducto=$_POST["NombreProducto"]??"";
        $tmpDescripcion=$_POST["descripcion"]??"";
        $tmpCategoria=$_POST["Categoria"]??"";
        $tmpCantidad=$_POST["cantidad"]??"";
        $tmpPrecio=$_POST["precio"]??"";
        $tmpImagen=$_POST["imagen"]??"";
        $tmpXsrfTk["xsrftk"]??"";
        $tmpEstado=$_POST["Estado"]??"";
        $tmpMode=$_POST["mode"]??"";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }

        if(Validators::IsEmpty($tmpNombreProducto)){
            $this->addError("name", "El nombre no puede estar vacio", "error");
        }
        $this->NombreProducto=$tmpNombreProducto;

        if(Validators::IsEmpty($tmpDescripcion)){
            $this->addError("name", "El nombre no puede estar vacio", "error");
        }
        $this->Descripcion=$tmpDescripcion;

        if(Validators::IsEmpty($tmpCategoria)){
            $this->addError("name", "El nombre no puede estar vacio", "error");
        }
        $this->Categoria=$tmpCategoria;

        if(Validators::IsEmpty($tmpCantidad)){
            $this->addError("name", "El nombre no puede estar vacio", "error");
        } elseif(!Validators::IsInteger($tmpCantidad)){
            $this->addError("name", "El nombre no puede estar vacio", "error");
        }
        $this->Cantidad=$tmpCantidad;

        if(Validators::IsEmpty($tmpPrecio)){
            $this->addError("name", "El nombre no puede estar vacio", "error");
        } elseif(!Validators::IsCurrency($tmpPrecio)){
            $this->addError("name", "El nombre no puede estar vacio", "error");
        }
        $this->Precio=$tmpPrecio;

        if(Validators::IsEmpty($estado)){
            $this->addError("name", "El nombre no puede estar vacio", "error");
        } elseif(!in_array($tmpEstado,["1","0"])){
            $this->addError("name", "El nombre no puede estar vacio", "error");
        }
        $this->estado=$tmpEstado;

        if(Validators::IsEmpty($tmpMode)|| !in_array($tmpMode,["INS","UPD","DEL"])){
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }
    }

    private function procesarAccion(){
        switch($this->mode){
            case "INS":
                $insResult=DAOInventarios::CreateInventarios(
                    $this->NombreProducto,
                    $this->Descripcion,
                    $this->Categoria,
                    $this->Cantidad,
                    $this->Precio,
                    $this->imagen,
                    $this->estado
                );
                $this->validateDBOperation(
                    "Producto insertado correctamente",
                    "Ocurrio un error al insertar el producto",
                    $insResult
                );
            break;

            case "UPD";
            $updResult=DAOInventarios::UpdateProductos(
                $this->NombreProducto,
                $this->Descripcion,
                $this->Categoria,
                $this->Cantidad,
                $this->Precio,
                $this->imagen,
                $this->estado
            );
                $this->validateDBOperation(
                    "Producto actualizado correctamente",
                    "Ocurrio un error al actualizar el producto",
                    $updResult
                );
            break;
            case "DEL";
            $delResult=DAOInventarios::DeleteProductos(
                $this->id
            );
            $this->validateDBOperation(
                "Producto eliminado correctamente",
                "Ocurrio un error al eliminar el producto",
                $delResult
            );
            break;
        }
    }

    private function validateDBOperation($msg, $error, $result)
    {
        if (!$result) {
            $this->errors["error_general"] = $error;
        } else {
            Site::redirectToWithMsg(
                "index.php?page=Mantenimientos-MantenimientoInventario",
                $msg
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=Mantenimiento-MantenimientoInventario",
            $msg
        );
    }

    private function addError($key, $msg, $context = "general")
    {
        if (!isset($this->errors[$context . "_" . $key])) {
            $this->errors[$context . "_" . $key] = [];
        }
        $this->errors[$context . "_" . $key][] = $msg;
    }

    private function generateXSRFToken()
    {
        $this->xsrftk = md5(uniqid(rand(), true));
        $_SESSION[$this->name . "_xsrftk"] = $this->xsrftk;
    }
    private function getXSRFToken()
    {
        if (isset($_SESSION[$this->name . "_xsrftk"])) {
            $this->xsrftk = $_SESSION[$this->name . "_xsrftk"];
        }
    }

    private function compareXSRFToken($postXSFR)
    {
        return $postXSFR === $this->xsrftk;
    }




    private function showView(){
        $this->generateXSRFToken();
        $viewData=array();
        $viewData["mode"]=$this->mode;
        $viewData["modeDsc"]=sprintf($this->modeDscArr[$this->mode],$this->NombreProducto);
        $viewData["id"]=$this->id;
        $viewData["NombreProducto"]=$this->NombreProducto;
        $viewData["descripcion"]=$this->Descripcion;
        $viewData["Categoria"]=$this->Categoria;
        $viewData["cantidad"]=$this->Cantidad;
        $viewData["precio"]=$this->Precio;
        $viewData["imagen"]=$this->imagen;
        $viewData["estado"]=$this->estado;
        $viewData["xsrftk"] = $this->xsrftk;
        $viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode == "DSP";
       // $viewData["prdcategoria".$this->Categoria]="selected";
        $viewData["prdest".$this->estado]="selected";
        \Views\Renderer::render("Mantenimientos/form",$viewData);
    }
}


