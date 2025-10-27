  <link rel="stylesheet" href="<?php echo base_url();?>adminfiles/plugins/datepicker/datepicker3.css"> 

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

        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Search Captain Weekly Data</a></li>
              <li><a href="#timeline" data-toggle="tab">Search Captain Daily Rides</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
               <div class="row">
               <div class="col-md-2"></div>
               <div class="col-md-2"> 
               <label> From Saturday</label> 
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                </div> 
               
                <div class="col-md-2"> 
                <label>To Friday</label> 
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                </div> 
              
                  <div class="col-md-2">  
                    <label>Select Captain</label>
                  <select class="form-control select2" name="captain_id" id="captain_id" style="width: 100%;">
                  <option selected="selected">Select Captain</option>
                  <?php foreach ($captain_table as $values):?>
                  <option value="<?php echo $values->id?>"><?php echo $values->captain_name;?>  (<?php echo $values->mobile_number;?>)</option>
                  <?php endforeach;?>
                </select>
                 </div> 
                 <br> 
                <div class="col-md-2"> 

                     <input type="button" name="filter" id="filter" value="Search Record" class="btn btn-info" />  
                </div>
              <div class="col-md-1">
              </div>
            </div>
                    <div class="timeline-item">
                      <h3 class="timeline-header title_name" style="display:none;"><a href="#">Captain Weekly Payments</a></h3>

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
            <form class="form-horizontal" action="<?php echo base_url();?>payments/captain_pay" method="post">
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Select Captain</label>
                  <div class="col-sm-10">

                  <select class="form-control select2" name="captain_id" id="captain_id" style="width: 100%;">
                  <option selected="selected">Select Captain</option>
                  <?php foreach ($captain_table as $values):?>
                  <option value="<?php echo $values->id?>"><?php echo $values->captain_name;?>  (<?php echo $values->mobile_number;?>)</option>
                  <?php endforeach;?>
                </select>

                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Week</label>
                  <div class="col-sm-10">
                   <input type="text" name="week" class="form-control" id="week_date" placeholder="Enter Week date"> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Mul Share</label>
                  <div class="col-sm-10">
                    <input type="number" name="mul_share" class="form-control" placeholder="Enter MUl Share Amount" id="mul_share" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Extra Amount</label>
                  <div class="col-sm-10">
                    <input type="number" name="extra_amount" class="form-control" placeholder="Enter Extra Payment" id="extra_payment" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Extra Amount Status</label>
                  <div class="col-sm-10">
                    <select class="form-conrol" name="extra_amount_status">
                      <option value="Captain Pay to Mul">Captain Pay it</option>
                      <option value="We Pay to Captain">Mul Pay it</option>
                    </select>
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
      <!-- /.row -->

    </section>
    <!-- /.content -->
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
         
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                var captain_id = $('#captain_id').val();  
                $('.title_name').show();
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"<?php echo base_url();?>payments/fetch_captain_payment",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date, captain_id:captain_id},  
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

      $(document).ready(function(){  
         
           $('#daily_filter').click(function(){  
               // var from_date = $('#from_date').val();  
                var today_date = $('#today_date').val();  
                var cap_id = $('#cap_id').val();  
                $('.title_name2').show();
                if(today_date != '' && cap_id != '')  
                {  
                     $.ajax({  
                          url:"<?php echo base_url();?>payments/fetch_daily_rides",  
                          method:"POST",  
                          data:{today_date:today_date, cap_id:cap_id},  
                          success:function(data)  
                          {  
                               $('#ride_table').html(data);  
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