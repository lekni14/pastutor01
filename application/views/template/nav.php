<nav class="navbar navbar-default head-border">
    <div class="container">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div id="wrap_logo">
                    <a href="#">
                        <img src="<?php echo base_url('img/logo.png'); ?>">
                    </a>
                </div>  
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                                                                            
                <!--<div class="ribbon  ribbon--blue">เข้าสู่ระบบ</div>-->                           
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.pastutor.com/" target="_blank">หน้าแรก</a></li> 
                    <li><?php echo anchor('course','คอร์สเรียนทั้งหมด'); ?></li> 
                    <li><?php echo anchor('app','รายการสมัครเรียน'); ?></li> 
                    <?php if($this->session->has_userdata('login')){ $session = $this->session->userdata('login') ?>
                    <li><?php echo anchor('member/'.$session['id'],$session['first_name'].' '.$session['last_name']); ?></li>
                    <li class="last"><?php echo anchor('logout','ออกจากระบบ','id="logout"'); ?></li>
                    <?php }else{ ?>
                    <li class="last"><a href="#" class="login" data-toggle="modal">เข้าสู่ระบบ</a></li> 
                    <?php } ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
</nav>
