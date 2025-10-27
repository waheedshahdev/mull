

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
                    <form action="#" id="captain_switch_form" class="form-horizontal">
                        <fieldset>
                            <div id="success_message"></div>
                           
                            <div class="control-group">
                                <label class="control-label">Captain Name/CNIC<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="captain_name_cnic" id="captain_name_cnic" required="" data-required="1" placeholder="Captain Name/CNIC" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Captain Mobile Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="number" name="captain_mobile" id="captain_mobile" required="" data-required="1" placeholder="E.g 03400112233" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Old Vendor CNIC Number/Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="old_vendor_cnic" id="old_vendor_cnic" type="text" required="" placeholder="E.g 1560200334488" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <hr>
                           
                             <div class="control-group">
                                <label class="control-label">New Vendor CNIC/Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="new_vendor_cnic" id="new_vendor_cnic" required="" type="text" placeholder="E.g 1560200334488" class="span6 m-wrap"/>
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
                                <div class="muted pull-left">Captain Switching Issues </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      
                                     
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="user_data">
                                        <thead>
                                            <tr>  
                               <th width="10%" style="border-left: #9E9A9A solid 1px;
    border-bottom:1px solid  #9E9A9A ; border-right:1px solid #9E9A9A  !important;">id</th>  
                               <th width="20%" style="border-left: #9E9A9A solid 1px;
    border-bottom:1px solid  #9E9A9A ; border-right:1px solid #9E9A9A  !important;">Captain Name/CNIC</th>  
                               <th width="20%" style="border-left: #9E9A9A solid 1px;
    border-bottom:1px solid  #9E9A9A ; border-right:1px solid #9E9A9A  !important;">Captain Mobile #</th>  
                               <th width="20%" style="border-left: #9E9A9A solid 1px;
    border-bottom:1px solid  #9E9A9A ; border-right:1px solid #9E9A9A  !important;">Old Vendor Name/CNIC</th>  
                               <th width="20%" style="border-left: #9E9A9A solid 1px;
    border-bottom:1px solid  #9E9A9A ; border-right:1px solid #9E9A9A  !important;">New Vendor Name/CNIC</th>  
                               <th width="20%" style="border-left: #9E9A9A solid 1px;
    border-bottom:1px solid  #9E9A9A ; border-right:1px solid #9E9A9A  !important;">Created at</th>  
                               <th width="20%" style="border-left: #9E9A9A solid 1px;
    border-bottom:1px solid  #9E9A9A ; border-right:1px solid #9E9A9A  !important;">Status</th>  
                               <th width="20%" style="border-left: #9E9A9A solid 1px;
    border-bottom:1px solid  #9E9A9A ; border-right:1px solid #9E9A9A  !important;">Action</th>  
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
