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
        <hr>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-8 col-md-offset-2">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
            <!-- /.box-header -->
            <?php foreach ($fine_data as $fine):?>
        <?php endforeach;?>
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>fines/update_fines/<?php echo $this->uri->segment(3)?>" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Captain Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="category_name" class="form-control" id="inputEmail3" value="<?php echo $fine->captain_name?>" placeholder="Enter Category Name" required="" disabled="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Customer Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="customer_id" class="form-control" id="customer_id" value="<?php echo $fine->customer_name?>" placeholder="Enter Base Fare" required="" disabled="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Complain</label>

                  <div class="col-sm-10">
                    <textarea name="complain" id="complain" class="form-control" required=""><?php echo $fine->complain;?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Fine Amount</label>

                  <div class="col-sm-10">
                   <input type="number" name="fine_amount" class="form-control" id="fine_amount" value="<?php echo $fine->fine_amount?>" placeholder="Enter Fine" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                   <select name="status" id="status">
                   	<option value="UNPAID">UNPAID</option>
                   	<option value="PAID">PAID</option>
                   	<option value="REMISSION">REMISSION</option>
                   </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Complain Date</label>

                  <div class="col-sm-10">
                   <input type="text" name="complain_date" class="form-control" id="complain_date" value="<?php echo $fine->complain_date?>" required="">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
               <!--  <button type="submit" class="btn btn-default">Cancel</button> -->
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