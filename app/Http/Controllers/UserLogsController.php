<?php

namespace App\Http\Controllers;

use App\UserLogs;
use Illuminate\Http\Request;

class UserLogsController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserLogs  $userLogs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logs = UserLogs::where('user_id', $id)->get();
        return $logs;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserLogs  $userLogs
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLogs $userLogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserLogs  $userLogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserLogs $userLogs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserLogs  $userLogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLogs $userLogs)
    {
        //
    }
}
