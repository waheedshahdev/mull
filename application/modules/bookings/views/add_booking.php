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

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $title;?></h3>
        </div>
        <!-- /.box-header -->
        <form method="post" id="add_booking">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Customer Name</label>
                <select class="form-control select2" name="customer_id" id="customer_id" style="width: 100%;">
                  <option selected="selected">Select Customer</option>
                  <?php foreach ($customer_table as $values):?>
                  <option value="<?php echo $values->id?>"><?php echo $values->customer_name;?>  (<?php echo $values->mobile_number;?>)</option>
                  <?php endforeach;?>
                </select>

              </div>
          </div>
              <!-- /.form-group -->
              <div class="col-md-6">
              <div class="form-group">
                <label>Select Riding Type</label>
                <select id="select_ride_type" name="select_ride_type" class="form-control select2" style="width: 100%;">
                  <option selected="selected">Select Riding Type</option>
                  <option id = "R" value="R">Regular</option>
                  <option id = "F" value= "F">Fixed</option>
                </select>
              </div>
            </div> 
            </div>

            <div class="row">
            <div class="col-md-6" >
              <div class="form-group" id="category_fixed" style="display:none;">
                <label>Select Category</label>
                <select class="form-control select2" name="category_id" id="category_id" style="width: 100%;">
                  <option selected="selected">Select Category</option>
                  <?php foreach ($choose_category as $values):?>
                  <option value="<?php echo $values->id?>" data-far="<?php echo $values->base_fare; ?>" data-perkm="<?php echo $values->per_km; ?>"><?php echo $values->category_name;?></option>
                  <?php endforeach;?>
                </select>
 
              </div>
          </div>
              <!-- /.form-group -->
              <div class="col-md-6" >
              <div class="form-group" id="category_type" style="display:none;">
                <label>Select Ride</label>
                <select  name="ride_for" id="ride_for" class="form-control select2" style="width: 100%;">

                  <option id = "N" value="N">Select Ride Type</option>
                  <option id = "O" value="One">One Way</option>
                  <option id = "T" value= "Two">Two way</option>
                  <option id = "D" value= "D">Full Day</option>
                </select>
              </div>
            </div> 
            </div>


            <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="search1" style="display:none;">
                <label>Pick up Location</label>
                <input class="form-control"  type="text" name="searchTextField" id="searchTextField"  placeholder="Enter Pick Up point" />
              </div>
          </div>
              <div class="col-md-6">
              <div class="form-group" id="search2" style="display:none;">
                <label>Drop off Location</label>
                <input class="form-control" type="text" name="searchTextField2" id="searchTextField2"  placeholder="Enter Destination"/>
              </div>
              <!-- /.form-group -->
            </div>
            </div>

                <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="time" style="display:none;">
                <label>Pick Up Time</label>
                <input class="form-control"  type="time" name="time" id="time"  placeholder="Enter Pick Up Time" />
              </div>
          </div>
             <!--  <div class="col-md-6">
              <div class="form-group" id="search2" style="display:none;">
                <label>Drop off Location</label>
                <input class="form-control" type="text" name="searchTextField2" id="searchTextField2"  placeholder="Enter Destination"/>
              </div>
            
            </div> -->
            </div>
            
            <input type="submit" id="submit" name="submit" style="width:100%;" class="btn btn-info" value="Search Captain">
            <input type="submit" id="estimation" name="estimation" style="width:100%; display:none;" class="btn btn-info" value="Estimate">
            </form>
            <br>
            <br>
            <div class="col-md-3" style="margin-top:19px">
                        <input type="hidden" id="fare_value"/>
                        <input type="hidden" id="rider_pays_value"/>
                        <input type="hidden" id="rp_share_value"/>
                        <input type="hidden" id="owing_driver_value"/>
                      </div>
             <div class="col-md-12">
                    <div id="directions-panel" class="note note-danger">
          <!-- datatable for fare calculation-->
                      <table id="fare_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Captain Name</th>
                  <th>Mobile Number</th>
                  <th>District</th>
                  <th>Captain Status</th>
                  <th>Status</th>
                  <th>Trip Amount</th>
                  <th>Trip Type</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

              </table>

              
                    </div>
                    <div class="md-checkbox has-info">
                    </div>
                    <br />
                    <!-- <input type="button" id="book_now" onclick="book_now()" style="width:100%;" class="btn sbold green" value="Book Now"> -->
                    
                    <!-- <div id="directions-panel" style="width:100%;height:300px;background-color:#f3e6f0; padding:15px">
                                         Fare Info will be displayed here.
                                         </div>--> 
                    
                  </div>
