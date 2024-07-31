<section class="container-l WWlist">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE PRODUCTO</th>
                <th>IMAGEN</th>
                <th>DESCRIPCION</th>
                <th>CATEGORIA</th>
                <th>CANTIDAD</th>
                <th>PRECIO</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
                <th><a href="index.php?page=Mantenimientos-Inventario&mode=INS">NUEVO PRODUCTO</a></th>
            </tr>    
        </thead> 
        <tbody>
            {{foreach productos}}

                <tr>
                    <td> {{id}} </td>
                    <td><a href="index.php?page=Mantenimientos-Inventario&mode=DSP&id={{id}}"> {{NombreProducto}} </a></td>
                    <td> <img style="width: 100px; height: 100px;" src="{{imagen}}"/></td>
                    <td> {{descripcion}} </td>
                    <td> {{Categoria}} </td>
                    <td> {{cantidad}} </td>
                    <td> {{precio}} </td>
                    <td> {{estado}} </td>
                    <td> 
                        <a href="index.php?page=Mantenimientos-Inventario&mode=UPD&id={{id}}">EDITAR / </a>
                        <a href="index.php?page=Mantenimientos-Inventario&mode=DEL&id={{id}}"> ELIMINAR</a>
                    </td>
                </tr>

            {{endfor productos}}
        </tbody>      
        <tfoot>
            <tr>
                <td colspan="6">Total de registros:{{total}} </td>
            </tr>
        </tfoot>
    </table>    
</section>    