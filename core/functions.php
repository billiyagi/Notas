<?php
     function excerpt($text_note, $range) {
          if ( strlen($text_note) > $range ) {
               return substr($text_note, 0, $range) . " ...";
          }else{
               return substr($text_note, 0, $range);
          }
     }

?>
