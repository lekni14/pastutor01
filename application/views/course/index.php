<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('template/css'); ?>    
	<?php $this->load->view('admin/template/phpfunction'); ?> 
    <body>
        <?php $this->load->view('template/nav'); ?>  
        <?php // $this->load->view('template/header'); ?>      
        <?php $this->load->view('template/ThaiDate'); ?> 
        <section class="head-page">
            <div class="container text-right">
                <h1 class="title-page">คอร์ส-โครงการ</h1>
            </div>
        </section>
        <section class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <blockquote>
                        <h2>รวมคอร์สเรียนทั้งหมด</h2>
                    </blockquote>                    
                </div>
            </div>
        </section>
        <section class="container">
            <div id="products" class="row list-group">
                <?php if($course): foreach ($course as $key => $value) { ?>
                    <?php if(strtotime(date('Y-m-d'))<strtotime($this->Mcourse_location->get_course_end_date_by_course($value['id']))):  ?>
                <div class="item col-xs-12 col-sm-6 col-md-4">
                    <div class="thumbnail">
					<?php 						
						$thumbnail = search($value['storage'], 'filename', '300x180');
						$storage = end($thumbnail);
					?>
                        <?php echo anchor('course/'.$value['id'],'<img class="group list-group-image" src="'.base_url().$storage['upload_path'].$storage['new_image'].'" alt="" />'); ?>                        
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading"><?=$value['name']?></h4>
                            <p class="group inner list-group-item-text">
                                <strong>รายละเอียด</strong> <?=$value['detail']?>                                
                            </p>
                            <?php foreach ($value['location'] as $key => $local) {
                                        echo '<p>วันที่ '.DateThai($local['course_date']).' '.$local['name'].'</p>';
                                    } ?>
                            <p class="sub-title"></p>
                            <div class="row">                                
                                <div class="col-md-12">
                                    <form id="frm-cart-reg">
                                        <input type="hidden" name="id" value="<?=$value['id']?>">
                                        <input type="hidden" name="name" value="<?=$value['name']?>">
                                        <input type="hidden" name="price" value="<?=$value['price']?>">
                                        <button class="btn btn-success btn-block btn-regitertion" id="">สมัครโครงการ</button>
                                    </form>                                    
                                    <?php // echo anchor('course/'.$value['id'],'สมัครโครงการ','class="btn btn-success btn-block"'); ?>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div> 
                <?php endif; ?>
                <?php }endif; ?>                
                
            </div>
        </section>
        
        <!-- Modal -->
        <?php $this->load->view('template/modal'); ?>                             
        <!-- /Modal -->
        <?php $this->load->view('template/javascript'); ?>
        <script>
            // A $( document ).ready() block.
            $( document ).ready(function() {
                <?php if($this->session->has_userdata('login')){ if($application){?>
                    var url = "<?php echo base_url('modal/application'); ?>";
                    $("#md-alert-course .modal-body").load(url);
                    $("#md-alert-course").modal('show')
                <?php } } ?>   
            });
            $('.btn-regitertion').click (function (e) {     
                e.preventDefault()
                var $form = $(this).closest("form");
                console.log($form.serializeArray())
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