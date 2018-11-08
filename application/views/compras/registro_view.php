<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
               <i class="fa fa-th-list"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="">Pages</a></li>
                    <li><?php echo $titulo; ?></li>
                    <li>                    
                        <select name="sucursal" id="sucursal" class="select-nosearch sucursal-head selserie">
                        <?php
                            foreach ($sucursales as $key => $value) {
                                echo '<option value="'.$value->idsucursal.'">'.$value->nombre.'</option>';
                            }
                         ?>                                    
                        </select> 
                    </li>                    
                </ul>
                <h4><?php echo $titulo; ?> 
                </h4>  
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->    
    <div class="contentpanel"> 
        <form id="comprasform">
        <?php echo form_hidden('token', $token) ?>        
        <!-- CONTENT GOES HERE -->    
           <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <input type="hidden" name="caddetalle" id="caddetalle">
                            <input type="hidden" name="idsucursal" id="idsucursal">

                            <input type="hidden" name="inpbaseimponible" id="inpbaseimponible">
                            <input type="hidden" name="inpigv" id="inpigv">
                            <input type="hidden" name="inppreciocompra" id="inppreciocompra">

                            <div class=" col-lg-5">
                                <div class="form-group">
                                    <label class="control-label">Proveedor <span id="rucproveedor" style="font-weight: bold;"></span></label>
                                    <div class="input-group mb15">
                                        <input type="hidden" class="form-control" name="idproveedor" id="idproveedor">
                                        <input type="text" class="form-control input-sm" name="proveedor" id="proveedor">
                                        <span class="input-group-btn ">
                                            <button type="button" class="btn btn-primary input-sm" data-toggle="modal" data-target=".bs-proveedores-modal-lg">...</button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="control-label">Fecha Compra</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" placeholder="" id="datepicker" name="fechaemision" value="<?php echo date("Y-m-d"); ?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div><!-- form-group -->
                            </div><!-- col-sm-6 -->  

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="control-label">Tipo Documento</label>
                                    <select name="tipocomprobante" id="tipocomprobante" class="form-control select-nosearch input-sm selserie" style="width: 100%">
                                        <?php
                                            foreach ($comprobantes as $key => $value) {
                                                echo '<option value="'.$value->idcomprobantes.'">'.$value->nombre.'</option>';
                                            }
                                         ?>  
                                    </select>
                                </div><!-- form-group -->
                            </div><!-- col-sm-6 -->

                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label class="control-label">Serie</label>
    								<input type="text" class="form-control input-sm" name="series" id="series">
                                </div><!-- form-group -->
                            </div><!-- col-sm-6 -->                         

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="control-label">Nro Documento</label>
    								<input type="text" class="form-control input-sm" name="nrocomprobante" id="nrocomprobante">
                                </div><!-- form-group -->
                            </div><!-- col-sm-6 -->                        

                    	</div>
                    	<div class="row">

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="control-label">Moneda</label>
                                    <select name="idmoneda" id="idmoneda" class="form-control select-nosearch input-sm" style="width: 100%">
                                        <?php
                                            foreach ($monedas as $key => $value) {
                                                echo '<option value="'.$value->idmoneda.'">'.$value->descripcion.'</option>';
                                            }
                                         ?>                    
                                    </select>
                                </div><!-- form-group -->
                            </div><!-- col-sm-6 -->  

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">A donde va la mercadería?</label>
                                    <select name="almacen" id="almacen" class="form-control select-nosearch input-sm selserie" style="width: 100%">
                                        <?php
                                            foreach ($almacenes as $key => $value) {
                                                echo '<option value="'.$value->idalmacen.'">'.$value->nombre.'</option>';
                                            }
                                         ?>  
                                    </select>
                                </div><!-- form-group -->
                            </div><!-- col-sm-6 -->                            

                    	</div>
                	</div>
            </div>

            <div class="panel panel-default comprobantes">
                <div class="panel-body">
                    <div class="row">
                          <table class="table table-striped table-dark" id="tblinvoice">
                                <thead>
                                  <tr>
                                    <th style="width: 5%">Item</th>
                                    <th style="display: none; width: 0%">IdProducto</th>
                                    <th style="width: 20%">Producto</th>
                                    <th style="width: 10%">U.M.</th>
                                    <th style="width: 10%; font-size: 10px;text-align: center;">Afec IGV / Inc. IGV</th>
                                    <th class="right" style="width: 10%">Cant.</th>
                                    <th class="right" style="width: 10%">P.U.</th>
                                    <th class="right" style="width: 10%">Base Imponible</th>
                                    <th class="right" style="width: 10%">Imp. IGV</th>
                                    <th class="right" style="width: 10%">Precio Compra</th>
                                    <th style="width: 5%"></th>
                                  </tr>
                                </thead>                        
                                <tbody id="tblinvoice-body">
                                </tbody>
                        </table>
                        <div>
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-productos-modal-lg"><span class="fa fa-plus"></span> Agregar Producto</a>
                        </div>
                    </div>
                </div>
            </div><!-- contentpanel -->

    		<div class="row">
                <div class="col-md-8">
                   <div class="panel panel-default comprobantes">
                        <div class="panel-body">            
                            <div class="form-group">
                                <label class="control-label">Observación</label>
                                <textarea class="form-control" rows="1" placeholder="Escriba aqúi alguna observación..."></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" id="generacomprobante">Generar Compra</button>
                </div>
                <div class="col-md-4">
                   <div class="panel panel-default comprobantes montos">
                        <div class="panel-body">              
                            <div class="form-group" style="display: none;">
                                <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Descuento Global</label>
                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                    <input type="text" class="form-control input-sm mount valor-total" id="inv-dcto-global" name="inv-dcto-global" placeholder="0.00" value="0">
                                </div>                        
                            </div><!-- form-group -->                        
                            <div class="form-group" style="display: none;">
                                <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Aumento</label>
                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                    <input type="text" class="form-control input-sm mount valor-total" name="inv-tot-otcargo" id="inv-tot-otcargo" placeholder="0.00" value="0">
                                </div>
                            </div><!-- form-group -->
                            <div class="form-group">
                                <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Base Imponible</label>
                                <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4 control-label mount valor-total" id="inv-tot-baseimp">0.00</span>
                            </div><!-- form-group -->  
                            <div class="form-group">
                                <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">IGV</label>
                                <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4 control-label mount valor-total" id="inv-tot-igv">0.00</span>
                            </div><!-- form-group -->  
                            <div class="form-group">
                                <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Precio Compra</label>
                                <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4 control-label mount valor-total" id="inv-tot-precompra">0.00</span>
                            </div><!-- form-group -->                     
                        </div>
                    </div>
                </div>                
            </div>
        </form>
    </div>        
