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
                                    <h5>คอร์ส-โครงการ</h5>
                                </header>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo anchor('administrator/course', '<i class="icon-chevron-left"></i> กลับ', 'class="btn btn-default"'); ?>
                                            <button id="btn-save-course" class="btn btn-primary"><i class="icon-save"></i> บันทึก</button>                                             
                                        </div>                                        
                                    </div> <br> 
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-justified setup-panel" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">คอร์ส-โครงการ</a></li>
                                        <li role="presentation"><a href="#location" aria-controls="location" role="tab" data-toggle="tab">สถานที่</a></li>
                                        <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">เอกสาร</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <br>
                                    <div class="alert alert-danger bs-callout bs-callout-warning hidden">
                                        <h4>ERROR</h4>
                                        <p>กรุณากรอกข้อมูลให้ครบ</p>
                                    </div>
                                    <form id="frm-course" enctype="multipart/form-data">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane setup-panel active" id="home">
                                                <div class="row">
                                                    <div class="col-sm-7 col-sm-offset-2">
                                                        <div class="form-horizontal">
                                                            <div class="form-group">
                                                                <label for="course_type" class="col-sm-4 control-label">ประเภทโครงการ</label>
                                                                <div class="col-sm-8">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input class="uniform" type="radio" value="0" name="course_type" checked="checked" /> แบบเดี่ยว
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input class="uniform" type="radio" value="1" name="course_type" /> แบบกลุ่ม
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group">
                                                                <label for="course_name" class="col-sm-4 control-label">คอร์ส-โครงการ</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="name" class="form-control" id="course_name" data-parsley-required="true" placeholder="ชื่อคอร์ส-โครงการ" >
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="price" class="col-sm-4 control-label">วันที่เริ่มสมัคร</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="reg_start_date" value="<?php echo date('d/m/Y'); ?>" id="reg_start_date" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="price" class="col-sm-4 control-label">วันที่สิ้นสุดสมัคร</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="reg_end_date" value="<?php echo date('d/m/Y'); ?>" id="reg_end_date" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="price" class="col-sm-4 control-label">ราคา</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="price" id="price" placeholder="ราคา" data-parsley-required="true" data-parsley-type="integer">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="discount" class="col-sm-4 control-label">ราคา(แบบกลุ่ม)</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="discount" id="discount" placeholder="ราคา(แบบกลุ่ม)" data-parsley-type="integer">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="person" class="col-sm-4 control-label">จำนวนผู้สมัคร(แบบกลุ่ม)</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="person" id="person" placeholder="จำนวนผู้สมัคร(แบบกลุ่ม)" data-parsley-type="integer">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">ส่วนลด</label>
                                                                <div class="col-sm-8">
                                                                    <input name="discount_exclusive" class="form-control" data-parsley-type="integer">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="active" class="col-sm-4 control-label">active</label>
                                                                <div class="col-sm-8">
                                                                    <select name="active" class="form-control">
                                                                        <option value="1">โชว์</option>
                                                                        <option value="0">ไม่โชว์</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane setup-panel" id="location">
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                        <div class="form-horizontal">
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-0 col-sm-10">
                                                                    <button type="button" class="btn btn-primary" id="btn-add-location"><i class="icon-plus"></i> เพิ่มสถานที่</button>
                                                                    <!--<button type="button" class="btn btn-danger" id="btn-remove-location"><i class="icon-minus"></i> ลบ</button>-->
                                                                </div>
                                                            </div>
                                                            <table class="table" id="tb-location">
                                                                <thead>
                                                                    <tr>
                                                                        <td><strong>สถานที่</strong></td>
                                                                        <td><strong>วันที่เริ่ม</strong></td>
                                                                        <td><strong>วันที่สิ้นสุด</strong></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>      
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane setup-panel" id="images">
                                                <div class="row">
                                                    <div class="col-sm-7 col-sm-offset-2">
                                                        <div class="form-horizontal">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>ภาพหน้าปก(300x180)</td>
                                                                        <td>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <span class="btn btn-file btn-default">
                                                                                    <span class="fileupload-new">Select file</span>
                                                                                    <span class="fileupload-exists">Change</span>
                                                                                    <input type="file" name="fileUpload[0][file]" required=""/>
                                                                                    <input type="hidden" name="fileUpload[0][name]" value="300x180" />
                                                                                </span>
                                                                                <span class="fileupload-preview"></span>
                                                                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>ภาพรายละเอียด</td>
                                                                        <td>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <span class="btn btn-file btn-default">
                                                                                    <span class="fileupload-new">Select file</span>
                                                                                    <span class="fileupload-exists">Change</span>
                                                                                    <input type="file" name="fileUpload[1][file]" />
                                                                                    <input type="hidden" name="fileUpload[1][name]" value="large" required />
                                                                                </span>
                                                                                <span class="fileupload-preview"></span>
                                                                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                                                            </div>
                                                                        </td>                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <td>เอกสารกำหนดการ(pdf)</td>
                                                                        <td><div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <span class="btn btn-file btn-default">
                                                                                    <span class="fileupload-new">Select file</span>
                                                                                    <span class="fileupload-exists">Change</span>
                                                                                    <input type="file" name="fileUpload[3][file]" />
                                                                                    <input type="hidden" name="fileUpload[3][name]" value="schedule" />
                                                                                </span>
                                                                                <span class="fileupload-preview"></span>
                                                                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                                                            </div>
                                                                        </td>                                                                        
                                                                    </tr>
