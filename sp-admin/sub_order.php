<?php
/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 03-01-17
 * Time: 4:29 PM
 */

require_once('config.php');
require_once('database/databaseConnectionPDO.php');
?>

<!-- Modal -->

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Sub-Order (Txn Id: <?php echo $_GET['specialCustomerMainOrderId']; ?> )</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table style="background-color: white" class="table table-hover">
                <thead>
                <tr>
                    <th style="text-align: center;">Product Name</th>
                    <th style="text-align: center;">Amount</th>
                    <th style="text-align: center;">Quantity</th>
                </tr>

                </thead>
                <tbody>
                <?php
                $specialCustomerMainOrderId = $_GET['specialCustomerMainOrderId'];
                $specialCustomerSubOrders = SpecialCustomerSubOrder::findBySpecialCustomerMainOrderId($specialCustomerMainOrderId);


                ?>
                <?php
                foreach ($specialCustomerSubOrders as $row)
                {
                    ?>
                    <tr>

                        <td><?php echo $row->product_name; ?></td>
                        <td style="text-align: right"><?php echo $row->product_amount; ?></td>
                        <td style="text-align: right"><?php echo $row->quantity; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>

            </table>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

