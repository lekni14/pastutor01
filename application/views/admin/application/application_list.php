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
                            <h2>  คอร์ส-โครงการ</h2>
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
                                    <div>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">ผู้สมัครทั้งหมด</a></li>
                                            <li role="presentation"><a href="#payment" aria-controls="payment" role="tab" data-toggle="tab">ผู้สมัครยังไม่ชำระเงิน</a></li>
                                            <li role="presentation"><a href="#holders" aria-controls="holders" role="tab" data-toggle="tab">ผู้มีสิทธิ์เข้าร่วมโครงการ</a></li>                                            
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="all">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover display" id="dataTables-all" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th> รหัสใบสมัคร </th>
                                                                <th>ชื่อ - นามสกุล</th>
                                                                <th>เบอร์โทร</th>                                                                                                                          
                                                                <th>จำนวนผู้สมัคร</th>  
                                                                <th>สถานะ</th>
                                                                <th>วันที่สมัคร</th> 
                                                                <th>สมัครแล้ว</th> 
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>       
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="payment">
                                                <div class="table-responsive">                                                   
                                                    <table class="table table-striped table-bordered table-hover display" id="dataTables-payment" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th> รหัสใบสมัคร </th>
                                                                <th>ชื่อ - นามสกุล</th>
                                                                <th>เบอร์โทร</th>                                                                                                                          
                                                                <th>จำนวนผู้สมัคร</th>  
                                                                <th>สถานะ</th>
                                                                <th>วันที่สมัคร</th> 
                                                                <th>สมัครแล้ว</th> 
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="holders">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover display" id="dataTables-holders" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th> รหัสใบสมัคร </th>
                                                                <th>ชื่อ - นามสกุล</th>
                                                                <th>เบอร์โทร</th>                                                                                                                          
                                                                <th>จำนวนผู้สมัคร</th>  
                                                                <th>สถานะ</th>
                                                                <th>วันที่สมัคร</th> 
                                                                <th>สมัครแล้ว</th> 
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        
                                                    </table>
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
        <script>
            $(document).ready(function () {
                datatable()
            });
            function datatable(data)
            {
                var data;
                console.log(data);
                table = $('.display').DataTable({ 
                    responsive: true,
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    dom: 'Bfrtip',
                    "language": {
                        "processing": "กำลังโหลด..." //add a loading image,simply putting <img src="loader.gif" /> tag.
                    },
                    buttons: [
                        {extend: 'excel', text: '<i class="fa fa-file-excel-o"></i> Export to Excel', className: 'btn btn-default'}

                    ],
                    "ajax": {
                        "url": "<?php echo site_url('administrator/application-by-coures/'.$course_id)?>?name=all",
                        "type": "POST",
                    },

                    //Set column definition initialisation properties.
                    "columnDefs": [
                        { 
                            "targets": [ -1 ], //last column
                            "orderable": true, //set not orderable
                        },
                    ],                        
                    "iDisplayLength": 20,                   
                });
            }
            function reload_table()
            {                
                table.ajax.reload(null,false); //reload datatable ajax 
            }
            $('a[href="#payment"]').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
                var url = "<?php echo site_url('administrator/application-by-coures/'.$course_id)?>?name=nopay";
                table.ajax.url( url ).load();
                table.ajax.reload(null,false); //reload datatable ajax 
            });
            $('a[href="#holders"]').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
                var url = "<?php echo site_url('administrator/application-by-coures/'.$course_id)?>?name=holders";
                table.ajax.url( url ).load();
                table.ajax.reload(null,false); //reload datatable ajax 
            });
            $('a[href="#all"]').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
                var url = "<?php echo site_url('administrator/application-by-coures/'.$course_id)?>?name=all";
                table.ajax.url( url ).load();
                table.ajax.reload(null,false); //reload datatable ajax 
            })
        </script>
    </body>

    <!-- END BODY -->
</html>
