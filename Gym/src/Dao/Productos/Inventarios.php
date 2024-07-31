<?php

namespace Dao\Productos;

class Inventarios extends \Dao\Table{
    
    public static function createInvetarios(
        $nombre,
        $descripcion,
        $categoria,
        $cantidad,
        $precio,
        $imagen,
        $estado
    ){
        $InsSql="INSERT INTO productos (NombreProducto, descripcion, Categoria, cantidad, precio, imagen, estado)
        values (:nombre, :descripcion, :categoria, :cantidad, :precio, :imagen, :estado);";

        $insParams=[
            'NombreProducto'=>$nombre,
            'descripcion'=>$descripcion,
            'Categoria'=>$categoria,
            'cantidad'=>$cantidad,
            'precio'=>$precio,
            'imagen'=>$imagen,
            'estado'=>$estado
        ];

        return self::executeNonQuery($InsSql,$insParams);
    }

    public static function updateProductos(
        $nombre,
        $descripcion,
        $categoria,
        $cantidad,
        $precio,
        $imagen,
        $estado
    )
    {
        $UpdSql="UPDATE productos set NombreProducto= :NombreProducto, descripcion= :descripcion, 
        Categoria= :categoria, cantidad= :cantidad, precio= :precio, imagen= :imagen estado= :estado
        WHERE id= :id;";

        $UpdParams=[
            'NombreProducto'=>$nombre,
            'descripcion'=>$descripcion,
            'Categoria'=>$categoria,
            'cantidad'=>$cantidad,
            'precio'=>$precio,
            'imagen'=>$imagen,
            'estado'=>$estado
        ];

        return self::executeNonQuery($UpdSql,$UpdParams);
    }

    public static function deleteProductos($id){
        $DelSql="DELETE from productos WHERE id= :id;";
        $DelParams=['id'=>$id];
        return self::executeNonQuery($DelSql,$DelParams);
    }

    public static function readAllProductos()
    {
        $sqlstr="SELECT * from productos;";
        return self::obtenerRegistros($sqlstr,array());
    }

    public static function readProductos($id){
        $sqlstr="SELECT * from productos WHERE id=:id;";
        $params=array('id'=>$id);
        return self::obtenerUnRegistro($sqlstr,$params);
    }
    
}