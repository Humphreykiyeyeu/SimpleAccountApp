<x-layout>
	<h1 class="text-center pt-5">Transfer Money</h1>
	<form method="POST" action="/userTransferMoney">
		@csrf 
		<div class='container pt-4 col-4'>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="Deposit for" name="name" value="{{$userData->name}}:  {{$userData->AccNumber}}" disabled>
				<label for="floatingInput">Transfer from</label>
				@error('name')
				<p class="text-danger">{{$message}}</p>
				@enderror
			</div>
			<div class="form-group form-floating mb-3">
				<select class="form-control" id="floatingInput" name="ReceiverName">
					@foreach($otherUserData as $otherUser)
					<option value="{{$otherUser->name}}">{{$otherUser->name}}: {{$otherUser->AccNumber}}</option>
					@endforeach
				</select>
				<label for="floatingInput">Send to</label>
				@error('ReceiverName')
				<p class="text-danger">{{$message}}</p>
				@enderror
			</div>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="Description" name="description" value="{{old('description')}}">
				<label for="floatingInput">Description</label>
				@error('description')
				<p class="text-danger">{{$message}}</p>
				@enderror
			</div>
			<div class="form-floating mb-3">
				<input type="number" class="form-control" id="floatingInput" placeholder="send amount" name="transferAmount">
				<label for="floatingInput">Amount to transfer</label>
				@error('transferAmount')
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
