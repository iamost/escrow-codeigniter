<div class="container">
    <div class='row my-4'>
        <div class="col-md-8 text-center mx-auto">
            <a href="<?= base_url() ?>transactions/buyer" class="btn btn-primary btn-xl">Start</a>
            <div id="accordion">
                <?php foreach ($transactions as $key => $transaction): ?>
                    <div class="card my-3">
                        <div class="card-header" id="<?= $key ?>">
                            <a class="btn btn-block" data-toggle="collapse" data-target="#<?= $transaction['id'] ?>" aria-expanded="false" aria-controls="<?= $transaction['id'] ?>">
                                <div class="row">
                                    <div class="col">ID:#<?= $transaction['id'] ?></div>
                                    <div class="col">Date: <?= $transaction['start_date'] ?></div>
                                    <div class="col">Ongoing</div>
                                </div>
                            </a>
                        </div>
                        <div id="<?= $transaction['id'] ?>" class="collapse" aria-labelledby="<?= $key ?>" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <ul class="list-group col">
                                        <li class="list-group-item border-0">Item:</li>
                                        <li class="list-group-item border-0"><?= $transaction['item'] ?></li>
                                    </ul>
                                    <ul class="list-group col">
                                        <li class="list-group-item border-0">Seller Email:</li>
                                        <li class="list-group-item border-0"><?= $transaction['seller_email'] ?></li>
                                    </ul>
                                    <ul class="list-group col">
                                        <li class="list-group-item border-0">Seller UserName:</li>
                                        <li class="list-group-item border-0"><?= $transaction['seller_username'] ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>