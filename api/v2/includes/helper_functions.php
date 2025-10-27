<?php 

function created_at(){
  return date('Y-m-d H:i:s');	
}

function if_empty($input){
  return (empty($input) || !isset($input) || is_null($input)	);
}





function e_response($message){
  return  json_encode(array('status' => 'failed',
			                 'errorCode' => 1,
							 'message' => $message));	
}

function key_response($message){
  return  json_encode(array('status' => 'failed',
			                 'errorCode' => 2,
							 'message' => $message));	
}

function s_response($message,$data, $array=''){
	     
  return  json_encode(array('status' => 'success',
                             'errorCode' => 0,
                             'message' => $message,
			                 'data' => $data));	
}

function s_response_2($message){
  return  json_encode(array('status' => 'success',
                             'errorCode' => 0,
                             'message' => $message));	
}
function s_ex_response($message,$data, $array=array()){
	     
    $resp = array('status' => 'success',
                             'errorCode' => 0,
                             'message' => $message,
			                 'data' => $data);
	$extra_array = array($array);
	$merged_array = array_merge($resp, $extra_array);
	$sliced = array_splice($merged_array);
	return  json_encode($sliced);						 	
}

/* API key encryption */
function apiKey()
{
   return md5(get_random_string(16));
}


function get_id($id){
  return intval($id);	
}

function empty_vars(){
  $missing = array();
 foreach ($_REQUEST as $key => $value) { 
   if ($value == "") { 
     array_push($missing, $key);
   }
 }
 if (count($missing) > 0) {
	 show_empty_vars($missing);
	 return true;
 }else{
	return false; 
 }
 
}

function show_empty_vars($missing){
  if (count($missing) > 0) {
  foreach ($missing as $k => $v) { 
     echo $v."<br> ";
  }
  }
}


function post($posted_value){
  return $_REQUEST[$posted_value];	
}

function get($posted_value){
  return $_GET[$posted_value];	
}

function req($posted_value){
  return $_REQUEST[$posted_value];	
}

function dd($array){
  echo '<pre>';
  print_r($array);
  echo '</pre>';	
}

function sms_api($to,$message)
{
$username = 'parvez';
$password = 'Mull2018';
$to = $to;
$from = 'Mull';
$message = $message;
$url = "http://Lifetimesms.com/plain?username=".$username."&password=" .$password.
"&to=" .$to. "&from=" .urlencode($from)."&message=" .urlencode($message)."";
//Curl Start
$ch = curl_init();
$timeout = 30;
curl_setopt ($ch,CURLOPT_URL, $url) ;
curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
$response = curl_exec($ch) ;
curl_close($ch) ; 
//Write out the response
//echo $response ;
}


// push notification 

// if ( ! function_exists('sendPushNotification')) :  

// function sendPushNotification($gcm_id, $post_id,$title,$message, $status=''){

//    /* define( 'API_ACCESS_KEY', 'AAAA0d_oHOI:APA91bGGO0Vn0OUHYo6n1bi0758QNpNCn0_RFnGUZcXwfRJA18mf50XxeL--lJ1uV_nVwesZJfzhi_luwDTRvBIak7D_Tc3tRaEZtk1gsj1nU-zcsKmt19H0Coe5AW4gHEt280nmHcTp' );
//     */
//      define( 'API_ACCESS_KEY', 'AAAAeLvH9Lw:APA91bFNkMyFZKkz60Yri12OgHq3X_8Ojmt17JAJ7-j1NllWO4pp5T6ldPmrDD73C38yTI38dvT38I1XjQvnHHImyEf7Mrcmj1olNOb_7BY6dLomkR00nfXIdCuEvT-3vpIOVo40XxB1' );

