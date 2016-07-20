<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover display" id="dataTables-payment" width="100%">
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
<?php $sesion = $this->session->userdata('admin'); ?>
<script>
    $(document).ready(function () {
        //datatables
        table = $('#dataTables-payment').DataTable({
            responsive: true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "language": {
                "processing": "กำลังโหลด..." //add a loading image,simply putting <img src="loader.gif" /> tag.
            },
            "ajax": {
                "url": "<?php echo site_url('administrator/marketing-application-by-coures/' . $course_location_id) ?>?name=all&martketing=<?=$sesion['id']?>",
                "type": "POST",
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": true, //set not orderable
                },
            ],
            "iDisplayLength": 20,
        });
    });
    function reload_table()
    {
        table.ajax.reload(null, false); //reload datatable ajax 
    }
</script>