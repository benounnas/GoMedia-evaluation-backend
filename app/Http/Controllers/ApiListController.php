<?php

namespace App\Http\Controllers;

use App\ApiList;
use App\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ApiList::where("active", 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $newApi = ApiList::create($request->validate([
            "name" => "required|max:50",
            "url" => "required"
        ]));


        $newTransactionLog = new TransactionLog();
        $newTransactionLog->action = "api created";
        $newTransactionLog->user_id = Auth::user()->id;
        $newTransactionLog->api_list_id = $newApi->id;
        $newTransactionLog->save();

        return response([
            "message" => "created succesfuly",
            "api" => $newApi
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $api = ApiList::findOrFail($id);
        $api->update($request->validate([
            "name" => "required|max:50",
            "url" => "required"
        ]));


        $newTransactionLog = new TransactionLog();
        $newTransactionLog->action = "api updated";
        $newTransactionLog->user_id = Auth::user()->id;
        $newTransactionLog->api_list_id = $id;
        $newTransactionLog->save();

        return response([
            "message" => "updated succesfuly",
            "api" => $api
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $api = ApiList::findOrFail($id);
        $api->active = 0;
        $api->update();

        $newTransactionLog = new TransactionLog();
        $newTransactionLog->action = "api deleted";
        $newTransactionLog->user_id = Auth::user()->id;
        $newTransactionLog->api_list_id = $id;
        $newTransactionLog->save();

        return response([
            "message" => "deleted",
        ], Response::HTTP_ACCEPTED);
    }
}