</div>

<div class="modal fade bs-proveedores-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close btn-modal-ubg" type="button">&times;</button>
              <h4 class="modal-title">Proveedores</h4>
          </div>
          <div class="modal-body">
            <div>
                <table id="tproveedores"> </table> 
                <div id="pager-proveedores"></div>   
            </div>
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-modal-proveedores" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
            <button type="button" class="btn btn-success btn-sel-proveedores btn-modal-ubg"><i class="fa fa-check"></i>Aceptar</button>
          </div>         
     </div>
    </div>
</div>

<div class="modal fade bs-productos-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close btn-modal-ubg" type="button">&times;</button>
              <h4 class="modal-title">Productos</h4>
          </div>
          <div class="modal-body">
            <div>
                <table id="tproductos"> </table> 
                <div id="pager-productos"></div>   
            </div>
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-modal-productos" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
            <button type="button" class="btn btn-success btn-sel-productos btn-modal-ubg"><i class="fa fa-check"></i>Aceptar</button>
          </div>         
     </div>
    </div>
</div>

<script>
    var $grid = $("#tdatos"),
        newWidth = $grid.closest(".ui-jqgrid").parent().width();
    $.jgrid.defaults.width = newWidth;
    $.jgrid.defaults.responsive = true;
    $.jgrid.defaults.styleUI = 'Bootstrap';
