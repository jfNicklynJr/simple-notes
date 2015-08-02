<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use DB;

/*
    we are using the [ Note ] class and thus don't need to reference the use of DB
        - use DB;
*/
use App\Note;

class PublicController extends Controller
{
    public function create()
    {
        
        if (Auth::check()) { 
            $notes = DB::select('SELECT * FROM  `simple-notes` ORDER BY created_at DESC, user_id');
             return view('public.index', compact('notes'));        
        }
       
       return view('public.index');
    }

    public function post(Note $note, Request $request) {
       
       
       if (Auth::check()) {
           $this->validate($request, [
                    'title'   => ['required', 'min:3'],
                    'content' => ['required', 'min:3'],
                ]);
          
           $input = $request->only('title', 'content');
           $input = array_add($input, 'user_id', Auth::user()->id);
           $note->create($input);
           return back();
       } else {
           
            $errors = ['ERROR: You are not logged in, and are not authorized to add posts.'];     
            return back()->withErrors(compact('errors'));
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        
        if (Auth::check()) {
           $this->validate($request, [
                    'title'   => ['required', 'min:3'],
                    'content' => ['required', 'min:20'],
                ]);
          
           $input = $request->only('title', 'content', 'id');
           $input = array_add($input, 'user_id', Auth::user()->id);
       
           
           DB::table('simple-notes')
                ->where('id', $input['id'])
                ->update($input);
         
           return redirect('guests');
       } else {
           
            $errors = ['ERROR: You are not logged in, and are not authorized to add posts.'];     
            return back()->withErrors(compact('errors'));
       }
       
    }

    public function update($id)
    {
        
        $notes = DB::select('SELECT * FROM  `simple-notes` WHERE id = '. $id);
        if ($notes) {
            
            $note = $notes[0];
            return view('public.edit', compact('note'));
        } else {
            
            $errors = ['ERROR: Post not found!'];     
            return back()->withErrors(compact('errors'));
        }
    }

    public function destroy($id)
    {
        //
    }
    
    public function delete($id) {
       
       if (Auth::check()) {
        
            $notes = DB::select("SELECT * FROM `simple-notes` WHERE id = $id");
            
            if ($notes) {
             
                $note = $notes[0];
                
                if (Auth::user()->id == $note->user_id) {
                    
                    //DB::delete('DELETE from `simple-notes` WHERE id ='.$note->id);
                    return back();
                } else {
                
                    $errors = ['ERROR: You are not the owner of this note, you are not authorized to delete this post.'];     
                    return back()->withErrors(compact('errors'));
                }
            } else {
                $errors = ['ERROR: Post not found.'];     
                return back()->withErrors(compact('errors'));
            }
       } else {
            
            return back();
       
       //dd($note);
         
       }
       
      
    }
}
