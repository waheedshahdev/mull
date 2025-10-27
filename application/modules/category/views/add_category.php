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
            <form class="form-horizontal" action="<?php echo base_url();?>category" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Category Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="category_name" class="form-control" id="inputEmail3" placeholder="Enter Category Name" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Category Base Fare</label>

                  <div class="col-sm-10">
                    <input type="text" name="base_fare" class="form-control" id="inputEmail3" placeholder="Enter Base Fare" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Per KM Price</label>

                  <div class="col-sm-10">
                    <input type="text" name="per_km" class="form-control" id="inputEmail3" placeholder="Enter Per KM Price" required="">
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
              <h3 class="box-title">View Categories</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <table class="table table-responsive">
           	<thead>
           		<tr>
           			<th>id</th>
           			<th>category Name</th>
                <th>Base Fare</th>
                <th>Per KM Fare</th>
           			<th>Created</th>
           			<th>Action</th>
           		</tr>

           	</thead>
           	<tbody>
           		<?php foreach ($view_categories as  $values):?>
           		<tr>
           			<td><?php echo $values->id;?></td>
           			<td><?php echo $values->category_name;?></td>
                <td><?php echo $values->base_fare;?></td>
                <td><?php echo $values->per_km;?></td>
           			<td><?php echo $values->created_at;?></td>
           			<td><a href="<?php echo base_url();?>caegory/delete_category/<?php echo $values->id;?>" class="btn btn-danger">Delete</a></td>
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