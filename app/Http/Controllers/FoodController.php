<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list all data
        $foodLibrary = food::orderBy('food_name','asc')->paginate(10);
        return view ('food.index')->with('foods', $foodLibrary);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //go to create data page
        return view ('food.create');
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
        $this->validate($request, [
            'food_name' => 'required',
            'food_image' => 'image|required|max:1999',
            'measurement_type' => 'required',
            'food_type' => 'required',
            'weigh_g' => 'required',
            'energy_kcal' => 'required',
            'water_g' => 'required',
            'protein_g' => 'required',
            'fat_g' => 'required',
            'cho_g' => 'required',
            'fibre_g' => 'required',
            'ca_mg' => 'required',
            'p_mg' => 'required',
            'fe_mg' => 'required',
            'na_mg' => 'required',
            'k_mg' => 'required'
        ]);

        //getfilename with extension
        $fileNameWithExt = $request->file('food_image')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just extension
        $extension = $request->file('food_image')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'_'.$extension;
        //upload the image
        $path = $request->file('food_image')->storeAs('public/food_image',$fileNameToStore);


        $foodLibrary = new Food;

        $foodLibrary->food_name = request('food_name');
        $foodLibrary->food_image = $fileNameToStore;
        $foodLibrary->measurement_type = request('measurement_type');
        $foodLibrary->food_type = request('food_type');
        $foodLibrary->weigh_g = request('weigh_g');
        $foodLibrary->energy_kcal = request('energy_kcal');
        $foodLibrary->water_g = request('water_g');
        $foodLibrary->protein_g = request('protein_g');
        $foodLibrary->fat_g = request('fat_g');
        $foodLibrary->cho_g = request('cho_g');
        $foodLibrary->fibre_g = request('fibre_g');
        $foodLibrary->ca_mg = request('ca_mg');
        $foodLibrary->p_mg = request('p_mg');
        $foodLibrary->fe_mg = request('fe_mg');
        $foodLibrary->na_mg = request('na_mg');
        $foodLibrary->k_mg = request('k_mg');

        $foodLibrary->save();

        return redirect('/food')->with('success', 'Food Data entered');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show specific food data
        $foodLibrary = food::findOrFail($id);
        return view('food.show')->with('food', $foodLibrary);
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
        $foodLibrary = food::findOrfail($id);
        return view('food.edit')->with('food', $foodLibrary);
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
        //edit update data
        $this->validate($request, [
            'food_name' => 'required',
            'food_image' => 'image|max:1999',
            'measurement_type' => 'required',
            'food_type' => 'required',
            'weigh_g' => 'required',
            'energy_kcal' => 'required',
            'water_g' => 'required',
            'protein_g' => 'required',
            'fat_g' => 'required',
            'cho_g' => 'required',
            'fibre_g' => 'required',
            'ca_mg' => 'required',
            'p_mg' => 'required',
            'fe_mg' => 'required',
            'na_mg' => 'required',
            'k_mg' => 'required'
        ]);

        if ($request->hasFile('food_image')) {
            //getfilename with extension
            $fileNameWithExt = $request->file('food_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('food_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'_'.$extension;
            //upload the image
            $path = $request->file('food_image')->storeAs('public/food_image',$fileNameToStore);
        } else {
            $anime = food::find($id);
            $adik = $anime->food_image;
            $fileNameToStore = $adik;
        }
        
        


        $foodLibrary = food::find($id);

        $foodLibrary->food_name = request('food_name');
        $foodLibrary->food_image = $fileNameToStore;
        $foodLibrary->measurement_type = request('measurement_type');
        $foodLibrary->food_type = request('food_type');
        $foodLibrary->weigh_g = request('weigh_g');
        $foodLibrary->energy_kcal = request('energy_kcal');
        $foodLibrary->water_g = request('water_g');
        $foodLibrary->protein_g = request('protein_g');
        $foodLibrary->fat_g = request('fat_g');
        $foodLibrary->cho_g = request('cho_g');
        $foodLibrary->fibre_g = request('fibre_g');
        $foodLibrary->ca_mg = request('ca_mg');
        $foodLibrary->p_mg = request('p_mg');
        $foodLibrary->fe_mg = request('fe_mg');
        $foodLibrary->na_mg = request('na_mg');
        $foodLibrary->k_mg = request('k_mg');

        $foodLibrary->save();

        return redirect('/food')->with('sucess', 'data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete specific data
        $foodLibrary = food::findOrFail($id);
        $foodLibrary->delete();

        return redirect ('/food')->with('message','Food Deleted');
    }
}
