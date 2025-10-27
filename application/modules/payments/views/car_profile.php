 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> cars</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <?php foreach ($car_data as $car_profile) {
          	$status = $car_profile->status;
            if($status==P)
            {
                $status_label= '';
                $status_desc = '<font color="info">Pending</font>';
            }
            elseif($status==A)
            {
                $status_label = "success";
                $status_desc = "<font color='success'>Approved</font>";
            }
            elseif($status==B) {
                $status_label = "info";
                $status_desc = "<font color='red'>Blocked</font>";
            }
            $cat = $car_profile->category_id;
            if($cat == 0)
            {
              $category_status = '<font color="red">Not Assign Yet</font>';

            }
            else {
              $category_status = $car_profile->category_name;
            }
          }?>
          <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center"><?php echo $car_profile->car_reg_number;?></h3>

              <ul class="list-group list-group-unbordered">
                
                <li class="list-group-item">
                  <b>Category</b> <a class="pull-right"><h4><?php echo $category_status;?></h4></a>
                </li>
                <li class="list-group-item">
                  <b>Credit Balance</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Check Payments</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About car</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-file-text-o margin-r-5"></i>Category</strong>
              <h4><?php echo $car_profile->category_name;?></h4>
              <hr>
              <input type="hidden" name="car_id" value="<?php $car_profile->id;?>">
              <strong><i class="fa fa-file-text-o margin-r-5"></i> Action</strong>
              
              <h4><!-- <a href="#" id="update_status" name="update_status" class="btn btn-danger ">Block</a> -->
                <button type="button" class="btn btn-danger btn-block block_car" id="<?php echo $this->uri->segment(3);?>" name="update">Block car</button></h4>
                <h4><button type="button" class="btn btn-info btn-block unblock_car" id="<?php echo $this->uri->segment(3);?>" name="approve">UnBlock car</button></h4>
                <h4><button type="button" class="btn btn-success btn-block approve_car" id="<?php echo $this->uri->segment(3);?>" name="approve">Approve car</button></h4>
                </h4>
                <h4><button type="button" class="btn btn-primary btn-block" name="" data-toggle="modal" data-target="#modal-default">Update car Info</button></h4>
                <h4><button type="button" class="btn btn-success btn-block" name="" data-toggle="modal" data-target="#myModel">Assign Category To Car</button></h4>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Profile</a></li>
              <li><a href="#timeline" data-toggle="tab">Payments</a></li>
              <li><a href="#settings" data-toggle="tab">Switch car</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
               
                    <div class="timeline-item">
                      <h3 class="timeline-header"><a href="#">Vendor Information</a></h3>

                      <div class="timeline-body">
                        <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Vendor Name</th>
                        <th>CNIC</th>
                        <th>Mobile #</th>
                        <th>Created</th>
                      </tr>
                      </thead>
                      <tbody>
                        
                        
                      <tr>
                        <td><?php echo $car_profile->id;?></td>
                        <td><?php echo $car_profile->vendor_name;?></td>
                        <td><?php echo $car_profile->cnic_number;?></td>
                        <td><?php echo $car_profile->mobile_number;?></td>

                        <td><?php echo $car_profile->created_at;?></td>
                       
                      </tr>
               
                        
                      </tbody>
                     
                    </table>
                      </div>
                    
                    </div>
                 
                </div>
                <!-- Post -->
                <!-- =========================================================== -->

      <div class="row">
        
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Car ID</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $car_profile->carid;?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">District</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $car_profile->district_name;?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Car Company</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $car_profile->name;?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Car Type</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $car_profile->type_name;?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->

      <!-- =========================================================== -->
      <!-- =========================================================== -->

      <div class="row">
        
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Car Model</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $car_profile->model;?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Car Color</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $car_profile->color;?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Car Status</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $status_desc;?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Created At</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $car_profile->created_at;?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->

      <!-- =========================================================== -->
       <!-- =========================================================== -->

      <div class="row">
        
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Updated At</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $car_profile->updated_at;?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <hr>
      <div class="post">
                  <div class="user-block">
                        <span class="username">
                          <a href="#">Car Document Pictures</a>
                          
                        </span>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">

                    <div class="col-sm-6">
                      <img class="img-responsive" src="<?php echo base_url();?>userfiles/car_document/<?php echo $car_profile->car_document;?>" alt="Photo">
                    </div>
                </div>
                </div>
      <!-- /.row -->

      <!-- =========================================================== -->
                <!-- /.post -->
              </div>
              <!-- modal for update car information -->
              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Edit Car Information</h4>
                    </div>
                    <div class="modal-body">
                      <form role="form" action="" id="<?php echo $this->uri->segment(3);?>" class"update_car_info" method="POST">
                        <input type="hidden" name="car_id" value="<?php echo $this->uri->segment(3);?>">
                        <div class="box-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Car Registration Number</label>
                            <input type="text" class="form-control" value="<?php echo $car_profile->car_reg_number;?>" id="car_reg_number" name="car_reg_number" placeholder="Enter Car Registration #">
                          </div>
                          <div class="form-group">
                            <select class="form-control select2" style="width: 100%;" name="district_id" id="district_id">
                              <option>hi dsfks</option>
                              <?php foreach ($fetch_district as $district): 
                              ?>
                              <option <?php if($district->id == $district->district_name){ echo "selected"; } ?> value="<?php echo $district->id;?>"><?php echo $district->district_name;?></option>
                            <?php endforeach;?>
                            </select>
                          </div>
                          <div class="form-group">
                            <select class="form-control select2" style="width: 100%;" id="car_company_id" name="car_company_id">
                              <option>Select...</option>
                              <?php foreach ($fetch_car_company as $campany):
                              ?>
                              <option  value="<?php echo $campany->id;?>"><?php echo $campany->name;?></option>
                            <?php endforeach;?>
                            </select>
                          </div>
                          <div class="form-group">
                            <select class="form-control select2" style="width: 100%;" name="car_type_id" id="car_type_id">
                              <option>Select...</option>
                              <?php foreach ($fetch_car_type as $type):
                              ?>
                              <option  value="<?php echo $type->id;?>"><?php echo $type->type_name;?></option>
                            <?php endforeach;?>
                            </select>
                          </div>
                           <div class="form-group">
                            <select class="form-control select2" style="width: 100%;" name="car_model_id" id="car_model_id">
                              <option>Select...</option>
                              <?php foreach ($fetch_car_model as $mod):
                              ?>
                              <option  value="<?php echo $mod->id;?>"><?php echo $mod->model;?></option>
                            <?php endforeach;?>
                            </select>
                          </div>
                           <div class="form-group">
                            <select class="form-control select2" style="width: 100%;" name="car_color_id" id="car_color_id">
                              <option>Select...</option>
                              <?php foreach ($fetch_car_color as $col):
                              ?>
                              <option  value="<?php echo $col->id;?>"><?php echo $col->color;?></option>
                            <?php endforeach;?>
                            </select>
                          </div>
                          
                         
                        </div>
                        <!-- /.box-body -->
                        <!-- <div class="box-footer">
                          <button type="type" class="btn btn-primary">Submit</button>
                        </div> -->
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="button" id="<?php echo $this->uri->segment(3);?>" class="btn btn-primary update_car_info">Save changes</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- modal for update car information -->
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    
                    <div class="timeline-item">
                      <h3 class="timeline-header"><a href="#">List</a></h3>

                      <div class="timeline-body">
                        <table id="example2" class="table table-bordered table-hover">
			                <thead>
			                <tr>
			                  <th>ID</th>
			                  <th>Reg #</th>
			                  <th>District</th>
			                  <th>Car Company</th>
			                  <th>Type</th>
			                  <th>Model</th>
			                  <th>Color</th>
			                  <th>Status</th>
			                  <th>Created</th>
			                  <th>Updated</th>
			                </tr>
			                </thead>
			                <tbody>
			                	
			                </tbody>
			               
			              </table>
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                 <form class="form-horizontal" action="<?php echo base_url();?>cars/switch_car" method="post">
                  <input type="hidden" value="<?php echo $this->uri->segment(3);?>" name="update_id">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">car Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" disabled placeholder="Name" value="<?php echo $car_profile->car_name;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Old Vendor ID</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" disabled name="old_vendor_id" id="old_vendor_id" placeholder="Email" value="<?php echo $car_profile->vendor_id;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">New Vendor ID</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="vendor_id" id="vendor_id" placeholder="Name">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                       
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="submit" value="Update" class="btn btn-danger">Switch</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

     <!-- Assign category to car -->
                <div class="modal fade" id="myModel">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Assign Category To Car</h4>
                    </div>
                    <div class="modal-body">
                      <form role="form">
                        <input type="hidden" name="car_id" id="car_id" value="<?php echo $this->uri->segment(3);?>">
                        <div class="box-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Assign Category to car</label>
                            <select class="form-control select2" style="width: 100%;" name="category_id" id="category_id">
                              <option>Select category</option>
                             <?php foreach ($assign_category as $assign):?>
                             <option value="<?php echo $assign->categoryid;?>"><?php echo $assign->category_name;?></option>
                           <?php endforeach;?>
                            </select>
                          </div>
                          <div class="form-group">
                            
                          </div>
                        </div>
                      <!--   <div class="box-footer">
                          <button type="button" class="btn btn-primary ">Submit</button>
                        </div> -->
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="button" id="<?php echo $this->uri->segment(3);?>"  class="btn btn-primary assign_cat">Save changes</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
                        <!-- End assign category car model -->
    <!-- /.content -->
  </div>