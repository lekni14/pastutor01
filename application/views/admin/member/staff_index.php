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
                            <h2>  ทีมงาน  </h2>
                        </div>
                    </div>
                    <hr />
                    <?php echo $this->breadcrumbs->show(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-user"></i></div>
                                    <h5>รายชื่อทีมงาน </h5>
                                </header>                            
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php // echo anchor('administrator/course/create', '<i class="icon-upload"></i>  อัพเกรดสมาชิก', 'class="btn btn-success"'); ?>                                            
                                        </div>                                        
                                    </div> <br> 
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th class="center">#</th>
                                                    <th>ชื่อ</th>
                                                    <th>นามสกุล</th>
                                                    <th>อีเมล</th>
                                                    <th>ระดับ</th>
                                                    <th>active</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php if ($admin): foreach ($admin as $key => $value): ?>
                                                        <tr>
                                                            <td><?= ++$key ?></td>
                                                            <td><?= $value['first_name'] ?></td>
                                                            <td><?= $value['last_name'] ?></td>
                                                            <td><?= $value['email'] ?></td>
                                                            <td><?= $value['permission']['name'] ?></td>
                                                            <td><?=($value['active']=='1')?'<i class="fa fa-check"></i>':''?></td>
                                                            <td>
                                                                <?php echo anchor('administrator/admin/edit/'.$value['id'],'<i class="icon-pencil icon-white"></i>','class="btn btn-primary"'); ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;
                                                endif; ?>
                                            </tbody>
                                        </table>
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
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable({
                    dom: 'Bfrtip',
                    buttons: [
                            { text: '<i class="icon-plus"></i> เพิ่มทีมงาน',className:'btn btn-success',action: function ( e, dt, node, config ) {
                                    window.location.replace("<?php echo base_url('administrator/admin/create'); ?>");
                                }
                            }
                        ]
                });
            });
        </script>


    </body>

    <!-- END BODY -->
</html>
