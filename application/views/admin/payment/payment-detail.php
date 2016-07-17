<table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead>
        <tr>
            <th class="text-left">โครงการ</th>
            <td class="text-left"><?=($application['course'])?$application['course']['name']:''?></td>
        </tr>
        <tr>
            <th class="text-left" style="vertical-align: top">ผู้สมัคร</th>
            <td class="text-left">
                <p><?=($application['member'])?$application['member']['first_name'].' '.$application['member']['last_name']:''?></p>
            </td>
        </tr>        
        <tr>
            <th class="text-left">ยอดรวม</th>
            <td class="text-left"><?=($application['payments'])?number_format($application['payments']['balance']+$application['payments']['discount'],2):''?></td>
        </tr>
        <tr>
            <th class="text-left">ส่วนลด</th>
            <td class="text-left"><?=($application['payments'])?number_format($application['payments']['discount'],2):''?></td>
        </tr>
        <tr>
            <th class="text-left">ค่าสมัครสุทธิ</th>
            <td class="text-left"><?=($application['payments'])?number_format($application['payments']['balance'],2):''?></td>
        </tr>
    </thead>
</table>
<br>
