 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> captains</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <?php foreach ($captain_data as $captain_profile) {
          	$status = $captain_profile->status;
            if($status==A)
            {
                $status_label= '';
                $status_desc = '<font color="info">Pending</font>';
            }
            elseif($status==1)
            {
                $status_label = "success";
                $status_desc = "<font color='success'>Approved</font>";
            }
            elseif($status==2) {
                $status_label = "info";
                $status_desc = "<font color='red'>Blocked</font>";
            }
          }?>
          <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center"><?php echo $captain_profile->captain_name;?></h3>

              <p class="text-muted text-center">Software Engineer</p>

              <ul class="list-group list-group-unbordered">
                
                <li class="list-group-item">
                  <b>Debit Balance</b> <a class="pull-right">13,287</a>
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
              <h3 class="box-title">About captain</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<strong><i class="fa fa-book margin-r-5"></i> captain_id</strong>

              <h4 class="text-muted">
                <?php echo $captain_profile->id;?>
              </h4>
              <hr>
              <strong><i class="fa fa-pencil margin-r-5"></i> District</strong>

              <h4 class="text-muted">
                <?php echo $captain_profile->district_name;?>
              </h4>

              <hr>

              <strong><i class="fa fa-mobile margin-r-5"></i> Contact Number</strong>

              <h4 class="text-muted"><?php echo $captain_profile->mobile_number;?></h4>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Status</strong>

              <h4><?php echo $status_desc;?></h4>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Created Date</strong>

              <h4><?php echo $captain_profile->created_at;?></h4>

              <hr>
              <hr>
              <input type="hidden" name="captain_id" value="<?php $captain_profile->id;?>">
              <strong><i class="fa fa-file-text-o margin-r-5"></i> Action</strong>
              
              <h4><!-- <a href="#" id="update_status" name="update_status" class="btn btn-danger ">Block</a> -->
                <button type="button" class="btn btn-danger btn-block update_status" id="<?php echo $this->uri->segment(3);?>" name="update">Block Captain</button></h4>
               <h4> <button type="button" class="btn btn-info btn-block unblock_captain" id="<?php echo $this->uri->segment(3);?>" name="">UnBlock Captain</button></h4>
               <h4> <button type="button" class="btn btn-success btn-block approve" id="<?php echo $this->uri->segment(3);?>" name="">Approve Captain</button></h4>
               <h4> <button type="button" class="btn btn-primary btn-block update_caption_profile" id="<?php echo $this->uri->segment(3);?>" name="">Update Captain Profile</button></h4>
             
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
              <li><a href="#settings" data-toggle="tab">Switch Captain</a></li>
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
                        <td><?php echo $captain_profile->id;?></td>
                        <td><?php echo $captain_profile->name;?></td>
                        <td><?php echo $captain_profile->cnic_number;?></td>
                        <td><?php echo $captain_profile->mobile_number;?></td>

                        <td><?php echo $captain_profile->created_at;?></td>
                       
                      </tr>
               
                        
                      </tbody>
                     
                    </table>
                      </div>
                    
                    </div>
                 
                </div>
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                        <span class="username">
                          <a href="#">Captain Pictures</a>
                          
                        </span>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" src="<?php echo base_url();?>userfiles/captain_images/<?php echo $captain_profile->cnic_front;?>" alt="Photo">
                    </div>
                    <div class="col-sm-6">
                      <img class="img-responsive" src="<?php echo base_url();?>userfiles/captain_images/<?php echo $captain_profile->cnic_back;?>" alt="Photo">
                    </div>
                  </div>
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" src="<?php echo base_url();?>userfiles/captain_images/<?php echo $captain_profile->liscence_front;?>" alt="Photo">
                    </div>
                    <div class="col-sm-6">
                      <img class="img-responsive" src="<?php echo base_url();?>userfiles/captain_images/<?php echo $captain_profile->liscence_back;?>" alt="Photo">
                    </div>
                  </div>
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" src="<?php echo base_url();?>userfiles/captain_images/<?php echo $captain_profile->captain_image;?>" alt="Photo">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          <?php
                          echo date('d-l-Y');
                          ?>
                        </span>
                  </li>
                  <li>
                    <i class="fa fa-user bg-aqua"></i>
                    <div class="timeline-item">
                      <h3 class="timeline-header"><a href="#">Captain Today Rides and Payment History</a></h3>
                      <div class="timeline-body">
                        <table id="example2" class="table table-bordered table-hover">
			                <thead>
			                <tr>
			                  <th>ID</th>
                        <th>Customer Name</th>
                        <th>Customer #</th>
                        <th>Pickup</th>
                        <th>Dropoff</th>
                        <th>Ride Amount</th>
                        <th>Ride Type</th>
			                  <th>Paid Amount</th>
			                  <th>Our Amount</th>
			                  <th>Captain Amount</th>
                        <th>Required Balance</th>
			                  <th>Required Balance Owner</th>
			                  <th>Created</th>
			                </tr>
			                </thead>
			                <tbody>
                        <?php foreach ($captain_today_rides as $today_ride):

                        $ride_type = $today_ride->ride_type;
                        if($ride_type == R){
                          $status = '<font color="primary">Regular</font>';
                        }
                        elseif($ride_type == F){
                          $status = '<font color="primary">Fixed</font>';
                        }
                        elseif($ride_type == D){
                          $status = '<font color="primary">Per Day</font>';
                        }
                        elseif($ride_type == O){
                          $status = '<font color="primary">One Way</font>';
                        }
                        elseif($ride_type == T){
                          $status = '<font color="primary">Two Way</font>';
                        }

                        $balance_type = $today_ride->balance_type;
                        if($balance_type == N){
                          $balance = '<font color="success">None</font>';
                        }
                        elseif($balance_type == M){
                          $balance = '<font color="success">Pay To Us</font>';
                        }
                        elseif($balance_type == C){
                          $balance = '<font color="success">Pay To Captain</font>';
                        }
                        ?>


			                	  <tr>
                            <td><?php echo $today_ride->id;?></td>
                            <td><?php echo $today_ride->customer_name;?></td>
                            <td><?php echo $today_ride->mobile_number;?></td>
                            <td><?php echo $today_ride->pickup_lat;?>,<?php echo $today_ride->pickup_lng;?></td>
                            <td><?php echo $today_ride->distination_lat;?><?php echo $today_ride->distination_lng;?></td>
                            <td><?php echo $today_ride->ride_amount;?></td>
                            <td><?php echo $status;?></td>
                            <td><?php echo $today_ride->paid_amount;?></td>
                            <td><?php echo $today_ride->pay_to_us;?></td>
                            <td><?php echo $today_ride->pay_to_cap;?></td>
                            <td><?php echo $today_ride->balance_amount;?></td>
                            <td><?php echo $balance;?></td>
                            <td><?php echo $today_ride->created_at;?></td> 
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
                 <form class="form-horizontal" action="<?php echo base_url();?>captains/switch_captain" method="post">
                  <input type="hidden" value="<?php echo $this->uri->segment(3);?>" name="update_id">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Captain Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" disabled placeholder="Name" value="<?php echo $captain_profile->captain_name;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Old Vendor ID</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" disabled name="old_vendor_id" id="old_vendor_id" placeholder="Email" value="<?php echo $captain_profile->vendor_id;?>">
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
    <!-- /.content -->
  </div>