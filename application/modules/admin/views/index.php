<div class="container-fluid">
            <div class="row-fluid">
              <!--   <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li class="active">
                            <a href="index.html"><i class="icon-chevron-right"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="calendar.html"><i class="icon-chevron-right"></i> Calendar</a>
                        </li>
                        <li>
                            <a href="stats.html"><i class="icon-chevron-right"></i> Statistics (Charts)</a>
                        </li>
                        <li>
                            <a href="form.html"><i class="icon-chevron-right"></i> Forms</a>
                        </li>
                        <li>
                            <a href="tables.html"><i class="icon-chevron-right"></i> Tables</a>
                        </li>
                        <li>
                            <a href="buttons.html"><i class="icon-chevron-right"></i> Buttons & Icons</a>
                        </li>
                        <li>
                            <a href="editors.html"><i class="icon-chevron-right"></i> WYSIWYG Editors</a>
                        </li>
                        <li>
                            <a href="interface.html"><i class="icon-chevron-right"></i> UI & Interface</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-success pull-right">731</span> Orders</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-success pull-right">812</span> Invoices</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-info pull-right">27</span> Clients</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-info pull-right">1,234</span> Users</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-info pull-right">2,221</span> Messages</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-info pull-right">11</span> Reports</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-important pull-right">83</span> Errors</a>
                        </li>
                        <li>
                            <a href="#"><span class="badge badge-warning pull-right">4,231</span> Logs</a>
                        </li>
                    </ul>
                </div> -->
                
                <!--/span-->
                <div class="span12" id="content">
                    <div class="row-fluid">
                       
                          <div class="navbar">
                              <div class="navbar-inner">
                                  <ul class="breadcrumb">
                                      <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                                      <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                                      <li>
                                          <a href="#">Dashboard</a> <span class="divider">/</span>  
                                      </li>
                                      <li>
                                          <a href="#">Settings</a> <span class="divider">/</span> 
                                      </li>
                                      <li class="active">Tools</li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                 <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Statistics</div>
                            
                            </div>
                            <div class="block-content collapse in">
                                <div class="span4">
                                    <div class="chart" data-percent="<?php echo $today_vendors;?>"><b><?php echo $today_vendors;?></b></div>
                                    <div class="chart-bottom-heading"><!-- <span class="label label-info">Visitors</span> -->
                            
                               
                                        <h3> Today's Vendor Reg</h3>

                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="chart" data-percent="<?php echo $today_cars;?>"><b><?php echo $today_cars;?></b></div>
                                    <div class="chart-bottom-heading"><!-- <span class="label label-info">Today's Car Reg</span> -->
                                        <h3> Today's Car Reg</h3>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="chart" data-percent="<?php echo $today_captains;?>"><b><?php echo $today_captains;?></b></div>
                                    <div class="chart-bottom-heading"><!-- <span class="label label-info">Users</span> -->
                                        <h3> Today's Captain Reg</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Vendor Registration</div>
                                  
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Vendor Register</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                  
                                            foreach($total_vendor_register as $reg){
                                                
                                            
                                                ?>
                                            <tr>
                                                <td><?php echo $reg->name;?></td>
                                                <td><?php echo $reg->email;?></td>
                                                <td><?php echo $reg->v_cnt;?></td>
                                            </tr>
                                        <?php 
                                    }
                                        ?>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>

                         <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Captain Registration</div>
                                   
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Captain Register</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                  
                                            foreach($total_captain_register as $reg){
                                                
                                            
                                                ?>
                                            <tr>
                                                <td><?php echo $reg->name;?></td>
                                                <td><?php echo $reg->email;?></td>
                                                <td><?php echo $reg->C_cnt;?></td>

                                            </tr>
                                        <?php 
                                    }
                                        ?>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                      
                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Cars Registration</div>
                                 
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Car Registration</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                  
                                            foreach($total_car_register as $reg){
                                                
                                            
                                                ?>
                                            <tr>
                                                <td><?php echo $reg->name;?></td>
                                                <td><?php echo $reg->email;?></td>
                                                <td><?php echo $reg->CAR_cnt;?></td>
                                            </tr>
                                        <?php 
                                    }
                                        ?>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                      
                    </div>
                  
             
                </div>
            </div>