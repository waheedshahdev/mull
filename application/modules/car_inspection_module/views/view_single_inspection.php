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
                        <?php foreach ($single_inspection as $single){
            }?>
          
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>car_inspection_module/update_single_inspection" method="post">
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">District</label>

                  <div class="col-sm-8">
                   <select name="office_id" id="office_id" class="form-control" disabled="">
                      <?php foreach ($office_data as $values):?>
                        <option value="<?php echo $values->id;?>" <?php if(isset($single->office_id) && ($single->office_id == $values->id)) echo 'selected="selected"';?>><?php echo $values->office_name;?></option>
                    <?php endforeach;?>
                   </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Car Number</label>

                  <div class="col-sm-8">
                    <input type="hidden" name="inspect_id" value="<?php echo $this->uri->segment(3);?>">
                    <input type="text" name="car_number" class="form-control" id="inputEmail3" value="<?php echo $single->car_number?>" placeholder="Enter Car Number" required="" disabled="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">A/C is Working?</label>

                  <div class="col-sm-8">
                   <select name="ac" id="ac" class="form-control">
                      <option value="Yes" <?php if(isset($single->ac) && ($single->ac == "Yes")) echo 'selected="selected"';?>>Yes</option>
                      <option value="No" <?php if(isset($single->ac) && ($single->ac == "No")) echo 'selected="selected"';?>>No</option>
                   </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Black Mirrors?</label>

                  <div class="col-sm-8">
                    <select name="black_mirrors" id="black_mirrors" class="form-control">
                      <option value="Yes" <?php if(isset($single->black_mirrors) && ($single->black_mirrors == "Yes")) echo 'selected="selected"';?>>Yes</option>
                      <option value="No" <?php if(isset($single->black_mirrors) && ($single->black_mirrors == "No")) echo 'selected="selected"';?>>No</option>
                   </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Tyre is Good?</label>

                  <div class="col-sm-8">
                   <select name="tyre" id="tyre" class="form-control">
                     <option value="Yes" <?php if(isset($single->tyre) && ($single->tyre == "Yes")) echo 'selected="selected"';?>>Yes</option>
                      <option value="No" <?php if(isset($single->tyre) && ($single->tyre == "No")) echo 'selected="selected"';?>>No</option>
                   </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Orignal Number Plates</label>

                  <div class="col-sm-8">
                   <select name="original_number_plates" id="original_number_plates" class="form-control">
                      <option value="Yes" <?php if(isset($single->original_number_plates) && ($single->original_number_plates == "Yes")) echo 'selected="selected"';?>>Yes</option>
                      <option value="No" <?php if(isset($single->original_number_plates) && ($single->original_number_plates == "No")) echo 'selected="selected"';?>>No</option>
                   </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Seat Condition is Good?</label>

                  <div class="col-sm-8">
                   <select name="seats_condition" id="seats_condition" class="form-control">
                      <option value="Yes" <?php if(isset($single->seats_condition) && ($single->seats_condition == "Yes")) echo 'selected="selected"';?>>Yes</option>
                      <option value="No" <?php if(isset($single->seats_condition) && ($single->seats_condition == "No")) echo 'selected="selected"';?>>No</option>
                   </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Suspension is Good?</label>

                  <div class="col-sm-8">
                   <select name="suspension" id="suspension" class="form-control">
                      <option value="Yes" <?php if(isset($single->suspension) && ($single->suspension == "Yes")) echo 'selected="selected"';?>>Yes</option>
                      <option value="No" <?php if(isset($single->suspension) && ($single->suspension == "No")) echo 'selected="selected"';?>>No</option>
                   </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Music System  in Car?</label>

                  <div class="col-sm-8">
                   <select name="music_system" id="music_system" class="form-control">
                      <option value="Yes" <?php if(isset($single->music_system) && ($single->music_system == "Yes")) echo 'selected="selected"';?>>Yes</option>
                      <option value="No" <?php if(isset($single->music_system) && ($single->music_system == "No")) echo 'selected="selected"';?>>No</option>
                   </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Inspection Fees</label>

                  <div class="col-sm-8">
                  <input type="text" name="inspection_fees" class="form-control" id="inputEmail3" value="<?php echo $single->inspection_fees;?>" placeholder="Enter Fees" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Status</label>

                  <div class="col-sm-8">
                   <select name="status" id="status" class="form-control" disabled="">
                      <option value="Not Approved" <?php if(isset($single->status) && ($single->status == "Not Approved")) echo 'selected="selected"';?>>Not Approved</option>
                      <option value="Approved" <?php if(isset($single->status) && ($single->status == "Approved")) echo 'selected="selected"';?>>Approved</option>
                   </select>
                  </div>
                </div>
               

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
               <!--  <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" name="submit" value="Submit" class="btn btn-info btn-block">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
                    </div>
                </div>
            </div><!--/.col-->
            <div class="col-sm-12">
                <p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
            </div>
        </div><!--/.row-->
    </div>  <!--/.main-->