<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientsRequest;
use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $admins = User::role('owner')->get();
        $clients = Client::all();
        return view('clients.create', compact('admins', 'clients'));
    }
    public function store(ClientsRequest $request)
    {
        $attrs = $request->only(['legal_name', 'name', 'tin', 'phone_1', 'phone_2', 'email', 'fax', 'address', 'comments', 'discount', 'payment_option', 'payment_terms', 'payment_adjustment', 'agent', 'invoice_to', 'currency', 'max_risk', 'bank_account', 'bank_name', 'BIC/SWIFT']);

        $attrs['reference_number'] = 'CLI' . $request->reference_number;
        $client = Client::create($attrs);

        session()->flash('Add');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
