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
                <h4><?php echo $titulo; ?></h4> 
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">  
        <form id="frmdata">
        <input type="hidden" name="opcion" id="opcion" value="U">
        <?php echo form_hidden('token', $token) ?>        
        <!-- CONTENT GOES HERE --> 
			<div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-btns" style="display: none;">
                        <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></a>
                    </div><!-- panel-btns -->
                    <h4 class="panel-title">Datos de la Empresa</h4>
                    <p>Información básica de la empresa.</p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">RUC*</label>
                                <input type="text" name="ruc" id="ruc" readonly="readonly" class="form-control input-sm" value="<?php echo $datempresa->RUC; ?>" required >
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="control-label">Razon Social*</label>
                                <input type="text" name="razon" id="razon" class="form-control input-sm" value="<?php echo $datempresa->RazonSocial; ?>" required >
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="control-label">Nombre Comercial*</label>
                                <input type="text" name="comercial" id="comercial" class="form-control input-sm" required value="<?php echo $datempresa->razoncomercial; ?>">
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 -->                          
                    </div>                                     
                </div><!-- panel-body -->
            </div> 

			<div class="row">
                <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-btns" style="display: none;">
                                    <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></a>
                                </div><!-- panel-btns -->
                                <h4 class="panel-title">Ubicación y Referencias</h4>
                                <p>información de dirección, ubigeo y teléfonos.</p>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Dirección*</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="direccion" id="direccion" class="form-control input-sm" required value="<?php echo $datempresa->Direccion; ?>">
                                    </div>
                                </div><!-- form-group -->
                            
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ubigeo*</label>
                                    <div class="col-sm-10">
		                                <div class="input-group">
		                                    <input type="hidden" class="form-control" name="idubigeo" id="idubigeo" value="<?php echo $datempresa->IdUbigeo; ?>">
		                                    <input type="text" class="form-control input-sm" name="ubigeo" id="ubigeo" required readonly="readonly" value="<?php echo $datempresa->formato1; ?>">
		                                    <span class="input-group-btn">
                                            <a type="button" id="search-ubigeo" class="btn btn-primary input-sm btn-ubigeo" data-toggle="modal" data-target=".bs-ubigeo-modal-lg">...</a>
		                                    </span>
		                                </div>
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tlf. / Cel.</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="telefono01" id="telefono01" class="form-control input-sm" value="<?php echo $datempresa->telefono01; ?>">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" name="telefono02" id="telefono02" class="form-control input-sm" value="<?php echo $datempresa->telefono02; ?>">
                                    </div>                                    
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Emial</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="email" id="email" class="form-control input-sm" value="<?php echo $datempresa->email; ?>">
                                    </div>
                                </div><!-- form-group -->                                

                            </div><!-- panel-body -->
                        </div><!-- panel-default -->
                </div><!-- col-md-6 -->
                
                <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-btns" style="display: none;">
                                    <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></a>
                                </div><!-- panel-btns -->
                                <h4 class="panel-title">Logo</h4>
                                <p>La imagen debe de ser de 500x500 pixeles en formato .png o .jpg</p>
                            </div>
                            <div class="panel-body">
                                <input type="hidden" name="logolast" id="logolast" value="<?php echo $datempresa->RutaLogo; ?>">
								<input type="file" name="logo" id="logo" accept="image/x-png,image/jpeg" />
								<div style="max-height: 174px;text-align: center;">
                                    <?php 
                                        if (strlen($datempresa->RutaLogo)>0)
                                        {
                                            $ruta=base_url().'assets/sys/logos/'.$datempresa->RutaLogo;
                                            echo '<img id="thumbnil" style="width:20%; margin-top:10px;"  src='.$ruta.' alt="image"/>';
                                        }
                                        else
                                        {
                                            echo '<img id="thumbnil" style="width:20%; margin-top:10px;"  src="" alt="image"/>';
                                        };
                                    ?>
								</div>				
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                </div><!-- col-md-6 -->
            </div>


			<div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-btns" style="display: none;">
                        <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></a>
                    </div><!-- panel-btns -->
                    <h4 class="panel-title">Datos para la firma de documentos</h4>
                    <p>Carga de Usuario y Clave SOL segundario, carga de firma digital (.pfx) y clave</p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">Usuario SOL</label>
                                <input type="text" name="usuariosol" id="usrsol" class="form-control input-sm" value="<?php echo $datempresa->usuariosol; ?>">
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">Clave SOL</label>
                                <input type="text" name="clavesol" id="clavesol" class="form-control input-sm" value="<?php echo $datempresa->clavesol; ?>">
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Subir Fima 
                                    <?php
                                        if (strlen($datempresa->rutafirma)>0)
                                        {
                                            echo '<span class="label label-success">Ya hay una firma Cargada!</span>';
                                        }else
                                        {
                                            echo '<span class="label label-danger">No existe firma!</span>';
                                        }
                                    ?>
                                </label>
                                <input type="hidden" name="firmalast" id="firmalast" value="<?php echo $datempresa->rutafirma; ?>">
                                <input type="file" name="firma" id="firma" onchange="empresa.validarfirma(this);" />
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">Clave Firma</label>
                                <input type="text" name="clavefirma" id="clavefirma" class="form-control input-sm" value="<?php echo $datempresa->clavefirma; ?>">
                            </div><!-- form-group -->
                        </div><!-- col-sm-6 -->
                    </div>                                     
                </div><!-- panel-body -->
            </div>

           <div class="panel panel-default comprobantes" style="margin-bottom: 10px;">
                    <div class="panel-body" style="padding: 10px 20px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3 mb5"><a href="#" class="btn btn-block btn-primary btn-lg btnguardar"><span class="fa fa-file-text"></span> Guardar</a></div>
                            </div>
                    </div>
                </div>
            </div>
        </form>
    </div><!-- contentpanel -->    
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
	$(function()
	{

        var archivo = null;

		empresa={
			init:function()
			{
				empresa.event();
				empresa.validate();
                empresa.getubigeo();
			}
			,event:function(){

                $(".btn-sel-ubigeo").click(function(event){
                    event.returnValue = false; /*para I.E.*/
                    if(event.preventDefault) event.preventDefault();

                    var selr = $("#tubigeo").jqGrid('getGridParam', 'selrow');
                    var rowData = $("#tubigeo").jqGrid('getRowData', selr)
                    $("#idubigeo").val(rowData.codigo);
                    $("#ubigeo").val(rowData.formato1);

                    $('.bs-ubigeo-modal-lg').modal('hide');
                });

                $(".btnguardar").click(function(event){
                    event.returnValue = false; /*para I.E.*/
                    if(event.preventDefault) event.preventDefault();
                    $("#frmdata").submit();
                    //empresa.setempresa($("#frmdata"))
                });
    
                $('#logo').on('change', function(event) {
                    empresa.showMyImage(this);
                });                
			}
			,validate:function(){
                $("#frmdata").validate({
                    highlight: function(element) {
                        jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                    },
                    success: function(element) {
                        jQuery(element).closest('.form-group').removeClass('has-error');
                    }
                    ,submitHandler: function(form) {
                        empresa.setempresa(form)
                    }
                }); 
			}
			,showMyImage:function(fileInput) {
			        var files = fileInput.files;
			        for (var i = 0; i < files.length; i++) {           
			            var file = files[i];
			            var imageType = /image.*/;     
			            if (!file.type.match(imageType)) {
			                continue;
			            }           
			            var img=document.getElementById("thumbnil");            
			            img.file = file;    
			            var reader = new FileReader();
			            reader.onload = (function(aImg) { 
			                return function(e) { 
			                    aImg.src = e.target.result; 
			                }; 
			            })(img);
			            reader.readAsDataURL(file);
			        }    
		    }
           ,setempresa(form)
            {
                var file_data = $('#logo').prop('files')[0];   
                var file_firma = $('#firma').prop('files')[0]; 
                var datos = new FormData();
                $('#frmdata input[type=text], #frmdata input[type=hidden]').each(function () {
                    //config[this.name] = this.value;
                    datos.append(this.name, this.value); 
                });
                datos.append('logo', file_data); 
                datos.append('firma', file_firma);
                //console.log(datos);


                var wurl="<?php echo base_url('empresa/store'); ?>";
                $.ajax({
                    async: true,
                    url: wurl,
                    type: "post",
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    data:datos
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
                                bootbox.alert("Se generó actualizo la información de la empresa!",function(){
                                    window.location.href=window.location.href;
                                });
                            }
                            else
                            {
                                  waitingDialog.hide();
                                  bootbox.alert("Error! : " + wmsg); 
                            }
                        }else
                        {
                          waitingDialog.hide();
                          bootbox.alert("Error! : Ocurrio algo inesperado, intente más tarde!");                             
                        }
                    }
                });          
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
            ,validarfirma:function(oInput) {
                    var _validFileExtensions = [".pfx"]; 
                    if (oInput.type == "file") {
                        var sFileName = oInput.value;
                         if (sFileName.length > 0) {
                            var blnValid = false;
                            for (var j = 0; j < _validFileExtensions.length; j++) {
                                var sCurExtension = _validFileExtensions[j];
                                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                    blnValid = true;
                                    break;
                                }
                            }
                             
                            if (!blnValid) {
                                bootbox.alert("Error el archivo " + sFileName + " es inválido!, no cumple con la extensión solicitada!");  
                                oInput.value = "";
                                return false;
                            }
                        }
                    }
                    return true;
                }
		}
		empresa.init();
	});
</script>