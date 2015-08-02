@extends('layout')

    @if($errors->any())
            <div class='error_msg'>
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
            
        @endif
    
@section ('content')

    
   <h2>Register</h2>
    <form method="POST" action="register">
    	{!! csrf_field() !!}
		
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input_form">
			<label>E-Mail Address</label>
			<input type="email" name="email" value="{{ old('email') }}"  placeholder="email">
			<label>Password</label>
			
			<input type="password" name="password" placeholder="password">
			<input type="password" name="password_confirmation"  placeholder="confirm password">
			
			<label>User Name</label>
			<input type="text" name="name" value="{{ old('name') }}"  placeholder="user name">
			
			
			<button type="submit">Register</button>
			<a href="login">already a member?</a>
		</div>
	</form>
    
@stop