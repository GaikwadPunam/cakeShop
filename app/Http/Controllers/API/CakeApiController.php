<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cake;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CakeApiController extends Controller
{
    public function index(Request $request){
        try{
            $cakes=cake::all();
            return response()->json([
                'cakes'=>$cakes
            ], 200);
        }
    
        catch(\Exception $exception){
            return response()->json(['error'=>$exception->getmessage()],403);


        }
    }

    public function store(Request $request){

        $validated = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

      ]);
      if ($validated->fails()){
          return response()->json( $validated->errors(),403);

}
try{
    $cake = new cake();
    $cake->name = $request->name;
    $cake->description = $request->description;
    $cake->price = $request->price;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('cakes', 'public');
        $cake->image = $imagePath;
    }

$cake->save(); 
return response()->json([
    'message' => 'product added successfully',
'cake_id'=> $cake->id
    
], 200); 
}
catch(\Exception $th){
    return response()->json(['error'=>$th->getmessage()],403);
}

    }

    public function deleteProduct(Request $request, $cake_id){
        try{
            $cake =cake::find($cake_id);
            $cake->delete();
            return response()->json([
                'message'=>'productdeleted successfully'
            ], 200);   
        }
        catch(\Exception $th){
            return response()->json(['error'=>$th->getmessage()],403);
    
    
        }
    }
    public function editProduct(Request $request, $id)
    {
        // Validate incoming request
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        if ($validated->fails()) {
            return response()->json($validated->errors(), 403);
        }
    
        try {
            // Fetch the cake by its ID
            $cake_data = Cake::find($id); // Use $id instead of $request->cake_id
            
            if (!$cake_data) {
                // If cake is not found, return a 404 error
                return response()->json(['message' => 'Product not found'], 404);
            }
    
            // Update product data
            $cake_data->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);
    
            // Check if there's an image file and update it
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('cakes', 'public');
                $cake_data->image = $path;
                $cake_data->save(); // Don't forget to save after updating the image
            }
    
            // Return response with success message and updated product
            return response()->json([
                'message' => 'Product updated successfully',
                'updated_product' => $cake_data, // Return the updated product object
            ], 200);
    
        } catch (\Exception $th) {
            // Return error message in case of failure
            return response()->json(['error' => $th->getMessage()], 403);
        }
    }
        


    public function update(Request $request, $id)
    {
        $cake = cake::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cakes', 'public');
            $cake->image = $path;
        }

        $cake->update($request->only(['name', 'description', 'price']));

        return response()->json($cake);
    }

    public function destroy($id)
    {
        cake::findOrFail($id)->delete();

        return response()->json(['message' => 'Cake deleted']);
    }
}
