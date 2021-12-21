<?php

class Notas extends DB {

     public function note_update( $conn, $data ) {
          $title = $data['title'];
          $text = $data['text'];
          $time = date('l, M Y - h:i:s');
          $id = $data['id'];

          $query = "UPDATE notes SET
                    title='$title',
                    text_note='$text',
                    time_note='$time' WHERE id=$id";
          $result = mysqli_query($conn, $query);
          return $result;
     }
}
