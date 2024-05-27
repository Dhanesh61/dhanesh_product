<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cancel;
use App\Models\Purchase;

class CancelController extends Controller
{
    public function cancel($purchase_id)
    {
        $purchase = Purchase::findOrFail($purchase_id);
        return view('cancel',['purchase' => $purchase]);
    }

    // public function submit(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'reason' => 'required|string|max:255',
    //     ]);

    //     // Store the reason in the database
    //     $cancel = new Cancel();
    //     $cancel->reason = $request->input('reason');
    //     // You may want to associate the reason with a user or purchase here if applicable
    //     $cancel->save();

    //     // Redirect back with a success message or do something else
    //     return redirect()->back()->with('success', 'Order cancellation reason submitted successfully.');
    // }
        public function cancelOrder(Request $request,$purchase_id){
            $id = Cancel::where('purchase_id', $purchase_id)->first();

            if(!$id){
                Cancel::create([
                    'user_id' => auth()->id(),
                    'purchase_id' => $purchase_id,
                    'reason' => $request->reason
                ]);
            
                return redirect('yourorder')->with('alreadycancel','your order already canceled');
            }else{
                return redirect('yourorder');

            }
        }

        public function cancelview(){
            $cancel = Cancel::all();
            return view('cancelview', compact('cancel'));
        }

        public function purchaseapprove($id)
        {
            $purchase = Purchase::findOrFail($id);
            $purchase->status = Purchase::APPROVED;
            $purchase->save();
            return redirect('purchase');
        }

        public function purchasecancel($id)
        {
            $purchase = Purchase::findOrFail($id);
            $purchase->status = Purchase::CANCELLED;
            $purchase->save();
            return redirect('purchase');
        }

        //user side
        public function deletecancel($id)
        {
            $details = Cancel::where('id',$id)->first();
            Cancel::where('id',$id)->delete();

            $purchase = Purchase::find($details->purchase_id);
            $purchase->status = Purchase::ORDERCANCEL;
            
            $purchase->save();              
            return redirect('cancelview');
        }
}
