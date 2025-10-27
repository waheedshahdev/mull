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
        <div class="col-md-8 col-md-offset-2 ">
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
           			<th>App Name</th>
           			<th>Phone Number</th>
                <th>Email</th>
           			<th>Status</th>
           	
           		</tr>

           	</thead>
           	<tbody id="contact_data">
           
        

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
