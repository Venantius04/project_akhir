<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Mockery\Undefined;

class TransactionController extends Controller
{
    public function show()
    {
        $transactions = Transaction::all();
        $customers = Customer::all();

        return view('transactions', [
            "transactions" => $transactions,
            "customers" => $customers
        ]);
    }
    public function store(Request $request)
    {
        $input = $request->only('customer_id');
        if ($input['customer_id'] == 'guest') {
            $input['customer_id'] = null;
        }
        $transaction = Transaction::create($input);
        return redirect('transactions/' . $transaction->id);
    }
    public function showOneTransaction($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            if ($transaction->status_transaction == 'success') {
                return redirect('transactions');
            }
            $products = Product::all();
            $cart = session()->get('cart');
            return view('transaction-detail', [
                "transaction" => $transaction,
                "products" => $products,
                "cart" => $cart
            ]);
        } catch (\Throwable $th) {
            return redirect('transactions');
        }
    }
    public function storeSession(Request $request)
    {
        $input = $request->only('product_id', 'qty');
        $product = Product::find($input['product_id']);
        $input['qty'] = (int)$input['qty'];
        $total = $product->price * $input['qty'];
        if ($input['qty'] > $product->stock) {
            session()->flash('error', 'Stock barang ' . $product->product_name . ' Habis');
            return redirect()->back();
        }
        $input['total'] = $total;
        $input['product'] = $product;
        if (!session('cart')) {
            $request->session()->put('cart', [$input]);
        } else {
            $sessionBefore = session()->get('cart');
            $status = false;
            foreach ($sessionBefore as $key => $item) {
                if ($item['qty'] > $item['product']->stock) {
                    session()->flash('error', 'Stock Habis');
                    return redirect()->back();
                }
                if ($item['product_id'] == $input['product_id']) {
                    $sessionBefore[$key]['qty'] += $input['qty'];
                    $sessionBefore[$key]['total'] += $item['total'];
                    $status = true;
                }
            }
            if ($status) {
                $request->session()->put('cart', $sessionBefore);
            } else {
                array_push($sessionBefore, $input);
                $request->session()->put('cart', $sessionBefore);
            }
        }
        return redirect()->back();
        dd(session()->get('cart'));
    }
    public function deleteItem(Request $request, $id)
    {
        $sessionBefore = session()->get('cart');
        (int)$id;
        unset($sessionBefore[$id]);
        $newSession = array_values($sessionBefore);
        session()->put('cart', $newSession);
        return redirect()->back();
    }
    public function checkout(Request $request, $id)
    {
        $input = $request->only('pay');
        (int)$input['pay'];
        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->back()->with('error', 'Tolong input barang terlebih dahulu');
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['total'];
        }
        if ($input['pay'] < $total) {
            return redirect()->back()->with('error', 'Uang Customer Kurang..');
        }
        foreach ($cart as $item) {
            unset($item['product']);
            $product = Product::find($item['product_id']);
            $product->stock -= $item['qty'];
            $product->save();
            $item['transaction_id'] = $id;
            TransactionDetail::create($item);
        }
        Transaction::find($id)->update([
            "pay" => $input['pay'],
            "status_transaction" => "success",
            "total" => $total,
            "kembalian" => $input['pay'] - $total
        ]);

        session()->forget('cart');
        return redirect('transactions')->with('success', 'Transaction Success');
    }
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }
}
