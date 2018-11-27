<?php
class Fac extends CI_Model{

  public function list_faculties() {
    $result = $this->db
    ->select('*')
    ->from('tbl_faculty')
    ->get()
    ->result();
    return $result;
  }

}
 ?>
