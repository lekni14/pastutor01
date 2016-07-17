<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('template/css'); ?>    
    <body>
        <?php $this->load->view('template/nav'); ?>  
        <section class="head-page">
            <div class="container text-right">
                <h1 class="title-page">ประวัติส่วนตัว</h1>
            </div>
        </section>
        <section class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">ข้อมูลส่วนตัว</a></li>
                        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">ข้อมูลติดต่อ</a></li>
                        <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">ข้อมูลการศึกษา</a></li>
                        <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">ข้อมูลการใช้ระบบ</a></li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="tab-content well">
                        <div role="tabpanel" class="tab-pane active" id="tab1">
                            <div class="row">
                                <form id="frm-change-name" class="form-horizontal col-md-offset-2 col-md-8" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $profile['id'] ?>">
                                    <div class="form-group">
                                        <label for="InputIdentification" class="col-sm-4 control-label">รูป</label>
                                        <div class="col-sm-7">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="fileUpload"></span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputIdentification" class="col-sm-4 control-label">เลขประจำตัวประชาชน<span class="required">*</span></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="identification" id="InputIdentification" placeholder="เลขประจำตัวประชาชน" required="" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
                                                   data-parsley-type="number" data-parsley-length="[13, 13]" value="<?= $profile['identification'] ?>">                                           
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputFirstname" class="col-sm-4 control-label">คำนำหน้า<span class="required">*</span></label>
                                        <div class="col-sm-8">
                                            <label class="col-sm-5">
                                                <input type="radio" name="title" value="1" <?=($profile['title']==1)?'checked':''?> > นางสาว   
                                            </label>
                                            <label class="col-sm-5">
                                                <input type="radio" name="title" value="2" <?=($profile['title']==2)?'checked':''?> > นาย   
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputFirstname" class="col-sm-4 control-label">ชื่อ<span class="required">*</span></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="first_name" id="InputFirstname" placeholder="ชื่อ" required value="<?= $profile['first_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputLastname" class="col-sm-4 control-label">นามสกุล<span class="required">*</span></label>
                                        <div class="col-sm-7">
                                            <input type="text" name="last_name" class="form-control" id="InputLastname" placeholder="นามสกุล" required="" value="<?= $profile['last_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNikname" class="col-sm-4 control-label">ชื่อเล่น<span class="required">*</span></label>
                                        <div class="col-sm-7">
                                            <input type="text" name="nickname" class="form-control" id="InputNikname" placeholder="ชื่อเล่น" required="" value="<?= $profile['nickname'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"></label>
                                        <div class="col-sm-8">
                                            <button type="button" id="btn-change-name" class="btn btn-sm btn-primary">บันทึก</button>
                                        </div>
                                    </div>
                                </form>
                            </div>                            
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab2">
                            <div class="row">
                                <form id="frm-change-contact" class="form-horizontal col-md-offset-2 col-md-8">
                                    <input type="hidden" name="member_id" value="<?= $profile['id'] ?>">
                                    <input type="hidden" name="id" value="<?= $profile['address']['id'] ?>">
                                    <div class="form-group">
                                        <label for="InputProvinceNo" class="col-sm-2 control-label">จังหวัด</label>
                                        <div class="col-sm-4">                                            
                                            <select class="selectpicker" id="ProvinceID"  name="province_id">
                                                <option data-hidden="true" value="<?= $profile['address']['province_id'] ?>"><?= $profile['address']['province']['PROVINCE_NAME'] ?></option>
                                            </select>
                                        </div>
                                        <label for="InputDistrictNo" class="col-sm-2 control-label">อำเภอ</label>
                                        <div class="col-sm-4">
                                            <select class="selectpicker" title="" id="district_id" name="district_id" disabled >                                            
                                                <option data-hidden="true" value="<?= $profile['address']['district_id'] ?>"><?= $profile['address']['district']['AMPHUR_NAME'] ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputSubdistrictNo" class="col-sm-2 control-label">ตำบล</label>
                                        <div class="col-sm-4">
                                            <select class="selectpicker" id="InputSubdistrictNo" title="<?= $profile['address']['sub_district']['DISTRICT_NAME'] ?>" name="sub_district_id" disabled>
                                                <option data-hidden="true" value="<?= $profile['address']['sub_district_id'] ?>"><?= $profile['address']['sub_district']['DISTRICT_NAME'] ?></option>
                                            </select>
                                        </div>
                                        <label for="postcode" class="col-sm-3 control-label">รหัสไปรษณีย์</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control numeric" id="postcode" name="postcode" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
                                                   data-parsley-type="number" value="<?= $profile['address']['postcode'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hno" class="col-sm-2 control-label">เลขที่</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="hno" id="hno" value="<?= $profile['address']['hno'] ?>">
                                        </div>
                                        <label for="mno" class="col-sm-2 control-label">หมู่ที่</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="mno" id="mno" value="<?= $profile['address']['mno'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lane" class="col-sm-2 control-label">ตรอก/ซอย</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="lane" id="lane" value="<?= $profile['address']['lane'] ?>">
                                        </div>
                                        <label for="road" class="col-sm-2 control-label">ถนน</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="road" id="road" value="<?= $profile['address']['road'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputEmail" class="col-sm-2 control-label">อีเมล</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="email_address" class="form-control" id="InputEmail" value="<?= $profile['email_address'] ?>">
                                        </div>
                                        <label for="InputContactNo" class="col-sm-2 control-label">โทรศัพท์<span class="required">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" name="contact_no" class="form-control numeric" id="InputContactNo" maxlength="10" required="" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
                                                   data-parsley-type="number" value="<?= $profile['contact_no'] ?>">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8">
                                            <button type="button" id="btn-change-contact" class="btn btn-sm btn-primary">บันทึก</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab3">
                            <div class="row">
                                <form id="frm-change-school" class="form-horizontal col-md-offset-2 col-md-8">
                                    <input type="hidden" name="id" value="<?= $profile['id'] ?>">
                                    <div class="form-group">
                                        <label for="InputProviceNo" class="col-sm-3 control-label">เลือกจังหวัด<span class="required"></span></label>
                                        <div class="col-sm-4">
                                            <select class="selectpicker" id="ProvinceID_sch" title="เลือกจังหวัด..."  required=""> 
                                                <option data-hidden="true" value="<?= $profile['school']['PROVINCE_ID'] ?>"><?= $profile['school']['province']['PROVINCE_NAME'] ?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="selectpicker" id="school_id" name="school_id" required="">                                            
                                                <option data-hidden="true" value="<?= $profile['school']['school_id'] ?>"><?= $profile['school']['school_name'] ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputProviceNo" class="col-sm-3 control-label">ระดับชั้น<span class="required"></span></label>
                                        <div class="col-sm-4">
                                            <select class="selectpicker" id="classroom" title="เลือกระดับชั้น..." name="classroom" required="">
                                                <option value="ม4." <?php
                                                if ($profile['classroom'] == 'ม4.') {
                                                    echo 'selected';
                                                }
                                                ?>>ม4.</option>
                                                <option value="ม5." <?php
                                                if ($profile['classroom'] == 'ม5.') {
                                                    echo 'selected';
                                                }
                                                ?>>ม5.</option>
                                                <option value="ม6." <?php
                                                        if ($profile['classroom'] == 'ม6.') {
                                                            echo 'selected';
                                                        }
                                                ?>>ม6.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-8">
                                            <button type="button" id="btn-change-school" class="btn btn-sm btn-primary">บันทึก</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab4">
                            <div class="row">
                                <form id="frm-change-pass" class="form-horizontal col-md-offset-2 col-md-8">
                                    <input type="hidden" name="id" value="<?= $profile['id'] ?>">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputPassword0" class="col-sm-5 control-label">Password (รหัสผ่านเดิม)</label>
                                            <div class="col-sm-7">
                                                <input type="password" name="password" class="form-control"  id="password" required="" parsley-validate="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-sm-5 control-label">Password (รหัสผ่านใหม่)</label>
                                            <div class="col-sm-7">
                                                <input type="password" name="new_password" class="form-control"  id="password3" required="" parsley-validate="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword" class="col-sm-5 control-label"> Password (รหัสผ่าน) อีกครั้ง</label>
                                            <div class="col-sm-7">
                                                <input type="password" data-parsley-equalto="#password3" parsley-equalto-message="Passwort stimmt nicht überein" parsley-validate="password" class="form-control" id="conf_password" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword" class="col-sm-5 control-label"></label>
                                            <div class="col-sm-7">
                                                <button type="button" id="btn-change-pass" class="btn btn-sm btn-primary">เปลี่ยนรหัสผ่าน</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>                         
            </div>           
        </section>
        <!-- Modal -->
<?php $this->load->view('template/modal'); ?>                             
        <!-- /Modal -->
<?php $this->load->view('template/javascript'); ?> 
        <script>
            $('#btn-change-name').click(function () {
                var $form = $("#frm-change-name");
                if ($form.parsley().validate()) {
                    $form = new FormData($("#frm-change-name")[0]);
                    ajaxUpfile("<?php echo base_url('api/member/update'); ?>", $form, "POST")
                            .done(function (r) {
                                if (r.result == true) {
                                    $('#md-success h5').text('บันทึกข้อมูลส่วนตัวสำเร็จ');
                                    $('#md-success').modal('show');
                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });
                }
            });
            $('#btn-change-contact').click(function () {
                var $form = $("#frm-change-contact");
                if ($form.parsley().validate()) {
                    ajaxRequest("<?php echo base_url('api/address/update'); ?>", $form.serializeArray(), "POST")
                            .done(function (r) {
                                if (r.result == true) {
                                    $('#md-success h5').text('บันทึกข้อมูลติดต่อเรียบร้อย');
                                    $('#md-success').modal('show');
                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });
                }
            });
            $('#btn-change-school').click(function () {
                var $form = $("#frm-change-school");
                if ($form.parsley().validate()) {
                    ajaxRequest("<?php echo base_url('api/member/update'); ?>", $form.serializeArray(), "POST")
                            .done(function (r) {
                                if (r.result == true) {
                                    $('#md-success h5').text('บันทึกข้อมูลการศึกษาเรียบร้อย');
                                    $('#md-success').modal('show');
                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });
                }
            });
            $('#btn-change-pass').click(function () {
                var $form = $("#frm-change-pass");
                if ($form.parsley().validate()) {
                    ajaxRequest("<?php echo base_url('api/change/pass'); ?>", $form.serializeArray(), "POST")
                            .done(function (r) {
                                if (r.result == true) {
                                    $('#md-success h5').text('บันทึกข้อมูลการศึกษาเรียบร้อย');
                                    $('#md-success').modal('show');
                                } else {
                                    $('#md-error h5').text('Password (รหัสผ่านเดิม) ไม่ถูกต้อง');
                                    $('#md-error').modal('show');
                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });
                }
            });
        </script>
    </body>
</html>