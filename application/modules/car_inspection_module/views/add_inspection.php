 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active"><?php echo $title;?></li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $title;?></h1>
            </div>
        </div><!--/.row-->
        
        <div class="row">
         
            <?php 
                            if($this->session->flashdata("error_msg") != ''){?>
                            <div class="alert alert-success">
                                <button class="close" data-dismiss="alert"></button>
                                <?php echo $this->session->flashdata("error_msg");?>
                            </div>
                            <?php
                            }
                            ?>
            
            <div class="col-md-12">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        Inspection Form
                        
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body timeline-container">
                        <form action="<?php echo base_url();?>car_inspection_module/add_car_inspection" method="post"  >
                        <ul class="timeline">
                            <li>
                                <div class="timeline-badge primary"><em class="glyphicon glyphicon-pushpin"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Car Number</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <input type="hidden" value="<?php echo $this->session->userdata['office_id'];?>" name="office_id">
                                       <input id="btn-input" type="text" class="form-control input-md" name="car_number" required="" placeholder="Type Car Plate Number here...   Eg  AB-123" />
                                           
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge primary"><em class="glyphicon glyphicon-pushpin"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Car A/C is Working</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <label class="radio-inline">
                                              <input type="radio" name="ac" value="Yes" required="">Yes
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="ac" value="No">No
                                            </label>
                                           
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge primary"><em class="glyphicon glyphicon-link"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Black Mirrors</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <label class="radio-inline">
                                              <input type="radio" name="black_mirrors" value="Yes">Yes
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="black_mirrors" value="No">No
                                            </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge primary"><em class="glyphicon glyphicon-camera"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Tyre Condition is Good?</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <label class="radio-inline">
                                              <input type="radio" name="tyre" required="" value="Yes">Yes
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="tyre" value="No">No
                                            </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge primary"><em class="glyphicon glyphicon-camera"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Original Number Plates?</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <label class="radio-inline">
                                              <input type="radio" name="original_number_plates" required="" value="Yes">Yes
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="original_number_plates" value="No">No
                                            </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge primary"><em class="glyphicon glyphicon-camera"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Seats Condition is Good?</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <label class="radio-inline">
                                              <input type="radio" name="seats_condition" required="" value="Yes">Yes
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="seats_condition" value="No">No
                                            </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge primary"><em class="glyphicon glyphicon-camera"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Car Suspension is Good?</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <label class="radio-inline">
                                              <input type="radio" name="suspension" required="" value="Yes">Yes
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="suspension" value="No">No
                                            </label>
                                    </div>
                                </div>
                            </li>
                             <li>
                                <div class="timeline-badge"><em class="glyphicon glyphicon-camera"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">High Music system in Car?</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <label class="radio-inline">
                                              <input type="radio" name="music_system" required="" value="Yes">Yes
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="music_system" value="No">No
                                            </label>
                                    </div>
                                </div>
                            </li>
                             <li>
                                <div class="timeline-badge"><em class="glyphicon glyphicon-camera"></em></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Enter Car Inspection Fees</h4>
                                    </div>
                                    <div class="timeline-body">
                                       <input type="number" name ="inspection_fees" class="form-control input-md" placeholder="Enter Fees..." required="" >
                                    </div>
                                </div>
                            </li>
                            <br><br>
                             <li>
                                <div class="timeline-badge"><em class="glyphicon glyphicon-logout"></em></div>
                                <div class="timeline-panel">
                                   
                                    <div class="timeline-body">
                                       <input type="submit" class="btn btn-primary btn-block" value="Save" name="submit" >
                                    </div>
                                </div>
                            </li>
                            
                        </ul>
                        </form>
                    </div>
                </div>
            </div><!--/.col-->
            <div class="col-sm-12">
                <p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
            </div>
        </div><!--/.row-->
    </div>  <!--/.main-->