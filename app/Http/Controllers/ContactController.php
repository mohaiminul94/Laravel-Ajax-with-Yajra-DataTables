<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('allContacts');
    }
    
    public function allContacts()
    {
        $contacts= Contact::latest()->get();
        return Datatables::of($contacts)
            ->addColumn('action', function($contacts) {
                return '<a onclick="showData('.$contacts->id.')" class="btn btn-success">Show</a>'.' '.
                       '<a onclick="editData('.$contacts->id.')" class="btn btn-primary">Edit</a>'.' '.
                       '<a onclick="deleteData('.$contacts->id.')" class="btn btn-danger">Delete</a>';
            })->make(true); 
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
        $data= [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];
        return Contact::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact= Contact::find($id);
        return $contact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact= Contact::find($id);
        return $contact;
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
        $contact= Contact::find($id);
        $contact->name= $request['name'];
        $contact->phone= $request['phone'];
        $contact->email= $request['email'];
        $contact->update();
        return $contact;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::destroy($id);
    }
}
