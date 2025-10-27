<div class="container-fluid">
            <div class="row-fluid">
                <div class="span12" id="content">
                    <div class="row-fluid">
                        <!-- <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Success</h4>
                          The operation completed successfully</div> -->
                          <div class="navbar">
                              <div class="navbar-inner">
                                  <ul class="breadcrumb">
                                      <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                                      <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                                      <li>
                                          <a href="<?php echo base_url();?>admin">Dashboard</a> <span class="divider">/</span>  
                                      </li>
                                     
                                      <li class="active">Search</li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Search</div>
                               <!--  <div class="pull-right"><span class="badge badge-warning">View More</span>

                                </div> -->
                            </div>
                            <div class="block-content collapse in">
                               <div class="control-group">
  								<label class="control-label">Search<span class="required">*</span></label>
  								<div class="controls">
  									<select class="span1 m-wrap" id="select_type" name="category" style="width: 11.982906%;">
  										<option value="">Select...</option>
  										<option value="cnic_number">CNIC</option>
  										<option value="mobile_number">PHONENO</option>
  										<option value="email_address">Email</option>
  										<option value="Category 4">Category 4</option>
  									</select>

                     <input type="text" class="form-control" id="search_vendor" name="search">
  								</div>
                  <button id="search_vendor_submit" class="btn btn-primary">Search</button>
  							</div>
  						
  								

  						
                            </div>
                        </div>
                        <!-- /block -->
						<div class="row-fluid" >
						<div class="block" id="vendor_table"> </div>
				   </div>
                    </div>
                   
                   
             
                </div>
            </div>