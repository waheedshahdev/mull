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
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="car_switching_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Car Reg Number</th>
                  <th>Old vendor Name/CNIC</th>
                  <th>Old Vendor Mobile Number</th>
                  <th>New Vendor Name/CNIC</th>
                  <th>New Vendor Mobile Number</th>
                  <th>Car Document</th>
                  <th>Created at</th>
                  <th>Status</th>
                  <th>Updated at</th>
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
  </div>