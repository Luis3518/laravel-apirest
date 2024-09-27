<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function users(Request $request){
        if($request->has('active')){
            $users = User::where('active',true)->get();
        }else{
            $users = User::all();
        }
        return response()->json($users);
    }

    // Método existente para login
    public function login(Request $request){
        $response = ["status"=>0,"msg"=>""];
        $data = json_decode($request->getContent());
        $user = User::where('email',$data->email)->first();
        if($user){
            if(Hash::check($data->password,$user->password)){
                $token = $user->createToken("example");
                $response["status"] = 1;
                $response["msg"] = $token->plainTextToken;
            }else{
                $response["msg"] = "Credenciales incorrectas";
            }
        }else{
            $response["msg"] = "Credenciales incorrectas";
        }
        return response()->json($response);        
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Usuario creado exitosamente', 'user' => $user], 201);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|string|min:8',
        ]);

        $user->update($request->only(['name', 'email']));

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return response()->json(['message' => 'Usuario actualizado exitosamente', 'user' => $user]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Usuario eliminado exitosamente']);
    }
}