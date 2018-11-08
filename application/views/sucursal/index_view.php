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
              <h4 class="modal-title">Sucursales</h4>
          </div>
          <div class="modal-body">            
              <div class="panel panel-default">            
                    <div class="panel-body nopadding">
                        <form class="form-horizontal form-bordered" id="frm-registro">
                            <input type="hidden" name="opcion" id="opcion" value="N">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-10">
                                    <input type="text" id="idsucursal" name="idsucursal" placeholder="Codigo" class="form-control empty" readonly="readonly" />
                                </div>
                            </div>
                            <!-- form-group -->                             
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Descripción</label>
                                <div class="col-sm-10">
                                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese la Descripción" class="form-control empty" required />
                                </div>
                            </div><!-- form-group -->
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
                                        <input type="text" name="ubigeo" id="ubigeo" class="form-control" placeholder="Ubigeo">
                                        <span class="input-group-btn">
                                            <button type="button" id="search-ubigeo" class="btn btn-primary" data-toggle="modal" data-target=".bs-ubigeo-modal-lg">...</button>
                                        </span>
                                </div>
                            </div>
                            <!-- form-group -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código Sunat</label>
                                <div class="col-sm-2">
                                    <input type="text" id="codigosunat" name="codigosunat" placeholder="Código Sunat" class="form-control empty" />
                                </div>
                            </div><!-- form-group --> 
                        </form>
                    </div>             
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-modal-reg" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
            <button type="button" class="btn btn-success btn-save btn-modal-reg"><i class="fa fa-check"></i>Aceptar</button>
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
        sucursal={
            init:function()
            {
                sucursal.event();
                sucursal.validate();
                sucursal.getsucursal();
                sucursal.getubigeo();                
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
                       $("#tipo").removeAttr('readonly');
                    }
                });
                
				$(".new-modal").click(function(event)
				{
				    $("#opcion").val('N');
				});

                $(".btn-save").click(function(event)
                {
                    event.returnValue = false; 
                    if(event.preventDefault) event.preventDefault();
                    $("#frm-registro").submit();
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

            }
            ,eventload:function()
            {
                $(".edit-modal").click(function(event)
                {
                    event.returnValue = false; 
                    if(event.preventDefault) event.preventDefault();
                    $("#opcion").val('U');
                    var idrow=$(this).data('id');
                    $("#tdatos").jqGrid('setSelection',idrow, false);

                    var selr = $("#tdatos").jqGrid('getGridParam', 'selrow');
                    var rowData = $("#tdatos").jqGrid('getRowData', selr)

                    //Cargando los Tipos
					sucursal.loadfield(rowData);

                    $('.bs-registro-modal-lg').modal('show');
                });

                $(".delete-modal").click(function(event)
                {
                    event.returnValue = false; 
                    if(event.preventDefault) event.preventDefault();

                    $("#opcion").val('D');
                    var idrow=$(this).data('id');
                    $("#tdatos").jqGrid('setSelection',idrow, false);
                    var selr = $("#tdatos").jqGrid('getGridParam', 'selrow');
                    var rowData = $("#tdatos").jqGrid('getRowData', selr)

                    //Cargando los Tipos
                    sucursal.loadfield(rowData);

                    bootbox.confirm({
                        title: "Sucursal",
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
                                sucursal.setsucursal($("#frm-registro"));
                        }
                    });                    
                }); 
            }
            ,loadfield:function(rowData)
            {
                    $("#idsucursal").val(rowData.idsucursal);
                    $("#nombre").val(rowData.nombre);
                    $("#direccion").val(rowData.direccion);
                    $("#codubigeo").val(rowData.ubigeo);
                    $("#ubigeo").val(rowData.formato1);
                    $("#codigosunat").val(rowData.codigosunat);
            }
            ,validate:function()
            {
                $("#frm-registro").validate({
                    highlight: function(element) {
                        jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                    },
                    success: function(element) {
                        jQuery(element).closest('.form-group').removeClass('has-error');
                    }
                    ,submitHandler: function(form) {
                        sucursal.setsucursal(form);
                    }
                });                 
            }
            ,getsucursal:function()
            {
                var wurl="<?php echo base_url('sucursal/list'); ?>";
                $("#tdatos").jqGrid({
                        url: wurl,
                        mtype: "get",
                        styleUI : 'Bootstrap',
                        responsive: true,
                        postData: {'token':$('input[name=token]').val()},
                        datatype: "json",
                        colModel: [
                            { label: '...', name: 'CHASIS', frozen:true , width: 80, formatter:function(cellValue, opts, rowObject){return '<button class="btn btn-success btn-xs edit-modal" data-id=' + rowObject.idsucursal + '><span class="fa fa-pencil"></span></button> <button class="btn btn-danger btn-xs delete-modal" data-id=' + rowObject.idsucursal + '><span class="fa fa-trash-o"></span></button>';}},
                            { label: 'Codigo', name: 'idsucursal', key: true, width: 75 },
                            { label: 'IdEmpresa', name: 'IdEmpresa', width: 75 },
                            { label: 'Descripción', name: 'nombre', width: 300 },
							{ label: 'Dirección', name: 'direccion', width: 300 },
							{ label: 'ubigeo', name: 'ubigeo', width: 300 },
                            { label: 'Ubigeo', name: 'formato1', width: 300 },
							{ label: 'Cod. Sunat', name: 'codigosunat', width: 100 },                            
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
                            sucursal.eventload();
                        },                        
                        sortname: 'idsucursal',
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
              $("#tdatos").jqGrid('hideCol',['IdEmpresa','ubigeo']); 
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
                            sucursal.eventload();
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

           ,setsucursal(form)
           {
                var wurl="<?php echo base_url('sucursal/store'); ?>";
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
                                wicon="";
                                if ($("#opcion").val()=='N'){
                                    wmnesaje='La Sucursal ' +  $("#nombre").val() + ' se ha generado!'
                                }
                                else if ($("#opcion").val()=='U'){
                                    wmnesaje='La Sucursal ' +  $("#nombre").val() + ' se ha actualizado!'
                                }
                                else if ($("#opcion").val()=='D'){
                                    wmnesaje='La Sucursal ' +  $("#nombre").val() + ' se ha elimiado!'
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
                });                
           }
        }
        sucursal.init();
    })
</script>