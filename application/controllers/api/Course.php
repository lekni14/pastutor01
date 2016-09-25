<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course
 *
 * @author dd
 */
require APPPATH . '/libraries/REST_Controller.php';

class Course extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model
        $this->load->model(array('Mcourse', 'Mcourse_location', 'Mstorage'));
    }

    function course_insert_post() {
        $files = $_FILES['fileUpload'];
        $name = $this->post('fileUpload');
//        print_r($this->post());
//        exit();
        $input = $this->post();
        //       if (!empty($this->post('id'))) {
//            $course = array(
//                'id' => $this->post('id'),
//                'name' => $this->post('name'),
//                'price' => $this->post('price'),
//                'discount' => $this->post('discount'),
//                'person' => $this->post('person'),
//                'staff_id' => $this->post('staff_id'),
//                'discount_exclusive' => $this->post('discount_exclusive'),
//                'active' => $this->post('active'),
//                'reg_start_date' => $this->convertdate($this->post('reg_start_date')),
//                'reg_end_date' => $this->convertdate($this->post('reg_end_date')),
//                'update_at' => Date('Y-m-d H:i:s')
//            );
//            $this->Mcourse->update_entry($course);
//            $course_id = $this->post('id');
//            $this->Mcourse_location->delete_location($this->post('id'));
//            if (in_array(0, $files['error']))
//            {
//                $this->Mstorage->delete_storage($this->post('id'),1);
//            }            
//            foreach ($input['location'] as $key => $value) {
//                    $location = array(
//                        'course_id' => $this->post('id'),
//                        'update_at' => Date('Y-m-d H:i:s'),
//                        'create_at' => Date('Y-m-d H:i:s'),
//                        'name' => $value['name'],
//                        'course_date' => $this->convertdate($value['cousre_date']),
//                        'course_end_date' => $this->convertdate($value['cousre_end_date']),
//                    );
//                    $location_id = $this->Mcourse_location->insert_entry($location);
//                } 
        $course = array(
            'name' => $this->post('name'),
            'course_type' => $this->post('course_type'),
            'price' => $this->post('price'),
            'discount' => $this->post('discount'),
            'person' => $this->post('person'),
            'staff_id' => $this->post('staff_id'),
            'discount_exclusive' => $this->post('discount_exclusive'),
            'active' => $this->post('active'),
            'reg_start_date' => $this->convertdate($this->post('reg_start_date')),
            'reg_end_date' => $this->convertdate($this->post('reg_end_date')),
            'create_at' => Date('Y-m-d H:i:s'),
            'update_at' => Date('Y-m-d H:i:s')
        );
        $course_id = $this->Mcourse->insert_entry($course);
        foreach ($input['location'] as $key => $value) {
            $location = array(
                'course_id' => $course_id,
                'update_at' => Date('Y-m-d H:i:s'),
                'create_at' => Date('Y-m-d H:i:s'),
                'name' => $value['name'],
                'course_date' => $this->convertdate($value['cousre_date']),
                'course_end_date' => $this->convertdate($value['cousre_end_date']),
            );
            $location_id = $this->Mcourse_location->insert_entry($location);
        }
        $this->upload_files($files, $course_id, $name);
        $message = array('result' => TRUE);
        $this->response($message, 200); // 200 being the HTTP response code
    }

    function course_update_post() {
        $files = $_FILES['fileUpload'];
        $name = $this->post('fileUpload');
        $course = array(
            'id' => $this->post('id'),
            'name' => $this->post('name'),
            'price' => $this->post('price'),
            'discount' => $this->post('discount'),
            'person' => $this->post('person'),
            'staff_id' => $this->post('staff_id'),
            'discount_exclusive' => $this->post('discount_exclusive'),
            'active' => $this->post('active'),
            'reg_start_date' => $this->convertdate($this->post('reg_start_date')),
            'reg_end_date' => $this->convertdate($this->post('reg_end_date')),
            'update_at' => Date('Y-m-d H:i:s')
        );
        $this->Mcourse->update_entry($course);
        $this->upload_files($files, $this->post('id'), $name);
        $message = array('result' => TRUE);
        $this->response($message, 200); // 200 being the HTTP response code
        //print_r($files);
    }

    function course_delete_post() {
        if ($this->Mcourse->delete_($this->post('id'))) {
            $message = array('result' => TRUE, 'data' => $this->post('row'));
            $this->response($message, 200); // 200 being the HTTP response code 
        }
    }

    function course_location_update_post() {
        if ($this->post('update') == 0) {
            $location = array(
                'name' => $this->post('inputlocation'),
                'course_date' => $this->convertdate($this->post('inputcousre_date')),
                'create_at' => Date('Y-m-d H:i:s'),
                'update_at' => Date('Y-m-d H:i:s'),
                'course_id' => $this->post('course_id'),
                'course_end_date' => $this->convertdate($this->post('inputcousre_end_date')),
            );
            $location_id = $this->Mcourse_location->insert_entry($location);
            $location['id'] = $location_id;
        } else {
            $location = array(
                'id' => $this->post('id'),
                'name' => $this->post('inputlocation'),
                'course_date' => $this->convertdate($this->post('inputcousre_date')),
                'create_at' => Date('Y-m-d H:i:s'),
                'update_at' => Date('Y-m-d H:i:s'),
                'course_id' => $this->post('course_id'),
                'course_end_date' => $this->convertdate($this->post('inputcousre_end_date')),
            );
            $location_id = $this->Mcourse_location->update_entry($location);
        }
        $this->session->set_flashdata('tab', 'location added');

        $message = array('result' => TRUE, 'data' => $location);
        $this->response($message, 200); // 200 being the HTTP response code
    }

    function course_location_delete_post() {
        $this->Mcourse_location->delete_location($this->post('id'));
        $message = array('result' => TRUE, 'data' => $this->post('row'));
        $this->response($message, 200); // 200 being the HTTP response code
    }

    private function convertdate($date) {
        $date_ = explode("/", $date);
        return $date_[2] . '-' . $date_[1] . '-' . $date_[0];
    }

    private function upload_files($files, $couse_id, $name) {
        $date = date('Ymd');
        $config = array(
            'upload_path' => 'upload_path/course/' . $date . '/',
            'allowed_types' => 'jpg|gif|png|pdf',
            'overwrite' => 1,
        );
        if (!is_dir('upload_path/course/' . $date)) {
            mkdir('./upload_path/course/' . $date, 0777, TRUE);
        }
        $this->load->library('upload', $config);

        $images = array();
        $errors = array();
        foreach ($files['name'] as $key => $image) {
            if ($files['error'][$key]['file'] == 0) {
                $_FILES['images[]']['name'] = $files['name'][$key]['file'];
                $_FILES['images[]']['type'] = $files['type'][$key]['file'];
                $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key]['file'];
                $_FILES['images[]']['error'] = $files['error'][$key]['file'];
                $_FILES['images[]']['size'] = $files['size'][$key]['file'];


                $fileName = $_FILES['images[]']['name'];
                $rename = $name[$key]['name'];
                $images[] = $fileName;
                $config['file_name'] = $rename . '_' . iconv("UTF-8", "TIS-620", str_replace(" ", "_", $fileName));

                $img = array(
                    'tid' => 1,
                    'fid' => $couse_id,
                    'upload_path' => 'upload_path/course/' . $date . '/',
                    'filename' => $name[$key]['name'],
                    'new_image' => $rename . '_' . str_replace(" ", "_", $fileName),
                    'file_type' => $_FILES['images[]']['type'],
                    'filesize' => $_FILES['images[]']['size'],
                );
                if (!empty($name[$key]['id'])) {
                    $this->Mstorage->delete_storage($name[$key]['id']);
                }
                $this->Mstorage->insert_entry($img);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('images[]')) {
                    $this->upload->data();
                } else {
                    return false;
                }
            }
        }

        return $images;
    }

}
