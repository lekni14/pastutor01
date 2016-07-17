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
            <?php // $this->load->view('admin/template/navbar'); ?>
            <!-- END HEADER SECTION -->
            <!-- MENU SECTION -->
            <?php $this->load->view('admin/template/leftmenu'); ?>            
            <!--END MENU SECTION -->
            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2> ระบบชำระเงิน </h2>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    ชำระเงินแล้ว
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th class="center">#</th>
                                                    <th>รหัสสมัคร</th>
                                                    <th>เลขประตัวประชาชน</th>
                                                    <th>ชื่อ - นามสกุล</th>
                                                    <th>คอร์ส-โครงการ</th>
                                                    <th>วันที่สมัคร</th>
                                                    <th>สถานนะ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>                                                
                                                <?php if($application): foreach ($application as $key => $value): ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?= ++$key ?></td>
                                                        <td><?=($value['application'])? $value['application']['app_code']:'' ?></td>
                                                        <td><?= ($value['member']) ? $value['member']['identification'] : '' ?></td>
                                                        <td><?= ($value['member']) ? $value['member']['first_name'] : '' ?>  <?= ($value['member']) ? $value['member']['last_name'] : '' ?></td>
                                                        <td><?= ($value['application']) ? ($value['application']['course'])?$value['application']['course']['name'] :'': '' ?></td>
                                                        <td><?= ($value['application'])?DateThai($value['application']['applicant_date']):'' ?></td>
                                                        <td><?=($value['application'])?($value['application']['flow'])?$value['application']['flow']['name']:'':''?></td>
                                                        <td class="center"><?=generate_date_today("d M Y H:i", strtotime($value['updated_at']),"th", true);?></td>
                                                    </tr>       
                                                <?php endforeach; endif; ?>
                                            </tbody>
                                        </table>
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

        <!-- FOOTER -->
        <?php $this->load->view('admin/template/footer') ?>
        <!--END FOOTER -->


        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('admin/template/javascript') ?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
        </script>


    </body>

    <!-- END BODY -->
</html>
