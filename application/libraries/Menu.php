<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

class Menu  {
   
 private $CI;
 private $men=array();
 private $data;

  function __construct()
    {
  		$this->CI =& get_instance();
  		$this->CI->load->model('UsuarioModel'); 
    }


  function display_children($arr,$parent, $level) {
	  	//print_r($result);  		

  		$clsul="";
		$ei="";
		$eflecha="";
		//$eflecha='<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';
  		if ($level==0){
  			$clsul="nav nav-pills nav-stacked";
  			//$ei="<i class='fa fa-dashboard'></i>";
  			
  		}elseif ($level>0) {
  			$clsul="children";
  		}



	  	$this->men[] = '<ul class = "'.$clsul.'">';
	  	foreach ($arr as $key => $value) {
	       //variables para armar cabezera
	       $var_prt = $value['parent'];
	       $var_idp = $value['id'];	
		   $var_lbl = ucwords(strtolower($value['nombre']));
		   $count = $value['count']; 
		   $icon_web= $value['icono'];
		   $linked=$value['url'];

		   $url="#";
		   if (strlen(trim($linked))>0)
		   {	
		   		$base=base_url().'';
		   		//echo $base;
		   		$url=$base.$linked;
		   }

		   //Verificando si hay icono
		   if (strlen(trim($icon_web))>0 && $level==0)
		   {
		   		$ei="<i class='fa ".$icon_web."'></i>";
		   }

		   if ($count>0)
		   {
		   		$this->men[]="<li class='parent'><a href='".$url."'>" .$ei.' <span>'.$var_lbl. "</span>".$eflecha."</a>";	
				$r=$this->findNameFromID($this->data,$var_idp);
		   		$this->display_children($r,$var_idp, $level + 1);		   		
		   		$this->men[]="</li>";
		   }elseif ($count==0) {
		   		$this->men[]="<li><a href='".$url."'>" .$ei.'<span>'. $var_lbl . " </span></a></li>";
		   }else;	   
	  	}

	  	$this->men[] = '</ul>';
	}

   function construyemenu($idempresa,$usuario)
   {
   		$this->men[]='';
	   	$result=$this->CI->UsuarioModel->getusuariomenu($idempresa,$usuario);
	   	$this->data=$result;	   
	   	$r=$this->findNameFromID($this->data,1);
	   	$this->display_children($r,1,0);
	   	return $this->men;
   }

	function findNameFromID($array,$ID) {
	    $results = array_values(array_filter($array, function($arrayValue) use($ID) { return $arrayValue['parent'] == $ID; } ));	   
	    if (count($results) > 0) {
	        return $results;
	    } else {
	        return FALSE;
	    }
	    return $results;
	}
} 