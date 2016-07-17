<table style="border:#dddddd thin solid" width="640" align="center" bgcolor="#ffffff">
    <tbody><tr>
            <td align="center" bgcolor="#ffffff">
                <table border="0" cellspacing="0" cellpadding="0" width="640" align="center" bgcolor="#ffffff">
                    <tbody>                        
                        <tr>
                            <td align="center">
                                <hr color="#ACCE22">
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ACCE22" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;font-weight:bold;padding:10px">
                                สถาบันกวดวิชาพี่เอก ( P.A.S  TUTOR )  
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                                    <tbody><tr>
                                            <td height="1"></td>
                                        </tr>
                                    </tbody></table>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family:Arial,Helvetica,sans-serif;font-size:13px;padding:10px;text-indent:1cm;text-align:justify">
                                <p>เรียน <?php echo $profile['first_name'].'  '.$profile['last_name'];?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family:Arial,Helvetica,sans-serif;font-size:13px;padding:10px;text-indent:1cm;text-align:justify">
                                <p style="margin: 0px">เลขที่สมาชิกของท่าน คือ <?=$profile['member_code']?></p>
                                <p style="margin: 0px">เลขประจำตัวประชาชน คือ<?=$profile['identification']?></p>
                                <p style="margin: 0px">รหัสผ่านที่ใช้ในการเข้าสู่ระบบ คือ <?= base64_decode($profile['password'])?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family:Arial,Helvetica,sans-serif;font-size:13px;padding:10px;text-indent:1cm;text-align:justify">
                                <p style="margin: 0px">หากท่านมีข้อสงสัยประการใดหรือต้องการสอบถามข้อมูลเพิ่มเติม กรุณาติดต่อ</p>
                                <p style="margin: 0px">โทรศัพท์ : 0-2739-8753  043-243-544 , 084-030-2207 </p>
                                <p style="margin: 0px">เวลาทำการ  09.00-19.00 น.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>