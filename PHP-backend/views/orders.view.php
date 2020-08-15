<?php require_once "views/partials/header.php";?>
    <div class="container" style="min-height: 100vh;">
        <h2 class="text-center mt-4 mb-4">Orders</h2>
        <?php foreach($orders as $order):?>
        <div class="row p-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> <?= date('D',strtotime($order->date)); ?> - <?= $order->date; ?> - <?= $order->time?></h5>
                        <p class="card-text">Order ID: <?= $order->id?></p>
                        <p class="card-text">Name: <?= $order->name?></p>
                        <p class="card-text">Address: <?= $order->address?></p>
                        <p class="card-text">Email: <?= $order->email?></p>
                        <p class="card-text">Phone: <?= $order->phone?></p>
                        <div>
                            <p class="card-text">Order:</p> <!-- This needs to be gotten from the item_order table. So id is this one, so we want id of those orders to be gotten -->
                            <div class="card">
                                <div class="card-body">
                                    <table style="width: 80%; margin: 0 auto;" class="text-center">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Title</th>
                                            <th>Extras</th>
                                            <th>Price</th>
                                        </tr>
                                        </thead>
                                        <?php foreach ($item_orders as $item_order):?> <!-- I am not selecting all fields but printing the ones which have the number-->
                                            <?php if($item_order->order_id == $order->id):?>
                                                <tr>
                                                    <td class="border border-secondary"><?= ($item_order->order_id == $order->id) ? $item_order->title : ''; ?></td>
                                                    <td class="border border-secondary"><?= ($item_order->order_id == $order->id) ? $item_order->extras : ''; ?></td>
                                                    <td class="border border-secondary"><?= ($item_order->order_id == $order->id) ? $item_order->price."&#163;" : ''; ?></td>

                                                </tr>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td></td>
                                            <td>Total:</td>
                                            <td><?= $order->total."&#163;"?></td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <p class="card-text">Price: <?= $order->total."&#163;"?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php require_once "views/partials/footer.php"; ?>