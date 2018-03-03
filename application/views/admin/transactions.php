
<div class="col-md-10 text-center mx-auto">
    <div id="accordion">

    </div>
</div>
<script>
    //When item Received Checked.
    function item_Received(trans_id, checked) {
        if (checked == true) {
            var dataString = {'trans_id': trans_id};
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>admin/dashboard/itemreceived",
                data: dataString,
                dataType: 'json',
                success: function (data) {
                    if (data.success == false) {
//                            $('#notif').html(data.notif);
                    } else if (data.success == true) {
                        location.href = "<?php echo base_url() ?>admin/dashboard/";
                    }
                },
                error: function (xhr, status, error) {
                    alert(error);
                },
            });
        }
    }
    //When item shipeed checkbox Checked.
    function item_Shipped(trans_id, checked) {
        if (checked == true) {
            var dataString = {'trans_id': trans_id};
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>admin/dashboard/itemshipped",
                data: dataString,
                dataType: 'json',
                success: function (data) {
                    if (data.success == false) {
//                            $('#notif').html(data.notif);
                    } else if (data.success == true) {
                        location.href = "<?php echo base_url() ?>admin/dashboard/";
                    }
                },
                error: function (xhr, status, error) {
                    alert(error);
                },
            });
        }
    }
    //When click approve button
    function approve(trans_id) {
        var dataString = {'trans_id': trans_id};
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>admin/dashboard/approve",
            data: dataString,
            dataType: 'json',
            success: function (data) {
                if (data.success == false) {
//                            $('#notif').html(data.notif);
                } else if (data.success == true) {
                    location.href = "<?php echo base_url() ?>admin/dashboard/";
                }
            },
            error: function (xhr, status, error) {
                alert(error);
            },
        });
    }
    //When click close button
    function closeTransaction(trans_id) {
        var dataString = {'trans_id': trans_id};
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>admin/dashboard/closetrans",
            data: dataString,
            dataType: 'json',
            success: function (data) {
                if (data.success == false) {
//                            $('#notif').html(data.notif);
                } else if (data.success == true) {
                    location.href = "<?php echo base_url() ?>admin/dashboard/";
                }
            },
            error: function (xhr, status, error) {
                alert(error);
            },
        });
    }
    //When admin click disapprove button
    function disapprove(trans_id) {
        var dataString = {'trans_id': trans_id};
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>admin/dashboard/disapprove",
            data: dataString,
            dataType: 'json',
            success: function (data) {
                if (data.success == false) {
//                            $('#notif').html(data.notif);
                } else if (data.success == true) {
                    location.href = "<?php echo base_url() ?>admin/dashboard/";
                }
            },
            error: function (xhr, status, error) {
                alert(error);
            },
        });
    }
    //Real time load Transactions
    function load_transactions(view = '') {
         $.ajax({
              url: "<?php echo base_url() ?>admin/dashboard/getalltrans",
              method: "POST",
              data: {view: view},
              success: function (data)
              {
                $('#accordion').html(data);
              }
         });
    }
    $(document).ready(function () {
        load_transactions();
//        setInterval(function () {
//             load_transactions();
//            ;
//        }, 10000);
    });
</script>