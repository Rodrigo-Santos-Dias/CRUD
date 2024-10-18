<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getStates()
    {
        $response = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
        return response()->json($response->json());
    }

    public function getCities($id)
    {
        $response = Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$id}/municipios");
        return response()->json($response->json());
    }




    public function register(Request $request){
        $incomingFields = $request -> validate(
            [   'name'=>'required',
                'cpf'=> 'required',
                'birthdate'=> 'required',
                'email'=> 'required',
                'phone'=> 'required',
                'address'=> 'required',
                'state'=> 'required',
                'city'=> 'required',
            ]);

            User::create([
                'name' => $incomingFields['name'],
                'cpf' => $incomingFields['cpf'],
                'birthdate' => $incomingFields['birthdate'],
                'email' => $incomingFields['email'],
                'phone' => $incomingFields['phone'],
                'address' => $incomingFields['address'],
                'state' => $incomingFields['state'],
                'city' => $incomingFields['city'],
                
            ]);            
            return redirect('home');
    }

    public function editUser(Request $request, User $user)
    {
        
        $incomingFields = $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'birthdate' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);
    
       
        $user->update([

            'name' => $incomingFields['name'],
            'cpf' => $incomingFields['cpf'],
            'birthdate' => $incomingFields['birthdate'],
            'email' => $incomingFields['email'],
            'phone' => $incomingFields['phone'],
            'address' => $incomingFields['address'],
            'state' => $incomingFields['state'],
            'city' => $incomingFields['city'],
        ]);
    
        
            return redirect('home');
    }
    

    public function deleteUser(User $user){
        $user -> delete();
        return redirect('home');

    }

}
