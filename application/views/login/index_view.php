<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo SIS_NAME.' :: Login'; ?></title>

        <link href="<?php echo base_url();?>assets/css/style.default.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/css/app.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->        
        <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/pace.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/retina.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.cookies.js"></script>
        <script src="<?php echo base_url();?>assets/js/custom.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>    
        <script src="<?php echo base_url();?>assets/js/jquery.numeric.js"></script> 
    </head>

    <body class="signin">    
        <section>            
            <div class="panel panel-signin">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?php echo base_url();?>assets/images/logo-primary.png" alt="CodesiFact" >
                    </div>
                    <br />
                    <div class="mb30"></div>
                    <div class="alert alert-danger" id="alert" style="display: none">
                       <span id="alert-mensaje"></span>
                    </div>                    
                     <form id="frmlogin">

                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="fa fa-university"></i></span>
                            <input type="text" class="form-control entero" placeholder="Ingrese su RUC" name="ruc" required maxlength="11">
                        </div><!-- input-group -->

                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" placeholder="Ingrese su usuario" name="loggin" required>
                        </div><!-- input-group -->
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Ingrese su Contraseña" name="password" required>
                        </div><!-- input-group -->
                        
                        <div class="clearfix">
                            <button type="submit" name="submit" id="submit" class="btn btn-success btn-block">Iniciar Sesión <i class="fa fa-angle-right ml5"></i></button>
                        </div>
                        <?php echo form_hidden('token', $token) ?>                 
                    <?php echo form_close() ?>
                    
                </div><!-- panel-body -->
                <!--<div class="panel-footer">
                    <a href="#" class="btn btn-primary btn-block">No tienes cuenta!, mira nuestra planes</a>
                </div> panel-footer -->
            </div><!-- panel -->            
        </section>
    </body>
</html>

<script type="text/javascript">
   $(function() {
      var login={
            init:function()
            {
                login.event();
                login.validate();
            }
            ,event:function()
            {
                $('.entero').numeric(false);
            }
            ,validate:function()
            {
                jQuery("#frmlogin").validate({
                    highlight: function(element) {
                        jQuery(element).closest('.input-group').removeClass('has-success').addClass('has-error');
                    },
                    success: function(element) {
                        jQuery(element).closest('.input-group').removeClass('has-error');
                    }
                    ,submitHandler: function(form) {
                        $("#alert-mensaje").html("");
                        $("#alert").hide();
                        login.loggin(form);
                    }
                });                
            }
           ,loggin:function(form)
           {
                var wurl =  "<?php echo base_url('login/user_login');?>"
                $.ajax({
                   async: true,
                   url: wurl,
                   type: "post",
                   dataType: 'json',  
                   contentType: 'application/x-www-form-urlencoded', 
                   data:$(form).serialize()
                  , beforeSend: function(data){
                   }
                   ,complete: function(data, status){ 
                        var werror=JSON.parse(data.responseText).error;
                        var wmsg=JSON.parse(data.responseText).mensaje;
                        if (werror==0)
                        {
                            $("#submit").attr('disabled','disabled');
                            window.location.href = "<?php echo base_url('home');?>"; 
                        }
                        else
                        {
                            $("#alert-mensaje").html(wmsg);
                            $("#alert").show();
                        }
                   }
             });                 
           }
        }
        login.init();
    });
</script>
