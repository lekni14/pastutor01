<div class="modal fade" id="md-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-lock"></i> เข้าสู่ระบบ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 wp-login">
                        <div class="login-warning text-center hidden">
                            <h4>ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</h4>
                            <button type="button" class="btn btn-repeat btn-lg">
                                <i class="glyphicon glyphicon-repeat"></i>
                            </button>
                            <p>ลองใหม่คลิกที่นี่ค่ะ</p>
                        </div>
                        <form id="frm-login" data-parsley-validate="">
                            <div class="form-group">
                                <label for="InputIdentification">เลขประจำตัวประชาชน</label>
                                <input type="text" class="form-control" id="InputIdentification" name="identification" required="">
                            </div>
                            <div class="form-group">
                                <label for="InputPassword">รหัสผ่าน</label>
                                <input type="password" name="password" class="form-control" id="InputPassword" required="">
                            </div>                                                        
                        </form>
                        <p>ลืมรหัสผ่าน <?php echo anchor('#','คลิ๊ก','id="forget-password"'); ?></p>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary btn-login">Login</button>
                    </div>                    
                    <div class="col-sm-6 text-center">
                        <h4 class="title-regit">สมัครสมาชิก (กรณียังไม่เป็นสมาชิก)</h4>
                        <button type="button" class="btn btn-regiter btn-lg" data-toggle="modal" data-target="#md-regiter">
                            <i class="fa fa-pencil fa-3x"></i>
                        </button>                                              
                    </div>
                </div>                        
            </div>
            <div class="modal-footer">
<!--                <div class="row">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary btn-login">Login</button>
                    </div>
                </div>                        -->
            </div>
        </div>
    </div>
</div>
