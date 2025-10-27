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
              <table id="rides_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Captain Name</th>
                  <th>Cap #</th>
                  <th>Customer Name</th>
                  <th>Customer #</th>
                  <th>Car Category</th>
                  <th>Pickup lat</th>
                  <th>Pickup lng</th>
                  <th>Destination lat</th>
                  <th>Destination lng</th>
                  <th>Ride Date</th>
                  <th>Ride Amount</th>
                  <th>Status</th>
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