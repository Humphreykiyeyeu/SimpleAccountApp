<x-layout>
	<h1 class="text-center pt-5">Deposit</h1>
	<form method="POST" action="/userdeposit">
		@csrf 
		<div class='container pt-4 col-4'>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="Deposit for" name="name" value="{{$userData->name}}: {{$userData->AccNumber}}" disabled>
				<label for="floatingInput">Deposit to</label>
				@error('name')
				<p class="text-danger">{{$message}}</p>
				@enderror
			</div>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="Description" name="description" value="{{old('description')}}">
				<label for="floatingPassword">Description</label>
				@error('description')
				<p class="text-danger">{{$message}}</p>
				@enderror
			</div>
			<div class="form-floating mb-3">
				<input type="number" class="form-control" id="floatingInput" placeholder="deposit amount" name="depositAmount">
				<label for="floatingInput">Deposit Amount</label>
				@error('depositAmount')
				<p class="text-danger">{{$message}}</p>
				@enderror
			</div>
			<div class="text-center mb-3">
				<button class="btn btn-primary" type="submit">Submit form</button>
			</div>
			<div>
				<p class="text-center small">Am done! return to <a href="/">Dashboard</a></p>
			</div>
		</div>
	</form>
</x-layout>
