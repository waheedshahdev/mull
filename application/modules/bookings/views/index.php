










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
            </div>

            <!-- end search -->
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="book_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Customer</th>
                  <th>Captain</th>
                  <th>category</th>
                  <th>Pickup</th>
                  <th>Dropoff</th>
                  <th>Status</th>
                  <th>Ride Type</th>
                  <th>Ride For</th>
                  <th>Booking Date</th>
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

<!-- another captain model -->

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
<!--   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

  <!-- Modal -->

   <div class="modal fade" id="myModal_assign" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assign Another Captain</h4>
        </div>
        <div class="modal-body">
          <table id="online_captains" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Captain Name</th>
                  <th>Phone Number</th>
                  <th>Status</th>
                  <th>Ride Type</th>
                  <th>District</th>
                  <th>Category</th>
                  <th>sate</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


 
  
</div>

<!-- end another captain model -->

  </div>

  <script type="text/javascript">
    



  </script>
