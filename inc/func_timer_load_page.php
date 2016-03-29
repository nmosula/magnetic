<?php
function timer_start() 
{ 
    $mtime = microtime(); 
    $mtime = explode(" ",$mtime); 
    $mtime = $mtime[1] + $mtime[0]; 
    $start_time = $mtime;   

    return $start_time; 
} 

function timer_end() 
{ 
    $mtime2 = microtime(); 
    $mtime2 = explode(" ",$mtime2); 
    $mtime2 = $mtime2[1] + $mtime2[0]; 
    $end_time = $mtime2; 
    
    return $end_time; 
}
?>