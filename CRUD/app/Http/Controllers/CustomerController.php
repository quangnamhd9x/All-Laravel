<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    //
    function index(){
        $customer = Customer::all();
        return view('customers.list', compact('customer'));
    }
    function create(){
        return view('customers.create');
    }
    function store(Request $request){
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->save();
        \Illuminate\Support\Facades\Session::flash('success', 'Tạo mới khách hàng thành công');
        return redirect()->route('customers.index');
    }
    function edit($id){
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }
    function update(Request $request, $id){
        $customer = Customer::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->save();
        Session::flash('success', 'Cập nhật khách hàng thành công');
        return redirect()->route('customer.index');
    }
    function destroy($id){
        $customer = Customer::findOfFail($id);
        $customer->delete();
        Session::flash('success', 'Xóa khách hàng thành công');
        return redirect()->route('customer.index');
    }
}
