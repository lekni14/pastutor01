<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="<?php echo base_url('js/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>        
<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo base_url('js/bootstrap-select.min.js'); ?>"></script>   
<script src="<?php echo base_url('js/jasny-bootstrap.min.js'); ?>"></script>     
<script type="text/javascript" src="<?php echo base_url('js/jquery-mockjax.js'); ?>" ></script>
<script src="<?php echo base_url('js/parsley.js') ?>"></script>
<script src="<?php echo base_url('js/parsley-th.js') ?>"></script>
<script src="<?php echo base_url('js/icheck.js') ?>"></script>
<script>
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-red',
    radioClass: 'iradio_square-green',
    increaseArea: '20%' // optional
  });
});
</script>
<script>
    $('.login').on('click', function () {
        $('#md-forget-password').modal('hide');
        $('#md-login').modal('show')
    });
    $("#forget-password").click(function () {
        $('#md-login').modal('hide');
        $('#md-forget-password').modal('show')
    });
    $("#forget-pas-sand").click(function () {
        var $form = $("#frm-forget-pass");
        if ($form.parsley().validate()) {
            $('#md-forget-password').modal('hide');
            ajaxRequest("<?php echo base_url('forget-password'); ?>", $form.serializeArray(), "POST")
                    .done(function (r) {
                        if (r.result == true) {
                            $('#md-success h5').text('ส่งอีเมลเรียบร้อย กรุณาตรวจสอบอีเมล');
                            $('#md-success').modal('show');
                        }
                    }).fail(function (r) {
                $('#md-error h5').text('Error!! มีสิ่งผิดพลาดไม่สามารถติดต่อฐานข้อมูลได้');
                $('#md-error').modal('show');
            });
        }
    });
</script> 
<script type="text/javascript">
    var login = <?php if ($this->session->has_userdata('login')) {
    echo 'true';
} else {
    echo 'null';
} ?>;
    $(document).ready(function () {

        //$('#md-walcome').modal('show');

        //called when key is pressed in textbox
        $(".numeric").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                //$("#errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });
    });
    $('#md-walcome').on('hidden.bs.modal', function (e) {
        location.reload();
    })
    $(".btn-repeat").click(function () {
        $(".login-warning").addClass('hidden')
    });
    $(document).ready(function () {
        $('.btn-login').click(function () {
            var $form = $("#frm-login");
            if ($form.parsley().validate()) {
                $.ajax({
                    url: "<?php echo base_url(); ?>api/login",
                    type: "post",
                    data: $form.serializeArray(),
                    dataType: "json",
                    //contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        console.log(res)
                        if (res.result == true) {
                            //localStorage.setItem('login',true);
                            $("#md-login").modal('hide');
                            //$('#md-success p').text(res.message);
                            $('#md-walcome').modal('show');
                            //location.reload();                            
                        } else {
                            $(".login-warning").removeClass('hidden')
                        }
                    },
                    error: function (result) {
                        $('#md-error h5').text('!!!Server Error');
                        $('#md-error').modal('show');
                    }
                });
            } else {
                return false;
            }
        });
    });
    $('.btn-submit-reg').click(function () {
        var $form = $("#frm-regit");
        console.log($form.serializeArray())
        if ($form.parsley().validate()) {
            $("#md-login").modal('hide');
            $("#md-regiter").modal('hide');
            $.ajax({
                url: "<?php echo base_url(); ?>api/member",
                type: "post",
                data: $form.serializeArray(),
                dataType: "json",
                //contentType: "application/json; charset=utf-8",
                success: function (res) {
                    if (res.response == 'success') {
                        $('#md-success h5').text('สมัครสมาชิกเรียบร้อบ');
                        $('#md-success').modal('show');
                        setTimeout(function(){                                
                                location.reload();
                        }, 2000);
                        //location.reload();
                    }else{
                        $('#md-error h5').text(res.error);
                        $('#md-error').modal('show');
                    }
                },
                error: function (result) {
                    $('#md-error h5').text('!!!Server Error');
                    $('#md-error').modal('show');
                }
            });
        } else {
            return false;
        }
    });
