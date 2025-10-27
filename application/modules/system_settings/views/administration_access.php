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
            <form class="form-horizontal" action="<?php echo base_url();?>system_settings/add_administrator" method="post">

              <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Office</label>
                 <div class="col-sm-10">
                <select name = "office_id" class="form-control select2" style="width: 100%;">
                  <?php foreach ($view_offices as $office):?>
                  <option value="<?php echo $office->id;?>"><?php echo $office->office_name;?></option>
              		<?php endforeach;?>
                </select>
              </div>
              </div>
              </div>
              <div class="box-body">
               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Administrator Name</label>
                 <div class="col-sm-10">
               <input type="text" name="name" id="name" class="form-control" placeholder="Enter Administrator name">
              </div>
              </div>
              </div>
              <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                 <div class="col-sm-10">
               <input type="email" name="email" id="email" class="form-control" placeholder="Enter Administrator Email">
              </div>
              </div>
              </div>

              <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                 <div class="col-sm-10">
               <input type="password" name="password" id="password" class="form-control" placeholder="Enter Administrator Password">
              </div>
              </div>
              </div>

              <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Access Level</label>
                 <div class="col-sm-10">
                <select name="user_type" class="form-control select2" style="width: 100%;">
                  <option value="Super Admin" selected="selected">Super Admin</option>
                  <option value="User Admin">User Admin</option>
                  <option value="User Admin CR">User Admin Customer Representative</option>
                  <option value="Car_inspection">Car Inspection Portal</option>
                  <option value="Accounts">Accounts</option>
                  <option value="Customer Care">Customer Care</option>
                  <option value="Manager">Manager</option>
                  <option value="Blind Partner">Blind Partner</option>
                </select>
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
              <h3 class="box-title">Administrators</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <table class="table table-responsive">
           	<thead>
           		<tr>
           			<th>id</th>
           			<th>Name</th>
           			<th>Created</th>
           			<th>Action</th>
           		</tr>

           	</thead>
           	<tbody>
           	<!--  -->

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