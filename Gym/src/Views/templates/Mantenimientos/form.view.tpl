<section>
    <h2>{{modeDsc}}</h2>
</section>
<section>
    <form action="index.php?page=Mantenimientos-Inventario&mode{{mode}}&id{{id}}" method="POST">
        <input type="hidden" name="id" value="{{id}}">
        <input type="hidden" name="xsrftk" value="{{xsrftk}}">
        <input type="hidden" name="mode" value="{{mode}}">

        <div>
            <label for="prdc">Codigo</label>
            <input type="text" name="Codigo" id="prdc" value="{{id}}" readonly>
        </div>

        <div>
            <label for="prdnom">Nombre Producto</label>
            <input type="text" name="NombreProducto" id="prdnom" value="{{NombreProducto}}" required>
        </div>

        <div>
            <label for="prddsc">Descripcion</label>
            <input type="text" name="descripcion" id="prddsc" value="{{descripcion}}"required>
        </div>

        <div>
            <label for="prdcategoria">Categoria</label>
            <select name="Categoria" id="prdcategoria">
                <option value="Creatina"{{Creatina}} >Creatina</option>
                <option value="Proteina"{{Proteina}} >Proteina</option>
                <option value="Preentreno"{{Preentreno}} >Preentreno</option>
                <option value="Aminoacidos"{{Aminoacidos}} >Aminoacidos</option>
            </select>
        </div> 

       <!-- <div>
            <label for="prdCat">Categoria</label>
            <input type="text" name="Categoria" id="prdCat" value="{{Categoria}}"required>
        </div>    -->


         <div>
            <label for="prdcant">CANTIDAD</label>
            <input type="text" name="cantidad" id="prdcant" value="{{cantidad}}"required>
        </div>    

         <div>
            <label for="prdprc">Precio</label>
            <input type="number" name="precio" id="prdprc" value="{{precio}}"required>
        </div>

         <div>
            <label for="prdimg">Imagen</label>
            <input type="text" name="Imagen" id="prdimg" value="{{imagen}}">
        </div>

        <div>
            <label for="prdest">Estado</label>
            <select name="Estado" id="prdest">
                <option value="1"{{prd1}} >1</option>
                <option value="0"{{prd0}} >0</option>
            </select>
        </div>

        <div>
            <button type="submit">Guardar</button>
            <button type="button" onclick="window.location='index.php?page=Mantenimientos-MantenimientoInventario'">Cancelar</button>
        </div>

        

    </form>
</section>