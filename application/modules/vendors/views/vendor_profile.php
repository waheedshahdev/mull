 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Vendors</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <?php foreach ($vendor_data as $vendor_profile) {
            $status = $vendor_profile->status;

            if($status==A)
            {
                $status_desc = "<font color='success'>Approved</font>";
            }
            else if($status ==P)
            {
                $status_desc = "<font color='blue'>Pending</font>";
            }
            else if($status ==B)
            {
                $status_desc = "<font color='red'>Blocked</font>";
            }
          }?>
          <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center"><?php echo $vendor_profile->name;?></h3>


              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <?php foreach ($count_car as $cont) {
                    # code...
                  }?>
                  <b>Cars</b> <a class="pull-right"><?php echo $cont->count_car;?></a>
                </li>
                <li class="list-group-item">
                  <?php foreach ($vendor_captain as $con) {
                    # code...
                  }?>
                  <b>Captains</b> <a class="pull-right"><?php echo $con->count_captain;?></a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Block Vendor</b></a>
              <a href="#" class="btn btn-info btn-block"><b>Update Vendor</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-8">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
             
              <h3 class="profile-username text-center">About Captain</h3>
              <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Mobile #</th>
                        <th>Status</th>
                        <th>Created</th>
                      </tr>
                      </thead>
                      <tbody>
                        <td><?php echo $vendor_profile->id;?></td>
                        <td><?php echo $vendor_profile->email_address;?></td>
                        <td><?php echo $vendor_profile->mobile_number;?></td>
                        <td><?php echo $status_desc;?></td>
                        <td><?php echo $vendor_profile->created_at;?></td> 
                      <tr>
         
                     
                      </tr>
                      </tbody>
                     
                    </table>
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>

                      </tr>
                      </thead>

                     
                    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Profile</a></li>
              <li><a href="#timeline" data-toggle="tab">Cars</a></li>
              <li><a href="#settings" data-toggle="tab">Captains</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                        <span class="username">
                          <a href="#">CNIC  Pictures</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                  
                  </div>
                </div>
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                  
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">

                    <div class="col-sm-6">
                      <img class="img-responsive" src="<?php echo base_url();?>userfiles/vendor_images/<?php echo $vendor_profile->cnic_front;?>" alt="Photo">
                    </div>
                    <div class="col-sm-6">
                      <img class="img-responsive" src="<?php echo base_url();?>userfiles/vendor_images/<?php echo $vendor_profile->cnic_back;?>" alt="Photo">
                    </div>
                    <!-- /.col -->
                    <!-- /.col -->
                  </div>
                </div>
                <!-- /.post -->
              </div>
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
                      <h3 class="timeline-header"><a href="#">Cars List</a></h3>

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
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($vendor_car as $cars):
                          $status = $cars->status;
                        if($status==A)
                        {
                            
                            $status_desc = '<font color="success">Approved</font>';
                        }
                        else if($status == B)
                        {
                            
                            $status_desc = "<font color='red'>Blocked</font>";
                        }
                        else{
                            $status_label = "info";
                            $status_desc = "<font color='info'>Blocked</font>";
                        }

                        ?>
                      <tr>
                        <td><?php echo $cars->id;?></td>
                        <td><?php echo $cars->car_reg_number;?></td>
                        <td><?php echo $cars->district_name;?></td>
                        <td><?php echo $cars->name;?></td>
                        <td><?php echo $cars->type_name;?></td>
                        <td><?php echo $cars->model;?></td>
                        <td><?php echo $cars->color;?></td>
                        <td><?php echo $status_desc;?></td>
                        <td><?php echo $cars->created_at;?></td>
                        <td><?php echo $cars->updated_at;?></td>
                        <td><a href="<?php echo base_url();?>cars/car_profile/<?php echo $cars->id;?>" class="btn btn-info btn-xs">Details</a></td>
                       
                      </tr>
                  <?php endforeach;?>
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


                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
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
                      <h3 class="timeline-header"><a href="#">Captains List</a></h3>

                      <div class="timeline-body">
                        <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Captain name</th>
                        <th>Mobile #</th>
                        <th>CNIC Number</th>
                        <th>District</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                       
                      </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($vendor_captain as $captains):
                          $status = $captains->status;
                        if($status==A)
                        {
                            
                            $status_desc = '<font color="success">Approved</font>';
                        }
                        else if($status == B)
                        {
                            
                            $status_desc = "<font color='red'>Blocked</font>";
                        }
                        else{
                            $status_label = "info";
                            $status_desc = "<font color='info'>Pending</font>";
                        }


                        ?>
                      <tr>
                        <td><?php echo $captains->id;?></td>
                        <td><?php echo $captains->captain_name;?></td>
                        <td><?php echo $captains->cnic_number;?></td>
                        <td><?php echo $captains->mobile_number;?></td>
                        <td><?php echo $captains->district_name;?></td>
                        <td><?php echo $status_desc;?></td>
                        <td><?php echo $captains->created_at;?></td>
                        <td><?php echo $captains->updated_at;?></td>
                        <td><a href="<?php echo base_url();?>captains/captain_profile/<?php echo $captains->id;?>" class="btn btn-info btn-xs">View</a></td>
                       
                      </tr>
                  <?php endforeach;?>
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

                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
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
    <!-- /.content -->
  </div>