//     if( !empty($status) && isset($status) ){
//      $notification_status = $status; 
//    }else{
//      $notification_status = 0; 
//    }
//    $msg = array
//           (
//     'body'  => $message,
//     'title' => $title,
//     'notification_status' => $notification_status,
//     'post_id' => $post_id,
//     'icon'  => 'myicon',/*Default Icon*/
//     'sound' => 'mySound'/*Default sound*/
//           );
//   $fields = array
//       (
//         'to'    => $gcm_id,
//         'data'  => $msg
//       );
//       /*
//       $fields = array
//       (
//         'to'    => $gcm_id,
//         'notification'  => $msg
//       );
//       */
//   /*$fields = array();
//   $fields['notification'] = $msg;
//   if(is_array($gcm_id)){
//     $fields['registration_ids'] = $gcm_id;
//   }else{
//     $fields['to'] = $gcm_id;
//   }   
//   */
//   $headers = array
//       (
//         'Authorization: key=' . API_ACCESS_KEY,
//         'Content-Type: application/json'
//       );
//   #Send Reponse To FireBase Server  
//   $ch = curl_init();
//   curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
//   curl_setopt( $ch,CURLOPT_POST, true );
//   curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
//   curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
//   curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
//   curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
//   $result = curl_exec($ch );
//   curl_close( $ch );
//   #Echo Result Of FireBase Server
//   return $result;

// }

// endif;


//end push notification


//========================================================================================

if ( ! function_exists('sendPushNotification_rider')) :

function sendPushNotification_rider($gcm_id,$post_id,$title,$message){

    define( 'API_ACCESS_KEY', 'AAAAeLvH9Lw:APA91bFNkMyFZKkz60Yri12OgHq3X_8Ojmt17JAJ7-j1NllWO4pp5T6ldPmrDD73C38yTI38dvT38I1XjQvnHHImyEf7Mrcmj1olNOb_7BY6dLomkR00nfXIdCuEvT-3vpIOVo40XxB1' );
   $msg = array

          (

    'body'  => $message,

    'title' => $title,

    'post_id' => $post_id,

    //'icon'  => 'myicon',/*Default Icon*/

  //  'sound' => 'mySound'/*Default sound*/

          );

  $fields = array

      (

        'to'    => $gcm_id,

        'data'  => $msg

      );

    

  

  $headers = array

      (

        'Authorization: key=' . API_ACCESS_KEY,

        'Content-Type: application/json'

      );

  #Send Reponse To FireBase Server  

  $ch = curl_init();

  curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );

  curl_setopt( $ch,CURLOPT_POST, true );

  curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );

  curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );

  curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );

  curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

  $result = curl_exec($ch );

  curl_close( $ch );

  #Echo Result Of FireBase Server

  return $result;

}

endif;
//========================================================================================




function generate_random_code($string_length = 6){ 
      //$character_string     = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	  $character_string     = '0123456789';
      $random_string         = "";
      for ($i = 0; $i < $string_length; $i++) {
           $random_string .= $character_string[rand(0, strlen($character_string) - 1)];
      }
      return $random_string;
 }
 if ( ! function_exists('get_random_string')) :
	 function get_random_string($string_length = 6){ 
		  $character_string     = SITE_KEY.'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		  $random_string         = "";
		  for ($i = 0; $i < $string_length; $i++) {
			   $random_string .= $character_string[rand(0, strlen($character_string) - 1)];
		  }
		  return $random_string;
	 }
 endif; 
 
 function send_email($email,$subject, $email_message){
	    $to = $email;
		$subject = $subject;
		//$from = $name.'@'.$_SERVER['HTTP_HOST'];
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: '.FROM_EMIAL."\r\n".
			'Reply-To: '.FROM_EMIAL."\r\n" .
			'X-Mailer: PHP/' . phpversion();
		// Sending email
		mail($to, $subject, $email_message, $headers); 
 }
 
 // Resize Image
if ( ! function_exists('smart_resize_image')) :
 
    /**
 * easy image resize function
 * @param  $file - file name to resize
 * @param  $string - The image data, as a string
 * @param  $width - new image width
 * @param  $height - new image height
 * @param  $proportional - keep image proportional, default is no
 * @param  $output - name of the new file (include path if needed)
 * @param  $delete_original - if true the original image will be deleted
 * @param  $use_linux_commands - if set to true will use "rm" to delete the image, if false will use PHP unlink
 * @param  $quality - enter 1-100 (100 is best quality) default is 100
 * @param  $grayscale - if true, image will be grayscale (default is false)
 * @return boolean|resource
 */
  function smart_resize_image($file,
                              $string             = null,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = false, 
                              $output             = 'file', 
                              $delete_original    = false, 
                              $use_linux_commands = false,
                              $quality            = 100,
                              $grayscale          = false
  		 ) {
      
    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null && $string === null ) return false;

    # Setting defaults and meta
    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;

    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );

      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
	  $widthX = $width_old / $width;
	  $heightX = $height_old / $height;
	  
	  $x = min($widthX, $heightX);
	  $cropWidth = ($width_old - $width * $x) / 2;
	  $cropHeight = ($height_old - $height * $x) / 2;
    }

    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
      default: return false;
    }
    
    # Making the image grayscale, if needed
    if ($grayscale) {
      imagefilter($image, IMG_FILTER_GRAYSCALE);
    }    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);

      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
	
	
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }

    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
    
    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: 
	  return false;
    }

    return true;
  }
