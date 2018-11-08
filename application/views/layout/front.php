<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo SIS_NAME.' :: '.$titulo; ?></title>

        <link href="<?php echo base_url();?>assets/css/style.default.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/js/jqgrid/ui.jqgrid-bootstrap.css"> 
        <link href="<?php echo base_url();?>assets/css/select2.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/css/app.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/css/jquery.gritter.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" rel="stylesheet">        
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
        <script src="<?php echo base_url();?>assets/js/jqgrid/grid.locale-es.js" ></script>
        <script src="<?php echo base_url();?>assets/js/jqgrid/jquery.jqGrid.js" ></script>
        <script src="<?php echo base_url();?>assets/js/select2.min.js"></script>    
        <script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>    
        <script src="<?php echo base_url();?>assets/js/jquery.numeric.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.gritter.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/waitingfor.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.es.min.js"></script>
    </head>

    <body>
        
        <?php  if($header) echo $header; ?>

        <section>
            <div class="mainwrapper">

              <?php  if($left)   echo $left; ?>
              <?php  if($middle) echo $middle; ?>
              <?php  if($footer) echo $footer; ?>
              <?php  if($controlsidebar) echo $controlsidebar; ?>
            </div><!-- mainwrapper -->
        </section>    
    </body>
</html>

<script type="text/javascript">

  
  $(function () {
      var url=window.location
      $('.parent a').each(function(e){
          var link = $(this).attr('href');
          if (link.substr(link.length - 1)=="#")
          {}else
          {
            if(link==url){            
                //$(this).parent('li').parent('li').addClass('active');
                //$(this).parent('li').addClass('active');
                $(this).parents('li').addClass('active');
                //$(this).closest('.treeview').addClass('active');
            }
          }
      }); 
    });
</script> 
