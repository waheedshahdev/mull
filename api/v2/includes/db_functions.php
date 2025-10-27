<?php 
/*---------------------------------------------------------------------------------------
|    			Application developed by Amin Dad Shah  								|          		 							  
----------------------------------------------------------------------------------------*/


    
// Function to include database connection
function connect_db(){
	$mysqli_obj = new mysqli();
	$mysqli_obj->connect(SERVER, DB_USER, DB_PASS, DB_NAME);
	return $mysqli_obj;
}


// Close connection
function close_db(){
	$con = connect_db();
	mysqli_close($con);
}
/** Db related functions **/

// Return table data as array
function fetch_array($query){
	return mysqli_fetch_array($query);
}

// Return result row as an object
function fetch_object($query){
	return mysqli_fetch_object($query);
}

// Return table data as row
function fetch_row($query){
	return mysql_fetch_row($query);
}

// Return table data as object
function fetch_assoc($query){
	return mysqli_fetch_assoc($query);
}

// Return number of rows
function num_rows($query){
	return mysqli_num_rows($query);
}


// Return single row as an associative array
function get_single_row($table, $where){
    $mysqli_obj = connect_db();
	$tbl_data = $mysqli_obj->query("SELECT * FROM $table WHERE $where");
	if(num_rows($tbl_data) > 0){
		$row = fetch_assoc($tbl_data);
		$array[] = $row;
	   return $array[0];
	}else{
	  return false;	
	}
}

// Return single row as an associative array using single sql query
function get_query_data($sql){
    $mysqli_obj = connect_db();
   $tbl_data = $mysqli_obj->query($sql);
   if(num_rows($tbl_data) > 0){
	   $row = fetch_assoc($tbl_data);
	   $array[] = $row;
	   return $array[0];
   }else{
	 return false;   
   }
}

// Return multiple rows as an associative array
function get_table_rows($table, $where){
    $mysqli_obj = connect_db();
	$tbl_data = $mysqli_obj->query("SELECT * FROM $table WHERE $where");
	if(num_rows($tbl_data) > 0){
		while($row = fetch_assoc($tbl_data)){
		  $array[] = $row;
		}
		return $array[0];
	}else{
		return false;	
	}
}

function get_table_data($table, $where,$order=null)
{
	$mysqli_obj = connect_db();
	if($order != null){
	  $order_clause = "ORDER BY $order";	
	}else{
	  $order_clause = "";	
	}
	$tbl_data = $mysqli_obj->query("SELECT * FROM $table WHERE $where $order_clause");
	if(num_rows($tbl_data) > 0){
		while($row = fetch_object($tbl_data)){
		  $array[] = $row;
		}
		return $array;
	}else{
	   return false;	
	}
	
	
}




// Return multiple column rows as an associative array
function get_columns($columns, $table, $where){
    $mysqli_obj = connect_db();
    $tbl_data = $mysqli_obj->query("SELECT $columns FROM $table WHERE $where");
	if(num_rows($tbl_data) > 0){
		while($row = fetch_array($tbl_data)){
		  $array[] = $row;
		}
	  return $array[0];
	}else{
	  return false;	
	}
}

function select_columns($columns, $table, $where, $order=''){
    $mysqli_obj = connect_db();
	if($order != ''){
	    $order_by = "ORDER BY $order";	
	}else{
		 $order_by = "";
	}
    $tbl_data = $mysqli_obj->query("SELECT $columns FROM $table WHERE $where $order_by");
	if(num_rows($tbl_data) > 0){
		while($row = fetch_array($tbl_data)){
		  $array[] = $row;
		}
	  return $array[0];
	}else{
	  return false;	
	}
}


function get_table_columns($columns,$table, $where)
{
	      	 $mysqli_obj = connect_db();
			 //echo "SELECT $columns FROM $table WHERE $where<br>";
			  $tbl_data = $mysqli_obj->query("SELECT $columns FROM $table WHERE $where");
			  if(num_rows($tbl_data) > 0){
					while($row = fetch_assoc($tbl_data)){
					  $array[] = $row;
					}
				  return $array[0];
			  }else{
				 return false;  
			  }
}

// Return single column as an associative array
function get_single_column($column,$table, $where){
	$mysqli_obj = connect_db();
	$tbl_data = $mysqli_obj->query("SELECT $column FROM $table WHERE $where");
	if(num_rows($tbl_data) > 0){
		$row = fetch_assoc($tbl_data);	
		$array[] = $row;
		return $array[0];
	}else{
	  return false;	
	}

}

