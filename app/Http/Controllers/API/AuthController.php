<?php
namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;



use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public function register(Request $request)
    {
       // $validated = $request->validate([
        //    'name' => 'required|string|max:225',
          //  'email' => 'required|string|email|max:225|unique:users',
          //  'password' => 'required|string|min:6|confirmed',
          $validated =Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'address' => 'required',
            'contact_number' => 'required|unique:users',

        ]);
        if ($validated->fails()){
            return response()->json( $validated->errors(),403);
        }
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->contact_number,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                ]);
    
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'access_token' => $token,
                'user' => $user
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json(['error'=>$exception->getmessage()],403);
        }

        }
    
        public function login(Request $request){

            $validated = Validator::make($request->all(),[
              'email' => 'required|string|email',
             'password' => 'required|string|min:6',
  
          ]);
          if ($validated->fails()){
              return response()->json( $validated->errors(),403);
          }
          $credentials = ['email' => $request->email, 'password'=> $request->password];
          try{
            if(!auth()->attempt($credentials)){
                return response()->json(['error'=>'invalid credentials'],403);
            }
                $user = User::where('email' , $request->email)->firstOrFail();
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'access_token' => $token,
                    'user' => $user
                ], 200);

            

          }        catch(\Exception $th){
            return response()->json(['error'=>$th->getmessage()],403);
        }

  
        }
        public function logout(Request $request){
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message'=> 'user has been logged out successfully'
                
            ], 200);


 
        }

}