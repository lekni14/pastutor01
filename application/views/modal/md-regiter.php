<div class="modal fade" id="md-regiter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"><i class="fa fa-pencil"></i> สมัครสมาชิก</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="frm-regit">
                            <h5 class="sub-title">ข้อมูลส่วนตัว</h5>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="InputIdentification" class="col-sm-4 control-label">เลขประจำตัวประชาชน<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="identification" id="InputIdentification" placeholder="เลขประจำตัวประชาชน" required="" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
    data-parsley-type="number" data-parsley-length="[13, 13]">
                                        <!--<input type="text" class="form-control numeric" name="identification" id="InputIdentification" data-parsley-type="number"  placeholder="เลขประจำตัวประชาชน" data-parsley-required="true"  maxlength="13">-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputFirstname" class="col-sm-4 control-label">คำนำหน้า<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <label class="col-sm-5">
                                            <input type="radio" name="title" value="1" required=""> นางสาว   
                                        </label>
                                        <label class="col-sm-5">
                                            <input type="radio" name="title" value="2"> นาย   
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputFirstname" class="col-sm-4 control-label">ชื่อ<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="firstname" id="InputFirstname" placeholder="ชื่อ" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputLastname" class="col-sm-4 control-label">นามสกุล<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="lastname" class="form-control" id="InputLastname" placeholder="นามสกุล" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputNikname" class="col-sm-4 control-label">ชื่อเล่น<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nickname" class="form-control" id="InputNikname" placeholder="ชื่อเล่น" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputContactNo" class="col-sm-4 control-label">โทรศัพท์<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="contact_no" class="form-control numeric" id="InputContactNo" maxlength="10" required="" data-parsley-validation-threshold="1" data-parsley-trigger="keyup">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputEmail" class="col-sm-4 control-label">อีเมล</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" class="form-control" id="InputEmail">
                                    </div>
                                </div>                                
                            </div>
                            <h5 class="sub-title">ข้อมูลติดต่อ</h5>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="InputProvinceNo" class="col-sm-2 control-label">จังหวัด</label>
                                    <div class="col-sm-4">
                                        <select class="selectpicker" id="ProvinceID" title="เลือกจังหวัด..." name="province_id">                                            
                                        </select>
                                    </div>
                                    <label for="InputDistrictNo" class="col-sm-2 control-label">อำเภอ</label>
                                    <div class="col-sm-4">
                                        <select class="selectpicker" title="เลือกอำเภอ..." id="district_id" name="district_id" disabled >                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputSubdistrictNo" class="col-sm-2 control-label">ตำบล</label>
                                    <div class="col-sm-4">
                                        <select class="selectpicker" id="InputSubdistrictNo" title="เลือกตำบล..." name="sub_district_id" disabled>
                                        </select>
                                    </div>
                                    <label for="postcode" class="col-sm-3 control-label">รหัสไปรษณีย์</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control numeric" id="postcode" name="postcode" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
    data-parsley-type="number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hno" class="col-sm-2 control-label">เลขที่</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="hno" id="hno">
                                    </div>
                                    <label for="mno" class="col-sm-2 control-label">หมู่ที่</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="mno" id="mno">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lane" class="col-sm-2 control-label">ตรอก/ซอย</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="lane" id="lane">
                                    </div>
                                    <label for="road" class="col-sm-2 control-label">ถนน</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="road" id="road">
                                    </div>
                                </div>                                                                
                            </div>
                            <h5 class="sub-title">ข้อมูลการศึกษา</h5>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="InputProviceNo" class="col-sm-2 control-label">จังหวัด<span class="required">*</span><span class="required"></span></label>
                                    <div class="col-sm-4">
                                        <select class="selectpicker" id="ProvinceID_sch" title="เลือกจังหวัด..." name="ProvinceID_sch" required="">                                            
                                        </select>
                                    </div>
                                    <label for="InputProviceNo" class="col-sm-2 control-label">โรงเรียน<span class="required">*</span><span class="required"></span></label>
                                    <div class="col-sm-4">
                                        <select class="selectpicker" id="school_id" title="เลือกโรงเรียน..." name="school_id" required="">                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputProviceNo" class="col-sm-2 control-label">ระดับชั้น<span class="required">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="selectpicker" id="classroom" title="เลือกระดับชั้น..." name="classroom" required="">
                                            <option value="ม4.">ม4.</option>
                                            <option value="ม5.">ม5.</option>
                                            <option value="ม6.">ม6.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h5 class="sub-title">ข้อมูลการใช้ระบบ</h5>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-sm-4 control-label">Password (รหัสผ่าน)<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" class="form-control"  id="password" required="" parsley-validate="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-4 control-label"> Password (รหัสผ่าน) อีกครั้ง<span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" name="conf_password" data-parsley-equalto="#password" parsley-equalto-message="Passwort stimmt nicht überein" parsley-validate="password" class="form-control" id="conf_password" required="">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>                   
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary btn-submit-reg">สมัครสมาชิก</button>
            </div>
        </div>
    </div>
</div>
