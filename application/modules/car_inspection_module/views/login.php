<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Inspection - Login</title>
    <link href="<?php echo base_url();?>inspectionfiles/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>inspectionfiles/css/datepicker3.css" rel="stylesheet">
    <link href="<?php echo base_url();?>inspectionfiles/css/styles.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4" style="margin-top:150px;">
                <?php 
                            if($this->session->flashdata("error_msg") != ''){?>
                            <div class="alert alert-success">
                                <button class="close" data-dismiss="alert"></button>
                                <?php echo $this->session->flashdata("error_msg");?>
                            </div>
                            <?php
                            }
                            ?>
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Log in</div>
                <div class="panel-body">
                    <form role="form" action="<?php echo base_url();?>car_inspection_module/dashboard" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <div class="checkbox">
                             
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Login"></fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->    
    

<script src="<?php echo base_url();?>inspectionfiles/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url();?>inspectionfiles/js/bootstrap.min.js"></script>
</body>
</html>
