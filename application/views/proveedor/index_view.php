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
                </ul>
                <h4><?php echo $titulo; ?> <button class="btn btn-primary btn-xs new-modal" data-toggle="modal" data-target=".bs-registro-modal-lg"><span class="fa fa-plus"></span></button></h4> 
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">  
        <?php echo form_hidden('token', $token) ?>        
        <!-- CONTENT GOES HERE -->    
        <div>
            <table id="tdatos"> </table> 
            <div id="pager"></div>
        </div> 
    </div><!-- contentpanel -->    
</div>
<div class="modal fade bs-registro-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close btn-modal-reg" type="button">&times;</button>
              <h4 class="modal-title">Proveedores</h4>
          </div>
          <div class="modal-body">            
              <div class="panel panel-default">            
                    <div class="panel-body nopadding">
                        <form class="form-horizontal form-bordered" id="frm-registro">
                            <input type="hidden" name="opcion" id="opcion" value="N">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-10">
                                    <input type="text" id="idproveedor" name="idproveedor" placeholder="Codigo" class="form-control empty" readonly="readonly" />
                                </div>
                            </div>
                            <!-- form-group -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Documento</label>
                                <div class="col-sm-3">
                                    <select id="tipodocumento" name="tipodocumento" class="select-nosearch" data-placeholder="Seleccione una Categoria" class="form-control" style="width: 100%" required>
                                        <?php
                                            foreach ($tablas as $key => $value) {
                                            	if ($value->codigo=="003002"){
                                                	echo '<option value="'.$value->codigo.'">'.$value->descripcion.'</option>';
                                            	}
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" id="nrodocumento" name="nrodocumento" placeholder="Nro Documento" class="form-control empty" required />
                                </div>                                
                            </div>
							<!-- form-group -->
                            <div class="form-group g-juridico">
                                <label class="col-sm-2 control-label">Razón Social</label>
                                <div class="col-sm-10">
                                    <input type="text" id="razonsocial" name="razonsocial" placeholder="Razón Social" class="form-control empty juridico" required />
                                </div>
                            </div>
                            <!-- form-group -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Dirección</label>
                                <div class="col-sm-10">
                                    <input type="text" id="direccion" name="direccion" placeholder="Dirección" class="form-control empty" />
                                </div>
                            </div><!-- form-group -->  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ubigeo</label>
                                <div class="input-group mb15">
                                        <input type="hidden" name="codubigeo" id="codubigeo" class="form-control">
                                        <input type="text" name="ubigeo" id="ubigeo" class="form-control">
                                        <span class="input-group-btn">
                                            <button type="button" id="search-ubigeo" class="btn btn-primary" data-toggle="modal" data-target=".bs-ubigeo-modal-lg">...</button>
                                        </span>
                                </div>
                            </div>
                            <!-- form-group -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Info. Contacto</label>
                                <div class="col-sm-2">
                                    <input type="text" id="celular" name="celular" placeholder="Celular" class="form-control empty" />
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="telefono" name="telefono" placeholder="Telefono" class="form-control empty" />
                                </div> 
                                <div class="col-sm-6">
                                    <input type="text" id="email" name="email" placeholder="Emial" class="form-control empty" />
                                </div>   
                            </div>
                            <!-- form-group -->                            
                        </form>
                    </div>             
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-modal-reg" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
            <button type="button" class="btn btn-success btn-save btn-modal-ubg"><i class="fa fa-check"></i>Aceptar</button>
          </div>
      </div>
    </div>
</div>

<div class="modal fade bs-ubigeo-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close btn-modal-ubg" type="button">&times;</button>
              <h4 class="modal-title">Ubigeo</h4>
          </div>
          <div class="modal-body">
            <div>
                <table id="tubigeo"> </table> 
                <div id="pagerubigeo"></div>   
            </div>
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-modal-ubg" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
            <button type="button" class="btn btn-success btn-sel-ubigeo btn-modal-ubg"><i class="fa fa-check"></i>Aceptar</button>
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
        proveedor={
            init:function()
            {
                proveedor.event();
                proveedor.validate();
                proveedor.getproveedores();
                proveedor.getubigeo();

                proveedor.hidefield();
            }
            ,event:function()
            {

                $('.modal').on('show.bs.modal', function (event) {
                    var idx = $('.modal:visible').length;
                    $(this).css('z-index', 1040 + (10 * idx));
                });

                $('.modal').on('shown.bs.modal', function (event) {
                    var idx = ($('.modal:visible').length) - 1; // raise backdrop after animation.
                    $('.modal-backdrop').not('.stacked').css('z-index', 1039 + (10 * idx));
                    $('.modal-backdrop').not('.stacked').addClass('stacked');
                });

                $('.bs-registro-modal-lg').on('shown.bs.modal', function (e) {
                    if ($("#opcion").val()=='N'){
                       $('.empty').val('');
                       $("#tipodocumento").removeAttr('readonly');
                       $("#nrodocumento").removeAttr('readonly');
                    }
                });

                $(".select-nosearch").select2({
                    minimumResultsForSearch: -1
                });

                $(".btn-sel-ubigeo").click(function(event)
                {
                    var selr = $("#tubigeo").jqGrid('getGridParam', 'selrow');
                    if(selr) {
                        var rowData = $("#tubigeo").jqGrid('getRowData', selr)
                        $("#codubigeo").val(rowData.codigo);
                        $("#ubigeo").val(rowData.formato1);
                        $('.bs-ubigeo-modal-lg').modal('hide');
                    };
                });
                
               $(".new-modal").click(function(event)
                {
                    $("#opcion").val('N');
               });
                

                $(".btn-save").click(function(event)
                {
                    event.returnValue = false; //
                    if(event.preventDefault) event.preventDefault();
                    //alert("Prueba");
                    $("#frm-registro").submit();
                });

                $('#tipodocumento').on('change', function() {
                    proveedor.hidefield();
                });
            }
            ,hidefield:function()
            {
               
            }
            
            ,eventload:function()
            {
                $(".edit-modal").click(function(event)
                {
                    event.returnValue = false; //
                    if(event.preventDefault) event.preventDefault();
                    $("#opcion").val('U');
                    var idrow=$(this).data('id');
                    $("#tdatos").jqGrid('setSelection',idrow, false);

                    var selr = $("#tdatos").jqGrid('getGridParam', 'selrow');
                    var rowData = $("#tdatos").jqGrid('getRowData', selr)

                    proveedor.loadfield(rowData);

                    $('.bs-registro-modal-lg').modal('show');
                });

                $(".delete-modal").click(function(event)
                {
                    event.returnValue = false; //
                    if(event.preventDefault) event.preventDefault();

                    $("#opcion").val('D');
                    var idrow=$(this).data('id');
                    $("#tdatos").jqGrid('setSelection',idrow, false);
                    var selr = $("#tdatos").jqGrid('getGridParam', 'selrow');
                    var rowData = $("#tdatos").jqGrid('getRowData', selr)

                    //Cargando los Tipos
                    proveedor.loadfield(rowData);

                    bootbox.confirm({
                        title: "Proveedores",
                        message: "¿Esta seguro de Eliminar este registro?",
                        buttons: {
                            cancel: {
                                label: '<i class="fa fa-times"></i> Cancelar'
                            },
                            confirm: {
                                label: '<i class="fa fa-check"></i> Confirmar',
                                className: 'btn-success'
                            }
                        },
                        callback: function (result) {
                            if (result)
                               proveedor.setproveedor($("#frm-registro"));
                        }
                    });                    
                }); 
            }
            ,loadfield:function(rowData)
            {
                    //Cargando los Tipos
                    $("#idproveedor").val(rowData.idproveedor);
                    $("#tipodocumento").val(rowData.CodigoTipo).trigger('change');
                    $("#nrodocumento").val(rowData.nrodocumento);
                    $("#razonsocial").val(rowData.razonsocial);
                    $("#direccion").val(rowData.direccion);
                    $("#codubigeo").val(rowData.ubigeo);
                    $("#ubigeo").val(rowData.formato1);
                    $("#telefono").val(rowData.telefono);
                    $("#celular").val(rowData.celular);
                    $("#email").val(rowData.email);

                    $("#tipodocumento").attr('readonly','readonly');
                    $("#nrodocumento").attr('readonly','readonly');
            }
            ,validate:function()
            {
                //$.validator.setDefaults(':hidden, [readonly=readonly]');
                $("#frm-registro").validate({
                    ignore: ':hidden, [readonly=readonly]',
                    highlight: function(element) {
                        jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                    },
                    success: function(element) {
                        jQuery(element).closest('.form-group').removeClass('has-error');
                    }
                    ,submitHandler: function(form) {
                        proveedor.setproveedor(form);
                    }
                });                 
            }
            ,getproveedores:function()
            {
                var wurl="<?php echo base_url('proveedor/list'); ?>";
                $("#tdatos").jqGrid({
                        url: wurl,
                        mtype: "get",
                        styleUI : 'Bootstrap',
                        responsive: true,
                        postData: {'token':$('input[name=token]').val()},
                        datatype: "json",
                        colModel: [
                            { label: '...', name: 'CHASIS', frozen:true , width: 80, formatter:function(cellValue, opts, rowObject){return '<button class="btn btn-success btn-xs edit-modal" data-id=' + rowObject.idproveedor + '><span class="fa fa-pencil"></span></button> <button class="btn btn-danger btn-xs delete-modal" data-id=' + rowObject.idproveedor + '><span class="fa fa-trash-o"></span></button>';}},
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
                            proveedor.eventload();
                        },                        
                        sortname: 'idproveedor',
                        sortorder: 'desc',                        
                        pager: "#pager"
                            }); 

              $("#tdatos").jqGrid('navGrid','#pager',
              {edit: false, add: false, del: false, search: false, refresh:true},
              {},
              {},
              {},
              {multipleSearch:true, multipleGroup:false, showQuery: true}
              );

              $("#tdatos").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: true });
              $("#tdatos").jqGrid('setFrozenColumns');
              $("#tdatos").jqGrid('hideCol',['idempresa','ubigeo','codtipodocumento']); 
            }
            ,getubigeo:function()
            {
                var wurl="<?php echo base_url('ubigeo/list'); ?>";
                $("#tubigeo").jqGrid({
                        url: wurl,
                        mtype: "get",
                        styleUI : 'Bootstrap',
                        responsive: true,
                        postData: {'token':$('input[name=token]').val()},
                        datatype: "json",
                        colModel: [
                            { label: 'Código', name: 'codigo', key: true, width: 75 },
                            { label: 'Descripción', name: 'formato1', width: 350 },                            
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
                            //producto.eventload();
                        },                        
                        sortname: 'codigo',
                        sortorder: 'asc',                        
                        pager: "#pagerubigeo"
                            }); 

              $("#tubigeo").jqGrid('navGrid','#pagerubigeo',
              {edit: false, add: false, del: false, search: false, refresh:true},
              {},
              {},
              {},
              {multipleSearch:true, multipleGroup:false, showQuery: true}
              );

              $("#tubigeo").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: true });
            }            
           ,setproveedor(form)
           {
                var wurl="<?php echo base_url('proveedor/store'); ?>";
                $.ajax({
                    async: true,
                    url: wurl,
                    type: "post",
                    dataType: 'json',
                    contentType: 'application/x-www-form-urlencoded',
                    data:$(form).serialize()
                    , beforeSend: function(data){
                        $(".btn-modal-reg").attr('disabled','disabled');
                        waitingDialog.show('Procesando...', {dialogSize: 'sm'});                         
                    },
                    complete: function(data, status){
                        if (status=="success")
                        {                         
                            var werror=JSON.parse(data.responseText).error;
                            var wmsg=JSON.parse(data.responseText).mensaje;
                            if (werror==0)
                            {                            
                                $('.bs-registro-modal-lg').modal('hide');
                                $("#tdatos").trigger('reloadGrid');
                                wmnesaje="";
                                if ($("#opcion").val()=='N'){
                                    wmnesaje='El Proveedor ' +  $("#nrodocumento").val() + ' se ha generado!'
                                }
                                else if ($("#opcion").val()=='U'){
                                    wmnesaje='El Proveedor ' +  $("#nrodocumento").val() + ' se ha actualizado!'
                                }

                                else if ($("#opcion").val()=='D'){
                                    wmnesaje='El Proveedor ' +  $("#nrodocumento").val() + ' se ha elimiado!'
                                }
                                waitingDialog.hide();
                                bootbox.alert(wmnesaje);
                            }
                            else
                            {
                                  waitingDialog.hide();
                                  bootbox.alert("Error! : " + wmsg);                                 
                            }
                        }
                        else
                        {
                          waitingDialog.hide();
                          bootbox.alert("Error! : Ocurrio algo inesperado, intente más tarde!");                            
                        }                            
                        $(".btn-modal-reg").removeAttr('disabled');
                    }
                })                
           }
        }
        proveedor.init();
    })
</script>
