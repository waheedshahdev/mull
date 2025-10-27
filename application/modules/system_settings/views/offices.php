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
            <form class="form-horizontal" action="<?php echo base_url();?>system_settings/add_office" method="post">

              <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">District</label>
                 <div class="col-sm-10">
                <select name = "district_id" class="form-control select2" style="width: 100%;">
                  <?php foreach ($view_district as $district):?>
                  <option value="<?php echo $district->id;?>"><?php echo $district->district_name;?></option>
              		<?php endforeach;?>
                </select>
              </div>
              </div>
              </div>
              <div class="box-body">
               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Office Name</label>
                 <div class="col-sm-10">
               <input type="text" name="office_name" id="office_name" class="form-control" placeholder="Enter Office name">
              </div>
              </div>
              </div>
              <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Office Phone</label>
                 <div class="col-sm-10">
               <input type="number" name="office_phone" id="office_phone" class="form-control" placeholder="Enter Office Phone Number">
              </div>
              </div>
              </div>
              <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Office Address</label>
                 <div class="col-sm-10">
                <textarea class="form-control" col="4" rows="5" name="office_address"></textarea>
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
           			<th>District</th>
           			<th>Office Name</th>
           			<th>Office Phone</th>
           			<th>Office Address</th>
           			<th>Created</th>
           			<th>Action</th>
           		</tr>

           	</thead>
           	<tbody>
           	<!--  -->
           	<?php foreach ($view_offices as $values):?>
           	<tr>
           		<td><?php echo $values->id;?></td>
           		<td><?php echo $values->district_name;?></td>
           		<td><?php echo $values->office_name;?></td>
           		<td><?php echo $values->office_phone;?></td>
           		<td><?php echo $values->office_address;?></td>
           		<td><?php echo $values->created_at;?></td>
           		<td><a href="#" class="btn btn-danger">Delete</a></td>
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