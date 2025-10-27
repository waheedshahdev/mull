<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Admin Home Page</title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url();?>userfiles/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>userfiles/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>userfiles/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>userfiles/assets/styles.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>userfiles/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  --> 
 
                
      
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->




        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="<?php //echo base_url();?>userfiles/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
         
        <script src="<?php echo base_url();?>userfiles/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Admin Panel</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo $this->session->userdata('name');?> <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>admin/logout">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <?php if($this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'Blind Partner'){ ?>
                            <li class="">
                                <a href="<?php echo base_url();?>admin">Dashboard</a>
                            </li>
                            <?php } ?>
                            <?php if($this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR'){ ?>
                            <li class="">
                                <a href="<?php echo base_url();?>admin/search">Search</a>
                            </li>
                            <?php }?>
                            <?php if($this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR'){ ?>
                             <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Add <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>admin/add_vendor">Add Vendor</a>
                                    </li>
                                   
                                   
                                </ul>
                            </li>
                            <?php } ?>
                            <?php if($this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR'){ ?>
                            <li class="">
                                <a href="<?php echo base_url();?>admin/car_switch">Car Switch</a>
                            </li>
                            <?php } ?>
                            <?php if($this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR'){ ?>
                            <li class="">
                                <a href="<?php echo base_url();?>admin/captain_switch">Captain Switch</a>
                            </li>
                            <?php } ?>
                            <?php if($this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR'){ ?>
                            <li class="">
                                <a href="#">Captain Complains</a>
                            </li>
                            <?php } ?>
                            <?php if($this->session->userdata('user_type') == 'Blind Partner'){ ?>
                             <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Office Revenue <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>admin/today_revenue">View Today Revenue</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>admin/monthly_revenue">View Monthly Revenue</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>admin/car_inspection_revenue">Car Inspection Revenue</a>
                                    </li>
                                   
                                   
                                </ul>
                            </li>
                            <?php } ?>
                            <?php if($this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR'){ ?>
                             <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Search Info <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>admin/search_captain_info">Search Captain Info</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>admin/search_car_info">Search Car Info</a>
                                    </li>
                                   
                                   
                                </ul>
                            </li>
                            <?php } ?>
                           <!--  <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Settings <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="#">Tools <i class="icon-arrow-right"></i>

                                        </a>
                                        <ul class="dropdown-menu sub-menu">
                                            <li>
                                                <a href="#">Reports</a>
                                            </li>
                                            <li>
                                                <a href="#">Logs</a>
                                            </li>
                                            <li>
                                                <a href="#">Errors</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">SEO Settings</a>
                                    </li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Content <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Blog</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">News</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Custom Pages</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Calendar</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="#">FAQ</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">User List</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Search</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Permissions</a>
                                    </li>
                                </ul>
                            </li> -->
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <?php if(isset($view_files))

                    $this->load->view($view_module.'/'.$view_files);

             ?>
        
            <hr>
            <footer>
                <p>&copy; Mul 2018</p>
            </footer>
        </div>
        <!--/.fluid-container-->

        <script src="<?php echo base_url();?>userfiles/vendors/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url();?>userfiles/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>userfiles/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="<?php echo base_url();?>userfiles/assets/scripts.js"></script>
              <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
              <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
              <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 
        <script src="<?php echo base_url();?>userfiles/assets/DT_bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>
