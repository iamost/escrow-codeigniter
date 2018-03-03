<div class="container">
    <?php echo validation_errors(); ?>
    <form id="seller_form">
        <div class="row my-4">
            <div class="col-md-8 mx-auto text-center">
                <div class="card bg-light p-3">
                    <h1 class="text-center text-dark mb-3"> Transaction: #<?= $id; ?></h1>
                    <input type="hidden" name="id" value="<?= $id ?>" required>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required autofocus value="<?= $buyer_username ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Name: First, Last" required autofocus value="<?= $buyer_name ?>">
                    </div>
                    <div class="form-group row">
                        <div class='col'>
                            <input type="text" class="form-control" name="streetadr" placeholder="Street Address" required autofocus value="<?= $streetadr ?>">
                        </div>
                        <div class='col'>
                            <input type="text" class="form-control" name="address" placeholder="Address" required autofocus value="<?= $address ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class='col'>
                            <input type="text" class="form-control" name="city" placeholder="City" required autofocus value="<?= $city ?>">
                        </div>
                        <div class='col'>
                            <input type="text" class="form-control" name="state" placeholder="State" value="<?= $state ?>">
                        </div>
                        <div class='col'>
                            <input type="text" class="form-control" name="zipcode" placeholder="Zip Code" required autofocus value="<?= $zipcode ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="phone" placeholder="Phone Number" required autofocus value="<?= $phone ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required autofocus value="<?= $buyer_email ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="item" placeholder="item" required autofocus value="<?= $item ?>">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="description" placeholder="Description" required autofocus></textarea>
                    </div>
                    <div class="form-group row">
                        <div class='col'>
                            <input type="number" class="form-control" name="item_price" placeholder="Item Price" required autofocus>
                        </div>
                        <div class='col'>
                            <input type="number" class="form-control" name="shipping" placeholder="Shipping Cost" required autofocus>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-xl mx-auto my-5" id="send">Send</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $("#seller_form").on('submit', function (event) {
            event.preventDefault();
            var dataString = $('#seller_form').serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>transactions/complete",
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
        });
    });
</script>
