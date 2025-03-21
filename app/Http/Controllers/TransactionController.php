<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function dashboard(){

        $user = auth()->user();
        $transactions = $user->Transaction;
        $total_credit=0;
        $total_debit= 0;
        $total_balance = $transactions->last()->balance;
        foreach($transactions as $trans){
            $total_credit =$total_credit + $trans->credit;
            $total_debit = $total_debit + $trans->debit;
        }

    //     if($request->input('search')){
    //         // Get the search query from the request
    //         $searchQuery = $request->input('search');

    // // Fetch transactions based on the search query
    //         $transactions = Transaction::where('user_id', auth()->id())
    //         ->where(function ($query) use ($searchQuery) {
    //             $query->where('transaction_number', 'LIKE', "%{$searchQuery}%")
    //             ->orWhere('transaction_type', 'LIKE', "%{$searchQuery}%")
    //               ->orWhereDate('created_at', $searchQuery); // Optionally filter by date
    //           })
    //     ->latest() // Order by latest
    //     ->paginate(10); // Paginate results (optional)

    // // Return the dashboard view with filtered transactions
    //     return view('dashboard',[
    //     'userData' => $user,
    //     'total_debit' => $total_debit,
    //     'total_credit' => $total_credit,
    //     'total_balance' => $total_balance,
    //     'transactions' => $transactions,  // Include the filtered transactions
    //     'searchQuery' => $searchQuery,    // Pass the search query
    // ]);
    // }
        

        return view('dashboard',[
            'userData' => $user,
            'total_debit' => $total_debit,
            'total_credit'=> $total_credit,
            'total_balance' => $total_balance,
        ]);
    }

    public function register(){
        return view('register');
    }

    public function registeruser(Request $request){
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:users,name'],
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|min:8|same:password',
        ]);
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);


        Transaction::create([
            'user_id' => $user->id,
            'transaction_type'=>'AccoutCreation',
            'transaction_number' => uniqid('TXN-'),
            'journal_number' => uniqid('JRN-'),
            'description' => 'Initial balance setup',
            'debit' => 0,
            'credit' => 0,
            'balance' => 0, 
            'created_at' => now(),
        ]);

        auth()->login($user);
        return redirect('/');
    }

    public function login(){
        return view('login');
    }
    
    public function loginuser(Request $request){
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255','exists:users,name'],
            'password' => 'required|min:8',
        ]);

        $user = User::where('name', $request->name)->first();
        $password = Hash::check($request->password, $user->password);
        if($password){
           auth()->login($user);
           return redirect('/');
       }

       return back()->withErrors(['password' => 'password sio sahihi, rudia tena']);
   }

   public function logout(){
    auth()->logout();
    return redirect()->Route('login');
}


public function deposit(){
    $user = auth()->user();
    return view('deposit', [
     'userData' => $user,
 ]);
}

public function userdeposit(Request $request){
    $request->validate([
        'depositAmount' => ['required', 'numeric', 'min:1','max:15000000'],
        'description'=> 'string | max:20 |min:0',
    ]);

    $user = auth()->user();
    $balance = $user->Transaction->last()->balance;
    $newBalance = $balance + $request->depositAmount;


    Transaction::create([
        'user_id' => $user->id,
        'transaction_type'=>'Deposit',
        'transaction_number' => uniqid('TXN-'),
        'journal_number' => uniqid('JRN-'),
        'description' => $request->description??'No description',
        'debit' => 0,
        'credit' => $request->depositAmount,
        'balance' => $newBalance, 
        'created_at' => now(),
    ]);
    return redirect('/deposit')->with('success', 'Deposit successful'); 
}
public function withdraw(){
    $user = auth()->user();
    return view('withdraw', [
     'userData' => $user,
 ]);
}

public function userwithdraw(Request $request){
    $request->validate([
        'withdrawAmount' => ['required', 'numeric', 'min:1','max:15000000'],
        'description'=> 'min:0 | string | max:20',
    ]);

    $user = auth()->user();
    $balance = $user->Transaction->last()->balance;
    $newBalance = $balance - $request->withdrawAmount;


    Transaction::create([
        'user_id' => $user->id,
        'transaction_type'=>'withdraw',
        'transaction_number' => uniqid('TXN-'),
        'journal_number' => uniqid('JRN-'),
        'description' => $request->description??'No description',
        'debit' => $request->withdrawAmount,
        'credit' => 0,
        'balance' => $newBalance, 
        'created_at' => now(),
    ]);
    return redirect('/withdraw')->with('success', 'withdraw successful'); 
}

public function transfer(){
    $user = auth()->user();
    $otherUser = User::all()->except($user->id);
    return view('transfer', [
     'userData' => $user,
     'otherUserData' => $otherUser,
 ]);
}

public function userTransferMoney(Request $request){

    $request->validate([
        'transferAmount' => ['required', 'numeric', 'min:1','max:15000000'],
        'description'=> 'min:0 | string | max:20',
        'ReceiverName' => ['required', 'string', 'max:255','exists:users,name'],
    ]);
    

    $user = auth()->user();
    $balance = $user->Transaction->last()->balance;
    $newUserBalance = $balance - $request->transferAmount;

    $RecieverUser = User::where('name', $request->ReceiverName)->first();
    $RecieverBalance = $RecieverUser->Transaction->last()->balance;
    $newRecieverBalance = $RecieverBalance + $request->transferAmount;


    Transaction::create([
        'user_id' => $user->id,
        'transaction_type'=>'transfer',
        'transaction_number' => uniqid('TXN-'),
        'journal_number' => uniqid('JRN-'),
        'description' => $request->description??'No description',
        'debit' => $request->transferAmount,
        'credit' => 0,
        'balance' => $newUserBalance, 
        'created_at' => now(),
    ]);

    Transaction::create([
        'user_id' => $RecieverUser->id,
        'transaction_type'=>'Recieved',
        'transaction_number' => uniqid('TXN-'),
        'journal_number' => uniqid('JRN-'),
        'description' => $request->description??'No description',
        'debit' => 0,
        'credit' => $request->transferAmount,
        'balance' => $newRecieverBalance, 
        'created_at' => now(),
    ]);
    return redirect('/transfer')->with('success', 'transfer successful'); 
}
public function search(Request $request){
    $search_query = $request->search; // Get the search input
    
    $filtered_transactions = Transaction::where('user_id', auth()->id()) // Filter by the logged-in user
        ->where(function($query) use ($search_query) {
            $query->where('transaction_number', 'LIKE', "%{$search_query}%")
                  ->orWhere('transaction_type', 'LIKE', "%{$search_query}%")
                  ->orWhereDate('created_at', $search_query);
        })
        ->latest()
        ->get();

    return view('dashboard', compact('filtered_transactions')); // Pass data to the view
}

}
