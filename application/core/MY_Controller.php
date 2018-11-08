<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller {

    //set the class variable.
    public $template  = array();
    public $data      = array();

    public function __construct() {
        parent::__construct();
        //$this->load->helper('url');
         //comprobamos si el usuario está logueado

        date_default_timezone_set('America/Lima');

         if($this->auth->is_logged() == FALSE)
         {  
            redirect(base_url('login'));
         }
    }
 
    //Layout
    public function layout($view, $params = null)
    {
        $this->template['header']   = $this->load->view('layout/header', $this->data, true);
        $this->template['left']   = $this->load->view('layout/left', $this->data, true);
        $this->template['middle'] = $this->load->view($view, $params, true);
        $this->template['footer'] = $this->load->view('layout/footer', $this->data, true);
        $this->template['controlsidebar'] = $this->load->view('layout/controlsidebar', $this->data, true);
        $this->load->view('layout/front', $this->template);
    }

/*
    //Grilla
    public function jq_getdata($request,$datain)
    {
        $page = $request['page'];
        $limit =$request['rows'];

        $count=count($datain);  //$data_count->COUNT;                
        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        } 

        if ($page > $total_pages)
        {
            $page=$total_pages;
        }
        $data=$datain;
        $responce=array("__type"=>"JqGridData",'page'=>$page,'total'=>$total_pages,'records'=>$count,'rows'=>$data); 
        return json_encode($responce);
    }

    public function jq_getatributes($request,$datacount)
    {
        //Obteniendo Limites para la Grilla
        $page = $request['page'];
        $limit =$request['rows'];
        $count=count($datacount);
        $total_pages = 0;
        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
        }
        else
        {
            $total_pages = 0;
        }

        if ($page > $total_pages)
        {
            $page=$total_pages;
        }
        $start = $limit*$page - $limit;
        $limit = $limit*$page;

        //Obteniendo Filtros para la Grilla
        $where = ""; //if there is no search request sent by jqgrid, $where should be empty
        $searchField =''; //$_POST['searchField'];
        $searchOper ='';  //$_POST['searchOper']; //? $this->_request->getQuery('searchOper'): false;
        $searchString =''; //$_POST['searchString'];//? $this->_request->getQuery('searchString') : false;

        if (!$searchField) $searchField=false;
        if (!$searchOper) $searchOper=false;
        if (!$searchString) $searchString=false;

        $wh = "";
        $searchOn = $request['_search'];
        if($searchOn=='true') {
            $searchstr = $searchString =$request['filters'];
            $wh= $this->constructWhere($searchstr);
        }

        $result=array('start' => $start , 'limit' => $limit, 'filter'=>$wh);
        return $result;
    }

    public function jq_getfilter($request)
    {
        ///Parametros de Busqueda                 
        $where = ""; //if there is no search request sent by jqgrid, $where should be empty
        $searchField =''; //$_POST['searchField'];
        $searchOper ='';  //$_POST['searchOper']; //? $this->_request->getQuery('searchOper'): false;
        $searchString =''; //$_POST['searchString'];//? $this->_request->getQuery('searchString') : false; 

        if (!$searchField) $searchField=false;
        if (!$searchOper) $searchOper=false;
        if (!$searchString) $searchString=false;                
        
        $wh = "";
        $searchOn = $request['_search'];
        if($searchOn=='true') {
            $searchstr = $searchString =$request['filters'];
            $wh= $this->constructWhere($searchstr);
        }
        return $wh;
    }


    ///Rutinas de Busqueda
    function constructWhere($s)
            {
                $qwery = "";
                //['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
                $qopers = array(
                              'eq'=>" = ",
                              'ne'=>" <> ",
                              'lt'=>" < ",
                              'le'=>" <= ",
                              'gt'=>" > ",
                              'ge'=>" >= ",
                              'bw'=>" LIKE ",
                              'bn'=>" NOT LIKE ",
                              'in'=>" IN ",
                              'ni'=>" NOT IN ",
                              'ew'=>" LIKE ",
                              'en'=>" NOT LIKE ",
                              'cn'=>" LIKE " ,
                              'nc'=>" NOT LIKE " );
                
                if ($s) {
                    $jsona = json_decode($s,true);
                    if(is_array($jsona)){
                        $gopr = $jsona['groupOp'];
                        $rules = $jsona['rules'];
                        $i =0;
                        foreach($rules as $key=>$val){
                            $field = $val['field'];
                            $op = $val['op'];
                            $v = $val['data'];
                            if($v && $op) {
                                $i++;
                                // ToSql in this case is absolutley needed
                                $v = $this->ToSql($field,$op,$v);
                                if ($i == 1) $qwery = " WHERE ";
                                else $qwery .= " " .$gopr." ";
                                switch ($op) {
                                    case 'in' :
                                    case 'ni' :
                                        $qwery .= $field.$qopers[$op]." (".$v.")";
                                        break;
                                    default:
                                        $qwery .= $field.$qopers[$op].$v;
                                }
                            }
                        }
                    }
                }        
                return $qwery;       
            }

    function ToSql($field, $oper, $val)
    {
        // we need here more advanced checking using the type of the field - i.e. integer, string, float
        switch ($field) {
            case 'id':
                return intval($val);
                break;
            case 'amount':
            case 'tax':
            case 'total':
                return floatval($val);
                break;
            default :
                //mysql_real_escape_string is better
                ///if($oper=='bw' || $oper=='bn') return "'" . addslashes($val) . "%'";  
                if($oper=='bw' || $oper=='bn') return "'%" . addslashes($val) . "%'";
                else if ($oper=='ew' || $oper=='en') return "'%" . addcslashes($val) . "'";
                else if ($oper=='cn' || $oper=='nc') return "'%" . addslashes($val) . "%'";
                else return "'" . addslashes($val) . "'";
        }
    }
    */
}