// Return 1 if data exists
function check_single_column($column,$table, $where){
  $mysqli_obj = connect_db();
  $tbl_data = $mysqli_obj->query("SELECT $column FROM $table WHERE $where");
  if(num_rows($tbl_data) > 0){
    return 1;
  }else{
    return 0;
  }  


}



// Save Table Data
function save_data($table,$array){
	$db = connect_db();
    $sql = 'INSERT INTO '.$table.' SET ';
	  $sep = '';
	  foreach($array as $key=>$value) {
		$sql .= $sep.$key." = '".trim(real_escape_string($value))."'";
		$sep = ',';
	}
	$sql_query = $sql;
	//echo $sql_query;
	$data = $db->query("$sql_query");
    return mysqli_insert_id($db);
}


// Update Table Data
function update_data($table,$array,$id){
	$db = connect_db();
    $sql = 'UPDATE '.$table.' SET ';
	  $sep = '';
	  foreach($array as $key=>$value) {
		$sql .= $sep.$key." = '".trim(real_escape_string($value))."'";
		$sep = ',';
	}
	$sql .= " WHERE `id` = ".$id."";
	execute_query($sql);
}

// Update Table Data using where
function update_data_with_where($table,$array,$where){
	$db = connect_db();
    $sql = 'UPDATE '.$table.' SET ';
	  $sep = '';
	  foreach($array as $key=>$value) {
		$sql .= $sep.$key." = '".trim(real_escape_string($value))."'";
		$sep = ',';
	}
	$sql .= " WHERE ".$where." ";
	
	execute_query($sql);
}

// Display column directly
function display($column, $table, $where){
  $db = connect_db();
  $tbl_data = $db->query("SELECT $column FROM $table WHERE $where");
  if(num_rows($tbl_data) > 0){
	  $row = fetch_assoc($tbl_data);
	  return $row[$column];
  }else{
	return false;  
  }
}




// Delete Data
function delete_data($table, $where){
    $db = connect_db();
    $delete_data = $db->query("DELETE FROM $table WHERE $where");
}


// Function to execute query
function execute_query_and_get_id($sql){
    $mysqli_obj = connect_db();
    $data = $mysqli_obj->query("$sql");
    return mysqli_insert_id($mysqli_obj);
}

// run the query 
function execute_query($sql){
    $mysqli_obj = connect_db();
    $data = $mysqli_obj->query("$sql");
    return $data;
}






// Find total number of records in a table
function find_total($table, $where){
	$mysqli_boject = connect_db();
	$query_data = $mysqli_boject->query("SELECT COUNT(*) AS num FROM $table WHERE $where");
    $total_records = fetch_assoc($query_data);
    return $total_records['num'];
}


if ( ! function_exists('get_total')) :
function get_total($index_column, $table, $where=''){
		if(!empty($where)){
			$where_clause = " WHERE $where";
		}else{
			$where_clause = "";
		}
		$mysqli_boject = connect_db();
	    $query_data = "SELECT COUNT($index_column) AS num FROM $table  $where_clause";	
	    $query = $mysqli_boject->query($query_data);					 
		$total_records = fetch_assoc($query);
		return $total_records['num'];
	}
endif;


// Find total number of records in a table
function find_sum($column,$table, $where){
  $mysqli_boject = connect_db();
  $query_data = $mysqli_boject->query("SELECT SUM($column) AS num FROM $table WHERE $where");
   $total_records = fetch_assoc($query_data);
   return $total_records['num'];
}

function real_escape_string($string){
  $con = connect_db();
  return mysqli_real_escape_string($con, $string);
}


// New Functions
if ( ! function_exists('select_column_name')) :
 function select_column_name($col,$table,$id){
	  $db = connect_db();
	  $query = $db->query("SELECT $col FROM $table WHERE id=".$id." ");
	  if(num_rows($query) > 0){
		  $row = fetch_assoc($query);
		  return $row[$col];
	  }else{
		return false;  
	  }
}
endif;

if ( ! function_exists('select_column_name_by_where')) :
 function select_column_name_by_where($col,$table,$where){
	       $db = connect_db();
		  $query = $db->query("SELECT $col FROM $table WHERE $where ");
		  if(num_rows($query) > 0){
			  $row = fetch_assoc($query);
			  return $row[$col];
		  }else{
			return false;  
		  }	
}
endif;

?>