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
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="<?php echo base_url('userfiles/images/invoice_logo.jpeg');?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">All Mull Revenue</h3>
              <h5 class="widget-user-desc"></h5>
              <h5 class="widget-user-desc"></h5>
            </div>
            <div class="box-footer no-padding">
              <?php foreach ($all_revenue as $values) {
                # code...
              }?>
              <ul class="nav nav-stacked">
                <li><a href="#">All Mull Revenue <span class="pull-right"><?php echo $values->all_revenue;?></span></a></li>
                <li><a href="#">All Extra Amount <span class="pull-right"><?php echo $values->extra_pay_by_customer;?></a></li>
                <?php foreach ($all_paid_revenue as $paid) {
                  # code...
                }?>
                <li><a href="#">All Paid Revenue  <span class="pull-right"><?php echo $paid->mul_revenue;?></span></a></li>
                <li><a href="#">All Paid Extra Amount <span class="pull-right"><?php echo $paid->extra_amount;?></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">This Month Revenue</h3>
              <h5 class="widget-user-desc"></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?php echo base_url('userfiles/images/invoice_logo.jpeg');?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <?php foreach ($monthly_revenue as $rev) {
                # code...
              }?>
              <div class="row">
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $rev->all_monthly_revenue?></h5>
                    <span class="description-text">Revenue</span>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $rev->monthly_extra_pay?></h5>
                    <span class="description-text">Extra</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <?php foreach ($current_month as $mon) {
                # code...
              }?>
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $mon->monthly_mul_revenue;?></h5>
                    <span class="description-text">Paid</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $mon->extra_amount;?></h5>
                    <span class="description-text">Extra Paid</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="<?php echo base_url('userfiles/images/invoice_logo.jpeg');?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Mull Monthly Credit</h3>
              <h5 class="widget-user-desc"></h5>
              <h5 class="widget-user-desc"></h5>
            </div>
            <div class="box-footer no-padding">
              <?php foreach ($current_month_credit as $credit) {
                # code...
              }?>
              <ul class="nav nav-stacked">
                <li><a href="#">Mull Pay To Offices <span class="pull-right"><?php echo $credit->monthly_office_share;?></span></a></li>
                <li><a href="#">Mull Pay to Captains Extra Amount <span class="pull-right"><?php echo $credit->extra_amount;?></a></li>

              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12 ">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Revenue</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <table class="table table-responsive">
            <thead>
              <tr>
                <th>Office id</th>
                <th>Office Name</th>
                <th>District</th>
                <th>Address</th>
                <th>Action</th>
              </tr>

            </thead>
            <tbody>
            <!--  -->
            <?php foreach ($view_offices as $values):?>
            <tr>
              <td><?php echo $values->office_id;?></td>
              <td><?php echo $values->office_name;?></td>
              <td><?php echo $values->district_name;?></td>
              <td><?php echo $values->office_address;?></td>
              <td><a href="<?php echo base_url();?>mul_revenue/view_office_revenue/<?php echo $values->office_id;?>" class="btn btn-info">View Revenue</a></td>
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