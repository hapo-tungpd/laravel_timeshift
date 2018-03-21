<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Haposoft</h3>

        <div class="box-tools pull-right">
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous"><i class="fa fa-chevron-left"></i></a>
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Next"><i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h5>From: Hr@haposoft.com,
                <span class="mailbox-read-time pull-right">{{ new \Carbon\Carbon(now()) }}</span></h5>
        </div>
        <!-- /.mailbox-read-info -->
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
            <p>Hello {{ $data['name'] }},</p>

            <p>Thank you so much for joining us. We are happy to have you join our Haposoft!.</p>
            <p>Your account:</p>
            <p>Email: {{ $data['email'] }}</p>
            <p>Password: {{ $data['password'] }}</p>
            <p>Thanks & Best regards,<br>Admin</p>
        </div>
        <!-- /.mailbox-read-message -->
    </div>
    <div class="col-sm-4 invoice-col">
        <address>
            <strong>Admin, Inc.</strong><br>
            TẦNG 6 TÒA NHÀ THỐNG NHẤT<br>
            SỐ 23 ĐƯỜNG TÔ VĨNH DIỆN, THANH XUÂN, HÀ NỘI<br>
            Phone: +84-125-645-9898<br>
            Email: Admin@haposoft.com
        </address>
    </div>
    <!-- /.box-body -->
</div>