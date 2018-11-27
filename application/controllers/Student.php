<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function index() {
      $this->load->view('welcome_student');
    }

    public function detail($stu_id = 0) {
      $access_token = $this->input->get('token');
      $auth = $this->Stu->auth($access_token);
      if(isset($auth)) {
        $result = $this->Stu->get_student_by_id($stu_id);
        if(empty($result)) {
            $array = array('success' => false,'data' => 'Student not found','token'=>null);
        } else {
            $data['id'] = $result->stu_id;
            $data['firstname'] = $result->stu_fname;
            $data['lastname'] = $result->stu_lname;
            $data['address'] = $result->stu_address;
            $data['phonenumber'] = $result->stu_phonenumber;
            $data['email'] = $result->stu_email;
            $edu['faculty'] = $result->fac_name;
            $edu['major'] = $result->maj_name;
            $data['education']  = $edu;
            $token['id'] = $auth->stu_id;
            $token['firstname'] = $auth->stu_fname;
            $token['lastname'] = $auth->stu_lname;
            $token['token'] = $access_token;
            $array = array('success' => true,'data' => $data,'token'=>$token);
        }
      } else {
        $array = array('success' => false,'data' => 'Invalid token','token'=>null);
      }
        $this->load->view('json',$array);
    }

    public function major($maj_id = 0) {
      $access_token = $this->input->get('token');
      $auth = $this->Stu->auth($access_token);
      if(isset($auth)) {
        $result = $this->Stu->get_student_by_majorid($maj_id);
        if(empty($result)) {
            $array = array('success' => false,'data' => 'Student not found','token'=>null);
        } else {
            foreach ($result as $r) {
                $d['id'] = $r->stu_id;
                $d['firstname'] = $r->stu_fname;
                $d['lastname'] = $r->stu_lname;
                $data[] = $d;
            }
            $token['id'] = $auth->stu_id;
            $token['firstname'] = $auth->stu_fname;
            $token['lastname'] = $auth->stu_lname;
            $token['token'] = $access_token;
            $array = array('success' => true,'data' => $data,'token'=>$token);
        }
      } else {
        $array = array('success' => false,'data' => 'Invalid token','token'=>null);
      }
        $this->load->view('json',$array);
    }

}
