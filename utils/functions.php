<?php
  function getCount($conn, $query) {
    $res = mysqli_query($conn, $query);
    return mysqli_num_rows($res);
  }

  function getData($conn, $query) {
    $res = mysqli_query($conn, $query);
    $data = array();
    if(mysqli_num_rows($res)>0) {
      while($row = mysqli_fetch_array($res)) {
        $data[] = $row;
      }
    }
    return $data;
  }
?>