<script src="CDNJS: https://cdnjs.com/libraries/1000hz-bootstrap-validator"></script>
        <script>
        $(function() {
            
        });
        </script>

        <script type="text/javascript">
		
        // start add vendor
        function add_vendor(){
            $(document).on('submit','#add_vendor_form',function(event){
				
            event.preventDefault();
            var name = $('#name').val();
            var cnic_number = $('#cnic_number').val();
            var email_address = $('#email_address').val();
            var mobile_number = $('#mobile_number').val();
			 var cnic_front = $('#cnic_front').val().split('.').pop().toLowerCase();
            var cnic_back = $('#cnic_back').val().split('.').pop().toLowerCase();
            var office_id=$("#office_id").val();
			var admin_id=$("#admin_id").val();
			if(name == "" || cnic_number=="" || email_address =="" || mobile_number == "")
			{
				$("#danger").addClass("show");
				$("#danger").removeClass("hide");
				
				
				
			}
			else if(cnic_number.length < 13)
			{
				$("#danger1").addClass("show");
				$("#danger1").removeClass("hide");
				
			}				
           
       else if(jQuery.inArray(cnic_front, ['gif', 'png', 'jpg', 'jpeg']) == -1 || jQuery.inArray(cnic_back, ['gif', 'png', 'jpg', 'jpeg']) == -1 )
            {
                alert("invalid Image File");
                $('#cnic_front'). val('');
                $('#cnic_back') . val('');

                return false;
            }
			else{
           
                $.ajax({
                    url: "<?php echo base_url();?>admin/add_vendor_data",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {
                        

                        if(data.includes("EMAIL") || data.includes("CNIC") || data.includes("MOBILE")){

                                if(data.includes("CNIC")){
                                    document.getElementById('cnic_number').focus();
                                    document.getElementById('cnic_number').select();
                                    document.getElementById('err_cnic').innerHTML="<p style='color:red'>CNIC must be unique OR must have exactly 13 digits</p>";
                                }else{
                                    document.getElementById('err_cnic').innerHTML="";

                                } 
                                if(data.includes("EMAIL")){
                                    document.getElementById('email_address').focus();
                                    document.getElementById('email_address').select();
                                    document.getElementById('err_email').innerHTML="<p style='color:red'>EMAIL must be unique</p>";
                                }else {
                                    document.getElementById('err_email').innerHTML="";
                                }
                                if(data.includes("MOBILE")){
                                    document.getElementById('mobile_number').focus();
                                    document.getElementById('mobile_number').select();
                                    document.getElementById('err_mobile').innerHTML="<p style='color:red'>MOBILE No. must be unique</p>";
                

                                }else{
                                    document.getElementById('err_mobile').innerHTML="";
                                }

                        }else{

                            document.getElementById('err_cnic').innerHTML="";
                            document.getElementById('err_email').innerHTML="";
                            document.getElementById('err_mobile').innerHTML="";

                            alert("Data Saved");
                            $('#add_vendor_form')[0].reset();
                            location.href = 'update_vendor/'+data;
                        }
                        
                    }
                });
			}

        });
            }
        // end add vendor

        // start add car
         $(document).on('submit','#add_car_form',function(event){
            event.preventDefault();
            var car_reg_number = $('#car_reg_number').val();
            var district_id = $('#district_id').val();
            var car_company_id = $('#car_company_id').val();
            var car_type_id = $('#car_type_id').val();
            var car_model_id = $('#car_model_id').val();
            var car_color_id = $('#car_color_id').val();
            var office_id = $('#office_id').val();
            var admin_id = $('#admin_id').val();
            var car_document = $('#car_document').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(car_document, ['gif', 'png', 'jpg', 'jpeg']) == -1)
            {
                alert("invalid Image File");
                $('#car_document'). val('');

                return false;
            }
           
                $.ajax({
                    url: "<?php echo base_url();?>admin/add_car_data",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {
                        alert("Data Saved");
                        //alert(data);
                        $('#add_car_form')[0].reset();
                        var id = $('#vendor_id').val();
                        location.href = '<?php echo base_url();?>admin/update_vendor/'+id;
                    }
                });
          

        });
        $(document).ready(function()
        {
            $('#district_id').on('change',function(){
                        var car_reg_number = $('#car_reg_number').val();
                        var district_id = $('#district_id').val();
                $.ajax({
                    url: "<?php echo base_url();?>admin/check_car",
                    method: 'POST',
                    data: {car_reg_number: car_reg_number, district_id: district_id},
                 
                    success: function(data){
                        $('#found_message').html(data);
                       alert()

                    }

            })
                })
        });

        //end add car
 
        // start add captain
        $(document).on('submit','#add_captain_form',function(event){
            event.preventDefault();
            var captain_name = $('#captain_name').val();
            var cap_id = $('#cap_id').val();
            var mobile_number = $('#mobile_number').val();
            var cnic_number = $('#cnic_number').val();
            var district_id = $('#district_id').val();
            var office_id = $('#office_id').val();
            var admin_id = $('#admin_id').val();
            var captain_image = $('#captain_image').val().split('.').pop().toLowerCase();
            var cnic_front = $('#cnic_front').val().split('.').pop().toLowerCase();
            var cnic_back = $('#cnic_back').val().split('.').pop().toLowerCase();
            var liscence_front = $('#liscence_front').val().split('.').pop().toLowerCase();
            var liscence_back = $('#liscence_back').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(captain_image, ['gif', 'png', 'jpg', 'jpeg']) == -1 || jQuery.inArray(cnic_front, ['gif', 'png', 'jpg', 'jpeg']) == -1 || jQuery.inArray(cnic_back, ['gif', 'png', 'jpg', 'jpeg']) == -1 || jQuery.inArray(liscence_front, ['gif', 'png', 'jpg', 'jpeg']) == -1 || jQuery.inArray(liscence_back, ['gif', 'png', 'jpg', 'jpeg']) == -1 )
            {
                alert("invalid Image File");
                $('#captain_image'). val('');
                $('#cnic_front'). val('');
                $('#cnic_back'). val('');
                $('#liscence_front'). val('');
                $('#liscence_back'). val('');

                return false;
            }
           
                $.ajax({
                    url: "<?php echo base_url();?>admin/add_captain_data",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {

                        if(data.includes("CNIC") || data.includes("MOBILE")){

                                if(data.includes("CNIC")){
                                    document.getElementById('cnic_number').focus();
                                    document.getElementById('cnic_number').select();
                                    document.getElementById('err_cnic').innerHTML="<p style='color:red'>CNIC must be unique OR must have exactly 13 digits</p>";
                                }else{
                                    document.getElementById('err_cnic').innerHTML="";

                                } 
                             
                                if(data.includes("MOBILE")){
                                    document.getElementById('mobile_number').focus();
                                    document.getElementById('mobile_number').select();
                                    document.getElementById('err_mobile').innerHTML="<p style='color:red'>MOBILE No. must be unique</p>";
                

                                }else{
                                    document.getElementById('err_mobile').innerHTML="";
                                }

                        }else{

                            document.getElementById('err_cnic').innerHTML="";
                            document.getElementById('err_mobile').innerHTML="";
                            alert("Data Saved");
                            
                            $('#add_captain_form')[0].reset();
                            var id = $('#vendor_id').val();
                            location.href = '<?php echo base_url();?>admin/update_vendor/'+id;

                        }
                    }
                });
          

        });
        // end add captain

        // start car switch
        $(document).on('submit','#car_switch_form',function(event){
            event.preventDefault();
            var car_doc = $('#car_doc').val().split('.').pop().toLowerCase();
            var car_reg_number = $('#car_reg_number').val();
            var old_vendor_cnic = $('#old_vendor_cnic').val();
            var old_vendor_number = $('#old_vendor_number').val();
            var new_vendor_cnic = $('#new_vendor_cnic').val();
            var new_vendor_number = $('#new_vendor_number').val();
			if(car_reg_number=="" || old_vendor_cnic == "" || old_vendor_cnic =="" ||new_vendor_cnic == "" || new_vendor_number=="")
			{
				$("#danger").addClass("show");
				$("#danger").removeClass("hide");
			}
			/*else if(new_vendor_cnic.length < 13)
			{
				$("#danger1").addClass("show");
				$("#danger1").removeClass("hide");
			}*/
            
            else if(jQuery.inArray(car_doc, ['gif', 'png', 'jpg', 'jpeg']) == -1)
            {
                alert("invalid Image File");
                $('#car_doc'). val('');

                return false;
            }
           else{
                $.ajax({
                    url: "<?php echo base_url();?>admin/car_switch_data",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {
                        
                        if(data=="already"){

                            alert("Request at specific date is already in list, please try later");
                        }else{
                        
                            $('#car_switch_form')[0].reset();
                            $('#success_message').html(data);
                            location.reload();
                        }
                      
                    }
                });
		   }
          

        });
        //end car switch
       
        // start captain switch
 $(document).on('submit','#captain_switch_form',function(event){
            event.preventDefault();
           
            var captain_name_cnic = $('#captain_name_cnic').val();
            var captain_mobile = $('#captain_mobile').val();
            var old_vendor_cnic = $('#old_vendor_cnic').val();
            var new_vendor_cnic = $('#new_vendor_cnic').val();
           

                $.ajax({
                    url: "<?php echo base_url();?>admin/captain_switch_data",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {

                        // alert(data);
                        if(data=="already"){

                            alert("Request at specific date is already in list, please try later");
                        }else{
                        
                            $('#captain_switch_form')[0].reset();
                            $('#success_message').html(data);
                            location.reload();
                        }
                      
                    }
                });
          
                
        });
        // end captain switch

        // show captain list
        $(document).ready(function(){  
      var dataTable = $('#user_data').DataTable({  
           "processing":true,  
           "serverSide":true,  
           "order":[],  
           "ajax":{  
                url:"<?php echo base_url() . 'admin/captain_datatable'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
                {  
                     "targets":[0, 3, 4],  
                     "orderable":false,  
                },  
           ],  
      });  
 });          // end show captain list

            // start code for car switch data
            $(document).ready(function(){  
      var dataTable = $('#car_data').DataTable({  
           "processing":true,  
           "serverSide":true,  
           "order":[],  
           "ajax":{  
                url:"<?php echo base_url() . 'admin/car_switch_datatable'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
                {  
                     "targets":[0, 3, 4],  
                     "orderable":false,  
                },  
           ],  
      });  
 });      
            // end code for car switch data
        </script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });

        //search vendor 
		$("#search_vendor_submit").click(function(e){
			e.preventDefault();
			var search_type = $("#select_type option:selected").val();
			var search_vendor = $("#search_vendor").val();
			console.log(search_type + " " + search_vendor);
			  $.ajax({
                    url: "<?php echo base_url();?>admin/search_vendor",
                    method: 'POST',
                    data: {search_type:search_type,search_vendor:search_vendor},
                    success: function(data)
                    {
                        $("#vendor_table").html(data);
                        console.log(data);
                        //$('#captain_switch_form')[0].reset();
                        //$('#success_message').html(data);
                      
                    }
                });
			
		});
		
		//search vendor code ends

        // search captain information
        $(document).ready(function(){  
         
           $('#filter').click(function(){  
                var search_type = $("#select_type option:selected").val();
                var search_captain = $("#search_captain").val(); 
             
                if(search_type != '' && search_captain != '')  
                {  
                     $.ajax({  
                          url:"<?php echo base_url();?>admin/fetch_captain_info",  
                          method:"POST",  
                          data:{search_type:search_type, search_captain:search_captain},  
                          success:function(data)  
                          {  
                               $('#captain_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Fill the Fields");  
                }  
           });  
      });
        </script>
    </body>

</html>