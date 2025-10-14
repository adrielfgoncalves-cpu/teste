<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


use function PHPUnit\Framework\isNull;
use Illuminate\Validation\ValidationException;

class userController extends Controller
{
    public function create(){
        return view('users.create');
    }
    
    public function add(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:3',
            ]);
            User::create($request->all());
            return redirect()->route('user.create')->with('success', 
            'Usuário cadastrado com sucesso!');

        } catch (\Illuminate\Validation\ValidationException $e) {
          // return dd($e);
            return back()->withInput()->with('error', 
           $e->getMessage());
        }
        
    }
    public function update(Request $request, User $user)
    {
     try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
              
            ]);
            User::update($request->all());
            return redirect()->route('view.list')->with('success', 
            'Usuário editado com sucesso!');

        } catch (ValidationException $e) {
          // return dd($e);
            return back()->withInput()->with('error', 
           $e->getMessage());
        }
        //retorna view-list
        
    }   
    public function delete($id)
    {
        try {
          if (!isNull($id) and $id != 0) {
              User::delete($id);
         }
            return "deletado";
        } catch (ValidationException $e) {
            return "error";        
        }
       
    }
    public function view($id)
    {
         $users = User::find($id,  
            ['id',
            'name', 
            'email'
        ]);
         
         return view('users.view', ['users' => $users]);
         
    }
    public function list()
    {
        $users = User::all( 
            'id', 'name', 'email'
         ); 
         //dd($users);
        return view('users.list', compact('users'));
    }
}
