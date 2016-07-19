<?php
$lia1 = '';
$lia2 = '';
$lia3 = '';
$lia4 = '';
$lia5 = '';
$li1 = '';
$li2 = '';
$li3 = '';
$li4 = '';
$li5 = '';
$li6 = '';
$li7 = '';
$a1 = 'class="accordion-toggle"';
$a2 = 'class="accordion-toggle"';
$a3 = 'class="accordion-toggle"';
$ul1 = 'class="collapse"';
$ul2 = 'class="collapse"';
$ul3 = 'class="collapse"';
$ul4 = 'class="collapse"';
$path = explode("/", current_url());
//print_r($path);
if (empty($path[4])) {
    $lia5 = 'active';
} else {
    switch ($path[4]) {
        case 'course':
            $lia1 = 'active';
            $a1 = 'class="accordion-toggle"';
            $ul1 = 'class="in"';
            $li1 = 'class="active"';
            break;
        case 'payment':
            $lia2 = 'active';
            $a2 = 'class="accordion-toggle"';
            $ul2 = 'class="in"';
            $li2 = 'class="active"';
            break;
        case 'no-payment':
            $lia2 = 'active';
            $a2 = 'class="accordion-toggle"';
            $ul2 = 'class="in"';
            $li3 = 'class="active"';
            break;
        case 'member':
            $lia3 = 'active';
            $a3 = 'class="accordion-toggle"';
            $ul3 = 'class="in"';
            $li4 = 'class="active"';
            break;
        case 'marketing':
            $lia4 = 'active';
            $a4 = 'class="accordion-toggle"';
            $ul4 = 'class="in"';
            $li5 = 'class="active"';
            break;
        case 'application':
            $lia1 = 'active';
            $a1 = 'class="accordion-toggle"';
            $ul1 = 'class="in"';
            $li6 = 'class="active"';
            break;
        case 'admin':
            $lia3 = 'active';
            $a3 = 'class="accordion-toggle"';
            $ul3 = 'class="in"';
            $li7 = 'class="active"';
            break;
        
    }
}
$session = $this->session->userdata('admin');
?>
<div id="left" >
    <div class="media user-media well-small">
    <div class="profile-userpic">
        <img src="<?php echo base_url('img/default-thumb.gif'); ?>" class="img-responsive" alt="">
    </div>
    <!-- END SIDEBAR USERPIC -->
    <!-- SIDEBAR USER TITLE -->
    <div class="profile-usertitle">
        <div class="profile-usertitle-name">
            <?= $session['first_name'] ?> <?= $session['last_name'] ?>
        </div>
        <div class="profile-usertitle-job">
            <?= $session['permission']['name'] ?> 
        </div>
    </div>
    <!-- END SIDEBAR USER TITLE -->
    <!-- SIDEBAR BUTTONS -->
    <div class="profile-userbuttons">
        <a href="<?php echo base_url('administrator/profile/edit'); ?>" class="btn btn-success btn-sm"><i class="icon-edit"></i> แก้โปรไฟล์</a>
    </div>
    </div>
    <ul id="menu" class="collapse">
        <?php if($session['permission_id']==2): ?>
        <li class="panel  <?= $lia3 ?>">
             <?php echo anchor('administrator/member', '<i class="fa fa-users"> </i> สมาชิก '); ?>                  
        </li>
        <li class="panel  <?= $lia1 ?>">
            <?php echo anchor('administrator/application', '<i class="icon-file-alt"></i> ผู้สมัครคอร์ส-โครงการ '); ?>                  
        </li>
        <li class="panel  <?= $lia4 ?>">
            <?php echo anchor('administrator/marketing', '<i class="icon-bullhorn"></i> ผลงานการตลาด '); ?>                  
        </li>
        <?php else: ?>                
        <li class="panel  <?= $lia5 ?>">
            <?php echo anchor('administrator', '<i class="icon-table"></i>  Dashboard'); ?>                 
        </li>    
        <li class="panel <?= $lia3 ?>">            
            <a href="#" data-parent="#menu" data-toggle="collapse" <?= $a1 ?> data-target="#member-nav">
                <i class="fa fa-users"> </i>สมาชิก
                <span class="pull-right">
                    <i class="icon-angle-left"></i>
                </span>
            </a>
            <ul <?= $ul3 ?> id="member-nav">
                <li <?= $li4 ?>>   
                    <?php echo anchor('administrator/member', '<i class="icon-angle-right"></i> รายชื่อสมาชิก '); ?>                    
                </li>
                <li <?= $li7 ?>>   
                    <?php echo anchor('administrator/admin', '<i class="icon-angle-right"></i> รายชื่อทีมงาน '); ?>                    
                </li>
            </ul>
        </li>
        <li class="panel <?= $lia1 ?>">            
            <a href="#" data-parent="#menu" data-toggle="collapse" <?= $a1 ?> data-target="#course-nav">
                <i class="icon-file-alt"> </i>คอร์ส-โครงการ 
                <span class="pull-right">
                    <i class="icon-angle-left"></i>
                </span>
            </a>
            <ul <?= $ul1 ?> id="course-nav">
                <li <?= $li1 ?>>   
                    <?php echo anchor('administrator/course', '<i class="icon-angle-right"></i> รายการคอร์ส-โครงการ '); ?>                    
                </li>                           
                <li <?= $li6 ?>>   
                    <?php echo anchor('administrator/application', '<i class="icon-angle-right"></i> ผู้สมัครคอร์ส-โครงการ '); ?>                    
                </li>                           
            </ul>
        </li>
        <li class="panel <?= $lia2 ?>">
            <a href="#" data-parent="#menu" data-toggle="collapse" <?= $a1 ?> data-target="#payment-nav">
                <i class="icon-money"> </i>ระบบชำระเงิน 
                <span class="pull-right">
                    <i class="icon-angle-left"></i>
                </span>
            </a>
            <ul <?= $ul2 ?> id="payment-nav">
                <li <?= $li2 ?>>   
                    <?php echo anchor('administrator/payment', '<i class="icon-angle-right"></i> ชำระเงินแล้ว'); ?>                    
                </li>   
                <li <?= $li3 ?>>   
            <?php echo anchor('administrator/no-payment', '<i class="icon-angle-right"></i> ยังไม่ชำระเงินแล้ว'); ?>                    
                </li>   
            </ul>
        </li>
        <li class="panel <?= $lia4 ?>">
            <a href="#" data-parent="#menu" data-toggle="collapse" <?= $a1 ?> data-target="#payment-marketing">
                <i class="icon-bullhorn"> </i>การตลาด
                <span class="pull-right">
                    <i class="icon-angle-left"></i>
                </span>
            </a>
            <ul <?= $ul4 ?> id="payment-marketing">
                <li <?= $li5 ?>>   
                    <?php echo anchor('administrator/marketing', '<i class="icon-angle-right"></i> ผู้สมัครคอร์ส-โครงการ '); ?>                    
                </li>                             
            </ul>
        </li>
        <?php endif; ?>
        <li class="panel">
            <?php echo anchor('admin/Administrator/logout', '<i class="icon-signout"></i>  ออกจากระบบ'); ?> 
        </li>
        
    </ul>
</div>