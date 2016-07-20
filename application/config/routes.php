<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Course';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*front  */
$route['index'] = 'Course';
$route['regiter'] = 'Member/regiter';
$route['login'] = 'Member/login';
$route['modal/regiter'] = 'Member/member';
$route['logout'] = 'Member/logout';
$route['member/(:num)'] = 'Member/member_profile/$1';
$route['member/edit/(:num)'] = 'Member/member_profile_edit/$1';
$route['location/(:num)'] = 'Course/location/$1';
$route['app'] = 'App/application';
$route['app/(:num)'] = 'App/application_detail/$1';
$route['app/edit/(:num)'] = 'App/application_edit/$1';
$route['app/application_print/(:num)'] = 'App/print_allpication/$1';
$route['course'] = 'Course/index';
$route['course/(:num)'] = 'Course/course_detail/$1';
$route['payin/(:num)'] = 'Payments/application_print/$1';
$route['modal/application'] = 'App/modal_application';
$route['forget-password'] = 'Member/forget_password';

/*admin  */
$route['administrator'] = 'admin/Administrator';
$route['admin/forget_password'] = 'admin/Administrator/forget_password';
$route['administrator/login'] = 'admin/Administrator/login';
$route['administrator/payment'] = 'admin/Payment/index';
$route['administrator/no-payment'] = 'admin/Payment/NOPayment';
$route['administrator/ajax_unpaid_list'] = 'admin/Payment/ajax_unpaid_list';
$route['administrator/payment-detail/(:num)'] = 'admin/Payment/detail/$1';
$route['administrator/course'] = 'admin/Course';
$route['administrator/course/(:num)'] = 'admin/Course/detail/$1';
$route['administrator/course/edit/(:num)'] = 'admin/Course/edit/$1';
$route['administrator/course/create'] = 'admin/Course/create';
$route['administrator/file/download/(:num)'] = 'admin/Course/download/$1';

$route['administrator/member'] = 'admin/Member/member_index';
$route['administrator/member/level-up'] = 'admin/Member/uplevel';
$route['administrator/member/(:num)'] = 'admin/Member/member_detail/$1';
$route['administrator/member-ajax'] = 'admin/Member/ajax_list';
$route['up-level'] = 'admin/Member/uplevel';

$route['administrator/application'] = 'admin/Application/application_index';
$route['administrator/payin/(:num)'] = 'admin/Application/application_print/$1';
$route['administrator/application_print/(:num)'] = 'admin/Application/print_allpication/$1';
$route['administrator/application/detail/(:num)'] = 'admin/Application/application_list/$1';
$route['administrator/application/detail/(:num)/(:num)'] = 'admin/Application/application_list_detail/$1/$2';
$route['administrator/application-by-coures/(:num)'] = 'admin/Application/ajax_list/id/$1';


$route['administrator/payment_follow']['POST'] = 'admin/Application/payment_follow';
$route['administrator/payment-follow-cancle']['POST'] = 'admin/Application/payment_follow_cancle';
$route['administrator/admin'] = 'admin/Administrator/staff_index';
$route['administrator/admin/edit/(:num)'] = 'admin/Administrator/staff_edit/$1';
$route['administrator/admin/create'] = 'admin/Administrator/staff_create';
$route['administrator/admin/create/data'] = 'admin/Administrator/data_create';
$route['administrator/admin/edit/data'] = 'admin/Administrator/data_edit';
$route['administrator/profile/edit'] = 'admin/Profile/index';
$route['administrator/profile/profile_update'] = 'admin/Profile/profile_update';


$route['administrator/marketing'] = 'admin/Marketing/marketing_index';
$route['administrator/marketing/detail/(:num)'] = 'admin/Marketing/marketing_list/$1';
$route['administrator/marketing/paymet/(:num)'] = 'admin/Marketing/marketing_paymet/$1';
$route['administrator/marketing/dataPost']['post'] = 'admin/Marketing/dataPost';
$route['administrator/marketing/ajax_edit/(:num)'] = 'admin/Marketing/ajax_edit/$1';
$route['administrator/marketing/delete']['post'] = 'admin/Marketing/delete';
$route['administrator/marketing-by-coures/(:num)'] = 'admin/Marketing/ajax_list/id/$1';
//$route['administrator/marketing-by-coures/(:num)'] = 'admin/Marketing/application_ajax_list/id/$1';
$route['administrator/marketing-application-by-coures/(:num)'] = 'admin/Marketing/ajax_payment_list/id/$1';//query application where marketing

/*api  */
$route['api/login'] = 'api/Member/login';
$route['api/member'] = 'api/Member/member';
$route['api/member/update'] = 'api/Member/member_update';
$route['api/address/update'] = 'api/Member/address_update';
$route['api/change/pass'] = 'api/Member/chang_pass';
$route['api/member/(:num)'] = 'api/Member/member/id/$1';
$route['api/provinces'] = 'api/Province/province';
$route['api/provinces-by-geo'] = 'api/Province/province_bygeo';
$route['api/school-by-province/(:num)'] = 'api/School/school_by_province/id/$1';
$route['api/amphurs/(:num)'] = 'api/Amphur/amphur/id/$1';
$route['api/tumbon/(:num)'] = 'api/District/tumbon/id/$1';
$route['api/zipcodes/(:num)'] = 'api/Zipcodes/zipcodes/id/$1';
$route['api/application'] = 'api/Application/application';
$route['api/application/update'] = 'api/Application/application_update';
$route['api/application/cancle'] = 'api/Application/application_cancel';
$route['api/applicants/delete'] = 'api/Application/applicant_delete';
$route['api/payment/update'] = 'api/Payments/payments_update';
$route['api/course_insert'] = 'api/Course/course_insert';
$route['api/course_update'] = 'api/Course/course_update';
$route['api/course_delete'] = 'api/Course/course_delete';
$route['api/course_location/delete'] = 'api/Course/course_location_delete';
$route['api/course_location/update'] = 'api/Course/course_location_update';

