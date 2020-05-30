@extends('layouts.app')

@section('content')
    {{-- <div class="flex-center position-ref full-height">
        <p>create new food ...</p>
    </div> --}}
    <div class="container">
        @extends('layouts.sidebarFoodLib')
        <div class="card">
            <div class="card-header">
                <p>Create a New Food</p>
            </div>
            <div class="card-subtitle">
                <p class="text-danger" style="text-align: center; padding-top:10px">Please dont leave any section blank !</p>
            </div>
            <div class="card-body">
                <form action="/food" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="food_name">Food Name : </label>
                        <input type="text" id="food_name" name="food_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="food_image">Food Image : </label>
                        <input type="file" name="food_image" id="food_image">
                    </div>
                    <div class="form-group wrapper">
                        <div>
                            <label for="food_type">Food type : </label>
                            <select name="food_type" id="food_type">
                                <option value="food">Food</option>
                                <option value="drink">Drink</option>
                            </select>
                        </div>
                        <div>
                            <label for="measurement_type">Measurement Type :</label>
                            <select name="measurement_type" id="measurement_type">
                                <option value="cup">Cup</option>
                                <option value="piece">Piece</option>
                                <option value="spoon">Spoon</option>
                                <option value="ml">ml</option>
                                <option value="bowl">Bowl</option>
                                <option value="plate">Plate</option>
                                <option value="set">Set</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group wrapper">
                        <div>
                            <label for="weigh_g">Food Weigh (g) :</label>
                            <input type="number" name="weigh_g" id="weigh_g" step="0.01">
                        </div>
                        <div>
                            <label for="energy_kcal">Food Energy (kcal) :</label>
                            <input type="number" name="energy_kcal" id="energy_kcal" step="0.01">
                        </div>
                    </div>
                    <div class="form-group wrapper">
                        <div>
                            <label for="water_g">Food Water content (g) :</label>
                            <input type="number" name="water_g" id="water_g" step="0.01">
                        </div>
                        <div>
                            <label for="protein_g">Protein (g) :</label>
                            <input type="number" name="protein_g" id="protein_g" step="0.01">
                        </div>
                    </div>
                    <div class="form-group wrapper">
                        <div>
                            <label for="fat_g">Fat (g) :</label>
                            <input type="number" name="fat_g" id="fat_g" step="0.01">
                        </div>
                        <div>
                            <label for="cho_g">Carbohydrates (g) :</label>
                            <input type="number" name="cho_g" id="cho_g" step="0.01">
                        </div>
                    </div>
                    <div class="form-group wrapper">
                        <div>
                            <label for="fibre_g">Fibre (g) :</label>
                            <input type="number" name="fibre_g" id="fibre_g" step="0.01">
                        </div>
                        <div>
                            <label for="ca_mg">Calcium (mg) :</label>
                            <input type="number" name="ca_mg" id="ca_mg" step="0.01">
                        </div>
                    </div>
                    <div class="form-group wrapper">
                        <div>
                            <label for="p_mg">Phosphorus (mg) :</label>
                            <input type="number" name="p_mg" id="p_mg" step="0.01">
                        </div>
                        <div>
                            <label for="fe_mg">Ferum/Iron (mg) :</label>
                            <input type="number" name="fe_mg" id="fe_mg" step="0.01">
                        </div>
                    </div>
                    <div class="form-group wrapper">
                        <div>
                            <label for="na_mg">Sodium (mg) :</label>
                            <input type="number" name="na_mg" id="na_mg" step="0.01">
                        </div>
                        <div>
                            <label for="k_mg">Potassium (mg) :</label>
                            <input type="number" name="k_mg" id="k_mg" step="0.01">
                        </div>
                    </div>
                    
                    <input type="submit" value="Save Data" style="float: right">
                </form>
            </div>
            
        </div>
        
    </div>
@endsection


