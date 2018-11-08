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
              <h4 class="modal-title">Series</h4>
          </div>
          <div class="modal-body">            
              <div class="panel panel-default">            
                    <div class="panel-body nopadding">
                        <form class="form-horizontal form-bordered" id="frm-registro">
                            <input type="hidden" name="opcion" id="opcion" value="N">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Código</label>
                                <div class="col-sm-8">
                                    <input type="text" id="idseries" name="idseries" placeholder="Codigo" class="form-control empty" readonly="readonly" />
                                </div>
                            </div>
                            <!-- form-group -->    

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Sucursal</label>
                                <div class="col-sm-8">
                                    <select id="idsucursal" name="idsucursal" class="select-nosearch" data-placeholder="Seleccione una Categoria" class="form-control" style="width: 100%" required>
                                        <?php
                                            foreach ($sucursales as $key => $value) {
                                                echo '<option value="'.$value->idsucursal.'">'.$value->nombre.'</option>';
                                            }
                                         ?>
                                    </select>
                                </div>
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Comprobante</label>
                                <div class="col-sm-8">
                                    <select id="idcomprobantes" name="idcomprobantes" class="select-nosearch" data-placeholder="Seleccione una Categoria" class="form-control" style="width: 100%" required>
                                        <?php
                                            foreach ($comprobantes as $key => $value) {
                                                echo '<option value="'.$value->idcomprobantes.'">'.$value->nombre.'</option>';
                                            }
                                         ?>
                                    </select>
                                </div>
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Serie</label>
                                <div class="col-sm-4">
                                    <input type="text" id="codigoserie" name="codigoserie" placeholder="Serie" class="form-control empty" required />
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="correlativo" name="correlativo" placeholder="Correlativo" class="form-control empty entero" required />
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="longitudcorrelativo" name="longitudcorrelativo" placeholder="Tamaño" class="form-control empty entero" required />
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

<script>
    var $grid = $("#tdatos"),
        newWidth = $grid.closest(".ui-jqgrid").parent().width();
    $.jgrid.defaults.width = newWidth;
    $.jgrid.defaults.responsive = true;
    $.jgrid.defaults.styleUI = 'Bootstrap';
</script>

<script type="text/javascript">
    $(function(){
        series={
            init:function()
            {
                series.event();
                series.validate();
                series.getcategoria();
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

               	$(".entero").numeric(false);

                $(".select-nosearch").select2({
                    minimumResultsForSearch: -1
                });				

                $(".btn-save").click(function(event)
                {
                    event.returnValue = false; 
                    if(event.preventDefault) event.preventDefault();
                    $("#frm-registro").submit();
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
                    series.loadfields(rowData);

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
                    series.loadfields(rowData);

                    bootbox.confirm({
                        title: "Series",
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
                                series.setcategoria($("#frm-registro"));
                        }
                    });                    
                }); 
            }
            ,loadfields:function(rowData)
            {
                $("#idseries").val(rowData.idseries);
                $("#idsucursal").val(rowData.idsucursal).trigger('change');;
                $("#idcomprobantes").val(rowData.idcomprobantes).trigger('change');;      

                $("#codigoserie").val(rowData.codigoserie); 
                $("#correlativo").val(rowData.correlativo); 
                $("#longitudcorrelativo").val(rowData.longitudcorrelativo); 
                
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
                        series.setcategoria(form);
                    }
                });                 
            }
            ,getcategoria:function()
            {
                var wurl="<?php echo base_url('series/list'); ?>";
                $("#tdatos").jqGrid({
                        url: wurl,
                        mtype: "get",
                        styleUI : 'Bootstrap',
                        responsive: true,
                        postData: {'token':$('input[name=token]').val()},
                        datatype: "json",
                        colModel: [
                            { label: '...', name: 'CHASIS', frozen:true , width: 80, formatter:function(cellValue, opts, rowObject){return '<button class="btn btn-success btn-xs edit-modal" data-id=' + rowObject.idseries + '><span class="fa fa-pencil"></span></button> <button class="btn btn-danger btn-xs delete-modal" data-id=' + rowObject.idseries + '><span class="fa fa-trash-o"></span></button>';}},
                            { label: 'Codigo', name: 'idseries', key: true, width: 75 },
                            { label: 'idsucursal', name: 'idsucursal', width: 1 },
                            { label: 'idcomprobantes', name: 'idcomprobantes', width: 1 },
                            { label: 'Comprobante', name: 'comprobante', width: 150 },                             
                            { label: 'Serie', name: 'codigoserie', width: 120 },
                            { label: 'Correlativo', name: 'correlativo', width: 120 },
                            { label: 'Tamañao', name: 'longitudcorrelativo', width: 120 },                         
                            { label: 'Sucursal', name: 'sucursal', width: 200 },                            
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
                            series.eventload();
                        },                        
                        sortname: 'idseries',
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
                $("#tdatos").jqGrid('hideCol',['idsucursal','idcomprobantes']); 
            }

           ,setcategoria(form)
           {
                var wurl="<?php echo base_url('series/store'); ?>";
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
                                    wmnesaje='La Categoria ' +  $("#descripcion").val() + ' se ha generado!'
                                }
                                else if ($("#opcion").val()=='U'){
                                    wmnesaje='La Categoria ' +  $("#descripcion").val() + ' se ha actualizado!'
                                }

                                else if ($("#opcion").val()=='D'){
                                    wmnesaje='La Categoria ' +  $("#descripcion").val() + ' se ha elimiado!'
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
        series.init();
    })
</script>