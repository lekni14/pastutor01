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
            <!--END MENU SECTION -->
            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>  สมาชิก  </h2>
                        </div>
                    </div>
                    <hr />
                    <?php echo $this->breadcrumbs->show(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-user"></i></div>
                                    <h5>รายละเอียดสมาชิก </h5>
                                </header>                            
                                <div class="body profile">
                                    <div class="row">
                                        <div class="col-md-offset-1 col-md-8 col-lg-offset-2 col-lg-8">
                                            <div class="profile">
                                                <div class="col-sm-12">
                                                    <div class="col-xs-12 col-sm-8">
                                                        <h2><?php if($member['title']==1):$title='นางสาว';else: $title='นาย';endif; echo $title.$member['first_name'].' '.$member['last_name']; ?>(<?php echo $member['nickname']; ?>)</h2>
                                                        <div class="media custom-media">
                                                            <div class="media-left">
                                                                <a href="#">
                                                                    <strong><i class="fa fa-mobile-phone fa-2x" aria-hidden="true"></i></strong>
                                                                </a>
                                                            </div>
                                                            <div class="media-body custom-body">
                                                                <p class="media-heading"><?=$member['contact_no']?></p>
                                                            </div>
                                                        </div>
                                                        <div class="media custom-media">
                                                            <div class="media-left">
                                                                <a href="#">
                                                                    <strong><i class="fa fa-envelope" aria-hidden="true"></i></strong>
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <p class="media-heading"><?=$member['email_address']?></p>
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
                                                                <p class="media-heading">โรงเรียน<?=$member['school']['school_name']?> จังหวัด<?=$member['school']['province']['PROVINCE_NAME']?> ชั้น <?=$member['classroom']?></p>
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
                                                                <p class="media-heading"><strong>บ้านเลขที่</strong> <?=$member['address']['hno']?> <strong>หมู่</strong> <?=$member['address']['mno']?> <strong>ตรอก/ซอย</strong> <?=$member['address']['lane']?> <strong>ถนน</strong> <?=$member['address']['road']?> <strong>ตำบล</strong> <?=$member['address']['sub_district']['DISTRICT_NAME']?> <strong>อำเภอ</strong> <?=$member['address']['district']['AMPHUR_NAME']?> <strong>จังหวัด</strong> <?=$member['address']['province']['PROVINCE_NAME']?> <strong>รหัสไปรษณีย์</strong> <?=$member['address']['postcode']?></p>
                                                            </div>
                                                        </div>
                                                    </div>             
                                                    <div class="col-xs-12 col-sm-4 text-center">
                                                        <figure>                                    
                                                            <?php if($member['storage']){ $storage = end($member['storage']);}else{ $storage='';} ?>
                                                            <img src="<?= ($storage) ? base_url($storage['upload_path'].$storage['new_image']) : base_url('img/default-thumb.gif') ?>" alt="" class="img-circle img-responsive">
                                                            <figcaption class="ratings">
                                                                <p>ระดับสมาชิก
                                                                    <?php 
                                                if($member['levelID']==0){
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                }elseif($member['levelID']==1){
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                    echo '<a href="#"><span class="fa fa-star-o"></span></a>';
                                                }elseif ($member['levelID']==2) {
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
                                                                </p>
                                                            </figcaption>                                                            
                                                        </figure>
                                                    </div>
                                                </div>     
                                            </div>                 
                                        </div>           
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

        <!--END MAIN WRAPPER -->

        <?php $this->load->view('admin/template/modals') ?>
        <!-- FOOTER -->
        <?php $this->load->view('admin/template/footer') ?>
        <!--END FOOTER -->


        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('admin/template/javascript') ?>
        <!-- END PAGE LEVEL SCRIPTS --> 

    </body>

    <!-- END BODY -->
</html>
