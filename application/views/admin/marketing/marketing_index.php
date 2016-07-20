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
                            <h2>  คอร์ส-โครงการ  </h2>
                        </div>
                    </div>
                    <hr />
                    <?php echo $this->breadcrumbs->show(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-file-alt"></i></div>
                                    <h5>คอร์ส-โครงการ </h5>
                                </header>                            
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th class="center">#</th>
                                                    <th> คอร์ส-โครงการ </th>
                                                    <th>สถานที่</th>
                                                    <th>วันที่</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php $row=0; if($course): foreach ($course as $key =>$value): ?>
                                                <tr>
                                                    <td><?=++$row?></td>
                                                    <td><?=$value['course']['name']?></td>
                                                    <td><?=$value['name']?></td>
                                                    <td><?=  DateThai($value['course_date'])?></td>
                                                    <td>
                                                        <?php echo anchor('administrator/marketing/detail/'.$value['id'],'<i class="icon-list icon-white"></i>','class="btn btn-success"'); ?>
                                                    </td>
                                                </tr>
                                                <?php endforeach; endif; ?>
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
                    responsive: true
                });
            });
        </script>


    </body>

    <!-- END BODY -->
</html>
