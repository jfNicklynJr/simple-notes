@extends('layout')

@section ('content')
    
    <?php if (Auth::check()) { ?> 
        <div class="code_block">   
            <h1> EDIT! {{ $note->title }} </h1>
            <p1> {{ Auth::user()->name }} </p1>    
            
           <form method="POST" action="">
                <div class="code_block sub_block {{ (Auth::user()->id == $note->user_id)?'owners_select':'' }}">
                       <input name="_method"type="hidden" value="PATCH">
                       <input type=hidden name="_token" value="{{ csrf_token() }}">
                       <input name="id" value="{{ $note->id }}">
                   <p>
                       <label for="name">title:</label>
                       <input type="text" id="this_title" name="title" value="{{ $note->title }}">
                   </p>
                   <p>
                       <textarea rows="6" name="content">{{ $note->content }}</textarea>
                   </p>
                   <input type="submit">
                   <a href="{{ URL::previous() }}">Go Back</a>
                </div>
           </form>
        </div>
    <?php } ?>
@stop