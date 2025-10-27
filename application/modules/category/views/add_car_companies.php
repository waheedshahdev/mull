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
       <section class="content">
      <div class="row">
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>category/add_car_company" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Car Company Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Enter Category Name" required="">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" name="submit" value="Submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
     <section class="content">
      <div class="row">
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12 ">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">View Car Company</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <table class="table table-responsive">
           	<thead>
           		<tr>
           			<th>id</th>
           			<th>Company Name</th>
           			<th>Created</th>
           			<th>Action</th>
           		</tr>

           	</thead>
           	<tbody>
           		<?php foreach ($view_categories as  $values):?>
           		<tr>
           			<td><?php echo $values->id;?></td>
           			<td><?php echo $values->name;?></td>
           			<td><?php echo $values->created_at;?></td>
           			<td><a href="<?php echo base_url();?>caegory/delete_car_company/<?php echo $values->id;?>" class="btn btn-danger">Delete</a></td>
           		</tr>
           	<?php endforeach;?>

           	</tbody>

           </table>
          </div>

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
      
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>