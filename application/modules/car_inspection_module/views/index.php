 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Today Inspections</h4>
                        <?php foreach ($today_inspections as $values) {
                            # code...
                        }?>
                        <div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $values->today_data;?>" ><span class="percent"><?php echo $values->today_data;?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>All Inspections</h4>
                        <?php foreach ($all_inspection as $val) {
                            
                        }?>
                        <div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $val->all_data;?>" ><span class="percent"><?php echo $val->all_data;?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Today Fees Amount</h4>
                        <?php foreach ($today_fees as $fees) {
                            # code...
                        }?>
                        <div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $fees->all_fees;?>" ><span class="percent"><?php echo $fees->all_fees;?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>All Inspection Amount</h4>
                        <?php foreach ($all_fees as $all) {
                            # code...
                        }?>
                        <div class="easypiechart" id="easypiechart-red" data-percent="100" ><span class="percent"><?php echo $all->all_inspection_fees;?></span></div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

         <div class="row">
           
           
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Today Office Share</h4>
                        <?php foreach ($office_share as $office) {
                            # code...
                        }?>
                        <div class="easypiechart" id="easypiechart-teal" data-percent="100" ><span class="percent"><?php echo $office->ofc_share;;?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Today Mul Share</h4>
                        <div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent"><?php echo $office->mul_share;?></span></div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
        
        <div class="row">
           
            
            
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        Notifications
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body timeline-container">
                        <ul class="timeline">
                            <li>
                                <div class="timeline-badge"><em class="glyphicon glyphicon-pushpin"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at sodales nisl. Donec malesuada orci ornare risus finibus feugiat.</p>
                                    </div>
                                </div>
                            </li>
                           
                           
                            <li>
                                <div class="timeline-badge"><em class="glyphicon glyphicon-paperclip"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!--/.col-->
            <div class="col-sm-12">
                <p class="back-link">Copy all right Reserved by <a href="https://www.mul.com.pk">Mul</a></p>
            </div>
        </div><!--/.row-->
    </div>  <!--/.main-->