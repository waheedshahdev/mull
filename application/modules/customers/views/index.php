
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title;?>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
        
          <div class="box box-success">
          
            <div class="box-header">
              <!-- start search -->
              <div class="row">
               <!-- <div class="col-md-2"></div>
               <div class="col-md-3">
                <select class="form-control myselects" data-column="0" >
                  <option value="">All</option>
                  <option value="P">Pending</option>
                  <option value="A">Approved</option>
                  <option value="B">Blocked</option>
                </select>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control mydrivers" data-column="1" placeholder="Search By Rider Name or Email" />
              </div>
              <div class="col-md-2">
                <button class="btn btn-info sbold green" onclick="check_status()"> Search</button>&nbsp;&nbsp;<button class="btn btn-info sbold green" onclick="location.reload()">View All</button>
              </div>
              <div class="col-md-1">
              </div> -->

              <div class="col-md-6 col-md-offset-4">
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Send SMS to Selected Customer</button>
                <button class="btn btn-success" data-toggle="modal" data-target="#myModal_manual">Send SMS to Manual Customers</button>
              </div>
              <div class="col-md-6 col-md-offset-4">
                
              </div>
            </div>

            <!-- end search -->
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="customers_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox" name="chekc_all" id="check_all"></th>
                  <th>ID</th>
                  <th>Customers Name</th>
                  <th>Customer #</th>
                  <th>Email</th>
                  <th>password</th>
                  <th>Status</th>
                  <th>Customer Status</th>
                  <th>Balance</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

              </table>
            </div>
      
          </div>
          <!-- /.box (chat box) -->
        </section>
      
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
    <!-- /checkbox sms modal -->
    <div class="container">
<!--   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Send Message</button> -->

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
          <form action="" method="post">
            <label> Write Message</label>
            <br>
            <textarea name="sms_message" id="sms_message" class="form-control" cols="5" rows="5" ></textarea>
            <br>
            <input type="button" name="btn_send" id="btn_send" value="Send" class="btn btn-info btn-block">
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<!-- End check box modal -->

 <!-- /checkbox sms modal -->
    <div class="container">
<!--   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Send Message</button> -->

  <!-- Modal -->
  <div class="modal fade" id="myModal_manual" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Message</h4>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>customers/send_manual_messages" method="post">

            <label>Enter Number</label>
            <input type="number" name="customer_number" class="form-control">

            <label> Write Message</label>
            <br>
            <textarea name="sms" id="sms" class="form-control" cols="5" rows="5" ></textarea>
            <br>
            <input type="submit" name="submit" id="submit" value="Send" class="btn btn-info btn-block">
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<!-- End check box modal -->

  </div>

  <script>

//$(document).ready(function(){

//$('.myselects').on('change',function(){

 


</script>