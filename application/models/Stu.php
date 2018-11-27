<?php
class Stu extends CI_Model{

  public function auth($token) {
    $result = $this->db
    ->select('stu_id,stu_fname,stu_lname,MD5(CONCAT(stu_id,stu_citizenid,stu_key)) AS token')
    ->from('tbl_student')
    ->having('token',$token)
    ->get()
    ->row();
    return $result;
  }

  public function get_student_by_id($stu_id) {
    $result = $this->db
    ->select('*')
    ->from('tbl_student')
    ->join('tbl_major', 'tbl_student.stu_majorid = tbl_major.maj_id', 'left')
    ->join('tbl_faculty', 'tbl_major.maj_facultyid = tbl_faculty.fac_id', 'left')
    ->where('stu_id',$stu_id)
    ->get()
    ->row();
    return $result;
  }

  public function get_student_by_majorid($maj_id) {
    $result = $this->db
    ->select('*')
    ->from('tbl_student')
    ->where('stu_majorid',$maj_id)
    ->get()
    ->result();
    return $result;
  }

}
 ?>
