<?php $this->load->view('modal/md-login'); ?>
<?php $this->load->view('modal/md-regiter'); ?>
<?php //$this->load->view('modal/md-regiter');     ?> 
<!-- modal success -->  
<div id="md-forget-password" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                <h4 class="modal-title">ลืมรหัสผ่าน</h4>
            </div>
            <div class="modal-body">
                <form id="frm-forget-pass" class="form-horizontal" data-parsley-validate="">
                    <div class="form-group">
                        <!--<label for="InputIdentification55" class="col-sm-2 control-label">เลขประจำตัวประชาชน</label>-->
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="InputIdentification55" name="identification" required="" placeholder="เลขประจำตัวประชาชน">
                            <!--<input type="email" class="form-control" id="Inputmail55" name="email" required="" placeholder="อีเมล">-->
                        </div>
                    </div>   
                    <div class="form-group">
                        <!--<label for="InputIdentification55" class="col-sm-2 control-label">เลขประจำตัวประชาชน</label>-->
                        <div class="col-sm-12">
                            <!--<input type="text" class="form-control" id="InputIdentification55" name="identification" required="" placeholder="เลขประจำตัวประชาชน">-->
                            <input type="email" class="form-control" id="Inputmail55" name="email" required="" placeholder="อีเมล">
                        </div>
                    </div>   
                </form>
                <p>เข้าสู่ระบบ <?php echo anchor('#', 'คลิ๊ก', 'class="login"'); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="forget-pas-sand">ส่ง</button>
            </div>
        </div>
    </div>
</div><!--End modal success --> 
<!-- modal success -->  
<div id="md-walcome" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                <h4 class="modal-title">ยินดีต้อนรับ</h4>
            </div>
            <div class="modal-body">
                <img src="<?php echo base_url('img/welcome.jpg'); ?>" width="100%">
            </div>
            <!--            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>               
                        </div>-->
        </div>
    </div>
</div><!--End modal success -->  
<!-- modal success -->  
<div id="md-success" class="modal modal-styled fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                <h4 class="modal-title"><i class="fa fa-check-circle"></i> SUCCESS</h4>
            </div>
            <div class="modal-body text-center">
                <h5></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">ปิด</button>               
            </div>
        </div>
    </div>
</div><!--End modal success -->  

<!-- modal error -->  
<div id="md-error" class="modal modal-styled fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                <h4 class="modal-title"><i class="fa fa-warning"></i> ERROR</h4>
            </div>
            <div class="modal-body text-center">
                <h5></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">ปิด</button>               
            </div>
        </div>
    </div>
</div><!--End modal error -->
<!--start modal confirm --> 
<div id="md-confirm" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                <h4 class="modal-title"><i class="fa fa-question-circle"></i> ยืนยัน</h4>
            </div>
            <div class="modal-body">
                <h5></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <a class="btn btn-primary" id="btn-confirm-delete">ลบ</a>
            </div>
        </div>
    </div>
</div><!--End modal confirm --> 

<!-- modal md-alert-course -->  
<div id="md-alert-course" class="modal fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                <h4 class="modal-title">ข้อมูลการสมัคร</h4>
            </div>
            <div class="modal-body">
                <h5>กำลังโหลดข้อมูล...</h5>
            </div>
        </div>
    </div>
</div><!--md-alert-course  --> 