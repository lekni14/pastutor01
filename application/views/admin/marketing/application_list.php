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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>คอร์ส-โครงการ</th>
                                                    <td><?=$course['name']?></td>
                                                </tr>
                                                <?php foreach ($course['location'] as $value): ?>
                                                <tr>
                                                    <th>สถานที่</th>
                                                    <td><?=($course['location'])?$value['name']:''?></td>
                                                </tr>
                                                <tr>
                                                    <th>วันที่</th>
                                                    <td><?=($course['location'])?$value['course_date'].' - '.$value['course_end_date']:''?></td>
                                                </tr>
                                                <?php endforeach;?>
                                            </table>
                                        </div>
                                    </div>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">ข้อมูลเด็กที่สมัครทั้งหมด</a></li>
                                            <li role="presentation"><a href="#payment" aria-controls="payment" role="tab" data-toggle="tab">เด็กทีมีสิทธิ์เข้าร่วมโครงการ</a></li>                                            
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
                                                                <th>สถานะ</th>
                                                                <th>วันที่สมัคร</th> 
                                                                <th>ผลงานการตลาด</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="payment">
                                                <div id="page-payment">
                                                    กำลังโหลด...
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
            $('a[href="#payment"]').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
                $( "#page-payment" ).load( "<?=  base_url('administrator/marketing/paymet/'.$course_id) ?>");
            })
            $(document).ready(function () {
                //datatables
                table = $('#dataTables-all').DataTable({ 
                    responsive: true,
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    "language": {
                        "processing": "กำลังโหลด..." //add a loading image,simply putting <img src="loader.gif" /> tag.
                    },                   
                    "ajax": {
                        "url": "<?php echo site_url('administrator/marketing-application-by-coures/'.$course_id)?>?name=all",
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
            function add_person()
            {
                $('[name="id"]').remove();
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
                $('#modal_form').modal('show'); // show bootstrap modal
                $('.modal-title').text('เพิ่มข้อมูล'); // Set Title to Bootstrap modal title
            }
            function edit(id)
            {
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string

                //Ajax Load data from ajax
                $.ajax({
                    url : "<?php echo site_url('administrator/marketing/ajax_edit/')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        $('<input>').attr({ type: 'hidden', name: 'id'}).appendTo('#form');
                        $('[name="id"]').val(data.id);
                        $('[name="first_name"]').val(data.first_name);
                        $('[name="last_name"]').val(data.last_name);
                        $('[name="nickname"]').val(data.nickname);
                        $('[name="contact_no"]').val(data.contact_no);
                        $('[name="identification"]').val(data.identification);
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('แก้ไขข้อมูลเด็ก'); // Set title to Bootstrap modal title

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    }
                });
            }
            function delete_person(id)
            {
                $("#md-confirm h5").text('แน่ใจหรือไม่ที่จะลบข้อมูลนี้?');
                $("#md-confirm a").attr('data-id', id);
                $("#md-confirm").modal('show')  
               
            }
            $("#btn-confirm-delete").click(function (e){
                e.preventDefault()
                $("#md-confirm").modal('hide') 
                
                ajaxRequest("<?php echo base_url('administrator/marketing/delete'); ?>",{'id':$(this).attr('data-id')},"POST")
                    .done(function(r) {
                        if(r.result==true){
                            $('#md-success h5' ).text('ลบข้อมูลสำเร็จ');
                            $('#md-success').modal('show');
                            setTimeout(function(){                                
                                reload_table();  
                            }, 2000);
                        } 
                    }).fail(function(r) {
                           $('#md-error h5' ).text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                           $('#md-error').modal('show');
                    });
            });
            function save()
            {
                var $form = $("#form");
                if ($form.parsley().validate()) {
                    $('#modal_form').modal('hide'); 
                    ajaxRequest("<?php echo base_url('administrator/marketing/dataPost'); ?>", $form.serializeArray(), "POST")
                            .done(function (r) {
                                if (r.result == true) {
                                    reload_table();                                   
                                }
                            }).fail(function (r) {
                        $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                        $('#md-error').modal('show');
                    });
                }
            }
        </script>


    </body>

    <!-- END BODY -->
</html>
