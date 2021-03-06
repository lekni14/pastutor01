﻿<!DOCTYPE html>
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
                            <h2>  ทีมงาน  </h2>
                        </div>
                    </div>
                    <hr />
                    <?php echo $this->breadcrumbs->show(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-user"></i></div>
                                    <h5>เพิ่มทีมงาน </h5>
                                </header>                            
                                <div class="body">
                                    <div class="row">
                                        <div class="col-sm-7 col-sm-offset-2">
                                            <form class="form-horizontal" id="frm-staff">
                                                <div class="form-group">
                                                    <label for="course_type" class="col-sm-4 control-label">active</label>
                                                    <div class="col-sm-8">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="hidden" value="0" name="active" />
                                                                <input class="uniform" type="checkbox" value="1" name="active" /> active
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>                                                            
                                                <div class="form-group">
                                                    <label for="first_name" class="col-sm-4 control-label">ชื่อ</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="first_name" class="form-control" id="first_name" data-parsley-required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="last_name" class="col-sm-4 control-label">นามสกุล</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="last_name"  id="last_name" data-parsley-required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="col-sm-4 control-label">อีเมล์</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control" name="email" data-parsley-required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phon" class="col-sm-4 control-label">โทรศัพท์</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="phon" id="price" data-parsley-required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="discount" class="col-sm-4 control-label">ระดับ</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="permission_id">
                                                            <option value="1">admin</option>
                                                            <option value="2">การตลาด</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-offset-4">
                                                    <button type="button" id="btn-save-staff" class="btn btn-primary btn btn-primary col-sm-3">บันทึก</button>                                          
                                                </div>
                                            </form>
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
            $('.uniform').uniform();
            $('#btn-save-staff').click(function () {
                var $form = $("#frm-staff");
                if ($form.parsley().validate()) {
                    ajaxRequest("<?php echo base_url('administrator/admin/create/data'); ?>", $form.serializeArray(), "POST")
                            .done(function (r) {
                                if (r.result == true) {
                                    console.log('r')
                                    $('#md-success h5').text('บันทึกข้อมูลสำเร็จ');
                                    $('#md-success').modal('show');
                                    setTimeout(function(){ 
                                        window.location.assign("<?php echo base_url('administrator/admin'); ?>")
                                    }, 2000);
                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });
                }else{
                     var ok = $('.parsley-error').length === 0;
                    $('.bs-callout-warning').toggleClass('hidden', ok);
                }
            });
        </script>


    </body>

    <!-- END BODY -->
</html>
