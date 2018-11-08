<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
               <i class="fa fa-th-list"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="<?php echo base_url('ventas'); ?>">Registro de Ventas</a></li>
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
        <form id="ventaform">
        <?php echo form_hidden('token', $token) ?>        
        <!-- CONTENT GOES HERE -->    
        <div class="panel panel-default comprobantes">
                <div class="panel-body">
                    <div class="row">
                        <input type="hidden" name="caddetalle" id="caddetalle">
                        <input type="hidden" name="idsucursal" id="idsucursal">

                        <input type="hidden" name="inpvalorigv" id="inpvalorigv">
                        <input type="hidden" name="inpgravadas" id="inpgravadas">
                        <input type="hidden" name="inpexonerada" id="inpexonerada">
                        <input type="hidden" name="inpinafectas" id="inpinafectas">
                        <input type="hidden" name="inpgratuitas" id="inpgratuitas">
                        <input type="hidden" name="inptotal" id="inptotal">

                        <div class=" col-lg-5">
                            <div class="form-group">
                                <label class="control-label">Cliente</label>
                                <div class="input-group mb15">
                                    <input type="hidden" class="form-control" name="idcliente" id="idcliente">
                                    <input type="text" class="form-control input-sm" name="cliente" id="cliente">
                                    <span class="input-group-btn ">
                                        <button type="button" class="btn btn-primary input-sm" data-toggle="modal" data-target=".bs-clientes-modal-lg">...</button>
                                    </span>
                                </div>
                            </div>
                        </div>

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
                                <select name="series" id="series" class="form-control select-nosearch input-sm" style="width: 100%">
                                    <?php
                                        foreach ($series as $key => $value) {
                                            echo '<option value="'.$value->idseries.'">'.$value->codigoserie.'</option>';
                                        }
                                     ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 -->

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">Fecha Emisión</label>
                                <div class="input-group">
                                    <input type="text" class="form-control input-sm" placeholder="" id="datepicker" name="fechaemision" value="<?php echo date("Y-m-d"); ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div><!-- input-group -->
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 --> 

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">Forma Pago</label>
                                <select name="formapago" id="formapago" class="form-control select-nosearch input-sm" style="width: 100%">
                                    <?php
                                        foreach ($formapagos as $key => $value) {
                                            echo '<option value="'.$value->codigo.'">'.$value->descripcion.'</option>';
                                        }
                                     ?>  
                                </select>
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 -->
                        
                    </div><!-- row -->
                    <div class="row">

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">Tipo de operación</label>
                                <select name="codtipooperacion" id="codtipooperacion" class="form-control select-nosearch input-sm" style="width: 100%">
                                    <?php
                                        foreach ($operacion as $key => $value) {
                                            echo '<option value="'.$value->codtipooperacion.'">'.$value->descripcion.'</option>';
                                        }
                                     ?>  
                                </select>
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 -->

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
                    </div><!-- row -->
                </div> 
        </div><!-- contentpanel -->

        <div class="panel panel-default comprobantes">
            <div class="panel-body">
                <div class="row">
                      <table class="table table-striped table-dark" id="tblinvoice">
                            <colgroup>
                                <col class="col-lg-1">
                                <col class="col-lg-3">
                                <col class="col-lg-1">
                                <col class="col-lg-2">
                                <col class="col-lg-1">
                                <col class="col-lg-1">
                                <col class="col-lg-1">
                                <col class="col-lg-1">
                            </colgroup>
                            <thead>
                              <tr>
                                <th>Item</th>
                                <th style="display: none">Producto</th>
                                <th>Producto</th>
                                <th class="right">Cant.</th>
                                <th>Tipo IGV</th>
                                <th class="right">Precio Unit.</th>
                                <th class="right">Sub Total</th>
                                <th class="right">Total</th>
                                <th></th>
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
                            <label class="control-label">Glosa</label>
                            <textarea class="form-control" rows="5" placeholder="Escriba aqúi alguna glosa..."></textarea>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" id="generacomprobante">Genenar Comrprobante</button>

            </div>
            <div class="col-md-4">
               <div class="panel panel-default comprobantes montos">
                    <div class="panel-body">              
                        <div class="form-group" style="display: none">
                            <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Descuento Global</label>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                <input type="text" class="form-control input-sm mount valor-total" id="inv-dcto-global" name="inv-dcto-global" placeholder="0.00" value="0">
                            </div>                        
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Exonerada</label>
                            <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4 control-label mount valor-total" id="inv-tot-exone">0.00</span>
                        </div><!-- form-group -->                    
                        <div class="form-group">
                            <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Inafecta</label>
                            <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4 control-label mount valor-total" id="inv-tot-inaf">0.00</span>
                        </div><!-- form-group --> 
                        <div class="form-group">
                            <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Gravada</label>
                            <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4 control-label mount valor-total" id="inv-tot-grav">0.00</span>
                        </div><!-- form-group --> 
                        <div class="form-group">
                            <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">IGV</label>
                            <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4 control-label mount valor-total" id="inv-tot-igv">0.00</span>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Gratuitas</label>
                            <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4 control-label mount valor-total" id="inv-tot-grat">0.00</span>
                        </div><!-- form-group -->
                        <div class="form-group" style="display: none;">
                            <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Otros Cargos</label>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                <input type="text" class="form-control input-sm mount valor-total" name="inv-tot-otcargo" id="inv-tot-otcargo" placeholder="0.00" value="0">
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Descuento Total(-)</label>
                            <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4 control-label mount valor-total" id="inv-tot-dscto">0.00</span>
                        </div><!-- form-group --> 
                        <div class="form-group">
                            <label class="col-xs-6 col-sm-6 col-md-8 col-lg-8 control-label mount">Total</label>
                            <span class="col-xs-6 col-sm-6 col-md-4 col-lg-4 control-label mount valor-total" id="inv-tot-total">0.00</span>
                        </div><!-- form-group -->                     
                    </div>
                </div>
            </div>                
        </div>

        </form>
    </div>