<!--                                                                    <tr>
                                                                        <td>วีดีโอ</td>
                                                                        <td><div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <span class="btn btn-file btn-default">
                                                                                    <span class="fileupload-new">Select file</span>
                                                                                    <span class="fileupload-exists">Change</span>
                                                                                    <input type="file" name="fileUpload[4][file]" />
                                                                                    <input type="hidden" name="fileUpload[4][name]" value="vdo" />
                                                                                </span>
                                                                                <span class="fileupload-preview"></span>
                                                                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                                                            </div>
                                                                        </td>                                                                        
                                                                    </tr>-->
                                                                </tbody>
                                                            </table>                                                                                                                        
                                                        </div>                                           
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
        <!-- modal location -->  
        <div id="md-location" class="modal modal-styled fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                        <!--<h4 class="modal-title"><i class="fa fa-check-circle"></i> SUCCESS</h4>-->
                    </div>
                    <div class="modal-body">
                        <form id="frm-location">
                            <div class="form-group">
                                <label for="location">สถานที่</label>
                                <textarea data-parsley-required="true" id="inputlocation" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="location">วันที่เริ่ม</label>
                                <input type="text" class="form-control" id="inputcousre_date" value="<?php echo date('d/m/Y'); ?>"  />
                            </div>
                            <div class="form-group">
                                <label for="location">วันที่สิ้นสุด</label>
                                <input type="text" class="form-control" id="inputcousre_end_date" value="<?php echo date('d/m/Y'); ?>" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btn-save-location">ตกลง</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>               
                    </div>
                </div>
            </div>
        </div><!--End modal location -->  
        <?php $this->load->view('admin/template/modals') ?>
        <!-- FOOTER -->
        <?php $this->load->view('admin/template/footer') ?>
        <!--END FOOTER -->


        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('admin/template/javascript') ?>
        <!-- END PAGE LEVEL SCRIPTS -->        
        <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jasny/js/bootstrap-inputmask.js"></script>

        <script>
            $('.uniform').uniform();
            $( document ).ready(function() {
                $("#discount").attr("readonly",'');
                $("#person").attr("readonly",'');
                
            });
            $( "input[name=course_type]" ).on( "click", function() {
                if($(this).val()==0){
                    $("#discount").attr("readonly",'');
                    $("#person").attr("readonly",'');
                }else{
                    $("#discount").removeAttr("readonly");
                    $("#person").removeAttr("readonly");
                }
              console.log($( "input:checked" ).val());
//                $('#graphFrame').toggle(function(){
//                      var $this = $(this);
//                      $this.is(":visible") ? $this.attr('src', 'graph1.php') : $this.removeAttr('src')
//                });
            });
            $('#btn-save-course').click(function () {
                var $form = $("#frm-course");
                if ($form.parsley().validate()) {
                    var $form = new FormData($("#frm-course")[0]);
                    ajaxUpfile("<?php echo base_url('api/course_insert'); ?>", $form, "POST")
                            .done(function (r) {
                                if (r.result == true) {
                                    console.log('r')
                                    $('#md-success h5').text('เพิ่มข้อมูลคอร์สสำเร็จ');
                                    $('#md-success').modal('show');
                                    setTimeout(function(){                                        
                                        location.reload();
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
            $("#btn-add-location").click(function () {
                $("#md-location").modal('show');
            });
            var row = $("#tb-location tr").length;
            $("#btn-save-location").click(function () {
                var $form = $("#frm-location");
                if ($form.parsley().validate()) {
                    $('#tb-location tr:last').after('<tr id="' + row + '"><td><input type="text" class="form-control" name="location[' + row + '][name]" id="name" value="' + $("#inputlocation").val() + '" readonly></td><td><input type="text" class="form-control" name="location[' + row + '][cousre_date]" value="' + $("#inputcousre_date").val() + '" readonly></td><td><input type="text" class="form-control datepicker" name="location[' + row + '][cousre_end_date]" value="' + $("#inputcousre_end_date").val() + '" id="" readonly /></td><td><button type="button" class="btn btn-danger btn-sm" onclick="delrow(' + row + ')"><i class="icon-trash"></i></button></td></tr>');
                    row++;
                    $("#md-location").modal('hide');
                }
            });
            function delrow(id)
            {
                $('table#tb-location tr#' + id).remove();
            }
            $('#start_date').datepicker({
                format: 'dd/mm/yyyy'
            });
            $('#end_date').datepicker({
                format: 'dd/mm/yyyy'
            });
            $('#reg_start_date').datepicker({
                format: 'dd/mm/yyyy'
            });
            $('#reg_end_date').datepicker({
                format: 'dd/mm/yyyy'
            });
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

            var checkin = $('#inputcousre_date').datepicker({
                format: 'dd/mm/yyyy',
              onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
              }
            }).on('changeDate', function(ev) {
              if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate());
                checkout.setValue(newDate);
              }
              checkin.hide();
              $('#inputcousre_end_date')[0].focus();
            }).data('datepicker');
            var checkout = $('#inputcousre_end_date').datepicker({
                format: 'dd/mm/yyyy',
              onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
              }
            }).on('changeDate', function(ev) {
              checkout.hide();
            }).data('datepicker');
        </script>


    </body>

    <!-- END BODY -->
</html>
