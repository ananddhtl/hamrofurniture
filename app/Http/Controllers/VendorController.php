<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
    public function vendorlogin(Request $request)
    {
       
        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                dd(Auth::user()->is_vendor);
                if (Auth::user()->is_vendor) {
                    return redirect('/vendor-dashboard');
                } else {
                    
                    return redirect('/some-non-vendor-page');
                }
            }

            return back()->withErrors(['email' => 'Invalid login credentials.']);
        }

        return redirect('auth.login');
    }
    public function vendorregister(Request $request)
    {
        
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'address' => 'required',
                'phone' => 'required',

            ]);
            $vendor = new Vendor;
            $vendor->name = $request->name;
            $vendor->email = $request->email;
            $vendor->address = $request->address;
            $vendor->phone = $request->phone;
            $vendor->password = bcrypt($request->password);
            $vendor->is_vendor = true;
            $vendor->save();
            Auth::login($vendor);
            return redirect('/vendor-login');
        }

        return view('admin.register');
    }
}