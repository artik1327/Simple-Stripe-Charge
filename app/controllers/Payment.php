<?php

require_once '../app/models/StripePayment.php';

/**
 * Class Payment
 */
class Payment extends Controller
{

    /**
     * Default route to Stripe payment form
     *
     */
    public function index()
    {

        $this->renderView('payment/index');
    }

    /**
     * Current action charges with Stripe payment
     *
     * Created route "/payment/charge"
     */
    public function charge()
    {
        // Created Stripe payment class
        $Payment = new StripePayment();

        // Sets needed params for charge
        $Payment->setToken('sk_test_slezupO7CjZyXfjAFmEY8L0H');
        $Payment->setAmount('999');
        $Payment->setCurrency('usd');
        $Payment->setDescription('Test_Charge');
        $Payment->setSource('tok_visa');

        // Charging payment
        $Payment->chargePayment();

        $this->renderView('payment/index', [
            'message' => $Payment->getMessage()
        ]);

    }

}