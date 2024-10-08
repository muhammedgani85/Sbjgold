<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use App\Models\Roles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LoanHelper;
use App\Models\Customer;
use App\Models\OccupationModel;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;



class CustomerManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $location = session('user_data')->location;

        $customers = Customer::orderBy('id', 'DESC')->where('location_id', $location)->get();

        $totalCustomers = $customers->count();

        // Count customers added today
        $todayCustomers = $customers->where('created_at', '>=', Carbon::today())->count();

        // Count customers added this week
        $weekCustomers = $customers->where('created_at', '>=', Carbon::now()->startOfWeek())->count();

        // Count customers added this month
        $monthCustomers = $customers->where('created_at', '>=', Carbon::now()->startOfMonth())->count();

        return view('content.customermanagement.dashboard', compact('customers', 'todayCustomers', 'weekCustomers', 'monthCustomers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {

        try {
            $data = session('user_data');


            if ($data) {
                $location = $data->location;
                $location_short_code = Branch::where('id', $location)->first();
                $locationCode = $location_short_code->branch_prefix . '-C'; // Adjust based on your location logic
                $customerCount = Customer::where('location_id', $location)->count();
                $customerId = $locationCode . '-' . str_pad($customerCount + 1, 4, '0', STR_PAD_LEFT);
                $occupations = OccupationModel::where('status', 'Active')->get();
                $branchs = Branch::where('status', 'Active')->get();
                $employee = [];
                return view('content.customermanagement.newcustomer', compact('occupations', 'branchs', 'employee', 'customerId', 'location'));
            } else {
                return redirect()->route('/login_verfication');
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|unique:customers',
            'initial' => 'required|max:2',
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'nullable',
            'spouse_name' => 'nullable',
            'gender' => 'required',
            'dob' => 'required|date',
            'marital_status' => 'required',
            'phone_number' => 'required|digits_between:10,13',
            'emergency_number' => 'required|digits_between:10,13',
            'email_id' => 'nullable|email|unique:customers',
            'city' => 'required',
            'permanent_address' => 'required',
            'communication_address' => 'required',
            'ward' => 'nullable',
            'aadhar_number' => 'required|digits:16|unique:customers',
            'driving_license_number' => 'nullable',
            'pan' => 'nullable',
            'occupation_id' => 'required|exists:occupation_models,id',
            /* 'occupation_type' => 'required', */
            /* 'job_type_details' => 'required', */
            'r_name' => 'nullable',
            'r_phone' => 'nullable',
            'r_address' => 'nullable',
            'r_name1' => 'nullable',
            'r_phone1' => 'nullable',
            'r2_address' => 'nullable',
            'r_others' => 'nullable',
            'customer_photo' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'customer_aadharr' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            /* 'customer_other' => 'nullable|file|mimes:jpg,jpeg,png',
            'account_holder_name' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required|unique:customers',
            'ifsc' => 'required',
            'gpay_no' => 'nullable' */
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();

        if ($request->hasFile('customer_photo')) {
            $data['customer_photo'] = $request->file('customer_photo')->store('photos');
        }

        if ($request->hasFile('customer_aadharr')) {
            $data['customer_aadharr'] = $request->file('customer_aadharr')->store('aadhar');
        }

        if ($request->hasFile('customer_other')) {
            $data['customer_other'] = $request->file('customer_other')->store('documents');
        }

        Customer::create($data);

        return response()->json(['success' => 'Customer created successfully']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('content.customermanagement.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $location = session('user_data')->location;
        $customer = Customer::findOrFail($id);
        $occupations = OccupationModel::where('status', 'Active')->get();
        return view('content.customermanagement.edit_customer', compact('location', 'customer', 'occupations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'customer_id' => 'required',
                'initial' => 'required|max:2',
                'first_name' => 'required',
                'last_name' => 'required',
                'father_name' => 'nullable',
                'spouse_name' => 'nullable',
                'gender' => 'required',
                'dob' => 'required|date',
                'marital_status' => 'required',
                'phone_number' => 'required|digits_between:10,13',
                'emergency_number' => 'required|digits_between:10,13',
                'email_id' => 'nullable|email|unique:customers',
                'city' => 'required',
                'permanent_address' => 'required',
                'communication_address' => 'required',
                'ward' => 'nullable',
                'aadhar_number' => 'required|digits:16',
                'driving_license_number' => 'nullable',
                'pan' => 'nullable',
                'occupation_id' => 'required|exists:occupation_models,id',
                /* 'occupation_type' => 'required', */
                /* 'job_type_details' => 'required', */
                'r_name' => 'nullable',
                'r_phone' => 'nullable',
                'r_address' => 'nullable',
                'r_name1' => 'nullable',
                'r_phone1' => 'nullable',
                'r2_address' => 'nullable',
                'r_others' => 'nullable',
                'customer_photo' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
                'customer_aadharr' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
                /* 'customer_other' => 'nullable|file|mimes:jpg,jpeg,png',
                'account_holder_name' => 'required',
                'bank_name' => 'required',
                'account_number' => 'required|unique:customers',
                'ifsc' => 'required',
                'gpay_no' => 'nullable' */
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = $request->all();

            if ($request->hasFile('customer_photo')) {
                $data['customer_photo'] = $request->file('customer_photo')->store('photos');
            }

            if ($request->hasFile('customer_aadharr')) {
                $data['customer_aadharr'] = $request->file('customer_aadharr')->store('aadhar');
            }

            if ($request->hasFile('customer_other')) {
                $data['customer_other'] = $request->file('customer_other')->store('documents');
            }
            $customer = Customer::findOrFail($id);
            $customer->update($request->all());

            return response()->json(['success' => 'Customer updated successfully']);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function softDelete($id)
    {
        $user = Customer::find($id);

        if ($user) {
            $user->status = 'Inactive';
            // $user->deleted_at = now();
            $user->save();

            return response()->json(['success' => true, 'message' => 'User status updated to Inactive.']);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }
    }
}
