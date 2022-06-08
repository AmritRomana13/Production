<!--Page Title-->
<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper">
            <h1 class="page-width">My Orders</h1>
        </div>
    </div>
</div>
<!--End Page Title-->

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
            <form action="#">
                <div class="wishlist-table table-content table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-name text-center alt-font">Date</th>
                                <th class="product-price text-center alt-font">Order ID</th>
                                <th class="product-name alt-font">Total Amount</th>
                                <th class="stock-status text-center alt-font">Transction ID</th>
                                <th class="product-price text-center alt-font">Address</th>
                                <th class="product-price text-center alt-font">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($orders)) {
                                foreach ($orders as $order) {
                            ?>
                                    <tr>
                                        <td class="product-name">
                                            <h4 class="no-margin"><?php echo date("d F Y, h:m A", strtotime($order->created_at)) ?></h4>
                                        </td>
                                        <td class="product-name">
                                            <h4 class="no-margin"><?php echo $order->order_id ?></h4>
                                        </td>
                                        <td class="product-name">
                                            <h4 class="no-margin"><?php echo $order->total_amount ?></h4>
                                        </td>
                                        <td class="product-name">
                                            <h4 class="no-margin"><?php echo $order->razorpay_payment_id ?></h4>
                                        </td>
                                        <td class="product-name">
                                            <h4 class="no-margin">
                                                <?php echo $order->first_name . ' ' . $order->last_name ?> <br>
                                                <?php echo $order->company  ?><br>
                                                <?php echo $order->address_1 . ',' . $order->address_2 . ',' . $order->city . ',' . $order->postcode  ?><br>
                                            </h4>
                                        </td>
                                        <td class="product-subtotal text-center"><a href="<?php echo base_url('myaccount/view_order/'). $order->id?>" type="button" class="btn btn-small">View Order</a></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="product-price text-center alt-font" colspan="6">
                                        No products Found
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>