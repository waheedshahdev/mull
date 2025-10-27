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
        <div class="col-md-8 col-md-offset-2">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>fines/add_captain_fine" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Select Name</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="customer_id" id="customer_id" style="width: 100%;">
                  <option selected="selected">Select Customer</option>
                  <?php foreach ($customer_table as $values):?>
                  <option value="<?php echo $values->id?>"><?php echo $values->customer_name;?>  (<?php echo $values->mobile_number;?>)</option>
                  <?php endforeach;?>
                </select>
                  </div>
                </div>
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Complain</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputEmail3" placeholder="Write Complain Here" required="" col="5" rows="5" name="complain"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Fine Amount</label>
                  <div class="col-sm-10">
                  	<input type="number" name="fine_amount" class="form-control" placeholder="Enter Fine Amount" id="fine_amount" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Fine Status</label>
                  <div class="col-sm-10">
                  	<select class="form-conrol" name="paid_status">
                  		<option value="UNPAID">UNPAID</option>
                  		<option value="PAID">PAID</option>
                  		<option value="REMISSION">REMISSION</option>
                  	</select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Complain Date</label>
                  <div class="col-sm-10">
                  	<input type="date" name="complain_date" class="form-control" placeholder="Enter Fine Amount" id="complain_date" required="">
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
 
      
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>