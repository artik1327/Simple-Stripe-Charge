<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WhaMedia</title>
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body>
<?php
if (!empty($data['message'])) {
    ?>
    <div class="message">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?= $data['message'] ?>
    </div>
<?php } ?>
<div id="content">
    <form action="/payment/charge" method="post" id="payment-form">
        <div class="form-row">
            <label for="card-element">
                Credit or debit card
            </label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>

        <button>Submit Payment</button>
    </form>
</div>


<script src="https://js.stripe.com/v3/"></script>
<script src="../js/custom.js"></script>
</body>
</html>



