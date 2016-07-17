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
                                    <h5>รายชื่อสมาชิก </h5>
                                </header>                            
                                <div class="body">  
                                    <form id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('administrator/member/level-up');?>">
                                        <input id="myInput" name="file" type="file" style="visibility:hidden" />
                                    </form>                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="dataTables-example" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>รหัสสมาชิก</th>
                                                    <th>เลขประตัวประชาชน</th>
                                                    <th>ชื่อ - นามสกุล</th>
                                                    <th>ชื่อเล่น</th>
                                                    <th>โรงเรียน</th>
                                                    <th>จังหวัด</th>
                                                    <th>ระดับสมาชิก</th>
                                                    <th>แก้ไขล่าสุด</th>
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
            $("#myInput").change(function (){
                submit_form()
                //$("#form").submit();
            })
            function submit_form()
            {
                var $form = $("#form");
                    var $form = new FormData($("#form")[0]);
                    ajaxUpfile("<?php echo base_url('up-level'); ?>", $form, "POST")
                            .done(function (r) {
                                console.log(r.result)
                                if (r.result == true) {
                                    console.log('r')
                                    $('#md-success h5').text(r.msg);
                                    $('#md-success').modal('show');
                                    setTimeout(function(){                                        
                                        reload_table()
                                    }, 2000);
                                }else{
                                    $('#md-error h5').text('Error!! '+r.msg);
                                    $('#md-error').modal('show');
                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });
            }
//            document.getElementById("file").onchange = function() {
//                document.getElementById("form").submit();
//            }
//            $(document).ready(function () {
//                $('#dataTables-example').dataTable({
//                    "language": {
//                        "lengthMenu": "Display _MENU_ records per page",
//                        "zeroRecords": "Nothing found - sorry",
//                        "info": "หน้า _PAGE_ of _PAGES_",
//                        "infoEmpty": "No records available",
//                        "infoFiltered": "(filtered from _MAX_ total records)"
//                    },
//                    "iDisplayLength": 20,
//                    dom: 'Bfrtip',
//                        buttons: [
//                            { text: '<i class="icon-upload"></i> อัพเกรดสมาชิก',className:'btn btn-success',action: function ( e, dt, node, config ) {
//                                    $('#myInput').click();
//                                }
//                            },
//                            {extend:'excel',text:'<i class="fa fa-file-excel-o"></i> Export to Excel',className: 'btn btn-default'}
//                            
//                        ],
//                });
//            });
            $(document).ready(function () {
                //datatables
                table = $('#dataTables-example').DataTable({ 
                    responsive: true,
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    dom: 'Bfrtip',
                    "language": {
                        "processing": "กำลังโหลด..." //add a loading image,simply putting <img src="loader.gif" /> tag.
                    },
                    buttons: [
                            { text: '<i class="icon-upload"></i> อัพเกรดสมาชิก',className:'btn btn-success',action: function ( e, dt, node, config ) {
                                    $('#myInput').click();
                                }
                            },
                            {extend:'excel',text:'<i class="fa fa-file-excel-o"></i> Export to Excel',className: 'btn btn-default'}
                            
                        ],             
                    "ajax": {
                        "url": "<?php echo site_url('administrator/member-ajax')?>",
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
            });
            function reload_table()
            {
                table.ajax.reload(null,false); //reload datatable ajax 
            }
        </script>


    </body>

    <!-- END BODY -->
</html>
