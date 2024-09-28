<?php

namespace App\Http\Controllers;

use App\Services\MpesaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    protected $mpesaService;

    // Inject MpesaService into the controller
    public function __construct(MpesaService $mpesaService)
    {
        $this->mpesaService = $mpesaService;
    }

    /**
     * Handle STK Push request.
     *
     * This method will validate the request, initiate the STK Push,
     * and return the response from MPESA.
     */
    public function stkPush(Request $request)
    {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric',
            'phone_number' => 'required|numeric|digits:12',  // Expecting phone number in international format (e.g., 2547XXXXXXXX)
        ]);

        // Capture request data
        $amount = $request->input('amount');
        $phoneNumber = $request->input('phone_number');

        // Hardcoded values
        $accountReference = 'DEFAULT_REF'; // Set your default account reference
        $transactionDesc = 'Payment for Service'; // Set your default transaction description

        // Call the MpesaService to initiate STK Push
        $response = $this->mpesaService->stkPushRequest($amount, $phoneNumber, $accountReference, $transactionDesc);

        // Return the response as JSON
        return response()->json($response);
    }

    /**
     * Handle MPESA callback response.
     *
     * This method will handle the MPESA callback and log the response for future processing.
     */
    public function handleCallback(Request $request)
    {
        // Log the callback data from MPESA
        $data = $request->all();  // MPESA sends the callback data in JSON format
        Log::info('MPESA Callback Data: ', $data);

        // Here, you can add logic to process the callback data, such as updating the payment status in the database.

        // Return a response to MPESA (ResultCode 0 means the callback was successfully received)
        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
    }
}
