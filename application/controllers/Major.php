<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Major extends CI_Controller {

    public function index() {
		    $this->load->view('welcome_major');
    }

    public function faculty($fac_id = 0) {
      $access_token = $this->input->get('token');
      $auth = $this->Stu->auth($access_token);
      if(isset($auth)) {
        $result = $this->Maj->get_major_by_facultyid($fac_id);
        if(empty($result)) {
            $array = array('success' => false,'data' => 'Major not found','token'=>null);
        } else {
            foreach ($result as $r) {
                $d['code'] = (int)$r->maj_id;
                $d['name'] = $r->maj_name;
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
