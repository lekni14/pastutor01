<script src="<?php echo base_url(); ?>assets/plugins/jquery-2.0.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<!-- END GLOBAL SCRIPTS -->

<!-- PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.time.js"></script>
<script  src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.stack.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/js/for_index.js"></script>-->
<!-- PAGE DATA TABLE -->
<script src="<?php echo base_url(); ?>assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/dataTables/moment.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/dataTables/datetime.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url('js/parsley.js') ?>"></script>
<script src="<?php echo base_url('js/parsley-th.js') ?>"></script>


<script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script>
<!-- PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
         <!-- END PAGE LEVEL SCRIPTS -->
<script>
//    $(function () {
//        var pgurl = window.location.href;
//        $("#menu li a").each(function () {
//            if ($(this).attr("href") == pgurl){
//                $(this).parent().addClass("active");
//                $(this).parents( "a" ).addClass("accordion-toggle");
//                $(this).parent().parent().parent().addClass("active");
//                $(this).parent().parent().addClass("in");
//            }                
//        })
//    });
     function ajaxRequest(urlSubmit, data, type) {
        return $.ajax({
            url: urlSubmit,
            type: type,
            data: data,
            dataType: "json",
            success: function (result) {
                if (result.result == 'false') {
                    $('#md-error h5').text(result.message);
                    $('#md-error').modal('show');
                }
                return result.result;
            },
            error: function (result) {
                $('#md-error h5').text('!!!Server Error');
                $('#md-error').modal('show');
            }
        });
    }
    function ajaxUpfile (urlSubmit, data, type) {
        return   $.ajax({
            url: urlSubmit, // point to server-side PHP script 
            cache: false,
            contentType: false,
            processData: false,
            data: data,                         
            type: type,
            dataType: "json",
            success: function(result) {
                if(result.result=='false'){
                    $('#md-error p' ).text(result.message);
                    $('#md-error').modal('show');  
                }
                return result;
            },
            error : function(result){
                    $('#md-error p' ).text('!!!Server Error');
                    $('#md-error').modal('show');
            }
        });
    }
</script>