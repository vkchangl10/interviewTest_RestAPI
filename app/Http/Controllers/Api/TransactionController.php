<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    /**
     * Fetch User Transations
     * @return mixed
    */
    public function index()
    {
        $auth = Auth::user();
        return response()->json([
            'status' => true,
            'transations' => $auth->transations
        ]);
    }

    /**
     * Store User Transations
     * @param Request $request
     * @return mixed
    */
    public function store(Request $request)
    {
        try{
            $auth = Auth::user();
            $request->validate([
                'title' => [
                    'required',
                    'string'
                ],
                'content' => [
                    'required',
                    'string'
                ],
            ]);

            Transaction::create([
                'user_id' => $auth->id,
                'title' => $request->title,
                'content' => $request->content,
            ]);

            return response()->json([
                'status' => true,
                'message' => "Transation created.."
            ], 201);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }



    /**
     * Get Single Transaction Details
     * @param integer $id Transaction Id
     * @return mixed
    */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json([
            'status' => true,
            'transaction' => $transaction
        ]);
    }
}
