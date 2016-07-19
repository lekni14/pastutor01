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
            <?php //$this->load->view('admin/template/navbar'); ?>
            <!-- END HEADER SECTION -->
            <!-- MENU SECTION -->
            <?php $this->load->view('admin/template/leftmenu'); ?>            
            <!--END MENU SECTION -->
            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height: 700px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1> Admin Dashboard </h1>
                        </div>
                    </div>
                    <hr />
                    <!--BLOCK SECTION -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?= $this->Mmember->count_all_by_course(); ?></div>
                                            <div>สมาชิกทั้งหมด</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('administrator/member') ?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="icon-file-alt fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?= $this->Mcourse->count_all_by_date(); ?>/<?= $this->Mcourse->count_all_by_all(); ?></div>
                                            <div>โครงการ-คอร์ส</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('administrator/application') ?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="icon-bullhorn fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">124</div>
                                            <div>การตลาด</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>                        
                    </div>
                    <!--END BLOCK SECTION -->
                    <hr />
                    <!-- CHART & CHAT  SECTION -->
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="box">
                                <header>
                                    <h5>Calendar</h5>
                                </header>
                                <div class="body">
                                    <div class="row">                                        
                                        <div id="calendar" class="col-lg-12"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--END CHAT & CHAT SECTION -->
                </div>

            </div>
            <!--END PAGE CONTENT -->

        </div>

        <!--END MAIN WRAPPER -->

        <!-- FOOTER -->
        <?php $this->load->view('admin/template/footer') ?>
        <!--END FOOTER -->


        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('admin/template/javascript') ?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
             var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                var hdr = {};

                if ($(window).width() <= 767) {
                    hdr = { left: 'title', center: '', right: 'prev,today,month,next' };
                } else {
                    hdr = { left: '', center: 'title', right: 'prev,today,month,next' };
                }
            $('#calendar').fullCalendar({
                header: hdr,
                buttonText: {
                    prev: '<i class="icon-chevron-left"></i>',
                    next: '<i class="icon-chevron-right"></i>'
                },
                events: <?php echo $events; ?>,
                windowResize: function (event, ui) {
                    $('#calendar').fullCalendar('render');
                }
            });
            
        </script>

    </body>

    <!-- END BODY -->
</html>