<table id="regular_fare_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Captain Name</th>
                  <th>CNIC Number</th>
                  <th>Mobile Number</th>
                  <th>Captain Status</th>
                  <th>Ride Type</th>
                  <th>District</th>
                  
                  <th>Category</th>
                  <th>Status</th>
                  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

              </table>


       <table width="100%" id="results">
            <tr>
              <td><div id="map" style="height:500px;border:1px solid #000;">Google Map</div></td>
              <td></td>
            </tr>
          </table>
          </div>
          <!-- /.row -->
        </div>
     
      </div>

    

    </section>
  </div>
  

<script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;

/*var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(4.207917999999999, 101.9827997),//sw bounds
            new google.maps.LatLng(4.209196599999999, 101.9833456));*///ne bounds
            var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7, 
            center: new google.maps.LatLng(35.2227,72.4258)
        });
        directionsDisplay.setMap(map);
  /*var options = {
    types: ['geocode'],
    strictBounds: true,
    componentRestrictions: {country: 'MY'}
};  
   var option2 = {
    types: ['geocode'],
    strictBounds: true,
    componentRestrictions: {country: 'MY'}
};  */
    var input =(document.getElementById('searchTextField'));
    var input2 =(document.getElementById('searchTextField2'));
    //var strictBounds = document.getElementById('strict-bounds-selector');
     var autocomplete = new google.maps.places.Autocomplete(input);
     var autocomplete2 = new google.maps.places.Autocomplete(input2);
   
        document.getElementById('submit').addEventListener('click', function() {

              calculateAndDisplayRoute(directionsService, directionsDisplay);
        //var distance = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(latitude1, longitude1), new google.maps.LatLng(latitude2, longitude2));
        });
      }
      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
       /* var checkboxArray = document.getElementById('waypoints');
        for (var i = 0; i < checkboxArray.length; i++) {
          if (checkboxArray.options[i].selected) {
            waypts.push({
              location: checkboxArray[i].value,
              stopover: true
            });
          }
        }*/
        directionsService.route({
          origin: document.getElementById('searchTextField').value,
          destination: document.getElementById('searchTextField2').value,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
        //$('#book_now').attr('disabled',false);
   var type = $("#category_fixed select option:selected").html();
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
      var base_fare=$("#category_fixed select option:selected").attr("data-far");
      var per_km=$("#category_fixed select option:selected").attr("data-perkm");
      console.log(base_fare);
            var summaryPanel = document.getElementById('directions-panel');
      //document.getElementById('calctest').value = distance.text;
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
        
         
        
        
        var final_km = 0;
      
          //summaryPanel.innerHTML += '<b><br>Route: ' + routeSegment +'</b><br>';
          summaryPanel.innerHTML += route.legs[i].start_address + '<br><br>to<br><br> ';
          summaryPanel.innerHTML += route.legs[i].end_address + '<br><br>';
          summaryPanel.innerHTML += "Ride category : " + type +'<br><br>';
          //summaryPanel.innerHTML += 'Total Distance: '+route.legs[i].distance.text + '<br>';
          var km_fare = route.legs[i].distance.text;
          
          var fare_km_split = km_fare.split(" ");
          var final_km = parseFloat(fare_km_split[0]);
          
        
          
         
        

            }
       summaryPanel.innerHTML += 'Total Distance: '+ final_km + 'Km<br>';
      
          }
    
     summaryPanel.innerHTML += 'Total Fare: '+ (final_km * per_km + parseInt(base_fare)) + ' Rs<br>';
    });
      }
    
      $(document).ready(function (){
    $("#select_ride_type").change(function(){
    var selected_option = $('#select_ride_type').val();
    if(selected_option === 'R' ){
        $("#category_fixed").hide();
        $("#category_type").hide();
        $("#estimation").hide();
        $("#submit").show();
        $("#search1").show();
        $("#search2").show();
 $("#category_fixed").show();
    }
        if(selected_option === 'F' ){
        $("#search1").show();
        $("#search2").show();
        $("#time").show();
        $("#submit").hide();
        $("#estimation").show();

        $("#category_fixed").show();
        $("#category_type").show();
       
    }
  })
  });
  //calcualting fare
  
    </script> 
<script
src="https://maps.googleapis.com/maps/api/js?3.27&key=AIzaSyDw2kLzHkMOg6Qvgf1WQxIHi5zirB3lX2g&libraries=places&callback=initMap">
</script>
