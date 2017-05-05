<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@novaframework.com
 * @version 3.0
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Upgrades;
use View;
use Input;
use Validator;
use Request;
use DB;
use Mailer;
use Auth;
use Nova\Helpers\PaypalIPN as Paypal;

class Upgrade extends Controller
{
    /**
     * The currently used Layout.
     *
     * @var string
     */
    protected $layout = 'Welcome';

    /**
     * Create and return a View instance.
     */

    public function Upgrade()
    {
        $message = __('We take a one time yearly account upgrade fee.<div class="fee cyan-text large-text">$49</div> <p>This enables us to keep the service running! Once, you upgrade your account:</p><p> You are able to download none stop, upload none stop.</p><p class="cyan-text">Click Below to  Subscribe</p>');

        return View::make('Upgrade/Upgrade')
            ->shares('title', __('Annual Account Upgrage'))
            ->withWelcomeMessage($message);
    }
    public function my_ipn(){
       if ($_SERVER['REQUEST_METHOD'] != "POST") die ("No Post Variables");
        // Initialize the $req variable and add CMD key value pair
        $req = 'cmd=_notify-validate';
        // Read the post from PayPal
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        // Now Post all of that back to PayPal's server using curl, and validate everything with PayPal
        // We will use CURL instead of PHP for this for a more universally operable script (fsockopen has issues on some environments)
        //$url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        $url = "https://www.paypal.com/cgi-bin/webscr";
        $curl_result=$curl_err='';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Content-Length: " . strlen($req)));
        curl_setopt($ch, CURLOPT_HEADER , 0);   
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $curl_result = @curl_exec($ch);
        $curl_err = curl_error($ch);
        curl_close($ch);

        $req = str_replace("&", "\n", $req);  // Make it a nice list in case we want to email it to ourselves for reporting

        // Check that the result verifies
        if (strpos($curl_result, "VERIFIED") !== false) {
            $req .= "\n\nPaypal Verified OK";
        } else {
            $req .= "\n\nData NOT verified from Paypal!";
            mail("adjoines@msn.com", "IPN interaction not verified", "$req", "From: adjoines@msn.com" );
            exit();
        }
        /* CHECK THESE 4 THINGS BEFORE PROCESSING THE TRANSACTION, HANDLE THEM AS YOU WISH
        1. Make sure that business email returned is your business email
        2. Make sure that the transaction’s payment status is “completed”
        3. Make sure there are no duplicate txn_id
        4. Make sure the payment amount matches what you charge for items. (Defeat Price-Jacking) */
        
        // Check Number 1 ------------------------------------------------------------------------------------------------------------
        $receiver_email = $_POST['receiver_email'];
        if ($receiver_email != "adjoines@msn.com") {
            $message = "Investigate why and how receiver email is wrong. Email = " . $_POST['receiver_email'] . "\n\n\n$req";
            mail("adjoines@msn.com", "Receiver Email is incorrect", $message, "From: adjoines@msn.com" );
            exit(); // exit script
        }
        // Check number 2 ------------------------------------------------------------------------------------------------------------
        if ($_POST['payment_status'] != "Completed") {
            // Handle how you think you should if a payment is not complete yet, a few scenarios can cause a transaction to be incomplete
        }
        // Connect to database ------------------------------------------------------------------------------------------------------
        // Check number 3 ------------------------------------------------------------------------------------------------------------
        /*$upgrade = Upgrades::where('txn_id', '=', $_POST['txn_id'])->get();
        if(count($upgrade) > 0){
            $message = "Duplicate transaction ID occured so we killed the IPN script. \n\n\n$req";
            mail("adjoines@msn.com", "Duplicate txn_id in the IPN system", $message, "From: adjoines@msn.com" );
            exit();
        }
       */
        // END ALL SECURITY CHECKS NOW IN THE DATABASE IT GOES ------------------------------------
        ////////////////////////////////////////////////////
        // Homework - Examples of assigning local variables from the POST variables
        $txn_id = $_POST['txn_id'];
        $payer_email = $_POST['payer_email'];
        $item_id = $_POST['item_number'];
        $item_name = $_POST['item_name'];
        //$custom = $_POST['custom'];
        // Place the transaction into the database
        // Mail yourself the details
        $upGrad = new Upgrades;
        $upGrad->txn_id = $txn_id;
        $upGrad->username = $item_name;
        $upGrad->payer_email = $payer_email;
        $upGrad->save();
        mail("adjoines@msn.com", "NORMAL IPN RESULT YAY MONEY!", $req, "From: adjoines@msn.com");
        // Here is some information on how to configure sendmail:
        // http://php.net/manual/en/function.mail.php#118210
     
            // Reply with an empty 200 response to indicate to paypal the IPN was received correctly
            header("HTTP/1.1 200 OK");
    }
    public function successCheckout(){
        $message = __('<h1>Thank Your For Upgrading Your Account</h1>.<p>You are the top of the Queue</p><p> Enjoy our service!</p><p class="cyan-text">Any Questions? Donot Hesitate to make contact!</p><h5><em class="cyan-text">Note: </em>It may take a while for your account to reflect your subscription. <p class="red-text">DO NOT DO MAKE ANY OTHER PAYMENT!</p> You will be Notified by Email!</h5> <a href="/contact" class="btn btn-floating btn-large pulse"> <i class="material-icons">email</i></a>');

        return View::make('Upgrade/success')
            ->shares('title', __('Success Account Upgrage'))
            ->withWelcomeMessage($message);
    }
     public function failedCheckout(){
        $message = __('<h1 class="red-text">Oops! Something went wrong!</h1>.<p>Subpcription failed</p><p> Verify with paypal why?</p><p class="cyan-text">Any Questions? Donot Hesitate to make contact!</p> <a href="/contact" class="btn btn-floating btn-large pulse"> <i class="material-icons">email</i></a>');

        return View::make('Upgrade/failed')
            ->shares('title', __('Oops! Failed Account Upgrage'))
            ->withWelcomeMessage($message);
    }
    
}
