<?php
class Maj extends CI_Model{

  public function get_major_by_facultyid($fac_id) {
    $result = $this->db
    ->select('*')
    ->from('tbl_major')
    ->where('maj_facultyid',$fac_id)
    ->get()
    ->result();
    return $result;
  }

}
 ?>
