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
            <?php // $this->load->view('admin/template/navbar'); ?>
            <!-- END HEADER SECTION -->
            <!-- MENU SECTION -->
            <?php $this->load->view('admin/template/leftmenu'); ?>            
            <!--END MENU SECTION -->
            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2> ระบบชำระเงิน </h2>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-file-alt"></i></div>
                                    <h5>ยังไม่ชำระเงิน</h5>
                                </header>                            
                                <div class="body">         
                                    <div class="row">
                                        <label class="col-md-1">ผลงานการตลาด</label>
                                        <div class="col-md-4">                                            
                                            <select class="form-control" id="sel_div_dd" name="">
                                                <option value="">เลือกการตลาด</option>
                                            <?php foreach ($marketing as $key => $value):  ?>
                                                <option value="<?=$value['id']?>"><?=$value['first_name'].'  '.$value['last_name']?></option>
                                            <?php endforeach; ?>
                                                <option value="">การตลาดทังหมด</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">                                            
                                            <thead>
                                                <tr>
                                                    <th class="center">#</th>
                                                    <th>รหัสสมัคร</th>
                                                    <th>เลขประตัวประชาชน</th>
                                                    <th>ชื่อ - นามสกุล</th>
                                                    <th>คอร์ส-โครงการ</th>
                                                    <th>วันที่สมัคร</th>
                                                    <th>สถานนะ</th>
                                                    <th>ผลงานการตลาด</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>                                                
                                                
                                            </tbody>
                                            <tfoot></tfoot>
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
        <?php $this->load->view('admin/template/modals') ?>
        <!--END MAIN WRAPPER -->
        <div class="modal fade" id="md-pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="H2">ชำระงิน</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div id="body-detail" class="col-md-12">
                                <h4>กำลังโหลด...</h4>
                            </div>
                        </div>
                        <form role="form" id="frm-pay">                    
                            <div class="form-group">
                                <label>สถานะ</label>
                                <select class="form-control" name="application_flow_id">
                                    <option value="3">ชำระเงินแล้ว</option>
                                    <option value="2">ยกเลิก(เกินกำหนดชำระเงืน)</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a class="btn btn-primary" id="btn-save-pay">บันทึก</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <?php $this->load->view('admin/template/footer') ?>
        <!--END FOOTER -->


        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('admin/template/javascript') ?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
            $(document).ready(function () {
                //datatables
                table = $('#dataTables-example').DataTable({ 
                    "sDom": '<"top"f>rt<"bottom"ip><"clear">',
                    responsive: true,
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    "language": {
                        "processing": "กำลังโหลด..." //add a loading image,simply putting <img src="loader.gif" /> tag.
                    }, 
//                    dom: 'Bfrtip',
//                    buttons: [
//                        'copy', 'excel', 'pdf'
//                    ],
                    "ajax": {
                        "url": "<?php echo site_url('administrator/ajax_unpaid_list')?>?unpaid=true",
                        "type": "POST",
                         data: function ( d ) {
                               // $.extend(d, me.data);
                                d.supersearch = $('.my-filter').val();

                                // Retrieve dynamic parameters
                                var dt_params = $('#dataTables-example').data('dt_params');
                                // Add dynamic parameters to the data object sent to the server
                                if(dt_params){ $.extend(d, dt_params); }
                             }
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
            $("#sel_div_dd").on("change", "", function() {
            
                var options = $(this).find('option:selected').val();
                console.log(options)
                 // Set dynamic parameters for the data table
                $('#dataTables-example').data('dt_params', { marketing: options });
                // Redraw data table, causes data to be reloaded
                $('#dataTables-example').DataTable().draw();
            });
            function reload_table()
            {
                table.ajax.reload(null,false); //reload datatable ajax 
            }
            function pay(id,appid)
            {
                var url = "<?php echo base_url('administrator/payment-detail'); ?>/"+appid;
                $("#md-pay .modal-body #body-detail").load(url); 
                $("#btn-save-pay").attr('href',$(this).attr('href'))
                $('<input>').attr({ type: 'hidden',id: 'foo', name: 'id',value:id}).appendTo('#frm-pay');
                $('<input>').attr({ type: 'hidden',id: 'foo', name: 'application_id',value:appid}).appendTo('#frm-pay');
                $("#md-pay").modal('show'); 
            }
            $("#btn-save-pay").click(function (e){   
                e.preventDefault();
                var $form = $("#frm-pay");
                if ( $form.parsley().validate() ){
                    ajaxRequest("<?=base_url('api/payment/update')?>",$form.serializeArray(),"POST")
                    .done(function(r) {
                        if(r.result==true){
                            $("#md-pay").modal('hide'); 
                            $('#md-success h5' ).text('บันทึกข้อมูลเรียบร้อย');
                            $('#md-success').modal('show');
                            setTimeout(function(){         
                                $('#md-success').modal('hide');
                                reload_table()
                            }, 2000);
                        } 
                    }).fail(function(r) {
                           $('#md-error h5' ).text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                           $('#md-error').modal('show');
                    });
                }
                
           });
        </script>


    </body>

    <!-- END BODY -->
</html>
