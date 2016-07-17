<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('template/css'); ?>    
    <body>
        <?php $this->load->view('template/nav'); ?>  
        <section class="head-page">
            <div class="container text-right">
                <h1 class="title-page">ประวัติส่วนตัว</h1>
            </div>
        </section>
        <section class="container profile">
            <div class="row">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-8">
                    <div class="well profile">
                        <div class="col-sm-12">
                            <div class="col-xs-12 col-sm-8">
                                <h2><?php if($profile['title']==1):$title='นางสาว';else: $title='นาย';endif; echo $title.$profile['first_name'].' '.$profile['last_name']; ?>(<?php echo $profile['nickname']; ?>)</h2>
                                <div class="media custom-media">
                                    <div class="media-left">
                                      <a href="#">
                                        <strong><i class="fa fa-mobile-phone fa-2x" aria-hidden="true"></i></strong>
                                      </a>
                                    </div>
                                    <div class="media-body custom-body">
                                      <p class="media-heading"><?=$profile['contact_no']?></p>
                                    </div>
                                </div>
                                <div class="media custom-media">
                                    <div class="media-left">
                                      <a href="#">
                                        <strong><i class="fa fa-envelope" aria-hidden="true"></i></strong>
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <p class="media-heading"><?=$profile['email_address']?></p>
                                    </div>
                                </div>
                                <h4 class="sub-title">โรงเรียน</h4>
                                <div class="media custom-media">
                                    <div class="media-left">
                                      <a href="#">
                                        <!--<strong><i class="fa fa-envelope" aria-hidden="true"></i></strong>-->
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <p class="media-heading">โรงเรียน<?=$profile['school']['school_name']?> จังหวัด<?=$profile['school']['province']['PROVINCE_NAME']?> ชั้น <?=$profile['classroom']?></p>
                                    </div>
                                </div>
                                <h4 class="sub-title">ที่อยู่</h4>
                                <div class="media custom-media">
                                    <div class="media-left">
                                      <a href="#">
                                        <!--<strong><i class="fa fa-envelope" aria-hidden="true"></i></strong>-->
                                      </a>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><strong>บ้านเลขที่</strong> <?=$profile['address']['hno']?> <strong>หมู่</strong> <?=$profile['address']['mno']?> <strong>ตรอก/ซอย</strong> <?=$profile['address']['lane']?> <strong>ถนน</strong> <?=$profile['address']['road']?> <strong>ตำบล</strong> <?=$profile['address']['sub_district']['DISTRICT_NAME']?> <strong>อำเภอ</strong> <?=$profile['address']['district']['AMPHUR_NAME']?> <strong>จังหวัด</strong> <?=$profile['address']['province']['PROVINCE_NAME']?> <strong>รหัสไปรษณีย์</strong> <?=$profile['address']['postcode']?></p>
                                    </div>
                                </div>
                            </div>             
                            <div class="col-xs-12 col-sm-4 text-center">
                                <figure><?php if($profile['storage']){ $storage = end($profile['storage']);}else{ $storage='';} ?>
                                    <img src="<?= ($storage) ? base_url($storage['upload_path'].$storage['new_image']) : base_url('img/default-thumb.gif') ?>" alt="" class="img-circle img-responsive">
                                    <figcaption class="ratings">
                                        <p>ระดับสมาชิก
                                            <?php 
                                                if($profile['levelID']==0){
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                }elseif($profile['levelID']==1){
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                }elseif ($profile['levelID']==2) {
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                }else{
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                }                                 
                                            ?>
                                            
<!--                                            <a href="#">
                                                <span class="fa fa-star"></span>
                                            </a>
                                            <a href="#">
                                                <span class="fa fa-star"></span>
                                            </a>
                                            <a href="#">
                                                <span class="fa fa-star"></span>
                                            </a>
                                            <a href="#">
                                                <span class="fa fa-star-o"></span>
                                            </a> -->
                                        </p>
                                    </figcaption>
                                    <figcaption>
                                        <?php echo anchor('member/edit/'.$profile['id'],'<i class="fa fa-pencil-square-o"></i> แก้ไขประวัติส่วนตัว','class="btn btn-primary btn-sm btn-block"'); ?>
                                        <!--<button class="btn btn-primary btn-sm btn-block"></button>-->
                                    </figcaption>
                                </figure>
                            </div>
                        </div>     
                    </div>                 
                </div>           
        </section>
        <!-- Modal -->
        <?php $this->load->view('template/modal'); ?>                             
        <!-- /Modal -->
        <?php $this->load->view('template/javascript'); ?>        
    </body>
</html>