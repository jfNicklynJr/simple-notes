@extends('layout')

@section ('content')

    
   <h2>Login</h2>
    <form method="POST" action="login">
    	{!! csrf_field() !!}
		
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input_form">
			<label>E-Mail Address</label>
			<input type="email" name="email" value="{{ old('email') }}">
			<label>Password</label>
			<input type="password" name="password">
				<button type="submit">Login</button>
				<a href="register">not a member?</a>
		</div>
	</form>
    
@stop