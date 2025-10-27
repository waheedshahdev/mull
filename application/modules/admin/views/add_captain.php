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
                    <form action="#" id="add_captain_form" class="form-horizontal">
                        <fieldset>
                            <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                               
                            </div>
                            <div id="found_message">

                            </div>
                            

                            <input type = "hidden" name="vendor_id" id="vendor_id" value="<?php echo $this->uri->segment(3);?>">
                            
                            <div class="control-group">
                                <label class="control-label">Captain Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="captain_name" id="captain_name" required="" data-required="1" placeholder="Enter Captain Name" class="span6 m-wrap"/>
                                    <input type="hidden" name="office_id" id="office_id" value="<?php echo $this->session->userdata('office_id');?>">
                                    <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $this->session->userdata('id');?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Captain ID<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="cap_id" id="cap_id" type="number" placeholder=" Enter CNIC Last 6 Number    ex:  123456" class="span6 m-wrap" required="" />
                                </div>
                                <div id="err_mobile"></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Phone Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="mobile_number" id="mobile_number" type="number" placeholder="Enter Captain Phone Number" class="span6 m-wrap" required="" />
                                </div>
                                <div id="err_mobile"></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CNIC Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="cnic_number" id="cnic_number" type="number" placeholder="Enter Captain CNIC Number" class="span6 m-wrap"/>
                                </div>
                                <div id="err_cnic"></div>
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
                                <label class="control-label">Captain Picture<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="captain_image" id="captain_image" type="file" class="span6 m-wrap"/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label">CNIC Front Picture<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="cnic_front" id="cnic_front" type="file" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CNIC Back Picture<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="cnic_back" id="cnic_back" type="file" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">License Front Picture<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="liscence_front" id="liscence_front" type="file" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">License Back Picture<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="liscence_back" id="liscence_back" type="file" class="span6 m-wrap"/>
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