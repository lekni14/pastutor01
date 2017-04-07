<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('template/css'); ?>   
<?php $this->load->view('admin/template/phpfunction'); ?> 	
    <body>
        <?php $this->load->view('template/nav'); ?> 
        <?php $this->load->view('template/ThaiDate'); ?>   
        <section class="head-page">
            <div class="container text-right">
                <h1 class="title-page">รายการสมัครเรียน</h1>
                <p></p>
            </div>
        </section>
        <?php if ((count($this->cart->contents()) > 0)||(count($application) > 0)): ?>
        <?php if($cart): ?>
        <section class="container regitertion-content">
            <?php if (count($this->cart->contents()) > 0): ?>
                <div class="row form-group">
                    <div class="col-xs-12">
                        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                            <li class="active">
                                <a href="#step-1">
                                    <h4 class="list-group-item-heading">Step 1</h4>
                                    <p class="list-group-item-text">สมัครโครงการ</p>
                                </a></li>
                            <li class="disabled">
                                <a href="#step-2">
                                    <h4 class="list-group-item-heading">Step 2</h4>
                                    <p class="list-group-item-text">ยืนยันการสมัครโครงการ</p>
                                </a></li>
                            <li class="disabled">
                                <a href="#step-3">
                                    <h4 class="list-group-item-heading">Step 3</h4>
                                    <p class="list-group-item-text">สมัครโครงการเสร็จสมบูรณ์</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row setup-content" id="step-1">
                    <div class="col-xs-12">
                        <div class="col-md-12 well">
                            <div class="row">     
                                <div class="list-group">
                                    <?php foreach ($this->cart->contents() as $items): ?>
                                        <li class="list-group-item cart">
                                            <div class="media col-md-3">
                                                <figure class="pull-left">
												<?php 
                                                    //$storage = end($course['storage']) 
                                                    $thumbnail = search($course['storage'], 'filename', '300x180');
                                                    $storage = end($thumbnail);
                                                ?>
                                                    <img class="media-object img-rounded img-responsive"  src="<?php echo base_url() . $storage['upload_path'] . $storage['new_image'] ?>" alt="" >
                                                </figure>
                                            </div>
                                            <div class="col-md-6">
                                                <form id="frm-reg">
                                                    <h4 class="list-group-item-heading"> <b>ชื่อโครงการ</b> <?= $course['name'] ?> </h4>
                                                    <p class="list-group-item-text"> <b>รหัสโครงการ</b> <?= $course['id'] ?> </p>
                                                    <p class="list-group-item-text"><b>สถานที่/วันที่</b></p>
                                                    <select class="selectpicker" id="course_location_id" name="course_location_id">
                                                        <?php foreach ($course['location'] as $key => $local) : ?>
                                                            <option value="<?= $local['id'] ?>"><?= $local['name'] . ' วันที่ ' . DateThai($local['course_date']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <p class="list-group-item-text"><b>ราคา</b> <?= $course['price'] ?></p>

                                                    <input type="hidden" name="member_id" value="<?php
                                                    if (isset($profile['id'])) {
                                                        echo $profile['id'];
                                                    }
                                                    ?>">
                                                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                                </form>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <button id="cancel-step-1" class="btn btn-default btn-lg btn-block">ยกเลิก</button> 
                                                <button id="activate-step-2" class="btn btn-primary btn-lg btn-block">สมัครโครงการ</button>

                                            </div>
                                        </li>
                                        <?php break; endforeach; ?>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-2">
                    <div class="col-xs-12">                        
                        <div class="col-md-12 well">
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
                                                            <tr>
                                                                <td>
                                                                    <input type="hidden" name="applicants[0][nickname]" value="<?= $profile['nickname'] ?>">
                                                                    <input type="hidden" name="applicants[0][last_name]" value="<?= $profile['last_name'] ?>">
                                                                    <input type="hidden" name="applicants[0][identification]" value="<?= $profile['identification'] ?>">
                                                                    <input type="hidden" name="applicants[0][first_name]" value="<?= $profile['first_name'] ?>">
                                                                    <input type="hidden" name="applicants[0][contact_no]" value="<?= $profile['contact_no'] ?>">
                                                                    <input type="hidden" name="applicants[0][price]" class="inputprice">
                                                                    #
                                                                </td>
                                                                <td><?= $profile['first_name'] ?>  <?= $profile['last_name'] ?></td>
                                                                <td><?= $profile['nickname'] ?></td>
                                                                <td><span class="price"><?= number_format($course['price'],2); ?></span></td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="3">ส่วนลด</th>
                                                                <td><?= $course['discount_exclusive']?></td>
                                                                <td>บาท</td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="3">
                                                                    <input type="hidden" name="balance" id="inputbalance" value="<?=$course['price']-$course['discount_exclusive']?>">
                                                                    <input type="hidden" name="discount" id="inputdiscount" value="<?= $course['discount_exclusive']?>">ค่าสมัครสุทธิ</th>
                                                                <td><span class="sumprice"><?= number_format($course['price']-$course['discount_exclusive'],2);?></span></td>
                                                                <td>บาท</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </form>
                                                <?php if($course['course_type']==true): ?>
                                                <button id="btn-add-people" class="btn btn-primary"><i class="fa fa-user-plus"></i> เพิ่มเพื่อน</button>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>                                
                                <div class="col-md-4">
                                    <div class="row">
                                        <i class="fa fa-bullhorn fa-3x fa-pull-left fa-border text-danger" aria-hidden="true"></i><p class="promotion">
                                            <?php if($course['course_type']==1): ?>
                                            สมัคร <?= $course['person'] ?> คนขึ้นไป จ่ายเพียงคนละ <?= $course['discount'] ?> บาท</p><br>
                                            <?php else: ?>
                                            สมัครวันนี้ ลดทันที <?= $course['discount_exclusive'] ?> บาท </p><br>
                                            <?php endif; ?>
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
                                                                <td class="text-left"><?php echo $course['name'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-left">สถานที่</th>
                                                                <td class="text-left"><span class="location"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-left">วันที่</th>
                                                                <td class="text-left"><span class="date_tut"></span></td>
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
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <button id="activate-step-3" class="btn btn-primary">ยืนยันการสมัคร</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-3">
                    <div class="col-xs-12">
                        <div class="col-md-12 well">
                            <h1 class="text-center">สมัครโครงการเสร็จสมบูรณ์</h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">โครงการ</th>
                                                    <td class="text-left"><?php echo $course['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">สถานที่</th>
                                                    <td class="text-left"><span class="location"></span></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">ค่าสมัครสุทธิ</th>
                                                    <td class="text-left"><span class="sumprice"><?= number_format($course['price']-$course['discount_exclusive'],2);?></span></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
    <?php echo anchor('payin/', '<i class="fa fa-print fa-4x  fa-2x fa-lg"></i> <span style="color: #fff;font-size: 30px;">พิมพ์ใบชำระเงิน</span>', 'class="btn btn-block btn-success" target="_blank" id="btn-print"') ?>
                                </div>
                                <div class="col-md-6">
                                    <h4>ช่องทางการชำระค่าสมัคร</h4>
                                    <!--<img height="70" src="<?php echo base_url('img/counterservice-7-11.png'); ?>"> <img height="70" src="<?php echo base_url('img/KTB Logo.jpg'); ?>">-->
                                    <div class="row">
                                        <div class="col-md-10 text-center"><h3>ชื่อบัญชี : นางอัจฉราภรณ์ คงเพชร</h3></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><img width="70" src="<?php echo base_url('img/KTB.jpg'); ?>"></div>
                                        <div class="col-md-10"><h2>984-0-30425-9</h2></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-2"><img width="70" src="<?php echo base_url('img/logo_scb.png'); ?>"></div>
                                        <div class="col-md-10"><h2>964-2-00100-0</h2></div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php else: ?>
        <?php endif; ?>
        </section>
        <?php endif; ?>
<?php if ($application): ?>
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <blockquote>
                        <h2>รายการสมัครแล้ว</h2>
                    </blockquote>
                    <div class="list-group">
                                <?php foreach ($application as $key => $value) : ?>
                        <a href="<?= base_url('app') . '/' . $value['id'] ?>" class="list-group-item well">
                            <div class="media">
							<?php 						
								$thumbnail = search($value['course']['storage'], 'filename', '300x180');
								$storage = end($thumbnail);
							?>
                                <?php if ($value['application_flow_id'] == 1): ?>
                                    <span class="label label-danger pull-right"><?= ($value['flow']) ? $value['flow']['name'] : '' ?></span>                            
                                <?php elseif ($value['application_flow_id'] == 3): ?>
                                    <span class="label label-success pull-right"><?= ($value['flow']) ? $value['flow']['name'] : '' ?></span>                            
                                <?php endif; ?>
                                <div class="pull-left">
                                    <img class="media-object" src="<?= base_url() . $storage['upload_path'] . $storage['new_image'] ?>" alt="Image">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $value['course']['name'] ?></h4>
                                    <p>วันที่ <?php echo DateThai($value['location']['course_date']) ?></p>
                                    <p>สถานที่ <?= $value['location']['name'] ?></p>
                                </div>
                            </div>	
                        </a>
<?php endforeach; ?>
                    </div>   
                </div>
            </div>
        </section>
        <?php endif; ?>
<?php else: ?>
            <section class="container text-center">
                <blockquote>
                    <h2>ยังไม่มีรายการสมัคร</h2>
                </blockquote>
            </section>
        <?php endif; ?>
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <blockquote class="text-center">หมายเหตุ : หากมีข้อสงสัย ข้อผิดพลาดในการสมัคร ติดต่อสอบถามได้ที่ โทร. 091-8656125 หรือโทร สอบถามพี่ทีมงาน</blockquote>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
            <?php if($cart): ?>
            <?php if($course['course_type']==1): ?>
            $("#btn-add-people").click(function () {
                $("#frm-add-people input").val('');
                $("#md-add-people").modal('show')
            });
            var row = $("#tb-people tbody tr").length;
            $('#btn-plus-people').click(function () {
                var $form = $("#frm-add-people");
                if ($form.parsley().validate()) {
                    $('#tb-people tbody tr:last').after('<tr id="' + row + '"><input type="hidden" name="applicants[' + row + '][price]" class="inputprice" value="<?= $course['price'] ?>"><input type="hidden" name="applicants[' + row + '][nickname]" value="' + $("#peopleNikname").val() + '"><input type="hidden" name="applicants[' + row + '][last_name]" value="' + $("#peopleLastname").val() + '"><input type="hidden" name="applicants[' + row + '][first_name]" value="' + $("#peopleFirstname").val() + '"><input type="hidden" name="applicants[' + row + '][identification]" value="' + $("#peopleIdentification").val() + '"><td>#</td><td>' + $("#peopleFirstname").val() + ' ' + $("#peopleLastname").val() + '</td><td>' + $("#peopleNikname").val() + '</td><td><span class="price"><?= $course['price'] ?></span></td><td><button type="button" class="btn btn-danger btn-sm" onclick="delrow(' + row + ')"><i class="fa fa-trash-o"></i></button></td></tr>');
                    row++;
                    cul(row)
                    $("#md-add-people").modal('hide')
                }
            });
            function delrow(id)
            {
                $('table#tb-people tr#' + id).remove();
                cul(row)
            }

            function cul(row)
            {
                var p = <?= $course['person'] ?>;
                var discount = <?= $course['discount'] ?>;
                var price = <?= $course['price'] ?>;
                var exclusive = <?= $course['discount_exclusive'] ?>;
                if (row >= p) {
                    $(".price").text(discount);
                    $(".inputprice").val(discount)
                } else {
                    $(".price").text(price);
                    $(".inputprice").val(price)
                }
                var sumprice = 0;
                $('.price').each(function () {
                    console.log($(this).text())
                    sumprice += parseFloat($(this).text());
                });
                var balance = sumprice - (sumprice * exclusive);
                console.log(sumprice)
                $(".sumprice").text(balance)
                $("#inputdiscount").val(sumprice * exclusive)
                $("#inputbalance").val(balance)

            }
            $(function ()
            {
                cul(row)
            });
            <?php endif; ?>
            <?php endif; ?>
            $(document).ready(function () {
                <?php if($this->session->flashdata('msg')): ?>
                     
                    $('#md-error h5').text('Error!! <?php echo $this->session->flashdata('msg'); ?>');
                    $('#md-error').modal('show');
                <?php endif; ?>
                var navListItems = $('ul.setup-panel li a'),
                        allWells = $('.setup-content');

                allWells.hide();

                navListItems.click(function (e)
                {
                    e.preventDefault();
                    var $target = $($(this).attr('href')),
                            $item = $(this).closest('li');

                    if (!$item.hasClass('disabled')) {
                        navListItems.closest('li').removeClass('active');
                        $item.addClass('active');
                        allWells.hide();
                        $target.show();
                    }
                });

                $('ul.setup-panel li.active a').trigger('click');

                // DEMO ONLY //
                var $form;
                $('#activate-step-2').on('click', function (e) {
                    $form = $("#frm-reg").serializeArray();
                    if (login) {
                        //cul(row)
                        var sear = $("#course_location_id").find("option:selected").text().search("วันที่");
                        var res = $("#course_location_id").find("option:selected").text().substring(sear);
                        var w = res.substring(7);
                        var location = $("#course_location_id").find("option:selected").text().substring(sear, 0);
                        $(".location").text(location)
                        $(".date_tut").text(w)
                        $('ul.setup-panel li:eq(1)').removeClass('disabled');
                        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
//                        ajaxRequest("<?php echo base_url('api/application'); ?>", $form.serializeArray(), "POST")
//                                .done(function (r) {
//                                    if (r.result == true) {
//                                        $('<input>').attr({type: 'hidden',id:'application_id',name: 'id',value:r.data.application_id}).appendTo('#frm-reg');
//                                        
//                                    }
//                                }).fail(function (r) {
//                            $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
//                            $('#md-error').modal('show');
//                        });
                    } else {
                        $("#md-login").modal('show')
                    }
                })
                $('#cancel-step-1').on('click', function (e) {
                    ajaxRequest("<?php echo base_url('App/cart_remove'); ?>", null, "POST")
                            .done(function (r) {
                                if (r.result == true) {
                                    window.location.href = "<?php echo base_url('app'); ?>";
                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });
                })
                $('#cancel-step-2').on('click', function (e) {
                    $('ul.setup-panel li a[href="#step-1"]').trigger('click');
                })
                $('#activate-step-3').on('click', function (e) {
                    $(this).remove();
                    $.each($("#frm-people").serializeArray(), function (index, value) {
                        $form.push(value)
                    });
                    ajaxRequest("<?php echo base_url('api/application'); ?>", $form, "POST")
                            .done(function (r) {
                                if (r.result == true) {

                                    $("#btn-print").attr('href', '<?php echo base_url('payin'); ?>/' + r.data.application_id)
                                    $('<input>').attr({type: 'hidden', id: 'application_id', name: 'id', value: r.data.application_id}).appendTo('#frm-reg');

                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });

                    $('ul.setup-panel li:eq(2)').removeClass('disabled');
                    $('ul.setup-panel li a[href="#step-3"]').trigger('click');
                })
            });
        </script>
    </body>
</html>