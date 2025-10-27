  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>adminfiles/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('name');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php if($this->session->userdata['user_type'] == 'Super Admin'){ ?>
       <li class ="actives">
          <a href="<?php echo base_url();?>saad">
            <i class="fa fa-th"></i> <span>Dashboard</span>
           
          </a>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager'){ ?>
        <li>
          <a href="<?php echo base_url();?>vendors">
            <i class="fa fa-user"></i> <span>Vendors</span>
           
          </a>
        </li>
        <?php } ?>

        <?php if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager'){ ?>
        <li>
          <a href="<?php echo base_url();?>captains">
            <i class="fa fa-user"></i> <span>Captains</span>
           
          </a>
        </li>
        <?php } ?>
        
        <?php if($this->session->userdata('user_type') == 'Super Admin'|| $this->session->userdata('user_type') == 'Manager'){ ?>
        <li>
          <a href="<?php echo base_url();?>cars">
            <i class="fa fa-car"></i>
            <span>Cars</span>
          </a>
        
        </li>
        <?php } ?>

        <?php if($this->session->userdata('user_type') == 'Super Admin'){ ?>
        <li>
          <a href="<?php echo base_url();?>cars/view_inspection">
            <i class="fa fa-car"></i>
            <span>Car Inspections</span>
          </a>
        
        </li>
        <?php } ?>
          <?php if($this->session->userdata('user_type') == 'Super Admin'|| $this->session->userdata('user_type') == 'Manager'){ ?>
         <li class="treeview">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Customers</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">159</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>customers"><i class="fa fa-circle-o"></i>All Customers</a></li>
            <li><a href="<?php echo base_url();?>saad/add_customer"><i class="fa fa-circle-o"></i>Register Customer</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care'){ ?>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Rides</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>rides"><i class="fa fa-circle-o"></i> All Rides</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Bookings</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>bookings"><i class="fa fa-circle-o"></i>Bookings</a></li>
            <li><a href="<?php echo base_url();?>bookings/add_booking"><i class="fa fa-circle-o"></i>Add Booking</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts') { ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Payment</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>payments"><i class="fa fa-circle-o"></i>Payments</a></li>
            <li><a href="<?php echo base_url();?>payments/pay_payment"><i class="fa fa-circle-o"></i> Pay Payment</a></li>
            <li><a href="<?php echo base_url();?>payments/paid_payments_table"><i class="fa fa-circle-o"></i> Paid Payments List</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Fines</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>fines"><i class="fa fa-circle-o"></i>Fines</a></li>
            <li><a href="<?php echo base_url();?>fines/add_fines"><i class="fa fa-circle-o"></i>Add Fine</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager' || $this->session->userdata('user_type') == 'Customer Care'){ ?>
        
        <li>
          <a href="<?php echo base_url();?>saad/vendors">
            <i class="fa fa-th"></i> <span>Captains Complains</span>
          </a>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager' || $this->session->userdata('user_type') == 'Customer Care'){ ?>
       
        <li>
          <a href="<?php echo base_url();?>saad/vendors">
            <i class="fa fa-th"></i> <span>Customers Complains</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">89</span>
            </span>
          </a>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Categories</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>category"><i class="fa fa-circle-o"></i> Add Category</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> View Categries</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Car Info</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>category/add_car_company"><i class="fa fa-circle-o"></i> Car Company</a></li>
            <li><a href="<?php echo base_url();?>category/car_type"><i class="fa fa-circle-o"></i> Car Type</a></li>
            <li><a href="<?php echo base_url();?>category/car_model"><i class="fa fa-circle-o"></i> Car Model</a></li>
            <li><a href="<?php echo base_url();?>category/car_color"><i class="fa fa-circle-o"></i> Car Color</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin'){ ?>
        <li>
          <a href="<?php echo base_url();?>captains/captain_switching_list">
            <i class="fa fa-th"></i> <span>Captains Switching List</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin'){ ?>
        <li>
          <a href="<?php echo base_url();?>cars/car_switching_list">
            <i class="fa fa-th"></i> <span>Car Switching List</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i>
            <span>Mul Revenue</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>mul_revenue"><i class="fa fa-circle-o"></i>Revenue</a></li>
            <li><a href="<?php echo base_url();?>mul_revenue/office_paid"><i class="fa fa-circle-o"></i>Office Paid Revenue Table</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care'){ ?>
        <li>
          <a href="<?php echo base_url();?>system_settings/contact_number">
            <i class="fa fa-money"></i> <span>Contact Number</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('user_type') == 'Super Admin'){ ?>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i>
            <span>System Settings</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>system_settings/offices"><i class="fa fa-circle-o"></i>Offices</a></li>
            <li><a href="<?php echo base_url();?>system_settings/administration_access"><i class="fa fa-circle-o"></i>Administration Access</a></li>
            <li><a href="<?php echo base_url();?>system_settings/rates"><i class="fa fa-circle-o"></i> Rates</a></li>
            <li><a href="<?php echo base_url();?>system_settings/mul_revenue"><i class="fa fa-circle-o"></i> Mul Revenue</a></li>
          </ul>
        </li>
        <?php } ?>

        

    
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>