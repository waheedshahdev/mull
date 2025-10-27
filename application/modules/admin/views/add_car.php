<div class="container">
            <div class="row-fluid">   
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
                                     
                                      <li class="active"><?php echo $title;?></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo $title;?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                    <!-- BEGIN FORM-->
                    <form action="#" id="add_car_form" class="form-horizontal">
                        <fieldset>
                            <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                               
                            </div>
                            <div id="found_message">

                            </div>
                            

                            <input type = "hidden" name="vendor_id" id="vendor_id" value="<?php echo $this->uri->segment(3);?>">
                            
                            <div class="control-group">
                                <label class="control-label">Car Registration Number<span class="required">*</span></label>
                                <div class="controls">
                                	
                                    <input type="text" name="car_reg_number" id="car_reg_number" data-required="1" placeholder="Enter vendor Name" class="span6 m-wrap"/>
                                    <input type="hidden" name="office_id" id="office_id" value="<?php echo $this->session->userdata('office_id');?>">
                                    <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $this->session->userdata('id');?>">
                                </div>
                            </div>
                            <div class="control-group">
                                          <label class="control-label" for="select01">District</label>
                                          <div class="controls">
                                            <select id="district_id" name="district_id" class="chzn-select">
                                              <option>Select District</option>
                                              <?php foreach ($view_district as $district) {
                                              	# code...
                                              ?>
                                              <option value="<?php echo $district->id;?>"><?php echo $district->district_name;?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                            <div class="control-group">
                                          <label class="control-label" for="select01">Car Company</label>
                                          <div class="controls">
                                            <select id="car_company_id" name="car_company_id" class="chzn-select">
                                              <option>Select Car Company</option>
                                              <?php foreach ($view_car_company as $company) {
                                              	# code...
                                              ?>
                                              <option value="<?php echo $company->id;?>"><?php echo $company->name;?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                            <div class="control-group">
                                          <label class="control-label" for="select01">Car Type</label>
                                          <div class="controls">
                                            <select id="car_type_id" name="car_type_id" class="chzn-select">
                                              <option>Select Car Type</option>

                                              <?php foreach ($view_car_type as $type) {
                                              	# code...
                                              ?>
                                              <option value="<?php echo $type->id;?>"><?php echo $type->type_name;?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                            <div class="control-group">
                                          <label class="control-label" for="select01">Car Model</label>
                                          <div class="controls">
                                            <select id="car_model_id" name="car_model_id" class="chzn-select">
                                              <option>Select Car Model</option>

                                              <?php foreach ($view_model as $model) {
                                              	# code...
                                              ?>
                                              <option value="<?php echo $model->id;?>"><?php echo $model->model;?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                            <div class="control-group">
                                          <label class="control-label" for="select01">Car Color</label>
                                          <div class="controls">
                                            <select id="car_color_id" name="car_color_id" class="chzn-select">
                                              <option>Select Car Color</option>

                                              <?php foreach ($view_color as $color) {
                                              	# code...
                                              ?>
                                              <option value="<?php echo $color->id;?>"><?php echo $color->color;?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                          
                             <div class="control-group">
                                <label class="control-label">Car Document Picture<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="car_document" id="car_document" type="file" class="span6 m-wrap"/>
                                </div>
                            </div>
                          
                           
                          
                           <!--  <div class="control-group">
                                <label class="control-label">Credit Card<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="creditcard" type="text" class="span6 m-wrap"/>
                                    <span class="help-block">e.g: 5500 0000 0000 0004</span>
                                </div>
                            </div> -->
                           
                            <!-- <div class="control-group">
                                <label class="control-label">Category<span class="required">*</span></label>
                                <div class="controls">
                                    <select class="span6 m-wrap" name="category">
                                        <option value="">Select...</option>
                                        <option value="Category 1">Category 1</option>
                                        <option value="Category 2">Category 2</option>
                                        <option value="Category 3">Category 5</option>
                                        <option value="Category 4">Category 4</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="form-actions">
                                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
                          
                            </div>
                        </fieldset>
                    </form>
                    <!-- END FORM-->
                </div>
                </div>     
                        </div>
                        <!-- /block -->
                    </div>       
                </div>
            </div>