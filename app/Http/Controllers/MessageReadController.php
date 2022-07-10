<?php

namespace App\Http\Controllers;

use App\Models\MessageRead;
use App\Http\Requests\StoreMessageReadRequest;
use App\Http\Requests\UpdateMessageReadRequest;

class MessageReadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageReadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageReadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessageRead  $messageRead
     * @return \Illuminate\Http\Response
     */
    public function show(MessageRead $messageRead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessageRead  $messageRead
     * @return \Illuminate\Http\Response
     */
    public function edit(MessageRead $messageRead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageReadRequest  $request
     * @param  \App\Models\MessageRead  $messageRead
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageReadRequest $request, MessageRead $messageRead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessageRead  $messageRead
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageRead $messageRead)
    {
        //
    }
}
