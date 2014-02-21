<?php  
function get_hash_table($table,$userid) {  
 $str = crc32($userid);  
 echo $str;
 if($str<0){  
 $hash = "0".substr(abs($str), 0, 1);  
 }else{  
 $hash = substr($str, 0, 2);  
 }  
  
 return $table."_".$hash;  
}  


//echo get_hash_table("message" , 2);

echo substr(crc32("-3") , 0 , 2);