//    $.fn.selectDropdown = function() {
//        this.css( "color", "green" );
//    };
//    function selectDropdown(dataSource,dataTextField,dataValueField){
//        
//    }
    $(document).ready(function () {

        $.ajax({
            url: "<?php echo base_url('api/provinces'); ?>",
            type: "get",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                $.each(res, function (key, value) {
                    $('#ProvinceID')
                            .append($("<option></option>")
                                    .attr("value", value.PROVINCE_ID)
                                    .text(value.PROVINCE_NAME));
                });
                $('#ProvinceID').selectpicker('refresh');
            },
            error: function (result) {
                $('#md-error h5').text('!!!Server Error');
                $('#md-error').modal('show');
            }
        });
        $.ajax({
            url: "<?php echo base_url('api/provinces-by-geo'); ?>",
            type: "get",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                $.each(res, function (key, value) {
                    $('#ProvinceID_sch')
                            .append($("<option></option>")
                                    .attr("value", value.PROVINCE_ID)
                                    .text(value.PROVINCE_NAME));
                });
                $('#ProvinceID_sch')
                            .append($("<option></option>")
                                    .attr("value", 0)
                                    .text('จังหวัดอื่นๆ'));
                $('#ProvinceID_sch').selectpicker('refresh');
            },
            error: function (result) {
                $('#md-error h5').text('!!!Server Error');
                $('#md-error').modal('show');
            }
        });
    });
    $("#ProvinceID_sch").change(function () {
        $.ajax({
            url: "<?php echo base_url(); ?>api/school-by-province/" + this.value,
            type: "get",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                $('#school_id').empty();
                $.each(res, function (key, value) {
                    $('#school_id')
                            .append($("<option></option>")
                                    .attr("value", value.school_id)
                                    .text('โรงเรียน'+value.school_name));
                });
                $('#school_id').selectpicker('refresh');
            }, error: function (result) {
                $('#md-error h5').text('!!!Server Error');
                $('#md-error').modal('show');
            }
        });
    });
    $("#ProvinceID").change(function () {
        $.ajax({
            url: "<?php echo base_url(); ?>api/amphurs/" + this.value,
            type: "get",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                $('#district_id').empty();
                $.each(res, function (key, value) {
                    $('#district_id')
                            .append($("<option></option>")
                                    .attr("value", value.AMPHUR_ID)
                                    .text(value.AMPHUR_NAME));
                });
                $('#district_id').removeAttr("disabled")
                $('#district_id').selectpicker('refresh');
                $('#InputSubdistrictNo').removeAttr("disabled")
            }, error: function (result) {
                $('#md-error h5').text('!!!Server Error');
                $('#md-error').modal('show');
            }
        });
    });
    $("#district_id").change(function () {
        $.ajax({
            url: "<?php echo base_url(); ?>api/tumbon/" + this.value,
            type: "get",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                $('#InputSubdistrictNo').empty();
                $.each(res, function (key, value) {
                    $('#InputSubdistrictNo')
                            .append($("<option></option>")
                                    .attr("value", value.DISTRICT_CODE)
                                    .text(value.DISTRICT_NAME));
                });
                $('#InputSubdistrictNo').selectpicker('refresh');
            }, error: function (result) {
                $('#md-error h5').text('!!!Server Error');
                $('#md-error').modal('show');
            }
        });
    });
    $("#InputSubdistrictNo").change(function () {
        $.ajax({
            url: "<?php echo base_url(); ?>api/zipcodes/" + this.value,
            type: "get",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                $("input[name='postcode']").val(res.zipcode)
            }, error: function (result) {
                $('#md-error h5').text('!!!Server Error');
                $('#md-error').modal('show');
            }
        });
    });
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
            success: function(result) {
                if(result.result=='false'){
                    $('#md-error h5').text(result.message);
                    $('#md-error').modal('show');  
                }
                return result;
            },
            error : function(result){
                    $('#md-error h5').text('!!!Server Error');
                    $('#md-error').modal('show');
            }
        });
    }
    $("#logout").click(function (e) {
        e.preventDefault()
        localStorage.clear();
        window.location.replace($(this).attr('href'));
    })
    

</script>