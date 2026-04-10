<?php
include 'includes/book-utilities.inc.php';
$customers = readCustomers('data/customers.txt');
$requestedID = isset($_GET['customer_id']) ? $_GET['customer_id'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>DC22892 Zhang Jieding</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/demo-styles.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="js/jquery.sparkline.2.1.2.js"></script>
    
    <style>
        .force-row { display: flex; flex-wrap: wrap; width: 100%; align-items: flex-start; }
        .left-col { width: 58%; padding: 10px; box-sizing: border-box; }
        .right-col { width: 42%; padding: 10px; box-sizing: border-box; }
        .mdl-card__title h4 { margin: 0; font-size: 20px; font-weight: normal; }
    </style>
</head>
<body>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    
    <?php include 'includes/header.inc.php'; ?>

    <div class="mdl-layout__drawer">
        <?php include 'includes/left-nav.inc.php'; ?>
    </div>

    <main class="mdl-layout__content mdl-color--grey-100">
        <div class="page-content">
            
            <div class="force-row">
                <div class="left-col">
                    <div class="mdl-card mdl-shadow--2dp" style="width:100%">
                        <div class="mdl-card__title mdl-color--orange mdl-color-text--white">
                            <h4>Customers</h4>
                        </div>
                        <div class="mdl-card__supporting-text" style="padding:0; width:100%;">
                            <table class="mdl-data-table mdl-js-data-table" style="width:100%; border:none;">
                                <thead>
                                    <tr><th>Name</th><th>University</th><th>City</th><th>Sales</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($customers as $c): ?>
                                    <tr>
                                        <td><a href="cisc3003-sugex10-after.php?customer_id=<?php echo $c[0]; ?>"><?php echo $c[1].' '.$c[2]; ?></a></td>
                                        <td><?php echo $c[4]; ?></td>
                                        <td><?php echo $c[6]; ?></td>
                                        <td><span class="inlinesparkline"><?php echo $c[11]; ?></span></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="right-col">
                    <div class="mdl-card mdl-shadow--2dp" style="width:100%">
                        <div class="mdl-card__title mdl-color--purple mdl-color-text--white">
                            <h4>Customer Details</h4>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <?php
                            if ($requestedID) {
                                foreach ($customers as $c) {
                                    if ($c[0] == $requestedID) {
                                        echo "<h5>$c[1] $c[2]</h5>";
                                        echo "<p><b>Email:</b> $c[3]</p><p><b>University:</b> $c[4]</p><p><b>City:</b> $c[6]</p>";
                                        break;
                                    }
                                }
                            } else { echo "Select a customer to view details."; }
                            ?>
                        </div>
                    </div>

                    <div class="mdl-card mdl-shadow--2dp" style="width:100%; margin-top:20px;">
                        <div class="mdl-card__title mdl-color--purple mdl-color-text--white">
                            <h4>Order Details</h4>
                        </div>
                        <div class="mdl-card__supporting-text" style="padding:0; width:100%;">
                            <?php
                            if ($requestedID) {
                                $orders = readOrders($requestedID, 'data/orders.txt');
                                if (count($orders) > 0) {
                                    echo "<table class='mdl-data-table' style='width:100%; border:none;'><tr><th>ISBN</th><th>Title</th></tr>";
                                    foreach ($orders as $o) { echo "<tr><td>$o[2]</td><td>$o[3]</td></tr>"; }
                                    echo "</table>";
                                } else { echo "<p style='color:red; font-weight:bold; padding:20px;'>No orders for this customer.</p>"; }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div> </div>

        <footer style="padding: 20px; text-align: center; font-weight: bold; background: #eee; border-top: 1px solid #ddd;">
            CISC3003 Web Programming: DC22892 Zhang Jieding 2026
        </footer>
    </main>
</div>

<script>
    $(function() {
        $('.inlinesparkline').sparkline('html', {
            type: 'bar', 
            barColor: '#2196F3', 
            height: '24px', 
            barWidth: 5
        });
    });
</script>
</body>
</html>