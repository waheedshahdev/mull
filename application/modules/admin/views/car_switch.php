<div class="container-fluid">
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
                    <form action="#" id="car_switch_form" class="form-horizontal">
                        <fieldset>
                            <div id="success_message">
                            </div>
							 <div class="alert alert-error hide alert-dismissable" id="danger">
							
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <button class="close" data-dismiss="alert"></button>
                                Fill all the fields Correctly
                            </div>
							<div class="alert alert-error hide alert-dismissable " id="danger1">
								 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <button class="close" data-dismiss="alert"></button>
                               Cnic is Not Correct it must be 13 digits
                            </div>
                            <div class="control-group">
                                <label class="control-label">Car Registration Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="car_reg_number" required="" id="car_reg_number" data-required="1" placeholder="E.g  AB - 1234" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Old Vendor Name / CNIC Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="old_vendor_cnic" required="" id="old_vendor_cnic" data-required="1" placeholder="Enter Old Vendor Name" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Old Vendor Mobile Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="old_vendor_number"required=""  id="old_vendor_number" type="number" placeholder="Enter Old Vendor CNIC" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <hr>
                            <div class="control-group">
                                <label class="control-label">New Vendor Name / CNIC Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="new_vendor_cnic" required="" id="new_vendor_cnic" type="text" placeholder="Enter New Vendor  Name" class="span6 m-wrap"/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label">New Vendor CNIC<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="new_vendor_number"   required="" id="new_vendor_number" type="number" placeholder="Enter New Vendor  CNIC" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Car Document Image<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="car_doc" id="car_doc" type="file" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <input type="hidden" name="office_id" value="<?php echo $this->session->userdata('id');?>">
                           
                          
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
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                          
                            </div>
                        </fieldset>
                    </form>
                    <!-- END FORM-->
                </div>
                </div>
         
                         
                        </div>
                        <!-- /block -->
                    </div>

                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Car Switching Issues </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      
                                     
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="car_data">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Car Reg Number</th>
                                                <th>Old Vendor Name/CNIC</th>
                                                <th>New Vendor Name/CNIC</th>
                                                <th>Status</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                 



                   
                </div>
            </div>