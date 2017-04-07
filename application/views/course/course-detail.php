<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('template/css'); ?>    
    <body>
        <?php $this->load->view('template/nav'); ?>  
        <?php $this->load->view('admin/template/phpfunction'); ?> 
        <section class="head-page">
            <div class="container text-right">
                <h1 class="title-page">โครงการ</h1>
            </div>
        </section>
        <section class="container regitertion-content">
            <div class="row form-group">
                <div class="col-xs-12">
                    <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                        <li class="active">
                            <a href="#step-1">
                                <h4 class="list-group-item-heading">โครงการ </h4>
                                <p class="list-group-item-text">รายละเอียดโครงการ <?php echo $course['name']; ?></p>
                            </a></li>
                        <li>
                            <a id="btn-regitertion" href="#step-2">
                                <h4 class="list-group-item-heading">สมัครโครงการ</h4>
                                <p class="list-group-item-text"><?php echo $course['name']; ?></p>
                            </a></li>
                        <!--                        <li class="disabled">
                                                    <a href="#step-3">
                                                        <h4 class="list-group-item-heading">Step 3</h4>
                                                        <p class="list-group-item-text">สมัครโครงการเสร็จสมบูรณ์</p>
                                                    </a>
                                                </li>-->
                    </ul>
                </div>
            </div>
            <div class="row setup-content" id="step-1">
                <div class="col-md-12 course-left">
                    <?php 
                    $path ='';
                        $large = search($course['storage'], 'filename', 'large');
						$storage = end($large);
                        if ($large) {
                           $path = $storage['upload_path'].$storage['new_image'];
                        } 
                        
                    ?>
                    <img src="<?php echo base_url($path); ?>">
                    <form id="frm-cart-reg">
                        <input type="hidden" name="id" value="<?= $course['id'] ?>">
                        <input type="hidden" name="name" value="<?= $course['name'] ?>">
                        <input type="hidden" name="price" value="<?= $course['price'] ?>">
                    </form>
                </div>
            </div>
        </section>
<!--        <section class="container">
            <div class="row">
                <div class="col-md-8  course-left">
                    <img src="<?php echo base_url('img/tetek_print_Page_1.jpg'); ?>">
                </div>
                <div class="col-md-4 course-right well ">
                    <div class="row">
                        <div class="col-xs-12 course-content">
                            <h2 class="sub-title"><?php echo $course['name']; ?></h2>
                            <h3>รายละเอียด</h3>
                            <p><?php echo $course['detail']; ?></p>
                            <p><strong>วันที่</strong> วันที่ 25-26 มิ.ย. 59 เวลา 08.30-16.00 น.</p>
                            <p><strong>สถานที่</strong> ณ หอประชุมใหญ่ ม.ภาคฯ จ.ขอนแก่น</p>
                            <p><strong>ราคา</strong> 300฿</p>
                        </div>
                        <button type="button" class="btn btn-primary btn-block">สมัครโครงการ</button>
                        <div class="btn-group" role="group" aria-label="...">
                            
                            <button type="button" class="btn btn-primary"><i class="fa fa-play-circle fa-lg" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-primary">Right</button>
                        </div>
                    </div>

                </div>
            </div>

        </section>-->
        <!-- Modal -->
        <?php $this->load->view('template/modal'); ?>                             
        <!-- /Modal -->
        <?php $this->load->view('template/javascript'); ?>
        <script>
            $('#btn-regitertion').click (function (e) {
                e.preventDefault();
                var $form = $("#frm-cart-reg");
                //if ( $form.parsley().validate() ){
                    ajaxRequest("<?php echo base_url('app'); ?>",$form.serializeArray(),"POST")
                    .done(function(r) {
                        if(r.result==true){
                            window.location.href = "<?php echo base_url('app'); ?>";
                        }else{
                            window.location.href = "<?php echo base_url('app'); ?>";
                        }
                    }).fail(function(r) {
                           $('#md-error h5' ).text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                           $('#md-error').modal('show');
                    });
                //}
            });
            

        </script>
    </body>
</html>