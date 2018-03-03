<div class="container">
    <div class="row my-4">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header ">
                    <form class="form-inline" id="itemsent">
                        <span>Buyer has made Payments, please send the item to us for verification.</span>
                        <a href="#" class="btn btn-link">(See Address)</a>
                        <input type="hidden" value="<?= $trans_id ?>" name="trans_id">
                        <input type="hidden" value="<?= $id ?>" name="cont_id">
                        <input class="form-check-input" type="checkbox" value="1" id="sent" name="sent">
                        <label class="form-check-label" for="sent">Sent</label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#sent').click(function () {
            if ($(this).prop("checked")) {
                var dataString = $('#itemsent').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>requests/itemsent",
                    data: dataString,
                    dataType: 'json',
                    success: function (data) {
                        if (data.success == false) {
//                            $('#notif').html(data.notif);
                        } else if (data.success == true) {
                            location.href = "<?php echo base_url() ?>transactions";
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(error);
                    },
                });
            }
        });
    });
</script>