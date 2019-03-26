<?php

namespace App\Http\Controllers;

use App\Services\PayPal;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{

//    public function createAndSendInvoice($slug, Request $request)
//    {
//        $user = Auth::user();
//        $invoice = $this->repo->createAndSendInvoice($slug, $user);
//
//        if ($invoice['success']) {
//            toastr()->success($invoice['message']);
//            return redirect()->route('paypal.invoices');
//        } else {
//            toastr()->warning($invoice['message']);
//            return redirect()->back();
//        }
//    }

    public function invoices(){
        $invoices = Invoice::where('freelancer_id', Auth::user()->freelancer->id)->get();

        return view('paypal.invoice-list', compact('invoices'));
    }

    public function newInvoice()
    {
        return view('paypal.create-invoice');
    }

    public function cancelInvoice($id)
    {
        $user = Auth::user();

        $services = new PayPal();
        $invoices = $services->cancelInvoice($id, $user);

        if ($invoices['success']) {
            return response()->json($invoices);
        } else {
            return response()->json($invoices);
        }
    }

    public function event(Request $request){
//        Log::info($request->all());
        if($request->resource_type == 'invoices'){
            $invoice = Invoice::where('invoice_id', $request->resource['invoice']['id'])->first();
            $invoice->status = $request->resource['invoice']['status'];
//            $invoice->cancelled_date = $response->resource->invoice->metadata->cancelled_date;
            $invoice->webhook_id = $request->id;
            $invoice->summary = $request->summary;
            $invoice->save();
        }

    }
}
