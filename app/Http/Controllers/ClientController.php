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
    public function viewClientsList()
    {
        $clients = Client::with('sales', 'invoices')->orderBy('legal_name', 'asc')->get();

        $groups = $clients->reduce(function ($carry, $client) {

            // get first letter
            $first_letter = $client['legal_name'][0];

            if (!isset($carry[$first_letter])) {
                $carry[$first_letter] = [];
            }

            $carry[$first_letter][] = $client;

            return $carry;
        }, []);
        $clients = Client::all();
        return view('clients.clients_list', compact('groups'));
    }

    public function create()
    {
        $admins = User::role('Administrator')->get();
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

    public function edit(Client $client)
    {
        $admins = User::role('Administrator')->get();
        $clients = Client::all();
        return view('clients.edit', compact('client', 'admins', 'clients'));
    }


    public function update(ClientsRequest $request, Client $client)
    {
        $attrs = $request->only(['legal_name', 'name', 'tin', 'phone_1', 'phone_2', 'email', 'fax', 'address', 'comments', 'discount', 'payment_option', 'payment_terms', 'payment_adjustment', 'agent', 'invoice_to', 'currency', 'max_risk', 'bank_account', 'bank_name', 'BIC/SWIFT']);

        $attrs['reference_number'] = 'CLI' . $request->reference_number;
        $client->update($attrs);

        session()->flash('Update');
        return redirect('/clients');
    }

    public function destroy(Request $request)
    {
        $client = Client::where('id', $request->client_id)->first();
        $client->delete();
        session()->flash('Delete');
        return back();
    }
}
