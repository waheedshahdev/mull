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
            <form class="form-horizontal" action="<?php echo base_url();?>system_settings/add_rates" method="post">

              <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                 <div class="col-sm-10">
                <select name = "category_id" class="form-control select2" style="width: 100%;">
                  <?php foreach ($view_category as $category):?>
                  <option value="<?php echo $category->id;?>"><?php echo $category->category_name;?></option>
              		<?php endforeach;?>
                </select>
              </div>
              </div>
              </div>
              <div class="box-body">
               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Base Fare</label>
                 <div class="col-sm-10">
               <input type="number" name="base_fare" id="base_fare" class="form-control" placeholder="Enter Base Fare Amount">
              </div>
              </div>
              </div>
              <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Per km Rate</label>
                 <div class="col-sm-10">
               <input type="number" name="per_km" id="per_km" class="form-control" placeholder="Enter Per km Rate">
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
    <?php 
                            if($this->session->flashdata("message") != ''){?>
                            <div class="alert alert-success">
                                <button class="close" data-dismiss="alert"></button>
                                <?php echo $this->session->flashdata("message");?>
                            </div>
                            <?php
                            }
                            ?>
    <section class="content">
      <div class="row">
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12 ">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Administrators</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <table class="table table-responsive">
           	<thead>
           		<tr>
           			<th>id</th>
           			<th>Category Name</th>
           			<th>Base Fare</th>
           			<th>Per Km Rate</th>
           			<th>Created</th>
           			<th>Updated</th>
           			<th>Action</th>
           		</tr>

           	</thead>
           	<tbody>
           	<!--  -->
           	<?php foreach ($view_rates as $values):?>
           	<tr>
           		<td><?php echo $values->id;?></td>
           		<td><?php echo $values->category_name;?></td>
           		<td><?php echo $values->base_fare;?></td>
           		<td><?php echo $values->per_km;?></td>
           		<td><?php echo $values->created_at;?></td>
           		<td><?php echo $values->updated_at;?></td>
           		<td><a href="#" class="btn btn-info">Update</a></td>
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
    <!-- /.content -->

  </div>