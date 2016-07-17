<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <?php $session = $this->session->userdata('admin'); $this->load->view('admin/template/head'); ?>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="padTop53 " >

        <!-- MAIN WRAPPER -->
        <div id="wrap" >
            <!-- HEADER SECTION -->
            <?php  $this->load->view('admin/template/navbar'); ?>
            <!-- END HEADER SECTION -->
            <!-- MENU SECTION -->
            <?php $this->load->view('admin/template/leftmenu'); ?>            
            <!--END MENU SECTION -->
            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>  โปรไฟล์  </h2>
                        </div>
                    </div>
                    <hr />
                    <?php echo $this->breadcrumbs->show(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="fa fa-user"></i></div>
                                    <h5>โปรไฟล์</h5>
                                </header>
                                <div class="body">                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-sm-7 col-sm-offset-2">
                                                <form id="frm-save-profile" class="form-horizontal">  
                                                    <label>ข้อมูลส่วนตัว</label>
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="<?=$session['id']?>">
                                                        <label for="course_name" class="col-sm-4 control-label">ชื่อ</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="first_name" class="form-control" id="first_name" data-parsley-required="true" value="<?=$session['first_name']?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course_name" class="col-sm-4 control-label">นามสกุล</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="last_name" class="form-control" id="last_name" data-parsley-required="true" value="<?=$session['last_name']?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course_name" class="col-sm-4 control-label">อีเมล</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="email" class="form-control" id="email" data-parsley-required="true" value="<?=$session['email']?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course_name" class="col-sm-4 control-label">โทรศัพท์</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="phon" class="form-control" id="phon" data-parsley-required="true" value="<?=$session['phon']?>">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <label>ข้อมูลเข้าระบบ</label>
                                                    <div class="form-group">
                                                        <label for="course_name" class="col-sm-4 control-label">username</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="username" class="form-control" id="username" value="<?=$session['username']?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course_name" class="col-sm-4 control-label">pasword</label>
                                                        <div class="col-sm-8">
                                                            <input type="pasword" name="password" class="form-control" id="pasword">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course_name" class="col-sm-4 control-label">new pasword</label>
                                                        <div class="col-sm-8">
                                                            <input type="pasword" name="newpassword" class="form-control" id="pasword">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course_name" class="col-sm-4 control-label">confirm password</label>
                                                        <div class="col-sm-8">
                                                            <input type="pasword" class="form-control" id="conf_pasword" data-parsley-equalto="#pasword">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-3 col-sm-offset-4">
                                                            <button id="btn-save-profile" class="btn btn-primary col-sm-12"><i class="icon-save"></i> บันทึก</button>
                                                        </div>                                                        
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
            </div>
            <!--END PAGE CONTENT -->
            <!-- END RIGHT STRIP  SECTION -->
        </div>

        <!--END MAIN WRAPPER -->

        <!-- FOOTER -->
        <?php $this->load->view('admin/template/footer') ?>
        <!--END FOOTER -->
        <?php $this->load->view('admin/template/modals') ?>

        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('admin/template/javascript') ?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
            $('#btn-save-profile').click(function (e) {
                e.preventDefault()
                var $form = $("#frm-save-profile");
                if ($form.parsley().validate()) {
                    ajaxRequest("<?php echo base_url('administrator/profile/profile_update'); ?>", $form.serializeArray(), "POST")
                            .done(function (r) {
                                if (r.result == true) {
                                    $('#md-success h5').text('บันทึกข้อมูลเรียบร้อย');
                                    $('#md-success').modal('show');
                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });
                }
            });
        </script>


    </body>

    <!-- END BODY -->
</html>
