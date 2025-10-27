 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active"><?php echo $title;?></li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $title;?></h1>
            </div>
        </div><!--/.row-->
        
        <div class="row">
         
            <?php 
                            if($this->session->flashdata("error_msg") != ''){?>
                            <div class="alert alert-success">
                                <button class="close" data-dismiss="alert"></button>
                                <?php echo $this->session->flashdata("error_msg");?>
                            </div>
                            <?php
                            }
                            ?>
            
            <div class="col-md-12">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        Inspection Form
                        
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body timeline-container">
                        <section class="col-lg-12 connectedSortable">
        
          <div class="box box-success">
          
            <div class="box-header">
              <!-- start search -->
              

            <!-- end search -->
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="car_inspection_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Office</th>
                  <th>Car Number</th>
                  <th>A/C</th>
                  <th>Black Mirrors</th>
                  <th>Tyre</th>
                  <th>Orignal # Plates</th>
                  <th>Seats</th>
                  <th>Suspension</th>
                  <th>Music System</th>
                  <th>Fees</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

              </table>
            </div>
      
          </div>
          <!-- /.box (chat box) -->
        </section>
                    </div>
                </div>
            </div><!--/.col-->
            <div class="col-sm-12">
                <p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
            </div>
        </div><!--/.row-->
    </div>  <!--/.main-->