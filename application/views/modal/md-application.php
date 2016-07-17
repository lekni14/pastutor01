<?php $this->load->view('template/ThaiDate'); ?> 
<div class="list-group">
    <?php if($application): foreach ($application as $key => $value) :?>
    <li href="#" class="list-group-item">
        <div class="media">
            <?php if($value['application_flow_id']==1):?>
            <a href="<?= base_url('payin').'/'.$value['id']?>" target="_blank" class="btn btn-success pull-right" >
                <i class="fa fa-print fa-2x fa-lg"></i> <span style="color: #fff;">พิมพ์ใบชำระเงิน</span>
            </a>
            <?php elseif(($value['application_flow_id']==3)||($value['application_flow_id']==7)):?>
            <a href="<?= base_url('app/application_print').'/'.$value['id']?>" target="_blank" class="btn btn-success pull-right" >
                <i class="fa fa-print fa-2x fa-lg"></i> <span style="color: #fff;">พิมพ์ใบลงทะเบียน</span>
            </a>
            <?php endif;?>
            <div class="pull-left">
                <img class="media-object" width="100" height="70" src="<?= base_url().$value['course']['storage'][0]['upload_path'] . $value['course']['storage'][0]['new_image'] ?>" alt="Image">
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $value['course']['name']?></h4>
<!--                <p>วันที่ <?php echo DateThai($value['location']['course_date'])?></p>
                <p>สถานที่ <?= $value['location']['name']?></p>-->
                <?php if($value['application_flow_id']==1):?>
                <p class="label label-danger"><?= $value['flow']['name']?></p>
                <?php elseif(($value['application_flow_id']==3)||($value['application_flow_id']==7)):?>
                <p class="label label-success"><?= $value['flow']['name']?></p>
                <?php endif;?>
            </div>
        </div>	
    </li>
    <?php endforeach; endif; ?>    				
</div>