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
                                    <h5>คอร์ส-โครงการ</h5>
                                </header>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo anchor('administrator/course/create','<i class="icon-plus"></i> เพิ่มคอร์ส-โครงการ','class="btn btn-success"'); ?>                                            
                                        </div>                                        
                                    </div> <br>   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">#</th>
                                                            <th> คอร์ส-โครงการ </th>
                                                            <th>ราคา</th>
                                                            <th>ราคา(แบบกลุ่ม)</th>
                                                            <th>จำนวนผู้สมัคร(แบบกลุ่ม)</th>
                                                            <th>ส่วนลด</th>
                                                            <th>แก้ไขล่าสุด</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> 
                                                        <?php if ($course): foreach ($course as $key => $value): ?>
                                                                <tr>
                                                                    <td><?= ++$key ?></td>
                                                                    <td><?= $value['name'] ?></td>
                                                                    <td><?= $value['price'] ?></td>
                                                                    <td><?= $value['discount'] ?></td>
                                                                    <td><?= $value['person'] ?></td>
                                                                    <td><?= $value['discount_exclusive'] ?></td>
                                                                    <td><?= DateTimeThai($value['update_at']) ?></td>
                                                                    <td>
                                                                        <?php echo anchor('api/course_delete', '<i class="icon-trash icon-white"></i>', 'class="btn btn-danger btn-confirm" data-id="'.$value['id'].'" data-row="'.$key.'"'); ?>
                                                                        <?php echo anchor('administrator/course/edit/' . $value['id'], '<i class="icon-pencil icon-white"></i>', 'class="btn btn-primary"'); ?>                                                                
                                                                        <?php echo anchor('administrator/course/' . $value['id'], '<i class="icon-list icon-white"></i>', 'class="btn btn-success"'); ?>                                                                
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach;
                                                        endif;
                                                        ?>
                                                    </tbody>
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
            <!--END PAGE CONTENT -->
            <!-- END RIGHT STRIP  SECTION -->
        </div>

        <!--END MAIN WRAPPER -->

        <!-- FOOTER -->
<?php $this->load->view('admin/template/footer') ?>
        <!--END FOOTER -->
<?php $this->load->view('admin/template/modals') ?>

        <!-- GLOBAL SCRIPTS -->
<?php $this->load->view('admin/template/javascript') ?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
            $(".btn-confirm").click(function (e){
                e.preventDefault()
                $("#md-confirm h5").text('ยืนยันลบข้อมูลสถานที่');
                $("#md-confirm a").attr( 'href',$(this).attr('href') );
                $("#md-confirm a").attr( 'data-id',$(this).attr('data-id') );
                $("#md-confirm a").attr( 'data-row',$(this).attr('data-row') );
                $("#md-confirm").modal('show')  
            });
            $("#btn-confirm-delete").click(function (e){
                e.preventDefault()
                $("#md-confirm").modal('hide') 
                
                ajaxRequest($(this).attr('href'),{'id':$(this).attr('data-id'),'row':$(this).attr('data-row')},"POST")
                    .done(function(r) {
                        if(r.result==true){
                            $('#md-success h5' ).text('ลบข้อมูลสำเร็จ');
                            $('#md-success').modal('show');
                            setTimeout(function(){                                
                                location.reload();
                            }, 2000);
                        } 
                    }).fail(function(r) {
                           $('#md-error h5' ).text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                           $('#md-error').modal('show');
                    });
            });
        </script>


    </body>

    <!-- END BODY -->
</html>