endif;

if ( ! function_exists('meridian_time')) :
function meridian_time($datetime){
	   return date('j F Y - H:i', strtotime($datetime));
  }
endif;

if ( ! function_exists('hr_datetime')) :
function hr_datetime($datetime){
	   
	   return date('d/m/Y g:i a', strtotime($datetime));
  }
endif;

if ( ! function_exists('hr_date')) :
function hr_date($date){
	   
	   return date('d/m/Y', strtotime($date));
  }
endif;


if ( ! function_exists('find_key_in_string')) :
function find_key_in_string($to_find, $in_string) {
     if (strpos($in_string, $to_find) !== false) {
		 return true;
	 }else{
		  return false;
	 }
 }	   
endif;

if ( ! function_exists('encode_id')) :
function encode_id($value){ 
		$skey 	= ENC_KEY; //"T3Encr3p71onK3y";
	    if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim(safe_b64_encode_id($crypttext)); 
    }
endif;	

if ( ! function_exists('decode_id')) :
function decode_id($value){
		$skey 	= ENC_KEY; //"T3Encr3p71onK3y";
        if(!$value){return false;}
        $crypttext = safe_b64_decode_id($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
endif;	

if ( ! function_exists('safe_b64_encode_id')) :
function safe_b64_encode_id($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }	
endif;	

if ( ! function_exists('safe_b64_decode_id')) :
function safe_b64_decode_id($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }	
endif;	

function sendin_blue_email($to_email, $to_name, $subject, $message, $attachment=''){
     	// Include Library here
		include_once 'Mailinv2.php';
		$mailin = new mailinv2('https://api.sendinblue.com/v2.0','TcG27sRLqHmkQnCE');
		$subject = $subject;
		$msg_append = $message;
		$msg_append.=email_footer;
		$data = array( "id" => 2,
		  "to" => $to_email,
		  "replyto" => email_from,
		  "attr" => array("SUBJECT"=>$subject,"MESSAGE"=>$msg_append),	
		  "headers" => array("Content-Type"=> "text/html;charset=iso-8859-1")	 
		);
  		$res = $mailin->send_transactional_template($data);
}



 function nice_time_ago($date)
	{
		//return "success";
		if(empty($date)) {
			return "No date provided";
		}
		
		$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths         = array("60","60","24","7","4.35","12","10");
		
		$now             = time();
		$unix_date         = strtotime($date);
		
		   // check validity of date
		if(empty($unix_date)) {    
			return "Bad date";
		}
	
		// is it future date or past date
		if($now > $unix_date) {    
			$difference     = $now - $unix_date;
			$tense         = "ago";
			
		} else {
			$difference     = $unix_date - $now;
			$tense         = "from now";
		}
		
		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}
		
		$difference = round($difference);
		
		if($difference != 1) {
			$periods[$j].= "s";
		}
		
		return "$difference $periods[$j] {$tense}";
	}

    function delivery_time_format($delivery_time)
	{
			$endtime='';
			$delivery_time_ends  = explode(' ',$delivery_time);
			$delivery_time_ends2 = explode(':',$delivery_time);
			if($delivery_time_ends[1]=='PM')
			{
				$hour = substr($delivery_time_ends2[0],0,2);
				$hour = $hour+12;
				$minut = substr($delivery_time_ends2[1],0,2);
				if($hour==24){$hour='00';}
				$endtime = "$hour:$minut:00";
			}
			else
			{
				$hour = substr($delivery_time_ends2[0],0,2);
				$minut = substr($delivery_time_ends2[1],0,2);
				$endtime = "$hour:$minut:00";
			}
			return $endtime;
	}




