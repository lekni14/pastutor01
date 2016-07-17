    <?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of App
 *
 * @author NiponRoom
 */
class App  extends CI_Controller{
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->library('cart');
        $this->load->model(array('Mcourse','Mmember','Mapplication'));
    }
    public function application()
    {        
        //----------- รายการสมัครเรียน
        $data['session'] = array();
        $data['session']['id'] = 0;
        $data['application'] = FALSE;
        if($this->session->has_userdata('login')){   
            $data['session'] = $this->session->userdata('login');
            $data['profile'] = $this->Mmember->getMember($data['session']['id']); 
            $data['application'] = $this->Mapplication->check_application($data['session']['id']);
        } 
            if($_POST){
                $this->cart->destroy();
                $insert_data = array( 'id' => $this->input->post('id'),
                    'name' => $this->input->post('name'),
                    'price' => $this->input->post('price'),
                   'qty' => 1 );
                $this->cart->insert($insert_data);
                $message = array('result'=>TRUE);
                echo json_encode($message);
                exit();
            } 
            $data['cart']=TRUE;
            $data['course'] = array('name'=>'','price'=>0,'person'=>0,'discount'=>0,'discount_exclusive'=>0);
            if(count($this->cart->contents())){
                $item = $this->cart->contents();
                foreach ($this->cart->contents() as $key => $item) 
                if($this->Mapplication->hasapp($item['id'],$data['session']['id'])){
                    $data['cart']=FALSE;
                    $this->cart->destroy();
                    $this->session->set_flashdata('msg', 'โครงการนี้คุณได้สมัครแล้ว');
                }else{
                    $data['course'] = $this->Mcourse->getCourseByID($item['id']);
                }
                            
            }        
            $this->load->view('application/application',$data);
    }
    public function application_detail($id)
    {
        if($this->session->has_userdata('login')){
            $data['application'] = $this->Mapplication->getApplicatoinByID($id);
            $this->load->view('application/application_detial',$data);
        }else{
            redirect();
        }
    }
    public function application_edit($id)
    {
        if($this->session->has_userdata('login')){
            $data['application'] = $this->Mapplication->getApplicatoinByID($id);
            $this->load->view('application/application_edit',$data);
        }else{
            redirect();
        }
    }
    public function modal_application()
    {
        if($this->session->has_userdata('login')){   
            $session = $this->session->userdata('login');
            $data['application'] = $this->Mapplication->check_application($session['id']);
            $this->load->view('modal/md-application',$data);
        } 
    }
    public function print_allpication($id)
    {
        //load library
        $this->load->library('zend');
        //generate barcode
        $this->load->library("Pdf");
        $pay = array(
                'id' => $id,
                'application_flow_id' => 7,
            );
        $this->Mapplication->update_entry($pay);
        $data['title'] = 'ใบลงทะเบียนหน้างาน';
        $data['application'] = $this->Mapplication->getApplicatoinByID($id);
        $this->load->view('application/pdf_application', $data);
    }      
    public function cart_remove()
    {
        $this->cart->destroy();
        $message = array('result'=>TRUE);
        echo json_encode($message);
    }
}
