<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('template/css'); ?>    
    <body>
        <?php $this->load->view('template/nav'); ?> 
        <?php $this->load->view('template/ThaiDate'); ?>   
        <section class="head-page">
            <div class="container text-right">
                <h1 class="title-page">รายการสมัครเรียน</h1>
                <p></p>
            </div>
        </section>
        <section class="container well">
            <h1 class="text-center">สรุปการสมัครโครงการ</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="col-md-12 table-bordered table-striped table-condensed cf">
                            <thead>
                                <tr>
                                    <th class="text-left">โครงการ</th>
                                    <td class="text-left"><?= ($application['course'])?$application['course']['name']:'' ?></td>
                                </tr>
                                <tr>
                                    <th class="text-left" style="vertical-align: top">ผู้สมัคร</th>
                                    <td class="text-left">
                                        <?php foreach($application['applicants'] as $key=> $value): ?>
                                        <p><?=++$key?>. <?=$value['first_name']?>  <?=$value['last_name']?></p>
                                        <?php endforeach ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">สถานที่</th>
                                    <td class="text-left"><?= ($application['location'])?$application['location']['name']:'' ?></td>
                                </tr>
                                <tr>
                                    <th class="text-left">วันที่</th>
                                    <td class="text-left"><?= ($application['location'])?DateThai($application['location']['course_date']):'' ?></td>
                                </tr>
                                <tr>
                                    <th class="text-left">ค่าสมัครสุทธิ</th>
                                    <td class="text-left"><?=($application['payments'])?number_format($application['payments']['balance'],2):''?></td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <?php if($application['application_flow_id']==1): ?>
                    <div class="alert alert-danger" role="alert"><b>สถานะ</b> <?=($application['flow'])?$application['flow']['name']:''?></div>                    
                    <?php elseif($application['application_flow_id']==3): ?>
                    <div class="alert alert-success" role="alert"><b>สถานะ</b> <?=($application['flow'])?$application['flow']['name']:''?></div>                    
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">    
                    <?php if($application['application_flow_id']==1): ?>
<!--                    <button type="button" id="btn-cancle-app" class="btn btn-danger"> 
                        <i class="fa fa-remove fa-2x fa-lg"></i> <span style="color: #fff">ยกเลิกการสมัคร</span>                        
                    </button>-->
                    <?php echo anchor('api/application/cancle','<i class="fa fa-remove fa-2x fa-lg"></i> <span style="color: #fff">ยกเลิกการสมัคร</span>','class="btn btn-danger" id="btn-cancle-app" data-id="'.$application['id'].'"'); ?>                  
                    <?php echo anchor('app/edit/'.$application['id'],'<i class="fa fa-pencil-square fa-2x fa-lg"></i> <span style="color: #fff">แก้ไขการสมัคร</span>','class="btn btn-primary"'); ?>                  
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <?php if($application['application_flow_id']==1): ?>
                    <?php echo anchor('payin/'.$application['id'],'<i class="fa fa-print fa-4x  fa-2x fa-lg"></i> <span style="color: #fff;font-size: 30px;">พิมพ์ใบชำระเงิน</span>','class="btn btn-block btn-success" target="_blank"') ?>
                    <br><h4 class="sub-title">ช่องทางการชำระค่าสมัคร</h4>
                    <!--<img height="70" src="<?php echo base_url('img/counterservice-7-11.png'); ?>"> <img height="70" src="<?php echo base_url('img/KTB Logo.jpg'); ?>">-->
                    <div class="row">
                        <div class="col-md-10 text-center"><h3>ชื่อบัญชี : นางอัจฉราภรณ์ คงเพชร</h3></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><img width="70" src="<?php echo base_url('img/KTB.jpg'); ?>"></div>
                        <div class="col-md-10"><h2>984-0-30425-9</h2></div>
                    </div><br> 
                    <?php elseif($application['application_flow_id']==3): ?>
                    <?php echo anchor('app/application_print/'.$application['id'],'<i class="fa fa-print fa-4x  fa-2x fa-lg"></i> <span style="color: #fff;font-size: 30px;">พิมพ์ใบลงทะเบียน</span>','class="btn btn-block btn-success" target="_blank"') ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <?php $this->load->view('template/modal'); ?>      
        <!-- Modal -->

        <!-- /Modal -->
        <?php $this->load->view('template/javascript'); ?>
        <script>
            $("#btn-cancle-app").click(function (e){
                e.preventDefault()
                $("#md-confirm h5").text('ยืนยันยกเลิกใบสมัครโครงการ');
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
                            $('#md-success h5' ).text('ลบข้อมูลสำเร็จ');
                            $('#md-success').modal('show');
                        } 
                    }).fail(function(r) {
                           $('#md-error h5' ).text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                           $('#md-error').modal('show');
                    });
            });
        </script>
    </body>
</html>