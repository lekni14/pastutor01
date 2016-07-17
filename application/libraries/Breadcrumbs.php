<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/Breadcrumbs_libraries.php';
 
class Breadcrumbs extends Breadcrumbs_libraries
{
    function __construct()
    {
        parent::__construct();
    }
    public function list_course() {
        $this->unshift('คอร์ส-โครงการ', '/');
        $this->push('รายการคอร์ส-โครงการ', '/administrator/course');
    }
    public function detail_course()
    {
        $this->list_course();
        $this->push('รายละเอียดคอร์ส-โครงการ', '/administrator/course/1');
    }
    public function edit_course()
    {
        $this->list_course();
        $this->push('แก้ไขคอร์ส-โครงการ', '/administrator/course/1');
    }
    public function create_course()
    {
        $this->list_course();
        $this->push('เพิ่มคอร์ส-โครงการ', '/administrator/course/1');
    }
    public function index_member()
    {
        $this->unshift('สมาชิก', '/');
        $this->push('รายชื่อสมาชิก', '/administrator/member');
    }
    public function detail_member()
    {
        $this->index_member();
        $this->push('รายละเอียดสมาชิก', '/administrator/member/1');
    }
    public function staff_index()
    {
        $this->unshift('สมาชิก', '/');
        $this->push('รายชื่อทีมงาน', '/administrator/admin');
    }
    public function staff_create()
    {
        $this->staff_index();
        $this->push('เพิ่มทีมงาน', '/administrator/admin/create');
    }
    public function staff_edit()
    {
        $this->staff_index();
        $this->push('แก้ไขทีมงาน', '/administrator/admin/edit');
    }
    public function list_application()
    {
        $this->unshift('คอร์ส-โครงการ', '/');
        $this->push('ผู้สมัครคอร์ส-โครงการ', '/administrator/application');
    }
    public function list_application_detail($id)
    {
        $this->list_application();
        $this->push('รายการผู้สมัคร', '/administrator/application/detail/'.$id);
    }
    public function list_application_detail_list($id)
    {
        $this->list_application_detail($id);
        $this->push('รายละเอียดการสมัครโครงการ', '/administrator/application/detail/');
    }
    public function profile_index()
    {
        $this->push('โปรไฟล์', '/administrator/');
    }
    public function marketing_index()
    {
        $this->unshift('การตลาด', '/');
        $this->push('ผู้สมัครคอร์ส-โครงการ', '/administrator/application');
    }
}
?>