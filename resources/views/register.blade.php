<x-layout>
	<h1 class="text-center pt-5">Registration form</h1>
	<form method="POST" action="/registeruser">
		@csrf 
		<div class='container pt-4 col-4'>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="Enter your name" name="name" value="{{old('name')}}">
				<label for="floatingInput">Username</label>
				@error('name')
				<p class="text-danger">{{$message}}</p>
				@enderror
			</div>
			<div class="form-floating mb-3">
				<input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
				<label for="floatingPassword">Password</label>
				@error('password')
				<p class="text-danger">{{$message}}</p>
				@enderror
			</div>
			<div class='form-floating mb-3'>	
				<input type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password" name="password_confirmation">
				<label for="floatingPassword">Confirm Password</label>
				@error('password_confirmation')
				<p class="text-danger">{{$message}}</p>
				@enderror
			</div>
			<div class="text-center mb-4">
				<button class="btn btn-primary" type="submit">Submit form</button>
			</div>
			<div>
				<p class="text-center small">Already have an account?, click <a href="/login">here</a></p>
			</div>
		</div>
	</form>
</x-layout>
