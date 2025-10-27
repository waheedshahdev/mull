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
               <?php foreach ($view as $vendor) {
                   # code...
               }?>
                    <form action="<?php echo base_url();?>admin/update_vendor_data/<?php echo $this->uri->segment(3);?>" id="form_sample_1" class="form-horizontal" method="post">

                        <fieldset>
                            <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <div class="alert alert-success hide">
                                <button class="close" data-dismiss="alert"></button>
                                Your form validation is successful!
                            </div>
                            <div class="control-group">
                                <label class="control-label">Vendor Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="name" data-required="1" value="<?php echo $vendor->name;?>" placeholder="Enter vendor Name" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CNIC Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="number" name="cnic_number" data-required="1" value="<?php echo $vendor->cnic_number;?>" placeholder="Enter vendor CNIC Number" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="email_address" type="email" value="<?php echo $vendor->email_address;?>" placeholder="Enter vendor Email" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Phone Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="mobile_number" type="number" value="<?php echo $vendor->mobile_number;?>"  placeholder="Enter vendor Phone Number" class="span6 m-wrap"/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label">CNIC Front Picture<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="cnic_front" type="file" value="<?php echo $vendor->cnic_front;?>" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CNIC Back Picture<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="cnic_back" value="<?php echo $vendor->cnic_back;?>"  type="file" class="span6 m-wrap"/>
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
                                <div class="muted pull-left">Add Car</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a href="<?php echo base_url();?>admin/add_car/<?php echo $this->uri->segment(3);?>"><button class="btn btn-success">Add Car <i class="icon-plus icon-white"></i></button></a>
                                      </div>
                                     
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Registration No</th>
                                                <th>District</th>
                                                <th>Car Company</th>
                                                <th>Car Type</th>
                                                <th>Model</th>
                                                <th>Color</th>
                                                <th>Created at</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($view_car as $car):
                                            $status = $car->status;
                                            if($status==A)
                                            {
                                                $status_desc = '<font style="color:green;">Approved</font>';
                                             
                                            }
                                            else if($status == P)
                                            {
                                                $status_desc = '<font style="color:blue;">Pending</font>';
                                            }
                                            else if($status == B)
                                            {
                                                $status_desc = '<font style="color:red;">Blocked</font>';
                                            }
                                        

                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $car->id;?></td>
                                                <td><?php echo $car->car_reg_number;?></td>
                                                <td><?php echo $car->district_name;?></td>
                                                <td><?php echo $car->name;?></td>
                                                <td class="center"><?php echo $car->type_name;?></td>
                                                <td class="center"><?php echo $car->model;?></td>
                                                <td class="center"><?php echo $car->color;?></td>
                                                <td class="center"><?php echo $car->created_at;?></td>
                                                <td class="center"><?php echo $status_desc;?></td>
                                                <td class="center"><a href="#">Edit</a></td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                   <!--  <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header" >
                                <div class="muted pull-left"  >Add Captain</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a href="<?php echo base_url();?>admin/add_captain/<?php echo $this->uri->segment(3);?>"><button class="btn btn-success">Add Captain <i class="icon-plus icon-white"></i></button></a>
                                      </div>
                                     
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Captain Name</th>
                                                <th>Phone Number</th>
                                                <th>CNIC Number</th>
                                                <th>District</th>
                                                <th>Created Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($captains as $captain):
                                                    $status = $captain->status;
                                                    if($status==A)
                                            {
                                                $status_desc = '<font style="color:green;">Approved</font>';
                                             
                                            }
                                            else if($status == P)
                                            {
                                                $status_desc = '<font style="color:blue;">Pending</font>';
                                            }
                                            else if($status == B)
                                            {
                                                $status_desc = '<font style="color:red;">Blocked</font>';
                                            }

                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $captain->id;?></td>
                                                <td><?php echo $captain->captain_name;?></td>
                                                <td><?php echo $captain->mobile_number;?></td>
                                                <td><?php echo $captain->cnic_number;?></td>
                                                <td><?php echo $captain->district_name;?></td>
                                                <td class="center"> <?php echo $captain->created_at;?></td>
                                                <td class="center"><?php echo $status_desc?></td>
                                                <td class="center"><a href="#">Edit</a></td>
                                            </tr>
                                        <?php endforeach;?>
                                          
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div> -->



                   
                </div>
            </div>