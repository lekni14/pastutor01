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
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    คอร์ส-โครงการ 
                                </div>
                                <div class="panel-body">
                                    <div>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-justified" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">คอร์ส-โครงการ</a></li>
                                            <li role="presentation"><a href="#location" aria-controls="location" role="tab" data-toggle="tab">สถานที่</a></li>
                                            <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">รูป</a></li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="home">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>คอร์ส-โครงการ:</td>
                                                            <td><?=$course['name']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ราคา</td>
                                                            <td><?=$course['price']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ราคา(แบบกลุ่ม)</td>
                                                            <td><?=$course['discount']?></td>
                                                        </tr>

                                                        <tr>
                                                        <tr>
                                                            <td>จำนวนผู้สมัคร(แบบกลุ่ม)</td>
                                                            <td><?=$course['person']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ส่วนลด</td>
                                                            <td><?=$course['discount_exclusive']?></td>
                                                        </tr>                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="location">
                                                <table class="table">
                                                    <?php foreach ($course['location'] as $key => $value) : ?>
                                                    <tbody>
                                                        <tr>
                                                            <td>สถานที่:</td>
                                                            <td><?=$value['name']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>วันที่</td>
                                                            <td><?=  DateThai($value['course_date'])?> - <?=  DateThai($value['course_end_date'])?></td>
                                                        </tr>  
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="images">...</div>
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

        <!-- FOOTER -->
        <?php $this->load->view('admin/template/footer') ?>
        <!--END FOOTER -->


        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('admin/template/javascript') ?>
        <!-- END PAGE LEVEL SCRIPTS -->
    </body>

    <!-- END BODY -->
</html>
