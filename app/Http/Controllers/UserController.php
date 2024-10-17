<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request){
        $incomingFields = $request -> validate(
            [   'name'=>'required',
                'cpf'=> 'required',
                'birthdate'=> 'required',
                'email'=> 'required',
                'phone'=> 'required',
                'address'=> 'required',
                #'state'=> 'required',
                #'city'=> 'required',
            ]);

            User::create([
                'name' => $incomingFields['name'],
                'cpf' => $incomingFields['cpf'],
                'birthdate' => $incomingFields['birthdate'],
                'email' => $incomingFields['email'],
                'phone' => $incomingFields['phone'],
                'address' => $incomingFields['address'],
                
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
            // 'state' => 'required',
            // 'city' => 'required',
        ]);
    
       
        $user->update([

            'name' => $incomingFields['name'],
            'cpf' => $incomingFields['cpf'],
            'birthdate' => $incomingFields['birthdate'],
            'email' => $incomingFields['email'],
            'phone' => $incomingFields['phone'],
            'address' => $incomingFields['address'],
        ]);
    
        
            return redirect('home');
    }
    

    public function deleteUser(User $user){
        $user -> delete();
        return redirect('home');

    }

}
