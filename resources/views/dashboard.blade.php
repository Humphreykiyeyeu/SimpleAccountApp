<x-layout>


	<div class="container mt-4 method='GET'">
		<!-- Search form -->
		 <div class="d-flex justify-content-center mb-4">
			<form method = 'GET' class="d-flex w-50" action="/">
				<input class="form-control me-2" type="search" placeholder="Search by Date, account journal number or transaction type" aria-label="Search" name='search'>
				<button class="btn btn-outline-primary" type="submit">Search</button>
			</form>
		</div> 

		<!-- User data table -->
		<div class="table-responsive mb-4">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Username</th>
						<th>Account Number</th>
						<th>Total Balance</th>
						<th>Total Credit</th>
						<th>Total Debit</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{auth()->user()->name}}</td>
						<td>{{$userData->AccNumber}}</td>
						<td>{{$total_balance}}</td>
						<td>{{$total_credit}}</td>
						<td>{{$total_debit}}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- transaction table -->
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Date</th>
						<th>Transaction Number</th>
						<th>Journal Number</th>
						<th>Description</th>
						<th>Transaction Type</th>
						<th>Debit</th>
						<th>Credit</th>
						<th>Balance</th>
					</tr>
				</thead>
				<tbody>
			@if($filtered_transactions)  
                
                @foreach($filtered_transactions->reverse() as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at }}</td>
                        <td>{{ $transaction->transaction_number }}</td>
                        <td>{{ $transaction->journal_number }}</td>
                        <td>{{ $transaction->description }}</td>
                        @if($transaction->transaction_type == 'withdraw')
                            <td class="text-danger">{{ $transaction->transaction_type }}</td>
                        @elseif($transaction->transaction_type == 'Deposit')
                            <td class="text-success">{{ $transaction->transaction_type }}</td>
                        @else
                            <td class="text-info">{{ $transaction->transaction_type }}</td>
                        @endif
                        <td>{{ $transaction->debit }}</td>
                        <td>{{ $transaction->credit }}</td>
                        <td>{{ $transaction->balance }}</td>
                    </tr>
                @endforeach
            @else  
                
                @foreach($userData->transaction->reverse() as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at }}</td>
                        <td>{{ $transaction->transaction_number }}</td>
                        <td>{{ $transaction->journal_number }}</td>
                        <td>{{ $transaction->description }}</td>
                        @if($transaction->transaction_type == 'withdraw')
                            <td class="text-danger">{{ $transaction->transaction_type }}</td>
                        @elseif($transaction->transaction_type == 'Deposit')
                            <td class="text-success">{{ $transaction->transaction_type }}</td>
                        @else
                            <td class="text-info">{{ $transaction->transaction_type }}</td>
                        @endif
                        <td>{{ $transaction->debit }}</td>
                        <td>{{ $transaction->credit }}</td>
                        <td>{{ $transaction->balance }}</td>
                    </tr>
                @endforeach
            @endif
					
				</tbody>
			</table>
		</div>

	</div>



</x-layout>
