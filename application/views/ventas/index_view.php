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
                <h4><?php echo $titulo; ?> 
                </h4>  
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->    
    <div class="contentpanel"> 
        <?php echo form_hidden('token', $token) ?>        
        <!-- CONTENT GOES HERE -->    
       <div class="panel panel-default comprobantes" style="margin-bottom: 10px;">
                <div class="panel-body" style="padding: 10px 20px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-3 mb5"><a href="<?php echo base_url('ventas/emision/03'); ?>" class="btn btn-block btn-primary btn-lg"><span class="fa fa-file-text"></span> Boletas</a></div>
                            <div class="col-lg-3 mb5"><a href="<?php echo base_url('ventas/emision/01'); ?>" class="btn btn-block btn-success btn-lg"><span class="fa fa-file-text"></span> Facturas</a></div>
                            <div class="col-lg-3 mb5"><a href="#" class="btn btn-block btn-warning btn-lg"><span class="fa fa-files-o"></span> Nota Crédito</a></div>
                            <div class="col-lg-3 mb5"><a href="#" class="btn btn-block btn-info btn-lg"><span class="fa fa-files-o"></span> Nota Débito</a></div>
                        </div>
                </div>
            </div>
        </div>

       <div class="panel panel-default comprobantes">
                <div class="panel-body">
                    <div class="row">
                        <table id="tdatos"> </table> 
                        <div id="pager"></div>         
                   </div>
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
        venta={
            init:function()
            {
                venta.getventas();
            }
            ,event:function()
            {}
            ,validate:function()
            {}
            ,getventas:function()
            {
                var wurl="<?php echo base_url('ventas/list'); ?>";
                $("#tdatos").jqGrid({
                        url: wurl,
                        mtype: "get",
                        styleUI : 'Bootstrap',
                        responsive: true,
                        postData: {'token':$('input[name=token]').val()},
                        datatype: "json",
                        colModel: [
                            { label: '...', name: 'CHASIS', frozen:true , width: 120, formatter:function(cellValue, opts, rowObject){return '<button class="btn btn-success btn-xs edit-modal" data-id=' + rowObject.IdProducto + '><span class="fa fa-file-code-o"></span></button> <button class="btn btn-danger btn-xs delete-modal" data-id=' + rowObject.IdProducto + '><span class="fa fa-file-pdf-o"></span></button> <button class="btn btn-primary btn-xs delete-modal" data-id=' + rowObject.IdProducto + '><span class="fa fa-archive"></span></button>';}},
                            { label: 'Nro Venta', name: 'idmovimiento', key: true, width: 75 },
                            { label: 'Sucursal', name: 'sucursal', width: 100 },
                            { label: 'Documento', name: 'comprobante', width: 180 },
                            { label: 'Serie', name: 'codigoserie', width: 60 },
                            { label: 'Nro. Documento', name: 'nrocomprobante', width: 120 },
                            { label: 'Fecha Emisión', name: 'fechaemision', width: 120 },
                            { label: 'DNI/RUC', name: 'cli_nrodoc', width: 100 },
                            { label: 'Cliente', name: 'cli_nombre', width: 200 },
                            { label: 'Moneda', name: 'moneda', width: 80 },
                            { label: 'Total Venta', name: 'total', width: 80 },
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
                        sortname: 'idmovimiento',
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
              $("#tdatos").jqGrid('hideCol',['CodigoTipo','IdCategoria']); 
            }
        }
        venta.init();
    });
 </script>   