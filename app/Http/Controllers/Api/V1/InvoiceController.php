<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{

    use HttpResponses;

    public function index(Request $request)
    {
        // return InvoiceResource::collection(Invoice::with('user')->get());
        // return InvoiceResource::collection(Invoice::where()->with('user')->get());
        return (new Invoice())->filter($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'type' => 'required|max:1',
            'paid' => 'required|numeric|between:0,1',
            'payment_date' => 'nullable',
            'value' => 'required|numeric|between:1,9999.99'
        ]);

        if($validator->fails()){
            return $this->error('Invalid Data',422,$validator->errors());
        }

        $created = Invoice::create($validator->validated());

        if(!$created){
            return $this->error('Invoice Not Created',400);
        }

        return $this->response('Invoice Created',200,new InvoiceResource($created->load('user')));

    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'type' => 'required|max:1|in:'. implode(',',['C','B','P']),
            'paid' => 'required|numeric|between:0,1',
            'payment_date' => 'nullable|date_format:Y-m-d H:i:s',
            'value' => 'required|numeric|between:1,9999.99'
        ]);

        if($validator->fails()){
            return $this->error('Invalid Data',422,$validator->errors());
        }

        $validated = $validator->validated();

        $updated = $invoice->update([
            'user_id' => $validated['user_id'],
            'type' => $validated['type'],
            'paid' => $validated['paid'],
            'payment_date' => $validated['paid'] ? $validated['payment_date'] : null,
            'value' => $validated['value']
        ]);

        if($updated){
            return $this->response('Invoice updated', 200, new InvoiceResource($invoice->load('user')));
        }

        return $this->error('Invoice Not Updated',400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $deleted = $invoice->delete();

        if($deleted){
            return $this->response('Invoice Deleted', 200);
        }
        return $this->error('Invoice Not Deleted',400);
    }
}
