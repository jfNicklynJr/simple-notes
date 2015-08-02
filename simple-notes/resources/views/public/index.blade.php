@extends('layout')
    
         @if($errors->any())
            <div class='error_msg'>
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
            
        @endif
    
@section ('content')

       
        
        <?php if (Auth::check()) { ?> 
            
            <h2>Welcome <strong>{{ Auth::user()->name }}</strong></h2>
            
            <div class="code_block">
                <a href="/simple-notes/public/logout">log out</a> 
            
                   @foreach($notes as $note) 
                    <div class="code_block sub_block {{ (Auth::user()->id == $note->user_id)?'owners_select':'' }}">
                        <h2>{{ $note->title }}</h2>
                        <p>{{ $note->content }}</p>
                        <div class='time_stamps'>
                            created:<span> {{ $note->created_at }}&nbsp;</span>
                            updated:<span > {{ $note->updated_at }} </span>
                             <?php if (Auth::check()  && Auth::user()->id == $note->user_id) { ?> 
                               <span>&nbsp;[&nbsp;<a href="notes/delete/{{$note->id}}">delete</a>&nbsp;]</span>
                               <span>&nbsp;[&nbsp;<a href="notes/edit/{{$note->id}}">edit</a>&nbsp;]</span>
                              
                            <?php } ?>
                        </div>
                    </div>
                @endforeach
            
                 <div class="code_block sub_block owners_select">
                      <form method="POST" action="" >
                           <input type=hidden name="_token" value="{{ csrf_token() }}">
                       <p>
                           <h2 style="margin-left:-20px;">Create a new note</h2>
                           <input type="text" id="this_title" name="title" placeholder="new note title">
                       </p>
                       <p>
                           <textarea rows="6" name="content"  placeholder="new note content"></textarea>
                       </p>
                       <input type="submit">
                    </form>  
               </div>
           
        <?php } else { ?>
        
            <h2>Welcome <strong>Guest</strong></h2>
        
            <div class="code_block">
                
                This is an academic site, creating a simple note-pad;
                To edit the notepad you must be <a href="/simple-notes/public/login">logged in</a>
            
        
        <?php } ?>
        
         
        </div>
        
@stop