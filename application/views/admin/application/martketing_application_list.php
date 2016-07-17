<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <?php $this->load->view('admin/template/head'); ?>    
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="padTop53 " >

        <!-- MAIN WRAPPER -->
        <div id="wrap" >
            <!-- HEADER SECTION -->
            <?php $this->load->view('admin/template/navbar'); ?>
            <!-- END HEADER SECTION -->
            <!-- MENU SECTION -->
            <?php $this->load->view('admin/template/leftmenu'); ?>            
            <!--END MENU SECTION -->
            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>  คอร์ส-โครงการ  </h2>
                        </div>
                    </div>
                    <hr />
                    <?php echo $this->breadcrumbs->show(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-file-alt"></i></div>
                                    <h5>คอร์ส-โครงการ </h5>
                                </header>                            
                                <div class="body">
                                    <div>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">ผู้สมัครทั้งหมด</a></li>
                                            <li role="presentation"><a href="#payment" aria-controls="payment" role="tab" data-toggle="tab">ผู้สมัครยังไม่ชำระเงิน</a></li>
                                            <li role="presentation"><a href="#holders" aria-controls="holders" role="tab" data-toggle="tab">ผู้มีสิทธิ์เข้าร่วมโครงการ</a></li>                                            
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="all">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover display" id="dataTables-all" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="center">#</th>
                                                                <th> รหัสใบสมัคร </th>
                                                                <th>ชื่อ - นามสกุล</th>
                                                                <th>เบอร์โทร</th>        
                                                                <th>สถานะ</th>
                                                                <th>วันที่สมัคร</th> 
                                                                <th>สมัครแล้ว</th> 
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>       
                                                            <?php  if ($application): foreach ($application as $index => $value): ?>
                                                                    <tr>
                                                                        <td><?= ++$index ?></td>
                                                                        <td><?= $value['app_code'] ?></td>
                                                                        <td><?= ($value['member']) ? $value['member']['first_name'] . '  ' . $value['member']['last_name'] : '' ?></td>
                                                                        <td><?= ($value['member']) ? $value['member']['contact_no'] : '' ?></td>                                                                       
                                                                        <td><?= ($value['flow']) ? $value['flow']['name'] : '' ?></td>   
                                                                        <td><?= DateThai($value['applicant_date']) ?></td>
                                                                        <td><?= countday($value['applicant_date']); ?> วัน</td>
                                                                        <td>
                                                                            <?php echo anchor('administrator/application/detail/' . $value['course']['id'] . '/' . $value['id'], '<i class="icon-list icon-white"></i>', 'class="btn btn-success"'); ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="payment">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover display" id="dataTables-payment" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="center">#</th>
                                                                <th> รหัสใบสมัคร </th>
                                                                <th>ชื่อ - นามสกุล</th>
                                                                <th>เบอร์โทร</th>                                                    
                                                                <th> คอร์ส-โครงการ </th>
                                                                <th>วันที่สมัคร</th>                                                    
                                                                <th>จำนวนผู้สมัคร</th>  
                                                                <th>สถานะ</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>       
                                                                <?php if ($pay): foreach ($pay as $index => $value): ?>
                                                                    <tr>
                                                                        <td><?= ++$index ?></td>
                                                                        <td><?= $value['app_code'] ?></td>
                                                                        <td><?= ($value['member']) ? $value['member']['first_name'] . '  ' . $value['member']['last_name'] : '' ?></td>
                                                                        <td><?= ($value['member']) ? $value['member']['contact_no'] : '' ?></td>
                                                                        <td><?= ($value['course']) ? $value['course']['name'] : '' ?></td>
                                                                        <td><?= DateThai($value['applicant_date']) ?></td>
                                                                        <td><?= $value['sum_applicants'] ?></td>
                                                                        <td><?= ($value['flow']) ? $value['flow']['name'] : '' ?></td>   
                                                                        <td>
                                                                            <?php echo anchor('administrator/application/detail/' . $value['course']['id'] . '/' . $value['id'], '<i class="icon-list icon-white"></i>', 'class="btn btn-success"'); ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="holders">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover display" id="dataTables-holders" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="center">#</th>
                                                                <th> รหัสใบสมัคร </th>
                                                                <th>ชื่อ - นามสกุล</th>
                                                                <th>เบอร์โทร</th>                                                    
                                                                <th> คอร์ส-โครงการ </th>
                                                                <th>วันที่สมัคร</th>                                                    
                                                                <th>จำนวนผู้สมัคร</th>  
                                                                <th>สถานะ</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>       
                                                                <?php if ($holders): foreach ($holders as $index => $holder): ?>
                                                                    <tr>
                                                                        <td><?= ++$index ?></td>
                                                                        <td><?= $holder['app_code'] ?></td>
                                                                        <td><?= ($holder['member']) ? $holder['member']['first_name'] . '  ' . $holder['member']['last_name'] : '' ?></td>
                                                                        <td><?= ($holder['member']) ? $holder['member']['contact_no'] : '' ?></td>
                                                                        <td><?= ($holder['course']) ? $holder['course']['name'] : '' ?></td>
                                                                        <td><?= DateThai($holder['applicant_date']) ?></td>
                                                                        <td><?= $holder['sum_applicants'] ?></td>
                                                                        <td><?= ($holder['flow']) ? $holder['flow']['name'] : '' ?></td>   
                                                                        <td>
                                                                    <?php echo anchor('administrator/application/detail/' . $holder['course']['id'] . '/' . $holder['id'], '<i class="icon-list icon-white"></i>', 'class="btn btn-success"'); ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; endif;
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
            <!--END PAGE CONTENT -->
            <!-- END RIGHT STRIP  SECTION -->
        </div>

        <!--END MAIN WRAPPER -->

<?php $this->load->view('admin/template/modals') ?>
        <!-- FOOTER -->
<?php $this->load->view('admin/template/footer') ?>
        <!--END FOOTER -->


        <!-- GLOBAL SCRIPTS -->
<?php $this->load->view('admin/template/javascript') ?>
        <!-- END PAGE LEVEL SCRIPTS --> 
        <script>
            $(document).ready(function () {
                $('.display').dataTable({
                    responsive: true,
                    "language": {
                        "lengthMenu": "Display _MENU_ records per page",
                        "zeroRecords": "ยังไม่มีข้อมูล",
                        "info": "หน้า _PAGE_ of _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)"
                    },
                    "iDisplayLength": 20,
                    dom: 'Bfrtip',
                    buttons: [
                        {extend: 'excel', text: '<i class="fa fa-file-excel-o"></i> Export to Excel', className: 'btn btn-default'}

                    ],
                });
//                $('#dataTables-payment').dataTable({
//                    responsive: true,
//                    "language": {
//                        "lengthMenu": "Display _MENU_ records per page",
//                        "zeroRecords": "ยังไม่มีข้อมูล",
//                        "info": "หน้า _PAGE_ of _PAGES_",
//                        "infoEmpty": "No records available",
//                        "infoFiltered": "(filtered from _MAX_ total records)"
//                    },
//                    "iDisplayLength": 20,
//                    dom: 'Bfrtip',
//                    buttons: [
//                        {extend: 'excel', text: '<i class="fa fa-file-excel-o"></i> Export to Excel', className: 'btn btn-default'}
//
//                    ],
//                });
//                $('#dataTables-holders').dataTable({
//                    responsive: true,
////                    "language": {
////                        "lengthMenu": "Display _MENU_ records per page",
////                        "zeroRecords": "ยังไม่มีข้อมูล",
////                        "info": "หน้า _PAGE_ of _PAGES_",
////                        "infoEmpty": "No records available",
////                        "infoFiltered": "(filtered from _MAX_ total records)"
////                    },
////                    "iDisplayLength": 20,
////                    dom: 'Bfrtip',
////                    buttons: [
////                        {extend: 'excel', text: '<i class="fa fa-file-excel-o"></i> Export to Excel', className: 'btn btn-default'}
////
////                    ],
//                });
            });
        </script>


    </body>

    <!-- END BODY -->
</html>
