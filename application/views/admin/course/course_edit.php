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
            <?php $this->load->view('admin/template/phpfunction'); ?>            
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
                                    <div>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-justified" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">คอร์ส-โครงการ</a></li>
                                            <li role="presentation"><a href="#location" aria-controls="location" role="tab" data-toggle="tab">สถานที่</a></li>
                                            <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">เอกสาร</a></li>
                                        </ul>

                                        <!-- Tab panes -->
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
                                                                        <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                                                        <input type="text" name="name" class="form-control" id="course_name" data-parsley-required="true" placeholder="ชื่อคอร์ส-โครงการ" value="<?= $course['name'] ?>" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="price" class="col-sm-4 control-label">วันที่เริ่มสมัคร</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="reg_start_date" value="<?= date("d/m/Y", strtotime($course['reg_start_date'])); ?>" id="reg_start_date" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="price" class="col-sm-4 control-label">วันที่สิ้นสุดสมัคร</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="reg_end_date" value="<?= date("d/m/Y", strtotime($course['reg_end_date'])); ?>" id="reg_end_date" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="price" class="col-sm-4 control-label">ราคา</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="price" id="price" placeholder="ราคา" data-parsley-required="true" data-parsley-type="integer" value="<?= $course['price'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="discount" class="col-sm-4 control-label">ราคา(แบบกลุ่ม)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="discount" id="discount" placeholder="ราคา(แบบกลุ่ม)" data-parsley-type="integer" value="<?= $course['discount'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="person" class="col-sm-4 control-label">จำนวนผู้สมัคร(แบบกลุ่ม)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="person" id="person" placeholder="จำนวนผู้สมัคร(แบบกลุ่ม)" data-parsley-type="integer" value="<?= $course['person'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="active" class="col-sm-4 control-label">ส่วนลด</label>
                                                                    <div class="col-sm-8">
                                                                        <input name="discount_exclusive" class="form-control" data-parsley-type="integer" value="<?= $course['discount_exclusive'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="active" class="col-sm-4 control-label">active</label>
                                                                    <div class="col-sm-8">
                                                                        <select name="active" class="form-control">
                                                                            <option <?= ($course['active'] == 1) ? 'selected' : '' ?> value="1">โชว์</option>
                                                                            <option <?= ($course['active'] == 0) ? 'selected' : '' ?> value="0">ไม่โชว์</option>
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
                                                                            <td><strong>ลบ</strong></td>
                                                                        </tr>
                                                                        <?php if ($course['location']): foreach ($course['location'] as $key => $value) : ?>
                                                                        <tr id="<?=$key?>">
                                                                            <td>
                                                                                <input type="text" class="form-control" name="location[<?=$key?>][name]" readonly id="name" data-parsley-required="true" value="<?= $value['name'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" readonly name="location[<?=$key?>][cousre_date]" value="<?= date("d/m/Y", strtotime($value['course_date'])); ?>" id="start_date" />
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" readonly name="location[<?=$key?>][cousre_end_date]" value="<?= date("d/m/Y", strtotime($value['course_end_date'])); ?>" id="end_date" />
                                                                            </td>
                                                                            <td>
<!--                                                                                <div class="checkbox anim-checkbox">
                                                                                    <input type="checkbox" id="ch1" class="danger" />
                                                                                    <label for="ch1">ลบ</label>
                                                                                </div>-->
                                                                                <a href="<?php echo base_url('api/course_location/delete'); ?>" class="btn btn-danger btn-sm btn-confirm" data-id="<?= $value['id'] ?>" data-row="<?=$key?>"><i class="icon-trash"></i></a>
                                                                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="delrow(<?=$key?>)"><i class="icon-trash"></i></button>-->
                                                                            </td>
                                                                        </tr>
                                                                            <?php endforeach;
                                                                        endif; ?>
                                                                    </thead>
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
                                                                            <td>ภาพหน้าปก(300x180)
    <?php $img = search($course['storage'], 'filename', '300x180');
$id = 0;
if ($img) {
    $img =end($img);
    $id = $img['id'];
} ?>
                                                                            </td>
                                                                            <td><a target="_blank" href="<?php echo base_url('administrator/file/download/' . $id); ?>" class="btn btn-primary"><i class="icon-download"></i></a></td>
                                                                            <td>
                                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                    <span class="btn btn-file btn-default">
                                                                                        <span class="fileupload-new">Select file</span>
                                                                                        <span class="fileupload-exists">Change</span>
                                                                                        <input type="file" name="fileUpload[0][file]" />
                                                                                        <input type="hidden" name="fileUpload[0][name]" value="300x180" />
                                                                                    </span>
                                                                                    <span class="fileupload-preview"></span>
                                                                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <td>ภาพรายละเอียด<?php $large = search($course['storage'], 'filename', 'large');
                                                                                $id = 0;
                                                                                if ($large) {
                                                                                     $large =end($large);
                                                                                    $id = $large['id'];
                                                                                } ?></td>
                                                                            <td><a target="_blank" href="<?php echo base_url('administrator/file/download/' . $id); ?>" class="btn btn-primary"><i class="icon-download"></i></a></td>
                                                                            <td>
                                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                    <span class="btn btn-file btn-default">
                                                                                        <span class="fileupload-new">Select file</span>
                                                                                        <span class="fileupload-exists">Change</span>
                                                                                        <input type="file" name="fileUpload[1][file]" />
                                                                                        <input type="hidden" name="fileUpload[1][name]" value="large" />
                                                                                        <input type="hidden" name="fileUpload[1][id]" value="<?= $id ?>" />
                                                                                    </span>
                                                                                    <span class="fileupload-preview"></span>
                                                                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                                                                </div>
                                                                            </td>                                                                        
                                                                        </tr>
                                                                        <tr>
                                                                            <td>เอกสารกำหนดการ(pdf)<?php $schedule = search($course['storage'], 'filename', 'schedule');
                                                                                    $id = 0;
                                                                                    if ($schedule) {
                                                                                        $schedule =end($schedule);
                                                                                        $id = $schedule['id'];
                                                                                    } ?>
                                                                            </td>
                                                                            <td><a target="_blank" href="<?php echo base_url('administrator/file/download/' . $id); ?>" class="btn btn-primary"><i class="icon-download"></i></a></td>
                                                                            <td><div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                    <span class="btn btn-file btn-default">
                                                                                        <span class="fileupload-new">Select file</span>
                                                                                        <span class="fileupload-exists">Change</span>
                                                                                        <input type="file" name="fileUpload[2][file]" />
                                                                                        <input type="hidden" name="fileUpload[2][name]" value="schedule" />
                                                                                        <input type="hidden" name="fileUpload[2][id]" value="<?= $id ?>" />
                                                                                    </span>
                                                                                    <span class="fileupload-preview"></span>
                                                                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                                                                </div>
                                                                            </td>                                                                        
                                                                        </tr>
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
            </div>
            <!--END PAGE CONTENT -->
            <!-- END RIGHT STRIP  SECTION -->
        </div>
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
                                <textarea data-parsley-required="true" id="inputlocation" name="inputlocation" class="form-control" rows="3"></textarea>
                                <input type="hidden" name="course_id" value="<?=$course['id']?>">
                            </div>
                            <div class="form-group">
                                <label for="location">วันที่เริ่ม</label>
                                <input type="text" class="form-control" id="inputcousre_date" name="inputcousre_date" value="<?php echo date('d/m/Y'); ?>"  />
                            </div>
                            <div class="form-group">
                                <label for="location">วันที่สิ้นสุด</label>
                                <input type="text" class="form-control" id="inputcousre_end_date" name="inputcousre_end_date" value="<?php echo date('d/m/Y'); ?>" />
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
        <!--END MAIN WRAPPER -->

        <!-- FOOTER -->
<?php $this->load->view('admin/template/footer') ?>
        <?php $this->load->view('admin/template/modals') ?>
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
                console.log($("input[name=course_type]").val())
               if($("input[name=course_type]").val()==0){
                    $("#discount").attr("readonly",'');
                    $("#person").attr("readonly",'');
                }else{
                    $("#discount").removeAttr("readonly");
                    $("#person").removeAttr("readonly");
                }
                
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
            $(".btn-confirm").click(function (e){
                e.preventDefault()
                $("#md-confirm h5").text('ยืนยันลบข้อมูลสถานที่');
                $("#md-confirm a").attr( 'href',$(this).attr('href') );
                $("#md-confirm a").attr( 'data-id',$(this).attr('data-id') );
                $("#md-confirm a").attr( 'data-row',$(this).attr('data-row') );
                $("#md-confirm").modal('show')  
            });
            $("#btn-confirm-delete").click(function (e){
                e.preventDefault()
                $("#md-confirm").modal('hide') 
                
                ajaxRequest($(this).attr('href'),{'id':$(this).attr('data-id'),'row':$(this).attr('data-row')},"POST")
                    .done(function(r) {
                        if(r.result==true){
                            delrow(r.data)
                            $('#md-success h5' ).text('ลบข้อมูลสำเร็จ');
                            $('#md-success').modal('show');
                        } 
                    }).fail(function(r) {
                           $('#md-error h5' ).text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                           $('#md-error').modal('show');
                    });
            });
            $('#btn-save-course').click(function () {
                var $form = $("#frm-course");
                if ($form.parsley().validate()) {
                    var $form = new FormData($("#frm-course")[0]);
                    ajaxUpfile("<?php echo base_url('api/course_update'); ?>", $form, "POST")
                            .done(function (r) {
                                if (r.result == true) {
                                    console.log('r')
                                    $('#md-success h5').text('บันทึกข้อมูลคอร์สสำเร็จ');
                                    $('#md-success').modal('show');
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });
                }
            });
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy'
            });
            $("#btn-add-location").click(function () {
                $("#md-location").modal('show');
            });
            var row = $("#tb-location tr").length-1;
            $("#btn-save-location").click(function () {
                var $form = $("#frm-location");
                if ($form.parsley().validate()) {
                    console.log($form.serializeArray())
                    ajaxRequest("<?php echo base_url('api/course_location/update'); ?>",$form.serializeArray(),"POST")
                    .done(function(r) {
                        if(r.result==true){
                            $('#tb-location tr:last').after('<tr id="' + row + '"><td><input type="text" class="form-control" name="location[' + row + '][name]" id="name" value="' + $("#inputlocation").val() + '" readonly></td><td><input type="text" class="form-control" name="location[' + row + '][cousre_date]" value="' + $("#inputcousre_date").val() + '" readonly></td><td><input type="text" class="form-control datepicker" name="location[' + row + '][cousre_end_date]" value="' + $("#inputcousre_end_date").val() + '" id="" readonly /></td><td><a href="http://localhost/pastutor/api/course_location/delete" class="btn btn-danger btn-sm btn-confirm" data-id="'+r.data.id+'" data-row="0"><i class="icon-trash"></i></a></td></tr>');
                            row++;
                            $("#md-location").modal('hide');
                        } 
                    }).fail(function(r) {
                           $('#md-error h5' ).text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                           $('#md-error').modal('show');
                    });
                   
                }
            });
            function delrow(id)
            {
                $('table#tb-location tr#' + id).remove();
            }
            $('#inputcousre_date').datepicker({
                format: 'dd/mm/yyyy'
            });
            $('#inputcousre_end_date').datepicker({
                format: 'dd/mm/yyyy'
            });
        </script>


    </body>

    <!-- END BODY -->
</html>
