<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Hash;   
use Mail;
use Illuminate\Support\Facades\Input;
use Flash;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        if (Auth::check()) { 
            return redirect('guests');
            return 'welcome user'.Auth::user()->id;//Redirect::to('/note-pad');
        }
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
                'email'     => 'required',
                'password'  => 'required',
            ]);
            
       $credentials = $request->only('email', 'password');
        
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
           
            return redirect('login');
            return 'success';    
        }
        
        return 'attempted login ';
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        Auth::logout();
        
        return redirect('guests');
    }
    
     
    public function register() {
        
        return view('sessions.register');
    }
    
    public function newUser(Request $request) {
        
        $this->validate($request, [
                'email'     => 'required|min:6|unique:users',
                'password'  => 'required|confirmed|min:6',
                'name' => 'required|min:6|unique:users',
            ]);
        
         $input = $request->only(
            'name',
            'email',
            'password',
            'password_confirmation'
        );
        
        $confirmation_code = str_random(6);
       
       // return Input::get('email').', '.$confirmation_code;
       
         User::create([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password')),
            'confirmation_code' => $confirmation_code
        ]);

        Mail::send('email.verify', compact('confirmation_code'), function($message) {
            $message->to(Input::get('email'), Input::get('name'))
                ->subject('Verify your email address');
        });

        Flash::message('Thanks for signing up! Please check your email.');

        return redirect('login');

    }
}
