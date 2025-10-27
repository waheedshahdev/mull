 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $title;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo $title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-4">
        	<?php foreach ($captain_data as $captain_profile) {
          	$status = $captain_profile->status;
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
          }?>
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
             
              <h3 class="profile-username text-center"><?php echo $captain_profile->captain_name;?></h3>

              <p class="text-muted text-center">Software Engineer</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <?php foreach ($captain_rating as $values) {
                    $stars = $values->cnt;
                    $rat = round($stars,1);
                  }?>
                  <b>Rating</b> <a class="pull-right">(<?php echo $rat;?>) star</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary"><b>Follow</b></a>
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
                        <th>District</th>
                        <th>Mobile #</th>
                        <th>Status</th>
                        <th>Created</th>
                      </tr>
                      </thead>
                      <tbody>
                        
                        
                      <tr>
                        <td><?php echo $captain_profile->id;?></td>

                        <td><?php echo $captain_profile->district_name;?></td>
                        <td><?php echo $captain_profile->mobile_number;?></td>
                        <td><?php echo $status_desc;?></td>
                        <td><?php echo $captain_profile->created_at;?></td>
                     
                      </tr>
                      </tbody>
                     
                    </table>
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th> <button type="button" class="btn btn-danger  update_status" id="<?php echo $this->uri->segment(3);?>" name="update">Block Captain</button></th>
                        <th><button type="button" class="btn btn-info  unblock_captain" id="<?php echo $this->uri->segment(3);?>" name="">UnBlock Captain</button></th>
                        <th><button type="button" class="btn btn-success  approve" id="<?php echo $this->uri->segment(3);?>" name="">Approve Captain</button></th>
                        <th><button type="button" class="btn btn-primary  update_caption_profile" id="<?php echo $this->uri->segment(3);?>" name="">Update Captain Profile</button></th>
                        <th><button type="button" class="btn btn-info  update_caption_profile" id="<?php echo $this->uri->segment(3);?>" name="" data-toggle="modal" data-target="#myModel">Switch Captain</button></th>
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
              <li><a href="#timeline" data-toggle="tab">Payments</a></li>
              <li><a href="#captain_history" data-toggle="tab">All Payment History</a></li>
              <li><a href="#fine_history" data-toggle="tab">All Fine History</a></li>
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
                        <td><?php echo $captain_profile->vendorid;?></td>
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
                     

                      <h3 class="timeline-header"><a href="#">Data Table </a> Captain Payment</h3>

                      <table id="example2" class="table table-bordered table-hover">
			                 <thead>
			                <tr>
			                  <th>ID</th>
			                 <th>Day</th>
			                  <th>Ride Amount Total</th>
			                  <th>pay to us</th>
			                  <th>Captain Total</th>
			                  <th>Total Rides</th>
			                  <th>reaming captain</th>
			                  <th>Reamining our</th>
			                
			                  
			                <!--  <th>Our Amount Total</th>
			                  <th>Captain Amount</th>
			                  <th>Required Balance</th>-->
			                  
			                  <th>Created</th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php 
                                $pay_to_us=0;
                               $pay_to_captain=0;
                                
                               print_r($captain_weekly_rides);
                        foreach ($captain_weekly_rides as $today_ride):

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
                            $pay_to_us += $today_ride->balance_amount;
                        }
                        elseif($balance_type == C){
                          $balance = '<font color="success">Pay To Captain</font>';
                            $pay_to_captain += $today_ride->balance_amount;
                        }
                                
                                ?>    
                               
                        
                      

			                	  <tr>
                            <td><?php echo count($today_ride->id);?></td>
                            <td><?php echo strftime("%a",strtotime($today_ride->created_ride_at));?></td>
                            <td><?php echo $today_ride->ride_amount; ;?></td>
                            
                            
                            <td><?php echo $today_ride->pay_to_us;?></td>
                            <td><?php echo $today_ride->pay_to_cap;?></td>
                            <td><?php echo $key;?></td>
                            <td><?php echo $pay_to_captain;?></td>
                            <td><?php echo $pay_to_us;?></td>
                            
                            
                            <td><?php echo $today_ride->created_ride_at;?></td> 
                            <td><button class="btn btn btn-primary"  data-toggle="modal" data-target="#captain_modal"  id="<?php echo $today_ride->created_ride_at;?>" onclick="show_rides(this.id,<?php echo $this->uri->segment(3);?>)">View</button></td> 
                           
                          </tr>
                        <?php $date= $today_ride->created_ride_at; endforeach;?>
			                </tbody>
			               
			              </table>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              
              <div class="tab-pane" id="captain_history">
                <!-- The timeline -->
               <div class="box-body">
              <table id="captain_payment_history" class="table table-bordered table-striped">
                <input type="hidden" id="cap_id" value="<?php echo $this->uri->segment(3);?>">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Customer Nmae</th>
                  <th>Customer Number</th>
                  <th>Pickup</th>
                  <th>Dropoff</th>
                  <th>Ride Amount</th>
                  <th>Customer Pay</th>
                  <th>Captain Share</th>
                  <th>Mul Share</th>
                  <th>Remainig Balance</th>
                  <th>Give Remaining Balance</th>
                  <th>Ride Type</th>
                  <th>Ride Date and Time</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

              </table>
            </div>
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
               <!-- /.tab-pane -->
              <div class="tab-pane" id="fine_history">
                <!-- The timeline -->
               <div class="box-body">
              <table id="captain_fine" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Customer Name</th>
                  <th>Complain</th>
                  <th>Fine Amount</th>
                  <th>Status</th>
                  <th>Complain Date</th>
                  <th>Created At </th>
                
                </tr>
                </thead>
                <tbody>

                </tbody>

              </table>
            </div>
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

    <!-- Switching modal -->
                <div class="modal fade" id="myModel">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Captain Switching </h4>
                    </div>
                    <div class="modal-body">
                      <form role="form" action="<?php echo base_url();?>captains/switch_captain" method="post">
                        <input type="hidden" value="<?php echo $this->uri->segment(3);?>" name="update_id">
                        <div class="box-body">
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

                          </div>
                        </div>
                      <!--   <div class="box-footer">
                          <button type="button" class="btn btn-primary ">Submit</button>
                        </div> -->
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" name="submit" value="Update" class="btn btn-primary ">Save changes</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
                        <!-- End Switching Model -->

  </div>
  
<!-- Modal -->
<div id="captain_modal" class="modal fade" role="dialog" >
  <div class="modal-dialog" id="captain_modal_datas">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Captains Rides </h4>
      </div>
      <div class="modal-body " id="captain_modal_data">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- modal for captian all day ride-- >