<div class="container">
    <form id="contract_form">
        <input type="hidden" name="trans_id" value="<?= $id ?>">
        <div class="row my-4">
            <div class="col-md-8 mx-auto text-center">
                <div class="card bg-light p-5">
                    <h1 class="text-center text-dark mb-3"> Transaction: #<?= $id; ?></h1>
                    <div class="form-group">
                        <input type="text" class="form-control" name="buyer_name" placeholder="Buyer: First, Last" required autofocus value="<?= $buyer_name ?>">
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
                        <input type="text" class="form-control" name="seller_name" placeholder="Seller: First, Last" required autofocus value="<?= $seller_name ?>">
                    </div>
                    <div class="form-group row">
                        <div class='col'>
                            <input type="text" class="form-control" name="seller_streetadr" placeholder="Street Address" required autofocus value="<?= $seller_streetadr ?>">
                        </div>
                        <div class='col'>
                            <input type="text" class="form-control" name="seller_address" placeholder="Address" required autofocus value="<?= $seller_address ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class='col'>
                            <input type="text" class="form-control" name="seller_city" placeholder="City" required autofocus value="<?= $seller_city ?>">
                        </div>
                        <div class='col'>
                            <input type="text" class="form-control" name="seller_state" placeholder="State" value="<?= $seller_state ?>">
                        </div>
                        <div class='col'>
                            <input type="text" class="form-control" name="seller_zipcode" placeholder="Zip Code" required autofocus value="<?= $seller_zipcode ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="item" placeholder="item" required autofocus value="<?= $item ?>">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="description" placeholder="Description" required autofocus><?= $description ?></textarea>
                    </div>
                    <div class="form-group row">
                        <div class='col'>
                            <input type="number" class="form-control" name="item_price" placeholder="Item Price" required autofocus value="<?= $item_price ?>">
                        </div>
                        <div class='col'>
                            <input type="number" class="form-control" name="shipping" placeholder="Shipping Cost" required autofocus value="<?= $shipping ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class='col'>
                            <input type="number" class="form-control" name="total_price" placeholder="Total Price" required autofocus>
                        </div>
                        <div class='col'>
                            <input type="number" class="form-control" name="refund_amount" placeholder="Refund Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="terms" placeholder="Terms"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-xl mx-auto my-5" id="send">Send</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $("#contract_form").on('submit', function (event) {
            event.preventDefault();
            var dataString = $('#contract_form').serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>admin/dashboard/newcontract",
                data: dataString,
                dataType: 'json',
                success: function (data) {
                    if (data.success == false) {
//                            $('#notif').html(data.notif);
                    } else if (data.success == true) {
                        location.href = "<?php echo base_url() ?>admin/dashboard";
                    }
                },
                error: function (xhr, status, error) {
                    alert(error);
                },
            });
        });
    });
</script>
