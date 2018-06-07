<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contact;

class HomeController extends Controller
{

	private $mode;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		$this->mode = 1;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if($this->mode == 0) {
			$id = (Auth::user()->id);
			$contacts = Contact::where('userID', $id)->get();
		}
		else {
			$contacts = Contact::all();
		}
        return view('home', compact('contacts'));
    }

	public function add(Request $request)
	{
		$contact = new Contact;
		$contact->firstName = $request->firstName;
		$contact->lastName = $request->lastName;
		$contact->phone = $request->phone;
		$contact->street = $request->street;
		$contact->city = $request->city;
		$contact->state = $request->state;
		$contact->zip = $request->zip;
		$contact->userID = Auth::user()->name;
		$contact->save();

		return redirect('/');
	}

	public function destroy($id)
	{
		$contact = Contact::find($id);
		$contact->delete();

		$id = (Auth::user()->id);
		$contacts = Contact::where('userID', $id)->get();
		return redirect('/');
	}

	public function search(Request $request)
	{
		$search = $request->search;

		if($this->mode == 0) {
			$id = (Auth::user()->id);
			$contacts = Contact::where('userID', $id)
								->where(function ($query) use ($search) {
									$query->where('firstName', 'LIKE', '%'. $search . '%')->
									orWhere('lastName', 'LIKE', '%'. $search . '%')->
									orWhere('phone', 'LIKE', '%'. $search . '%')->
									orWhere('street', 'LIKE', '%'. $search . '%')->
									orWhere('city', 'LIKE', '%'. $search . '%')->
									orWhere('state', 'LIKE', '%'. $search . '%')->
									orWhere('zip', 'LIKE', '%'. $search . '%');
			})->get();
		}
		else {
			$contacts = Contact::where(function ($query) use ($search) {
									$query->where('firstName', 'LIKE', '%'. $search . '%')->
									orWhere('lastName', 'LIKE', '%'. $search . '%')->
									orWhere('phone', 'LIKE', '%'. $search . '%')->
									orWhere('street', 'LIKE', '%'. $search . '%')->
									orWhere('city', 'LIKE', '%'. $search . '%')->
									orWhere('state', 'LIKE', '%'. $search . '%')->
									orWhere('zip', 'LIKE', '%'. $search . '%');
			})->get();
		}


		return view('home', compact('contacts'));
	}
}
