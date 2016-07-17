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
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">รายชื่อผู้สมัครโครงการ</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form id="frm-people">
                                    <table id="tb-people" class="col-md-12 table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                            <tr>
                                                <th width="5%" class="text-center">#</th>
                                                <th width="35%" class="text-center">ชื่อ-นามสกุล</th>
                                                <th width="20%" class="text-center">ชื่อเล่น</th>
                                                <th width="15%" class="text-center">ค่าสมัคร</th>
                                                <th width="15%" class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($application['applicants'] as $key => $value) : ?>
                                            <tr id="<?=$key?>">
                                                <td>
                                                    <input type="hidden" name="applicants[0][id]" value="<?= $value['id'] ?>">
                                                    <input type="hidden" name="applicants[0][application_id]" value="<?= $value['application_id'] ?>">
                                                    <input type="hidden" name="applicants[0][nickname]" value="<?= $value['nickname'] ?>">
                                                    <input type="hidden" name="applicants[0][last_name]" value="<?= $value['last_name'] ?>">
                                                    <input type="hidden" name="applicants[0][identification]" value="<?= $value['identification'] ?>">
                                                    <input type="hidden" name="applicants[0][first_name]" value="<?= $value['first_name'] ?>">
                                                    <input type="hidden" name="applicants[0][price]" class="inputprice" value="<?= $value['price'] ?>">
                                                    #
                                                </td>
                                                <td><?= $value['first_name'] ?>  <?= $value['last_name'] ?></td>
                                                <td><?= $value['nickname'] ?></td>
                                                <td><span class="price"><?= $value['price'] ?></span></td>
                                                <td><?php if($key!=0): ?><a href="<?php echo base_url('api/applicants/delete'); ?>" class="btn btn-danger btn-sm btn-confirm" data-id="<?= $value['id'] ?>" data-row="<?=$key?>"><i class="fa fa-trash-o"></i></a><?php endif; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">ส่วนลด</th>
                                                <td><?= $application['course']['discount_exclusive'] * 100 ?></td>
                                                <td>%</td>
                                            </tr>
                                            <tr>
                                                <th colspan="3">
                                                    <input type="hidden" id="inputbalance" name="balance">
                                                    <input type="hidden" name="payment_id" value="<?=($application['payments'])?$application['payments']['id']:''?>">
                                                    <input type="hidden" name="discount" id="inputdiscount">ค่าสมัครสุทธิ
                                                </th>
                                                <td><span class="sumprice"></span></td>
                                                <td>บาท</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </form>
                                <button id="btn-add-people" class="btn btn-primary"><i class="fa fa-user-plus"></i> เพิ่มเพื่อน</button>
                            </div>
                        </div>
                    </div>                                    
                </div>                                
                <div class="col-md-4">
                    <div class="row">
                        <i class="fa fa-bullhorn fa-3x fa-pull-left fa-border text-danger" aria-hidden="true"></i><p class="promotion">สมัคร <?= $application['course']['person'] ?> คนขึ้นไป จ่ายเพียงคนละ <?= $application['course']['discount'] ?> บาท</p><br>
                    </div>
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">สรุปการสมัครโครงการ</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                        <thead>
                                            <tr>
                                                <th class="text-left">โครงการ</th>
                                                <td class="text-left"><?=($application['course'])?$application['course']['name']:'' ?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">สถานที่</th>
                                                <td class="text-left"><?=($application['location'])?$application['location']['name']:''?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">วันที่</th>
                                                <td class="text-left"><?=($application['location'])?DateThai($application['location']['course_date']):''?></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php echo anchor('app/'.$application['id'],'<i class="fa fa-chevron-circle-left fa-2x fa-lg"></i> <span>   กลับ  </span>','class="btn btn-default"'); ?>                  
                    <?php echo anchor('api/application/update','<i class="fa fa-save fa-2x fa-lg"></i> <span style="color: #fff">บันทึกการแก้ไข</span>','class="btn btn-primary" id="btn-save-people"'); ?>                  
                </div>
            </div>
        </section>

        <!-- Modal -->
        <?php $this->load->view('template/modal'); ?>      
        <!-- Modal -->
        <div class="modal fade" id="md-add-people" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-pencil-square fa-2x"></i> เพิ่มเพื่อน</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="frm-add-people">
                                    <div class="form-group">
                                        <label for="InputIdentification">เลขประจำตัวประชาชน<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="identification" id="peopleIdentification" placeholder="เลขประจำตัวประชาชน" required="" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
                                               data-parsley-type="number" data-parsley-length="[13, 13]">                                                               
                                    </div>
                                    <div class="form-group">
                                        <label for="InputFirstname">ชื่อ<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="firstname" id="peopleFirstname" placeholder="ชื่อ" required>                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="InputLastname">นามสกุล<span class="required">*</span></label>
                                        <input type="text" name="lastname" class="form-control" id="peopleLastname" placeholder="นามสกุล" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNikname">ชื่อเล่น<span class="required">*</span></label>                                      
                                        <input type="text" name="nickname" class="form-control" id="peopleNikname" placeholder="ชื่อเล่น" required="">                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-plus-people" class="btn btn-primary"><i class="fa fa-plus-circle"></i> เพิ่ม</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal -->
        <?php $this->load->view('template/javascript'); ?>
        <script>
            $(".btn-confirm").click(function (e){
                e.preventDefault()
                $("#md-confirm h5").text('ยืนยันลบข้อมูลเพื่อนผู้ร่วมโครงการ');
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
            $('#btn-save-people').click (function (e) {
                e.preventDefault()
                var $form = $("#frm-people");
                ajaxRequest($(this).attr('href'),$form.serializeArray(),"POST")
                    .done(function(r) {
                        if(r.result==true){
                            $('#md-success h5' ).text('อัพเดตรายชื่อสมัครตัวสำเร็จ');
                            $('#md-success').modal('show');
                            setTimeout(function(){
                                window.location.replace("<?php echo base_url().'app/'.$application['id'] ?>");
                                //location.reload();
                            }, 2000);
                            
                        } 
                    }).fail(function(r) {
                           $('#md-error h5' ).text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                           $('#md-error').modal('show');
                    });
            });
            $("#btn-add-people").click(function () {
                $("#frm-add-people input").val('');
                $("#md-add-people").modal('show')
            });
            var row = $("#tb-people tbody tr").length;
            $('#btn-plus-people').click(function () {
                var $form = $("#frm-add-people");
                if ($form.parsley().validate()) {
                    $('#tb-people tbody tr:last').after('<tr id="' + row + '"><input type="hidden" name="applicants[' + row + '][application_id]" value="<?= $application['id'] ?>"><input type="hidden" class="inputprice" name="applicants[' + row + '][price]" value="<?= $application['course']['price'] ?>"><input type="hidden" name="applicants[' + row + '][nickname]" value="' + $("#peopleNikname").val() + '"><input type="hidden" name="applicants[' + row + '][last_name]" value="' + $("#peopleLastname").val() + '"><input type="hidden" name="applicants[' + row + '][first_name]" value="' + $("#peopleFirstname").val() + '"><input type="hidden" name="applicants[' + row + '][identification]" value="' + $("#peopleIdentification").val() + '"><td>#</td><td>' + $("#peopleFirstname").val() + ' ' + $("#peopleLastname").val() + '</td><td>' + $("#peopleNikname").val() + '</td><td><span class="price"><?= $application['course']['price'] ?></span></td><td><button type="button" class="btn btn-danger btn-sm" onclick="delrow(' + row + ')"><i class="fa fa-trash-o"></i></button></td></tr>');
                    row++;
                    cul(row)
                    $("#md-add-people").modal('hide')
                }
            });
            function delrow(id)
            {
                row--;
                $('table#tb-people tr#' + id).remove();
                console.log(row)
                cul(row)
            }
            
            function cul(row)
            {
                var p = <?= $application['course']['person'] ?>;    
                var discount = <?= $application['course']['discount'] ?>;
                var price = <?= $application['course']['price'] ?>;
                var exclusive = <?= $application['course']['discount_exclusive'] ?>;
                if(row >= p){
                    $(".price").text(discount);
                    $(".inputprice").val(discount)
                }else{
                    $(".price").text(price);
                    $(".inputprice").val(price)
                }
                var sumprice = 0;
                $('.price').each(function() {
                    sumprice+=parseFloat($(this).text());
                });
                var balance = sumprice - (sumprice*exclusive);
                $(".sumprice").text(balance)
                $("#inputdiscount").val(sumprice*exclusive)
                $("#inputbalance").val(balance)

            }
            $(function()
            {
                cul(row)
            });
        </script>
    </body>
</html>