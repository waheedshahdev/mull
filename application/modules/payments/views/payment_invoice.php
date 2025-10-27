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
             


            <!-- end search -->
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
                <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <?php foreach ($invoice_data as $row) {
              # code...
            }?>
            <img src="<?php echo base_url('userfiles/images/invoice_logo.jpeg');?>" style="width:100px; height: 100px;">
            <small class="pull-right">Date: <?php echo date('d-l-Y');?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>MUL, Inc.</strong><br>
            Rahim Abad<br>
            Mingora Swat<br>
            Phone: (xxx) xxxx-xxxxxx<br>
            Email: info@mul.com
          </address>
        </div>
        <!-- /.col -->
        <!-- <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>John Doe</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (555) 539-1037<br>
            Email: info@mul.com
          </address>
        </div>
 -->        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo $row->invoice_id;?></b><br>
          <br>
          <b>Paid Due Date:</b> <?php echo date('d-l-Y');?> <br>
          <b>Account:</b> By Hand Payment
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Invoice ID</th>
              <th>Week</th>
              <th>Mul Share</th>
              <th>Extra Amount</th>
              <th>Extra Amount Status</th>
              <th>Status</th>
              <th>Paid On</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><?php echo $row->invoice_id;?></td>
              <td><?php echo $row->week;?></td>
              <td><?php echo $row->mul_share;?></td>
              <td><?php echo $row->extra_amount;?></td>
              <td><?php echo $row->extra_amount_status;?></td>
              <td><?php echo $row->status;?></td>
              <td><?php echo $row->created_at;?></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <h3> SELF</h3>

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Accountant Signature and Stamp
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due: <?php echo $row->week;?> </p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>PKR: <?php echo $row->subtotal;?></td>
              </tr>
              <tr>
                <th>Tax (0.00)</th>
                <td>PKR: 0.00</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>PKR: <?php echo $row->subtotal;?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a type="button" onclick="myFunction()" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print</a>
<!--           <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
    </section>
    <!-- /.content -->
      
          </div>
          <!-- /.box (chat box) -->
        </section>
      
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
<script>
function myFunction() {
    window.print();
}
</script>

