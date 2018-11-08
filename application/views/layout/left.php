<?php
$CI =& get_instance();
$CI->load->library('Menu');
$menu=array();
$s=$this->session->userdata();
$usuario=$s["login"];
$idempresa=$s["idempresa"];
$menu=$CI->menu->construyemenu($idempresa,$usuario);
?>

                <div class="leftpanel">
                    <div class="media profile-left">
                        <a class="pull-left profile-thumb" href="profile.html">
                            <img class="img-circle" src="<?php echo base_url();?>assets/images/photos/profile.png" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Elen Adarna</h4>
                            <small class="text-muted">Beach Lover</small>                        
                        </div>
                    </div><!-- media -->
                    
                    <h5 class="leftpanel-title">Menú de Opciones</h5>
                      <?php
                        foreach ($menu as $key => $value) {
                          # code...
                          echo $value;
                        }
                      ?>

                    <!--
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="index.html"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="messages.html"><span class="pull-right badge">5</span><i class="fa fa-envelope-o"></i> <span>Messages</span></a></li>
                        <li class="parent"><a href=""><i class="fa fa-suitcase"></i> <span>UI Elements</span></a>
                            <ul class="children">
                                <li><a href="alerts.html">Alerts &amp; Notifications</a></li>
                                <li><a href="buttons.html">Buttons</a></li>
                                <li><a href="extras.html">Extras</a></li>
                                <li><a href="graphs.html">Graphs &amp; Charts</a></li>
                                <li><a href="icons.html">Icons</a></li>
                                <li><a href="modals.html">Modals</a></li>
                                <li><a href="widgets.html">Panels &amp; Widgets</a></li>
                                <li><a href="sliders.html">Sliders</a></li>                                
                                <li><a href="tabs-accordions.html">Tabs &amp; Accordions</a></li>
                                <li><a href="typography.html">Typography</a></li>
                            </ul>
                        </li>                                        
                    </ul>
                -->
                    
                </div><!-- leftpanel -->