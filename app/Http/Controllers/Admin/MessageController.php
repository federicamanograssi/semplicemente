<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Apartment;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            // FILTRARE SOLO QUELLI DELL'UTENTE
            'messages' => Message::whereHas('apartment', function($query){
                $query->where('user_id', Auth::id());
            })->get()
        ];

        return view('admin.messages.index', $data);
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
        $request->validate([
            'email_sender' => 'required|min:2|max:50',
            'message_text' => 'required',
            'apartment_id' => 'required',
        ]);

        $data = $request->all();
        $newMessage = new Message();
        $newMessage->apartment_id = $data['apartment_id'];
        $newMessage->fill($data);
        $newMessage->save();

        // AGGIUNGERE MESSAGGIO SUCCESSO INVIO E SVUOTARE FORM senza far fare redirect

        return redirect()->route('apartments.show',$data['apartment_id']);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    }
}
