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
             <?php
                                    $session = $this->session->userdata('admin'); 
                                    if($session['permission_id'] == 1){
                                        $application_flow_id = 11;
                                    }else if($session['permission_id'] == 2){
                                        $application_flow_id = 10;
                                    }
                                        ?>
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
                                    <h5>คอร์ส-โครงการ </h5>
                                </header>                            
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-12 text-left">
                                            
                                            <?php echo anchor('administrator/payin/'.$application['id'],'<i class="fa fa-print fa-2x fa-lg"></i> <span>พิมพ์ใบชำระเงิน</span>','class="btn btn-success" target="_blank"') ?>
                                            <?php echo anchor('administrator/application_print/'.$application['id'],'<i class="fa fa-print fa-2x fa-lg"></i> <span>พิมพ์ใบลงทะเบียน</span>','class="btn btn-warning" target="_blank"') ?>
                                            <?php echo anchor('administrator/payment-follow-cancle', 'ยกเลิกใบสมัคร', 'class="btn btn-danger col-sm-2 pull-right btn-confirm" data-id="'.$application['id'].'" data-application-flow-id="'.$application_flow_id.'"'); ?>
                                        </div><br>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover display" id="dataTables-example">
                                            <tr>
                                                <th>รหัสสมัคร</th>
                                                <td><?= $application['app_code'] ?></td>                                                
                                            </tr>
                                            <tr>
                                                <th>โครงการ</th>
                                                <td><?= ($application['course']) ? $application['course']['name'] : '' ?></td>                                                
                                            </tr>
                                            <tr>
                                                <th>ผู้สมัคร</th>
                                                <td>
                                                    <?php foreach ($application['applicants'] as $index => $value): ?>
                                                        <p><?= ++$index ?>. <?= $value['first_name'] ?> <?= $value['last_name'] ?></p>
                                                    <?php endforeach; ?>
                                                </td>                                                
                                            </tr>
                                            <tr>
                                                <th>สถานที่</th>
                                                <td><?= ($application['location']) ? $application['location']['name'] : '' ?></td>                                                
                                            </tr>
                                            <tr>
                                                <th>วันที่</th>
                                                <td><?= ($application['location']) ? DateThai($application['location']['course_date']) : '' ?></td>                                                
                                            </tr>
                                            <tr>
                                                <th>ค่าสมัครสุทธิ</th>
                                                <td><?= ($application['payments']) ? $application['payments']['balance'] : '' ?></td>                                                
                                            </tr>
                                            <tr>
                                                <th>สถานะ</th>
                                                <td><?= ($application['flow']) ? $application['flow']['name'] : '' ?></td>                                                
                                            </tr>
                                        </table>
                                    </div>                                    
                                   
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="well well-sm">
                                                    <?php if($follow): foreach ($follow as $key => $value) :?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <div id="postlist">
                                                                <div class="panel">
                                                                    <div class="panel-heading">
                                                                        <h4>การติดตาม ครั้งที่ <?=++$key?></h4>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <?=$value['report']?>
                                                                    </div>

                                                                    <div class="panel-footer">
                                                                        <span class="label label-default">ติดตามโดย : <?=($value['admin'])?$value['admin']['first_name'].' '.$value['admin']['last_name']:''?></span> <span class="label label-default pull-right"><small><em><?=  DateTimeThai($value['updated_at'])?></em></small></span>
                                                                    </div>
                                                                </div>                                                    
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <?php endforeach; endif;?>   
                                                    <?php if ($session['permission_id'] == 2): ?>
                                                    <?php if(($key<2)||(empty($key))): ?>
                                                    <?php if(($application['application_flow_id']==1)||($application['application_flow_id']==8)||($application['application_flow_id']==9)): ?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <form id="frm-report">
                                                                <div class="form-group">                                                        
                                                                    <input type="hidden" name="admin_id" value="<?= $session['id'] ?>">
                                                                    <input type="hidden" name="application_id" value="<?= $application['id'] ?>">
                                                                    <input type="hidden" name="application_flow_id" value="<?= ($key<1)?8:9; ?>">
                                                                    <textarea class="form-control" name="report" rows="3"></textarea>
                                                                </div>                           
                                                                <button type="button" id="btn-save-report" class="btn btn-primary col-sm-2 pull-right">บันทึก</button>
                                                                <?php echo anchor('administrator/payment-follow-cancle', 'ยกเลิกใบสมัคร', 'class="btn btn-danger col-sm-2 pull-right btn-confirm" data-id="'.$application['id'].'" data-application-flow-id="10"'); ?>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <?php if(($application['application_flow_id']==1)||($application['application_flow_id']==8)||($application['application_flow_id']==9)): ?>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-10">
                                                            <?php echo anchor('administrator/payment-follow-cancle', 'ยกเลิกใบสมัคร', 'class="btn btn-danger col-sm-2 pull-right btn-confirm" data-id="'.$application['id'].'" data-application-flow-id="10"'); ?>                                          
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                                                                       
                                        </div>
                                        <div class="row">
                                            
                                        <?php endif; ?>
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
                $('#btn-save-report').click(function () {
                    var $form = $("#frm-report");
                    if ($form.parsley().validate()) {
                        ajaxRequest("<?php echo base_url('administrator/payment_follow'); ?>", $form.serializeArray(), "POST")
                                .done(function (r) {
                                    if (r.result == true) {
                                        console.log('r')
                                        $('#md-success h5').text('เพิ่มข้อมูลสำเร็จ');
                                        $('#md-success').modal('show');
                                        setTimeout(function () {
                                            location.reload();
                                        }, 2000);
                                    }
                                }).fail(function (r) {
                            $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                            $('#md-error').modal('show');
                        });
                    } else {
                        var ok = $('.parsley-error').length === 0;
                        $('.bs-callout-warning').toggleClass('hidden', ok);
                    }
                });
                $(".btn-confirm").click(function (e){
                    e.preventDefault()
                    $("#md-confirm h5").text('ยืนยันการยกเลิกใบสมัครนี้');
                    $("#md-confirm a").attr( 'href',$(this).attr('href') );
                    $("#md-confirm a").attr( 'data-id',$(this).attr('data-id') );
                    $("#md-confirm a").attr( 'data-row',$(this).attr('data-application-flow-id') );
                    $("#md-confirm").modal('show')  
                });
                $("#btn-confirm-delete").click(function (e){
                    e.preventDefault()
                    $("#md-confirm").modal('hide') 

                    ajaxRequest($(this).attr('href'),{'application_id':$(this).attr('data-id'),'application_flow_id':$(this).attr('data-row')},"POST")
                        .done(function(r) {
                            if(r.result==true){
                                $('#md-success h5' ).text('การยกเลิกใบสมัครนี้แล้ว');
                                $('#md-success').modal('show');
                                setTimeout(function(){                                
                                    location.reload();
                                }, 2000);
                            } 
                        }).fail(function(r) {
                               $('#md-error h5' ).text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                               $('#md-error').modal('show');
                        });
                });
            </script>
    </body>

    <!-- END BODY -->
</html>
