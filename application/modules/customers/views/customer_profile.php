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
       
        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
             
              <h3 class="profile-username text-center">About Customer</h3>
              <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Mobile #</th>
                        <th>Status</th>
                        <th>Customer Status</th>
                        <th>Verification Status</th>
                        <th>Last Login</th>
                        <th>Location</th>
                        <th>Created</th>
                      </tr>
                      </thead>

                      <?php foreach ($customer_data as $values) {
                      
                       $status = $values->status;
                          if($status== A)
                          {
                              $status_label= '';
                              $status_desc = '<font color="info">Approved</font>';
                          }
                          else if($status == B)
                          {
                              $status_desc = "<font color='red'>Blocked</font>";
                          }
                          else if($status == P)
                          {
                              $status_desc = "<font color='Blue'>Pending</font>";
                          }

                          $code = $values->verification_code;
                          if($code == 1){
                            $verification = 'Verified';
                          }
                          else{
                            $verification = $code;
                          }

                      }?>
                      <tbody>
                        
                        
                      <tr>
                        <td><?php echo $values->id;?></td>

                        <td><?php echo $values->customer_name;?></td>
                        <td><?php echo $values->email;?></td>
                        <td><?php echo $values->mobile_number;?></td>
                        <td><?php echo $status_desc;?></td>
                        <td><?php echo $values->customer_status;?></td>
                        <td><?php echo $verification;?></td>
                        <td><?php echo $values->last_login;?></td>
                        <td><?php echo $values->customer_location;?></td>
                        <td><?php echo $values->created_at;?></td>
                     
                      </tr>
                      </tbody>
                     
                    </table>
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <?php
                            if($status == 'A'){
                        ?>
                        <th> <button type="button" class="btn btn-danger  update_status" id="<?php echo $this->uri->segment(3);?>" name="update">Block Customer</button></th>
                        <?php
                            }
                        ?>
                        <?php
                            if($status == 'B'){
                        ?>
                        <th><button type="button" class="btn btn-info  unblock_captain" id="<?php echo $this->uri->segment(3);?>" name="">UnBlock Customer</button></th>
                        <?php
                            }
                        ?>

                        <th><button type="button" class="btn btn-info  unblock_captain" id="" data-toggle="modal" data-target="#myModal" name="">Send Message to Customer</button></th>

                        <th><button type="button" class="btn btn-success  unblock_captain" id="" data-toggle="modal" data-target="#myModal1" name="">Update Customer Profile</button></th>

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
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
               
                    <div class="timeline-item">
                      <h3 class="timeline-header"><a href="#">Rides History</a></h3>

                      <div class="timeline-body">
                        <table id="ride_list" class="table table-bordered table-hover">
                          <input type="hidden" id="cust_id" value="<?php echo $this->uri->segment(3);?>">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Captain Name</th>
                        <th>Pickup</th>
                        <th>Destiny</th>
                        <th>Ride Amount</th>
                        <th>Customer Pay</th>
                        <th>Remaining Balance</th>
                        <th>Remain Bal To</th>
                        <th>Ride Type</th>
                        <th>Created</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>

                        
                      </tbody>
                     
                    </table>
                      </div>
                    
                    </div>
                 
                </div>
              </div>
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
                

                <div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Message</h4>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>customers/send_individual_sms/<?php echo $this->uri->segment(3);?>" method="post">

            <select class="form-control" name="purpose">
              
              <option>Select Purpose</option>
              <option value="Warning">Warning</option>
              <option value="General Text">General Text</option>
              <option value="Offer">Offer</option>
            </select>
            <br>

          <textarea name="sms_text" col="5" rows="5" class="form-control"></textarea>
          <br>
          <input type="submit" name="submit" value="Send" class="btn btn-primary">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
                        <!-- End Switching Model -->
<!-- model for update customer -->

        <div class="container">

          <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Change Customer Profile</h4>
                </div>
                <div class="modal-body">

                  <form role="form" action="<?php echo base_url();?>customers/update_customer_profile/<?php echo $this->uri->segment(3);?>" method="POST">
                        <div class="box-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Customer Name</label>
                            <input type="text" class="form-control" value="<?php echo $values->customer_name;?>" id="customer_name" name="customer_name" placeholder="Enter Customer Name">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Customer Email</label>
                            <input type="text" class="form-control" value="<?php echo $values->email;?>" id="email" name="email" placeholder="Enter Email">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Mobile Number</label>
                            <input type="text" class="form-control" value="<?php echo $values->mobile_number;?>" id="mobile_number" name="mobile_number" placeholder="Enter Moblie Number">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Customer Status</label>
                            <select class="form-control select2" style="width: 100%;" id="status" name="status">
                              <option>Select...</option>
                              <option <?php if ($values->status == 'P' ) echo 'selected' ; ?>  value="P">Pending</option>
                              <option <?php if ($values->status == 'A' ) echo 'selected' ; ?> value="A">Approved</option>
                              <option <?php if ($values->status == 'B' ) echo 'selected' ; ?> value="B">Block</option>
                            </select>
                          </div>
                         

                        <!--   <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" class="form-control" value="<?php //echo $values->password;?>" id="password" name="password" placeholder="Enter Moblie Number">
                          </div> -->
                         
                        </div>
                        <!-- /.box-body -->
                        <!-- <div class="box-footer">
                          <button type="type" class="btn btn-primary">Submit</button>
                        </div> -->
                        <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" id="submit" name="submit" class="btn btn-primary update_car_info">Save changes</button>
                    </div>
                      </form>
                </div>
            
              </div>
              
            </div>
          </div>
          
        </div>


<!-- end model for update customer -->


  </div>