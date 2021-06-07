<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function login(Request $request){
        $user = User::where(['email'=>$request->email])->first();
        
        if(!$user || !Hash::check($request->password, $user->password)){
            return 'Email ou Mot de passe incorrect';
            //return back()->With('error', 'Email ou mot de passe invalide'); //->with('errors', 'Email ou Mot de passe incorrect');
        }else{
            $request->session()->put('user',$user);
            //return redirect('/');
            if($user->type == "USR"){
                //return redirect()->url()->previous();
                return redirect('/');
            }else{
                return redirect(route('dashboard'));
            }
        }
    }

    function register(Request $request){
        
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $password = Hash::make($request->password); //bcrypt($request->password);

        if(!User::where(['email'=>$request->email])->first()){
            $user = new User();
            $user->nom = $nom;
            $user->prenom = $prenom;
            $user->email = $email;
            $user->password = $password;
    
            $user->save();    
            return redirect('login');

        }else{
            return redirect()->back()->withErrors($error)->withInput("eroooooor");
        }
        
    }

    function clients(){
        $clients = DB::table('users')
                        ->where('type', 'USR')
                        ->get();
        return view('clients', ['clients'=>$clients]);
    }

    function blockUser($id){
        
        $User = User::find($id);
        $User->etat ='BLOCKED';
        $User->save();
        
        return redirect(route('clients'));
    }

    function unblockUser($id){
        
        $User = User::find($id);
        $User->etat ='AUTHORIZED';
        $User->save();
        
        return redirect(route('clients'));
    }
}
