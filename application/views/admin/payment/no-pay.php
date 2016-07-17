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
            <?php // $this->load->view('admin/template/navbar'); ?>
            <!-- END HEADER SECTION -->
            <!-- MENU SECTION -->
            <?php $this->load->view('admin/template/leftmenu'); ?>            
            <!--END MENU SECTION -->
            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2> ระบบชำระเงิน </h2>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    ชำระเงินแล้ว
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th class="center">#</th>
                                                    <th>รหัสสมัคร</th>
                                                    <th>เลขประตัวประชาชน</th>
                                                    <th>ชื่อ - นามสกุล</th>
                                                    <th>คอร์ส-โครงการ</th>
                                                    <th>วันที่สมัคร</th>
                                                    <th>สถานนะ</th>
                                                    <th>แก้ไขล่าสุด</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>                                                
                                                <?php if($application): foreach ($application as $key => $value): ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?= ++$key ?></td>
                                                        <td><?=($value['application'])? $value['application']['app_code']:'' ?></td>
                                                        <td><?= ($value['member']) ? $value['member']['identification'] : '' ?></td>
                                                        <td><?= ($value['member']) ? $value['member']['first_name'] : '' ?>  <?= ($value['member']) ? $value['member']['last_name'] : '' ?></td>
                                                        <td><?= ($value['application']) ? ($value['application']['course'])?$value['application']['course']['name'] :'': '' ?></td>
                                                        <td><?= ($value['application'])?DateThai($value['application']['applicant_date']):'' ?></td>
                                                        <td><?=($value['application'])?($value['application']['flow'])?$value['application']['flow']['name']:'':''?></td>
                                                        <td class="center"><?=generate_date_today("d M Y H:i", strtotime($value['updated_at']),"th", true);?></td>                                                        
                                                        <td><a href="<?=  base_url('api/payment/update')?>" data-id="<?=$value['id']?>" data-appid="<?=$value['application']['id']?>" class="btn btn-primary btn-pay"><i class="icon-pencil icon-white"></i></a></td>
                                                    </tr>       
                                                <?php endforeach; endif; ?>
                                            </tbody>
                                        </table>
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
        <?php $this->load->view('admin/template/modals') ?>
        <!--END MAIN WRAPPER -->
        <div class="modal fade" id="md-pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="H2">ชำระงิน</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div id="body-detail" class="col-md-12">
                                
                            </div>
                        </div>
                        <form role="form" id="frm-pay">                    
                            <div class="form-group">
                                <label>สถานะ</label>
                                <select class="form-control" name="application_flow_id">
                                    <option value="3">ชำระเงินแล้ว</option>
                                    <option value="2">ยกเลิก(เกินกำหนดชำระเงืน)</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a class="btn btn-primary" id="btn-save-pay">บันทึก</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <?php $this->load->view('admin/template/footer') ?>
        <!--END FOOTER -->


        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('admin/template/javascript') ?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
            $(".btn-pay").click(function (e){
                e.preventDefault();
                var url = "<?php echo base_url('administrator/payment-detail'); ?>/"+$(this).attr('data-appid');
                $("#md-pay .modal-body #body-detail").load(url); 
                $("#btn-save-pay").attr('href',$(this).attr('href'))
                $('<input>').attr({ type: 'hidden',id: 'foo', name: 'id',value:$(this).attr('data-id')}).appendTo('#frm-pay');
                $('<input>').attr({ type: 'hidden',id: 'foo', name: 'application_id',value:$(this).attr('data-appid')}).appendTo('#frm-pay');
                $("#md-pay").modal('show'); 
            });
            $("#btn-save-pay").click(function (e){   
                e.preventDefault();
                var $form = $("#frm-pay");
                if ( $form.parsley().validate() ){
                    ajaxRequest($(this).attr('href'),$form.serializeArray(),"POST")
                    .done(function(r) {
                        if(r.result==true){
                            $("#md-pay").modal('hide'); 
                            $('#md-success h5' ).text('บันทึกข้อมูลเรียบร้อย');
                            $('#md-success').modal('show');
                            setTimeout(function(){                                
                                location.reload();
                            }, 2000);
                        } 
                    }).fail(function(r) {
                           $('#md-error h5' ).text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                           $('#md-error').modal('show');
                    });
                }
                
            });
        </script>


    </body>

    <!-- END BODY -->
</html>
