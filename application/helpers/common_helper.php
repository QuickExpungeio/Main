<?php
if (!function_exists('getCurrentTimeOfAllTimeZone')) {
   function getCurrentTimeOfAllTimeZone($timeZene = "GMT-4"){
      $ParkDate = new DateTime("now", new DateTimeZone($timeZene));
      return $ParkDate->format('Y-m-d h:i:s');
   }
   function getCurrentDateOfAllTimeZone($timeZene = "GMT-4"){
      $ParkDate = new DateTime("now", new DateTimeZone($timeZene));
      return $ParkDate->format('Y-m-d');
   }
}

?> 
               
