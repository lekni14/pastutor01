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
                <a class="btn btn-primary" id="btn-confirm-delete">ยืนยัน</a>
            </div>
        </div>
    </div>
</div><!--End modal confirm --> 

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="form-body">
                        <input name="course_location_id" type="hidden" value="<?=$course['id']?>">
                        <div class="form-group">
                            <label class="control-label col-md-3">เลขประจำตัวประชาชน</label>
                            <div class="col-md-9">
                                <input name="identification" class="form-control" type="text" data-parsley-trigger="keyup" data-parsley-type="number" data-parsley-length="[13, 13]" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ชื่อ</label>
                            <div class="col-md-9">
                                <input name="first_name" class="form-control" type="text" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">นามสกุล</label>
                            <div class="col-md-9">
                                <input name="last_name" class="form-control" type="text" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3">ชือเล่น</label>
                            <div class="col-md-9">
                                <input name="nickname" class="form-control" type="text" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3">โทร</label>
                            <div class="col-md-9">
                                <input name="contact_no" class="form-control" type="text" data-parsley-trigger="keyup" data-parsley-type="number" data-parsley-length="[10, 10]" required="" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>  
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->