</script>
<script type="text/javascript">
    $(function(){   
    	compras={
    		init:function()
    		{
    			compras.default();
    			compras.event();
    			compras.validate();
    		}
            ,default:function(){
                $('#datepicker').datepicker({
                    language: "es",
                    autoclose: true,
                    format: "yyyy-mm-dd",
                });

    			compras.getproveedor();
                compras.getproductos();
                $("#idsucursal").val($("#sucursal").val());
            }    		
    		,event:function()
    		{
                $('.bs-productos-modal-lg').on('shown.bs.modal', function (e) {
                  //alert("I want this to appear after the modal has opened!");
                    $("#tproductos").setGridWidth( $("#tproductos").closest(".ui-jqgrid").parent().width());
                });

                $('.bs-proveedores-modal-lg').on('shown.bs.modal', function (e) {
                  //alert("I want this to appear after the modal has opened!");
                    $("#tproveedores").setGridWidth( $("#tproveedores").closest(".ui-jqgrid").parent().width());
                });   

                $(".btn-sel-proveedores").click(function(event){
                    event.returnValue = false; /*para I.E.*/
                    if(event.preventDefault) event.preventDefault();

                    var selr = $("#tproveedores").jqGrid('getGridParam', 'selrow');
                    var rowData = $("#tproveedores").jqGrid('getRowData', selr)
                    $("#idproveedor").val(rowData.idproveedor);
                    $("#proveedor").val(rowData.razonsocial);
                    $("#rucproveedor").html(': ' + rowData.nrodocumento);

                    $('.bs-proveedores-modal-lg').modal('hide');
                }); 

                $(".btn-sel-productos").click(function(event){
                    event.returnValue = false; /*para I.E.*/
                    if(event.preventDefault) event.preventDefault();

                    var selr = $("#tproductos").jqGrid('getGridParam', 'selrow');
                    var rowData = $("#tproductos").jqGrid('getRowData', selr)
                    tabla.agregar(rowData);
                    $('.bs-productos-modal-lg').modal('hide');
                });

                $("#generacomprobante").click(function(event){
                    event.returnValue = false; /*para I.E.*/
                    if(event.preventDefault) event.preventDefault();

                    //Obteniendo Tipo de Documento
                    var result=compras.validaformulario()
                    if (result[0]>0)
                    {
                        bootbox.alert(result[1]);
                    }else{
                        bootbox.confirm({
                            title: "Compras",
                            message: "¿Esta seguro de genear esta compra?",
                            buttons: {
                                cancel: {
                                    label: '<i class="fa fa-times"></i> Cancelar'
                                },
                                confirm: {
                                    label: '<i class="fa fa-check"></i> Confirmar'
                                }
                            },
                            callback: function (result) {
                              if (result)
                                compras.setcompra($("#comprasform"));
                            }
                        });
                    }
                });                
    		}
            ,validaformulario:function()
            {
                //Validando Cliente   
                var  logmensaje="<div class='error-venta'>";            
                strL_proveedor=$("#idproveedor").val();
                intL_valida=0;
                if (strL_proveedor.length==0){
                    logmensaje=logmensaje + "<label class='error'>Debe de ingresar un Proveedor!" + "</label>";
                    intL_valida++;
                }

                strL_series=$("#series").val();
                intL_valida=0;
                if (strL_series.length==0){
                    logmensaje=logmensaje + "<label class='error'>Debe de ingresar una serie!" + "</label>";
                    intL_valida++;
                }

                strL_nrocomprobante=$("#nrocomprobante").val();
                intL_valida=0;
                if (strL_nrocomprobante.length==0){
                    logmensaje=logmensaje + "<label class='error'>Debe de ingresar un numero de comprobante!" + "</label>";
                    intL_valida++;
                }                    

                //Validando Detalle
                if (tabla.countrow('tblinvoice tbody')==0)
                {
                    logmensaje=logmensaje + "<label class='error'>No hay productos agregados!" + "</label>";
                    intL_valida++;
                }

                //Validando Tabla que tenga Valores
                if (tabla.validaimportestabla()>0)
                {
                    logmensaje=logmensaje + "<label class='error'>Revisar los Precio Unitario y Cantidades!" + "</label>";
                    intL_valida++;
                }


                logmensaje=logmensaje + '</div>'

                return [intL_valida,logmensaje];
            }               
    		,validate:function()
    		{
    		}
			,getproveedor:function(){
                var wurl="<?php echo base_url('proveedor/list'); ?>";
                $("#tproveedores").jqGrid({
                        url: wurl,
                        mtype: "get",
                        styleUI : 'Bootstrap',
                        responsive: true,
                        postData: {'token':$('input[name=token]').val()},
                        datatype: "json",
                        colModel: [
                            { label: 'Código', name: 'idproveedor', key: true, width: 75 },
                            { label: 'Codigo Empresa', name: 'idempresa', width: 100 },
                            { label: 'Codigo Tipo Documento', name: 'codtipodocumento', width: 150 },                            
                            { label: 'Tipo Doc.', name: 'tipodocumento', width: 80 },                            
                            { label: 'Razon Social', name: 'razonsocial', width: 200 },
                            { label: 'Nro Doc.', name: 'nrodocumento', width: 100 },
                            { label: 'Dirección', name: 'direccion', width: 250 },
                            { label: 'Codigo Ubigeo', name: 'ubigeo', width: 150 },
                            { label: 'Ubigeo', name: 'formato1', width: 250 },
                            { label: 'Teléfono', name: 'telefono', width: 100 },
                            { label: 'Celular', name: 'celular', width: 100 },
                            { label: 'E-mail', name: 'email', width: 200 },
                        ],
                        viewrecords: true,
                        height: 300,
                        rowNum: 100,
                        ShrinkToFit: false,
                        shrinkToFit: false,
                        rownumbers: true,
                        jsonReader: {
                          root: "rows",               
                          repeatitems: false
                        },                        
                        gridview: true,
                        gridComplete: function(){
                        },                        
                        sortname: 'idproveedor',
                        sortorder: 'desc',                        
                        pager: "#pager-proveedores"
                            }); 

              $("#tproveedores").jqGrid('navGrid','#pager-proveedores',
              {edit: false, add: false, del: false, search: false, refresh:true},
              {},
              {},
              {},
              {multipleSearch:true, multipleGroup:false, showQuery: true}
              );

              $("#tproveedores").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: true });
              $("#tproveedores").jqGrid('hideCol',['idempresa','ubigeo','codtipodocumento']); 
            }
            ,getproductos:function(){
                var wurl="<?php echo base_url('producto/list'); ?>";
                $("#tproductos").jqGrid({
                        url: wurl,
                        mtype: "get",
                        styleUI : 'Bootstrap',
                        responsive: true,
                        postData: {'token':$('input[name=token]').val()},
                        datatype: "json",
                        colModel: [
                            { label: 'Codigo', name: 'IdProducto', key: true, width: 75 },
                            { label: 'CodigoTipo', name: 'CodigoTipo', width: 100 },
                            { label: 'Tipo', name: 'Tipo', width: 100 },                            
                            { label: 'Descripción', name: 'Descripcion', width: 300 },
                            { label: 'UMD', name: 'unidadmedida', width: 80 },
                            { label: 'CodigoCategoria', name: 'IdCategoria', width: 200 },
                            { label: 'Categoria', name: 'Categoria', width: 200 },
                            { label: 'Cod. Referencia', name: 'CodigoReferencia', width: 150 },
                            { label: 'Imagen', name: 'Imagen', width: 150 },
                        ],
                        viewrecords: true,
                        height: 200,
                        rowNum: 100,
                        ShrinkToFit: false,
                        shrinkToFit: false,
                        rownumbers: true,
                        jsonReader: {
                          root: "rows",               
                          repeatitems: false
                        },                        
                        gridview: true,
                        gridComplete: function(){
                        },                        
                        sortname: 'IdProducto',
                        sortorder: 'desc',                        
                        pager: "#pager-productos"
                            }); 

              $("#tproductos").jqGrid('navGrid','#pager-productos',
              {edit: false, add: false, del: false, search: false, refresh:true},
              {},
              {},
              {},
              {multipleSearch:true, multipleGroup:false, showQuery: true}
              );

              $("#tproductos").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: true });
              $("#tproductos").jqGrid('setFrozenColumns');
              $("#tproductos").jqGrid('hideCol',['CodigoTipo','IdCategoria']);
            }
            ,setcompra(form)
             {
                var wurl="<?php echo base_url('compras/store'); ?>";
                $.ajax({
                    async: true,
                    url: wurl,
                    type: "post",
                    dataType: 'json',
                    contentType: 'application/x-www-form-urlencoded',
                    data:$(form).serialize()
                    , beforeSend: function(data){
                        waitingDialog.show('Procesando...', {dialogSize: 'sm'});
                    },
                    complete: function(data, status){
                        if (status=="success"){
                            var werror=JSON.parse(data.responseText).error;
                            var wmsg=JSON.parse(data.responseText).mensaje;
                            if (werror==0)
                            {                            
                                var wcodigo=JSON.parse(data.responseText).id;
                                waitingDialog.hide();
                                bootbox.alert("Se ha registro la compra con el nro de movimiento : <strong>" + wcodigo + "</strong>" );
                            }
                            else
                            {
                                  waitingDialog.hide();
                                  bootbox.alert("Error! : . " + wmsg); 
                            } 
                        }else
                        {
                          waitingDialog.hide();
                          bootbox.alert("Error! : Ocurrio algo inesperado, intente más tarde!");                              
                        }                       
                    }
                });
             }
    	}


		tabla={
            init:function()
            {

            }
            ,agregar:function(rowData)
            {	

                var idrow=tabla.countrow('tblinvoice tbody') + 1;
                var cadena = "<tr id='idrow-" + rowData.IdProducto + "' class='idrow-invoice'>";
                cadena = cadena + "<td><span class='invitem'>" + idrow +"</span></td>";
                cadena = cadena + "<td style='display: none'><span class='invidprod'>" + rowData.IdProducto + "</span></td>";
                cadena = cadena + "<td>" + rowData.Descripcion + "</td>";
                cadena = cadena + "<td>" + rowData.unidadmedida + "</td>";
                cadena = cadena + "<td style='text-align: center;'><input type='checkbox' name='optaigv-"+ rowData.IdProducto +"' value=1 checked='checked' class='optaigv'> / <input type='checkbox' name='optiigv-"+ rowData.IdProducto +"' value=2 class='optiigv'></td>";                
                cadena = cadena + "<td><input type='text' placeholder='0' id='invcnt-"+ rowData.IdProducto +"' class='form-control input-sm entero calcula right invcnt' value='1'></td>";
                cadena = cadena + "<td><input type='text' placeholder='0' id='invpu-"+ rowData.IdProducto +"' class='form-control input-sm decimal calcula right invpu' value='1'></td>";                
                cadena = cadena + "<td class='right'><span class='invbaseimp' id='invbaseimp-" + rowData.IdProducto + "'>0.0000</span></td>";
                cadena = cadena + "<td class='right'><span class='invimpigv' id='invimpigv-" + rowData.IdProducto + "'>0.0000</span></td>";
                cadena = cadena + "<td class='right'><span class='invprccomp' id='invprccomp-" + rowData.IdProducto + "'>0.0000</span></td>";
                cadena = cadena + "<td><a class='btn btn-danger btn-sm elimina'><span class='fa fa-trash-o'></span></a></td>";
                $("#tblinvoice tbody").append(cadena);
                tabla.event(rowData.IdProducto);
                tabla.eliminar();
            }
            ,eliminar:function(){
                $("a.elimina").click(function(){
                   var id = $(this).parents("tr").find("td").eq(0).html();
                        $(this).parents("tr").fadeOut("normal", function(){
                            $(this).remove();
                            tabla.actualizaritem('tblinvoice-body');
                            tabla.calculatotal();
                        })
                });
            }
            ,cantidad:function(){

            }
            ,event:function(idrow)
            {              

                //Validaciones
                $(".entero").numeric(false);
                $(".decimal").numeric();

                $("#invcnt-" + idrow).on("input", function() {
                    tabla.calcularow(idrow);
                });

                $("#invpu-" + idrow).on("input", function() {
                    tabla.calcularow(idrow);
                });

				$("input[type=checkbox]").on('change', function() {
					tabla.calcularow(idrow);
				});

				/*
                $("input[name=opt-"+idrow+"]").on("change", function() {
                    tabla.calcularow(idrow);
                });
                */

                tabla.calcularow(idrow);

                /*
                $("#inv-tot-otcargo").on("input", function() {
                    tabla.calculatotal();
                });
                */

            }
            ,countrow:function(id){
                var cantidad = $("#" + id).find("tr").length;
                return cantidad;
            }
            ,calcularow:function(idrow){               

                //Obteniendo el IGV
                var cnt         =0.00;
                var pu          =0.00;
                var baseimponible = 0.00;
                var importeigv    = 0.00;
                var preciocompra  = 0.00; 
                var igv 		  =18;

                //Afecto IGv / Incluye IGV
                var flgafectoigv=$("input[name=optaigv-"+idrow+"]").is(":checked");
                var flgincluyeigv=$("input[name=optiigv-"+idrow+"]").is(":checked");

                if (igv>0)
                    igv=igv/100;
                else
                    igv=0;

                if ((parseFloat($("#invcnt-" + idrow).val())==0 || $("#invcnt-" + idrow).val().length==0) ||
                    (parseFloat($("#invpu-" + idrow).val())==0 || $("#invpu-" + idrow).val().length==0)){
                    cnt=0;
                    pu=0;
	                baseimponible = 0.00;
	                importeigv    = 0.00;
	                preciocompra  = 0.00;                     
                }else
                {
                	//Obteniendo Valor Inputado
                    cnt=parseFloat($("#invcnt-" + idrow).val());
                    pu=parseFloat($("#invpu-" + idrow).val());
                    //Obteniendo Precio de Compra
                    baseimponible=0;
                    importeigv=0;

                    
                    if (!flgafectoigv && !flgincluyeigv) 
                    {
						baseimponible=cnt*pu;//preciocompra / (igv+1);
						preciocompra=baseimponible * (igv+1);						
						importeigv=0;
                    }
                    else if (flgafectoigv && flgincluyeigv)                     
                    {
						preciocompra=cnt*pu;//preciocompra / (igv+1);
						baseimponible=preciocompra / (igv+1);						
						importeigv=preciocompra-baseimponible;
                    }
                    else if (flgafectoigv) 
                    {                    	
						baseimponible=cnt*pu;//preciocompra / (igv+1);
						preciocompra=baseimponible * (igv+1);						
						importeigv=preciocompra-baseimponible;
                    }                    
                    else if (flgincluyeigv) 
                    {
                    	preciocompra=cnt*pu;
                    	baseimponible=0;
                    	importeigv=0;
                    }
                	//importeigv=preciocompra-baseimponible;
                    
                }


                $("#invbaseimp-" + idrow).html(baseimponible.toFixed(4));
                $("#invimpigv-" + idrow).html(importeigv.toFixed(4));
                $("#invprccomp-" + idrow).html(preciocompra.toFixed(4));

                tabla.calculatotal();
            }
            ,validaimportestabla:function()
            {
                var intL_validavalor=0;
                $("#tblinvoice tbody tr").each(function (index) {

                    if ((parseFloat($(this).find("td .invcnt").val())==0 || $(this).find("td .invcnt").val().length==0) ||
                        (parseFloat($(this).find("td .invpu").val())==0 || $(this).find("td .invpu").val().length==0)){
                       intL_validavalor++;
                    }
                });
                return intL_validavalor;
            }
            ,calculatotal:function(){
                var dbl_baseimp=0;
                var dbl_igv=0;
                var dbl_precompra=0;

                var dbl_tot_baseimp=0;
                var dbl_tot_igv=0;
                var dbl_tot_precompra=0;                
                
                //Totalizando                
                $("#tblinvoice tbody tr").each(function (index) {


                    var dbl_baseimp=parseFloat($(this).find("td span.invbaseimp").html()); //Base Imponible
                    var dbl_igv=parseFloat($(this).find("td span.invimpigv").html());//IGV
                    var dbl_precompra=parseFloat($(this).find("td span.invprccomp").html());//Total

                    //obteniendo el IGV
                    dbl_tot_baseimp=dbl_tot_baseimp + (dbl_baseimp);
                    dbl_tot_igv=dbl_tot_igv + (dbl_igv);
                    dbl_tot_precompra=dbl_tot_precompra + (dbl_precompra);
                });

                $("#inv-tot-baseimp").html(dbl_tot_baseimp.toFixed(2));
                $("#inv-tot-igv").html(dbl_tot_igv.toFixed(2));
                $("#inv-tot-precompra").html(dbl_tot_precompra.toFixed(2));                              

                $("#inpbaseimponible").val($("#inv-tot-baseimp").html());
                $("#inpigv").val($("#inv-tot-igv").html());
                $("#inppreciocompra").val($("#inv-tot-precompra").html());          

                tabla.almacenardetalle();
            }
            ,actualizaritem:function(id)
            {
                for (var i=0;i<document.getElementById(id).rows.length;i++)
                {
                  document.getElementById(id).rows[i].cells[0].innerHTML=(i+1);
                }                
            }
            ,almacenardetalle:function(){
                var cadena="";
                var intL_item=0;
                var intL_idproducto=0;
                var bol_flgafectoigv=false;
                var bol_flgincluyeigv=false;
                var dbl_preciounitario=0;
                var dbl_cantidad=0;
                var dbl_baseimponible=0;
                var dbl_igv=0;
                var dbl_preciocompra=0;


                $("#tblinvoice tbody tr").each(function (index) {
                    chk_flgafectoigv=$(this).find("td input.optaigv"); //check afecto igv
                    chk_flgincluyeigv=$(this).find("td input.optiigv"); //check incluyen igv

                    intL_item=$(this).find("td span.invitem").html(); //Item
                    intL_idproducto=$(this).find("td span.invidprod").html(); //IdProducto
                    bol_flgafectoigv=$(chk_flgafectoigv).is(":checked"); //flg afecto igv                  
                    bol_flgincluyeigv=$(chk_flgincluyeigv).is(":checked"); //flg inc igv
                    dbl_preciounitario=$(this).find("td input.invpu").val(); //precio unitario
                    dbl_cantidad=$(this).find("td input.invcnt").val(); //cantidad
                    dbl_baseimponible=$(this).find("td span.invbaseimp").html(); //base imponible
                    dbl_igv=$(this).find("td span.invimpigv").html();//igv
                    dbl_preciocompra=$(this).find("td span.invprccomp").html();//precio compra

                    cadena=cadena + intL_item + "|" +
							intL_idproducto + "|" +
                    	 	bol_flgafectoigv + "|" +
                    	 	bol_flgincluyeigv + "|" +
                    	 	dbl_cantidad + "|" +                    	 	
                    	 	dbl_preciounitario + "|" +
                    	 	dbl_baseimponible  + "|" +
                    	 	dbl_igv   + "|" +
                    	 	dbl_preciocompra + "|"  ;

                    $("#caddetalle").val(cadena);
                });
            }
        }

    	compras.init();    
        tabla.init();     	
    });
 </script>   
