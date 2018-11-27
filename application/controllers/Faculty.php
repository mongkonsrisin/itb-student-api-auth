<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends CI_Controller {

    public function index() {
		    $this->load->view('welcome_faculty');
    }

    public function list() {
      $access_token = $this->input->get('token');
      $auth = $this->Stu->auth($access_token);
      if(isset($auth)) {
        $result = $this->Fac->list_faculties();
        foreach ($result as $r) {
            $d['code'] = (int)$r->fac_id;
            $d['name'] = $r->fac_name;
            $data[] = $d;
        }
        $token['id'] = $auth->stu_id;
        $token['firstname'] = $auth->stu_fname;
        $token['lastname'] = $auth->stu_lname;
        $token['token'] = $access_token;
        $array = array('success' => true,'data' => $data,'token'=>$token);
      } else {
        $array = array('success' => false,'data' => 'Invalid token','token'=>null);
      }
        $this->load->view('json',$array);
    }

}
