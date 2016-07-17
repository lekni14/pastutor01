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
        <section class="container">
            <div class="row">     
                <div class="list-group">
                    <?php if($application): foreach ($application as $key => $value) :?>
                    <a href="<?= base_url('app').'/'.$value['id']?>" class="list-group-item well">
                        <div class="media">
                            <?php if($value['application_flow_id']==1): ?>
                            <span class="label label-danger pull-right"><?= ($value['flow'])? $value['flow']['name']:'' ?></span>                            
                            <?php elseif($value['application_flow_id']==3): ?>
                            <span class="label label-success pull-right"><?= ($value['flow'])? $value['flow']['name']:'' ?></span>                            
                            <?php endif; ?>
                            <div class="pull-left">
                                <img class="media-object" src="<?= base_url().$value['course']['storage'][0]['upload_path'] . $value['course']['storage'][0]['filename'] ?>" alt="Image">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $value['course']['name']?></h4>
                                <p>วันที่ <?php echo DateThai($value['location']['course_date'])?></p>
                                <p>สถานที่ <?= $value['location']['name']?></p>
                            </div>
                        </div>	
                    </a>
                    <?php endforeach; else: ?>
                        <div class="row form-group">
                            <div class="col-xs-12 text-center well">
                                <h1>ยังไม่มีรายการสมัคร</h1>
                            </div>
                        </div>
                    <?php endif; ?>
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
            $(document).ready(function () {

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
                $('#activate-step-2').on('click', function (e) {
                    $('ul.setup-panel li:eq(1)').removeClass('disabled');
                    $('ul.setup-panel li a[href="#step-2"]').trigger('click');
                    $(this).remove();
                })
            });

        </script>
    </body>
</html>
