<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{

    //Show all listings
    public function index()
    {
        return view('listings.index', [      
            'listings'=> Listing::latest()->filter(request(['tag','search']))
            ->paginate(5)
        ]);
    }
    //Show single page listing
    public function show(Listing $listing)
    {
        return view('listings.show',[
            'listing'=> $listing
        ]);
    }

    //Show Create Form
    public function create(){
        return view('listings.create');
    }


    //Store listing data
    public function store(Request $request){
        $formFields = $request->validate([
            'title'=> 'required',
            'company'=> ['required', Rule::unique('listings',
            'company')],
            'location'=> 'required',
            'website'=> 'required',
            'email'=> ['required', 'email'],
            'tags'=> 'required',
            'description'=> 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos',
            'public');
        } 

        Listing::create($formFields);

        return redirect('/')->with('message','Post created successfully!');
    }

    //Show Edit Form
    public  function edit(Listing $listing)
    {
        return view ('listings.edit', ['listing' => $listing]);
    }

    //Update listing data
    public function update(Request $request,Listing $listing){
        $formFields = $request->validate([
            'title'=> 'required',
            'company'=> ['required'],
            'location'=> 'required',
            'website'=> 'required',
            'email'=> ['required', 'email'],
            'tags'=> 'required',
            'description'=> 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos',
            'public');
        } 

     $listing->create($formFields);

        return back()->with('message','Post updated successfully!');
    }

        //Delete post
        public function destroy(Listing $listing){
            $listing->delete();
            return redirect('/')->with('message', 'Post deleted successfully!');
        }
}
