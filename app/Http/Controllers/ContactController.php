<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Contact;
use App\Phone;
class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::orderBy('first_name')->get();
        return view('contacts.index', ['contacts' => $contacts]);
    }

    public function create(){
        return view('contacts.create');
    }
    public function store(Request $request){
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'address' => 'required',
            'birthday' => 'required'
        ]);

        $contact = new Contact([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'birthday' => $request->get('birthday')
        ]);
        $contact->save();
        foreach($request->ddd as $key => $ddd){
            $phone = new Phone(['ddd'=> $ddd, 'number' => $request->number[$key]]);
            $contact->phones()->save($phone);
        }
        return redirect('/contacts')->with('success', 'Contact saved!');
    }

    public function search(Request $request){
        $word = $request->get('contact');
        $contactArray = array();
        $results = Contact::searchContacts($word);
        foreach($results as $result){
            array_push($contactArray, Contact::find($result->contact_id));
        }
        return view('contacts.index', ['contacts' => array_unique($contactArray)]);
    }

    public function destroy($id){
        $contact = Contact::find($id);
        if (!$contact)
            return response()->json(['message' => 'Record not found'], 404);
        $contact->delete();
        return redirect('/contacts')->with('success', 'Contact deleted!');
    }
    public function edit($id){
        $contact = Contact::find($id);
        return view('contacts.edit', compact('contact'));        
    }
    public function update(Request $request, $id){
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'address' => 'required',
            'birthday' => 'required'
        ]);

        $contact = Contact::find($id);
        $contact->first_name =  $request->get('first_name');
        $contact->last_name = $request->get('last_name');
        $contact->email = $request->get('email');
        $contact->address = $request->get('address');
        $contact->birthday = $request->get('birthday');

        $contact->save();
        foreach($request->ddd as $key => $ddd){
            $phone = new Phone(['ddd'=> $ddd, 'number' => $request->number[$key]]);
            $contact->phones()->save($phone);
        }
        return redirect('/contacts')->with('success', 'Contact updated!');
    }
    public function birthdays(){
        $contacts = Contact::getBirthdays();
        return view('contacts.birthday', ['contacts' => $contacts]);
    }

}
