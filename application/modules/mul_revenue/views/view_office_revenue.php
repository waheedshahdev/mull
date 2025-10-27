 
  <link rel="stylesheet" href="<?php echo base_url();?>adminfiles/plugins/datepicker/datepicker3.css"> 
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
        <div class="col-md-8 col-md-offset-2">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
             
              <h3 class="profile-username text-center">Office Information</h3>
              <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Office Name</th>
                        <th>District</th>
                        <th>Mobile #</th>
                        <th>Address</th>
                        <th>Created</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php foreach($view_offices as $val){

                        }?>
                      <tr>
                        <td><?php echo $val->office_name;?></td>

                        <td><?php echo $val->district_name;?></td>
                        <td><?php echo $val->office_phone;?></td>
                        <td><?php echo $val->office_address;?></td>
                        <td><?php echo $val->office_created_at;?></td>
                     
                      </tr> 
                      </tbody>
                     
                    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
       

            <section class="content">

      <div class="row">

        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Search Office Captain Paid Monthly Revenue</a></li>
              <li><a href="#timeline" data-toggle="tab">Search Captain Daily Rides</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
               <div class="row">
               <div class="col-md-2"></div>
               <div class="col-md-2"> 
               <label> Start Of Month</label> 
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                     <input type="hidden" name="office_id" id="office_id" class="form-control" value="<?php echo $this->uri->segment(3);?>" />  
                </div> 
               
                <div class="col-md-2"> 
                <label>End of Month</label> 
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                </div> 
              
                 
                 <br> 
                <div class="col-md-2"> 

                     <input type="button" name="filter_office_revenue" id="filter_office_revenue" value="Search Record" class="btn btn-info" />  
                </div>
              <div class="col-md-1">
              </div>
            </div>
                    <div class="timeline-item">
                      <h3 class="timeline-header title_name" style="display:none;"><a href="#">Office Monthly Revenue</a></h3>

                      <div class="timeline-body">
                        <table id="order_table" class="table table-bordered table-hover">
                      <thead>
                      
                      </thead>
                      <tbody>
                        
                        
                      <tr>
                      
                       
                      </tr>
               
                        
                      </tbody>
                     
                    </table>
                      </div>
                    
                    </div>
                 
                </div>
                <!-- Post -->
                <!-- =========================================================== -->

                <!-- /.post -->
              </div>



              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                                <!-- Post -->
                <div class="post">
               <div class="row">
               <div class="col-md-2"></div>
               <div class="col-md-2"> 
               <label> From Saturday</label> 
                     <input type="text" name="today_date" id="today_date" class="form-control" placeholder="From Date" />  
                </div> 
               
            <!--     <div class="col-md-2"> 
                <label>To Friday</label> 
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                </div>  -->
              
                  <div class="col-md-2">  
                    <label>Select Captain</label>
                  <select class="form-control select2" name="cap_id" id="cap_id" style="width: 100%;">
                  <option selected="selected">Select Captain</option>
                  <?php foreach ($captain_table as $values):?>
                  <option value="<?php echo $values->id?>"><?php echo $values->captain_name;?>  (<?php echo $values->mobile_number;?>)</option>
                  <?php endforeach;?>
                </select>
                 </div> 
                 <br> 
                <div class="col-md-2"> 

                     <input type="button" name="daily_filter" id="daily_filter" value="Search Record" class="btn btn-info" />  
                </div>
              <div class="col-md-1">
              </div>
            </div>
                    <div class="timeline-item">
                      <h3 class="timeline-header title_name2" style="display:none;"><a href="#">Captain Daily Rides</a></h3>

                      <div class="timeline-body">
                        <table id="order_table" class="table table-bordered table-hover">
                      <thead>
                      
                      </thead>
                      <tbody>
                      <tr>
                      </tr>
                      </tbody>
                    </table>
                      </div>
                      <div class="timeline-body">
                        <table id="ride_table" class="table table-bordered table-hover">
                      <thead>
                      
                      </thead>
                      <tbody>
                      <tr>
                      </tr>
                      </tbody>
                    </table>
                      </div>
                    
                    </div>
                 
                </div>
                <!-- Post -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

               <section class="content">
      <div class="row">
                            
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-8 col-md-offset-2">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>mul_revenue/pay_to_office" method="post">
              <div class="box-body">
                <input type="hidden" name="office_id" value="<?php echo $this->uri->segment(3);?>">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Month</label>
                  <div class="col-sm-10">
                    <select class="form-conrol" name="month_name">
                      <option value="January">January</option>
                      <option value="February">February</option>
                      <option value="March">March</option>
                      <option value="April">April</option>
                      <option value="May">May</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                      <option value="September">September</option>
                      <option value="October">October</option>
                      <option value="November">November</option>
                      <option value="December">December</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Office Share</label>
                  <div class="col-sm-10">
                    <input type="number" name="office_share" class="form-control" placeholder="Enter MUl Share Amount" id="office_share" required="">
                  </div>
                </div>


                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select class="form-conrol" name="status">
                      <option value="UNPAID">UNPAID</option>
                      <option value="PAID">PAID</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputEmail3" placeholder="Write Description Here" required="" col="5" rows="5" name="description"></textarea>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" name="submit" value="Pay" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>



      </div>
      </div>
      <!-- /.row -->

    </section>


  </div>

  <script src="<?php echo base_url();?>adminfiles/plugins/datepicker/bootstrap-datepicker.js"></script>

  <script>  

  $('#from_date').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
      
    });
  $('#to_date').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
      
    });
   $('#week_date').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
      
    });
   $('#today_date').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
      
    });


    $(document).ready(function(){  
         
           $('#filter_office_revenue').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();   
                var office_id = $('#office_id').val();   
                $('.title_name').show();
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"<?php echo base_url();?>mul_revenue/fetch_office_monthly_revenue",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date, office_id:office_id},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });







   </script>