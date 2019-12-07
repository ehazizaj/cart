<?php

namespace App\Http\Controllers;

use App\Car;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars')->with(['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_cars');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request); //in this function we validate the request we will consume
        $car = Car::create($request->all()); //after validation has passed we create the new car
        $this->handleTags($request,$car); //in this function we manage the tags, if we should create it or just sync it
        return redirect()->back()->with('success', sprintf('Car Created'));
    }

    public function handleTags(Request $request, Car $car){

        /**
         * Once the article has been saved, we deal with the tag logic.
         * Grab the tag or tags from the field, sync them with the article
         */

        //save tags in an array
        $tagList = explode(",", $request->tags);

        //for each item in array check if this tag excists or should be created
        foreach($tagList as $tagName){
            Tag::firstOrCreate(['name' => $tagName]);
        }

        // Once All tags are created/taken query just the id
        $tags = Tag::whereIn('name', $tagList)->pluck('id');

        //sync all the tags that are related to this car
        $car->tags()->sync($tags);
    }

    public function validator(Request $request) {
        $request->validate([
            'brand'=>['required', 'max:25'],
            'model'=>['required','max:25'],
            'registration'=>['required', 'numeric'],
            'engine'=>['required','max:25'],
            'price'=>['required', 'numeric'],
            'tags' => 'required'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $tags = $car->tags()->pluck('name')->implode(',');
        return view('admin.edit_car')->with(['car' => $car, 'tags'=>$tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $this->validator($request);
        $car->update($request->all());
        $this->handleTags($request,$car);
        return redirect()->route('admin.cars.index')->with('success', sprintf('Car Updated With Success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
       $car = Car::findOrFail($request->car);
       if ($car->isActive == 1)
       {
           $staus = 0;
       }
       elseif($car->isActive == 0)
       {
           $staus = 1;
       }
       $car->isActive = $staus;
       $car->save();
        return $car->isActive;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->tags()->detach();
        $car->delete();
        return response(['msg' => 'Car deleted', 'status' => 'success']);
    }





}