<div class="modal fade bs-clientes-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close btn-modal-ubg" type="button">&times;</button>
              <h4 class="modal-title">Clientes</h4>
          </div>
          <div class="modal-body">
            <div>
                <table id="tclientes"> </table> 
                <div id="pager-clients"></div>   
            </div>
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-modal-clientes" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
            <button type="button" class="btn btn-success btn-sel-clientes btn-modal-ubg"><i class="fa fa-check"></i>Aceptar</button>
          </div>         
     </div>
    </div>
</div>

<div class="modal fade bs-productos-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close btn-modal-ubg" type="button">&times;</button>
              <h4 class="modal-title">Productos / Servicios</h4>
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
    var $grid = $("#tclientes"),
        newWidth = $grid.closest(".ui-jqgrid").parent().width();
    $.jgrid.defaults.width = newWidth;
    $.jgrid.defaults.responsive = true;
    $.jgrid.defaults.styleUI = 'Bootstrap';
</script>

<script type="text/javascript">
    $(function(){
        //Constantes
        var cons_GRAVADAS="GRA";
        var cons_EXONERADA="EXO";
        var cons_INAFECTA="INA";
        var cons_GRAUITA="GRT";

        venta={
            init:function(){
                venta.default();
                venta.event();
                venta.validate();
            }
            ,default:function(){
                $('#datepicker').datepicker({
                    language: "es",
                    autoclose: true,
                    format: "yyyy-mm-dd",
                });

                venta.getclientes();
                venta.getproductos();

                $("#idsucursal").val($("#sucursal").val());
            }
            ,event:function(){

                $('.bs-productos-modal-lg').on('shown.bs.modal', function (e) {
                  //alert("I want this to appear after the modal has opened!");
                    $("#tproductos").setGridWidth( $("#tproductos").closest(".ui-jqgrid").parent().width());
                })

                $('.bs-clientes-modal-lg').on('shown.bs.modal', function (e) {
                  //alert("I want this to appear after the modal has opened!");
                    $("#tclientes").setGridWidth( $("#tclientes").closest(".ui-jqgrid").parent().width());
                })            

                $(".btn-sel-productos").click(function(event){
                    event.returnValue = false; /*para I.E.*/
                    if(event.preventDefault) event.preventDefault();

                    var selr = $("#tproductos").jqGrid('getGridParam', 'selrow');
                    var rowData = $("#tproductos").jqGrid('getRowData', selr)
                    tabla.agregar(rowData);
                    $('.bs-productos-modal-lg').modal('hide');
                });

                $(".btn-sel-clientes").click(function(event){
                    event.returnValue = false; /*para I.E.*/
                    if(event.preventDefault) event.preventDefault();

                    var selr = $("#tclientes").jqGrid('getGridParam', 'selrow');
                    var rowData = $("#tclientes").jqGrid('getRowData', selr)
                    $("#idcliente").val(rowData.idcliente);
                    $("#cliente").val(rowData.descripcion);

                    $('.bs-clientes-modal-lg').modal('hide');
                });  

                $('.selserie').on('change', function() {
                    venta.getseries();
                })  

                $("#generacomprobante").click(function(event){
                    event.returnValue = false; /*para I.E.*/
                    if(event.preventDefault) event.preventDefault();

                    //Obteniendo Tipo de Documento
                    txt_comprobante=$("#tipocomprobante option:selected").text();
                    txt_serie=$("#series option:selected").text();

                    var result=venta.validaformulario()
                    if (result[0]>0)
                    {
                        bootbox.alert(result[1]);
                    }else{
                        bootbox.confirm({
                            title: "Comprobante",
                            message: "¿Esta seguro de emitir esta: <strong>" + txt_comprobante + "</strong> de la serie: <strong>"+txt_serie +"</strong> ?",
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
                                venta.setventa($("#ventaform"));
                            }
                        });
                    }
                });
            }
            ,validate:function()
            {

            }
            ,validaformulario:function()
            {
                //Validando Cliente   
                var  logmensaje="<div class='error-venta'>";            
                strL_cliente=$("#idcliente").val();
                intL_valida=0;
                if (strL_cliente.length==0){
                    logmensaje=logmensaje + "<label class='error'>Debe de ingresar un cliente!" + "</label>";
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

                if ($("#series option").length==0)
                {
                    logmensaje=logmensaje + "<label class='error'>Seleccione una serie!" + "</label>";
                    intL_valida++;
                }

                logmensaje=logmensaje + '</div>'

                return [intL_valida,logmensaje];
            }            
            ,getclientes:function(){
                var wurl="<?php echo base_url('cliente/list'); ?>";
                $("#tclientes").jqGrid({
                        url: wurl,
                        mtype: "get",
                        styleUI : 'Bootstrap',
                        responsive: true,
                        postData: {'token':$('input[name=token]').val()},
                        datatype: "json",
                        colModel: [
                            { label: 'Código', name: 'idcliente', key: true, width: 75 },
                            { label: 'Codigo Empresa', name: 'idempresa', width: 100 },
                            { label: 'Ape. Paterno', name: 'paterno', width: 100 },
                            { label: 'Ape. Materno', name: 'materno', width: 300 },
                            { label: 'Nombres', name: 'nombres', width: 200 },
                            { label: 'Razon Social', name: 'razonsocial', width: 200 },
                            { label: 'Codigo Tipo Documento', name: 'codtipodocumento', width: 150 },
                            { label: 'Tipo Doc.', name: 'tipodocumento', width: 80 },
                            { label: 'Nro Doc.', name: 'nrodocumento', width: 100 },
                            { label: 'Cliente', name: 'descripcion', width: 250 },
                            { label: 'Dirección', name: 'direccion', width: 250 },
                            { label: 'Codigo Ubigeo', name: 'ubigeo', width: 150 },
                            { label: 'Ubigeo', name: 'formato1', width: 250 },
                            { label: 'Teléfono', name: 'telefono', width: 100 },
                            { label: 'Celular', name: 'celular', width: 100 },
                            { label: 'E-mail', name: 'email', width: 200 },
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
                        sortname: 'idcliente',
                        sortorder: 'desc',                        
                        pager: "#pager-clients"
                            }); 

              $("#tclientes").jqGrid('navGrid','#pager-clients',
              {edit: false, add: false, del: false, search: false, refresh:true},
              {},
              {},
              {},
              {multipleSearch:true, multipleGroup:false, showQuery: true}
              );

              $("#tclientes").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: true });
              $("#tclientes").jqGrid('setFrozenColumns');
              $("#tclientes").jqGrid('hideCol',['idempresa','paterno','materno','nombres','razonsocial','ubigeo','codtipodocumento']); 
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

            ,setventa(form)
             {
                var wurl="<?php echo base_url('ventas/store'); ?>";
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
                                var wnrodoc=JSON.parse(data.responseText).nrodoc;
                                waitingDialog.hide();
                                bootbox.alert("Se generó el comprobante, Nro de Documento : <strong>" + wnrodoc + "</strong>" );
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
            ,getseries()
            {
                var wurl="<?php echo base_url('ventas/getserie'); ?>";
                $.ajax({
                    async: true,
                    url: wurl,
                    type: "post",
                    dataType: 'json',
                    contentType: 'application/x-www-form-urlencoded',
                    data:{'idsucursal':$("#sucursal").val(),'idcomprobante':$("#tipocomprobante").val()}
                    , beforeSend: function(data){
                        $("#series").html('');
                    },
                    complete: function(data, status){
                        var wdata=JSON.parse(data.responseText).series;
                        $.each(wdata, function (i, item) {
                            $('#series').append('<option value='+item.idseries+'>' + item.codigoserie + '</option>');
                        });
                    }
                });                
            }
        };

        tabla={
            init:function()
            {

            }
            ,agregar:function(rowData)
            {
                var idrow=tabla.countrow('tblinvoice tbody') + 1;
                var cadena = "<tr id='idrow-" + idrow + "' class='idrow-invoice'>";
                cadena = cadena + "<td><span class='invitem'>" + idrow +"</span></td>";
                cadena = cadena + "<td style='display: none'><span class='invidprod'>" + rowData.IdProducto + "</span></td>";
                cadena = cadena + "<td>" + rowData.Descripcion + "</td>";
                cadena = cadena + "<td><input type='text' placeholder='0' id='invcnt-"+ idrow +"' class='form-control input-sm entero calcula right invcnt' value='1'></td>";
                cadena = cadena + "<td><select id='invafe-" + idrow + "' class='form-control select-nosearch input-sm tipoafect' style='width: 100%'></select></td>";
                cadena = cadena + "<td><input type='text' placeholder='0.00' class='form-control input-sm decimal calcula right invpu' id='invpu-"+ idrow +"'></td>";
                cadena = cadena + "<td class='right'><span style='display:none' class='invsublarge' id='invsublarge-" + idrow + "'>0.00</span><span class='invsub' id='invsub-" + idrow + "'>0.00</span></td>";
                cadena = cadena + "<td class='right'><span class='invtot' id='invtot-" + idrow + "'>0.00</span></td>";
                cadena = cadena + "<td><a class='btn btn-danger btn-sm elimina'><span class='fa fa-trash-o'></span></a></td>";
                $("#tblinvoice tbody").append(cadena);
                tabla.event(idrow);
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
                var items=<?php echo json_encode($afectaciones, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS); ?>;

                //Cargando Combo
                $.each(items, function (i, item) {
                    $('#invafe-'+ idrow).append('<option value='+item.idtipoafectacion+' data-igv='+item.valorigv+' data-tafect='+item.tipafect+'>' + item.descripcion + '</option>');
                });

                $('#invafe-'+ idrow).on('change', function() {
                    tabla.calcularow(idrow);
                })                 

                //Validaciones
                $(".entero").numeric(false);
                $(".decimal").numeric();

                $("#invcnt-" + idrow).on("input", function() {
                    tabla.calcularow(idrow);
                });

                $("#invpu-" + idrow).on("input", function() {
                    tabla.calcularow(idrow);
                });

                $("#inv-tot-otcargo").on("input", function() {
                    tabla.calculatotal();
                });

            }
            ,countrow:function(id){
                var cantidad = $("#" + id).find("tr").length;
                return cantidad;
            }
            ,calcularow:function(idrow){
                
                //Obteniendo el IGV
                var subtotal    =0.00;
                var cnt         =0.00;
                var pu          =0.00;
                var total       =0.00;
                var igv         =parseFloat($('#invafe-'+ idrow).find(':selected').attr('data-igv'));
                var valorigv    =0.00;
                var valor       =0.00;

                if (igv>0)
                    igv=igv/100;
                else
                    igv=0;

                if ((parseFloat($("#invcnt-" + idrow).val())==0 || $("#invcnt-" + idrow).val().length==0) ||
                    (parseFloat($("#invpu-" + idrow).val())==0 || $("#invpu-" + idrow).val().length==0)){
                    cnt=0;
                    pu=0;
                    subtotal=0.00;
                    total=0.00;
                }else
                {
                    cnt=parseFloat($("#invcnt-" + idrow).val());
                    pu=parseFloat($("#invpu-" + idrow).val());
                    total=cnt*pu;
                    if (igv==0)
                        subtotal=total;
                    else
                        subtotal=total/(igv+1);
                }

                $("#invsublarge-" + idrow).html(subtotal);
                $("#invsub-" + idrow).html(subtotal.toFixed(2));
                $("#invtot-" + idrow).html(total);

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
                var dbl_grabadas=0;
                var dbl_inafectas=0;
                var dbl_exoneradas=0;
                var dbl_gratuitas=0;
                var dbl_igv=0;
                var dbl_otroscargo=0;
                var dbl_total=0;
                
                //Totalizando                
                $("#tblinvoice tbody tr").each(function (index) {
                    cbo_afectacion=$(this).find("td select.tipoafect"); //Obteniendo el Combo
                    str_tipoafect=$(cbo_afectacion).find(':selected').attr('data-tafect') //Obteiendo el tipo de afectacin

                    var dblL_subtotal=parseFloat($(this).find("td span.invsub").html()); //SubTotal
                    var dblL_total=parseFloat($(this).find("td span.invtot").html());//Total

                    if (str_tipoafect==cons_GRAVADAS)
                        dbl_grabadas=dbl_grabadas + dblL_subtotal;
                    else if (str_tipoafect==cons_GRAUITA)
                        dbl_gratuitas=dbl_gratuitas + dblL_subtotal;
                    else if (str_tipoafect==cons_INAFECTA)
                        dbl_inafectas=dbl_inafectas + dblL_subtotal;
                    else if (str_tipoafect==cons_EXONERADA)
                        dbl_exoneradas=dbl_exoneradas + dblL_subtotal;

                    //obteniendo el IGV
                    dbl_igv=dbl_igv + (dblL_total-dblL_subtotal);
                });

                dbl_total = dbl_grabadas + dbl_exoneradas + dbl_inafectas + dbl_igv;

                //Otros Cargos                
                if ((parseFloat($("#inv-tot-otcargo").val())==0 || $("#inv-tot-otcargo").val().length==0))
                    dbl_otroscargo=0
                else{
                    dbl_otroscargo=parseFloat($("#inv-tot-otcargo").val())    ;
                    dbl_total=dbl_total+dbl_otroscargo;
                }                

                $("#inv-tot-exone").html(dbl_exoneradas.toFixed(2));
                $("#inv-tot-inaf").html(dbl_inafectas.toFixed(2));
                $("#inv-tot-grav").html(dbl_grabadas.toFixed(2));
                $("#inv-tot-grat").html(dbl_gratuitas.toFixed(2));
                $("#inv-tot-igv").html(dbl_igv.toFixed(2))
                $("#inv-tot-total").html(dbl_total.toFixed(2));

                $("#inpvalorigv").val($("#inv-tot-igv").html());
                $("#inpgravadas").val($("#inv-tot-grav").html());
                $("#inpexonerada").val($("#inv-tot-exone").html());
                $("#inpinafectas").val($("#inv-tot-inaf").html());
                $("#inpgratuitas").val($("#inv-tot-grat").html());
                $("#inptotal").val($("#inv-tot-total").html());              

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
                var strL_codafectacion="";
                var dblL_valorcant=0;
                var dblL_valorpu=0;
                var dblL_valorsubtotal=0;
                var dblL_valorsubtotallargo=0;
                var dblL_valortotal=0;

                $("#tblinvoice tbody tr").each(function (index) {
                    cbo_afectacion=$(this).find("td select.tipoafect"); //Obteniendo el Combo

                    intL_item=$(this).find("td span.invitem").html(); //Item
                    intL_idproducto=$(this).find("td span.invidprod").html(); //IdProducto
                    strL_codafectacion=$(cbo_afectacion).find(':selected').val(); //Obteiendo el tipo de afectacin                    
                    dblL_valorcant=$(this).find("td input.invcnt").val(); //Cantidad
                    dblL_valorpu=$(this).find("td input.invpu").val(); //precio unitario
                    dblL_valorsubtotal=$(this).find("td span.invsub").html(); //SubTotal
                    dblL_valorsubtotallargo=$(this).find("td span.invsublarge").html(); //SubTotal
                    dblL_valortotal=$(this).find("td span.invtot").html();//Total

                    cadena=cadena + intL_item + "|" + intL_idproducto + "|" + strL_codafectacion + "|" + dblL_valorcant + "|" + dblL_valorpu + "|" + dblL_valorsubtotal + "|" + dblL_valorsubtotallargo + "|" + dblL_valortotal + "|" ;

                    $("#caddetalle").val(cadena);
                });
            }
        }

        venta.init();
        tabla.init();        
    });
</script> 