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
              <!-- start search -->
              <div class="row">
               <div class="col-md-2"></div>
               <div class="col-md-3">
                <select class="form-control myselects" data-column="0" >
                  <option value="">All</option>
                  <option value="P">Pending</option>
                  <option value="A">Approved</option>
                  <option value="B">Blocked</option>
                </select>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control mydrivers" data-column="1" placeholder="Search By Rider Name or Email" />
              </div>
              <div class="col-md-2">
                <button class="btn btn-info sbold green" onclick="check_status()"> Search</button>&nbsp;&nbsp;<button class="btn btn-info sbold green" onclick="location.reload()">View All</button>
              </div>
              <div class="col-md-1">
              </div>
            </div>

            <!-- end search -->
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="captains_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>CNIC Number</th>
                  <th>Mobile Number</th>
                  <th>District</th>
                  <th>Created at</th>
                  <th>Status</th>
                  <th>Updated at</th>
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
      
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <script>

//$(document).ready(function(){

//$('.myselects').on('change',function(){

  function check_status(){

    var s=$('.myselects').val();
    var d=$('.mydrivers').val();

    i=$('.myselects').attr('data-column');

    j=$('.mydrivers').attr('data-column');

    if(d!='' && s!=''){

     var i=$('.myselects').attr('data-column');

     j=$('.mydrivers').attr('data-column');

     cap.column(i).search(s).draw();

     cap.column(j).search(d).draw();
   }

   else if(s!=''){

    var i=$('.myselects').attr('data-column');

    cap.column(i).search(s).draw();

  }

  else if(d!=''){

    j=$('.mydrivers').attr('data-column');

    cap.column(j).search(d).draw();

  }

  else{

    cap.column(i).search(s).draw();

    cap.column(j).search(d).draw();
  }

}


</script>