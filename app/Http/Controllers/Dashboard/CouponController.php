<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CouponRequest;
use App\Services\Dashboard\CouponService;
class CouponController extends Controller
{
    protected $couponService;
    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function index()
    {
        return view('dashboard.coupons.index');
    }

    public function getAll()
    {
        return $this->couponService->getcouponsForDatatables();
    }
    public function create()
    {
        return view('dashboard.coupons.create');
    }

    public function store(CouponRequest $request)
    {
        // dd($request->all());
        $data = $request->only(['code', 'discount_percentage', 'limit', 'time_used', 'status', 'start_date', 'end_date']);
        $coupon = $this->couponService->createcoupon($data);

        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.general_error'),
            ], 500);

        }
        return response()->json([
            'status' => 'success',
            'message' => __('messages.added_successfully')
        ], 201);


    }

    public function edit(string $id)
    {
        $coupon = $this->couponService->getcoupon($id);
        return view('dashboard.coupons.edit', compact('coupon'));

    }
    public function update(CouponRequest $request, string $id)
    {
        $data = $request->only(['code', 'discount_percentage', 'limit', 'time_used', 'status', 'start_date', 'end_date']);
        // dd($data);
        $coupon = $this->couponService->updatecoupon($id, $data);
        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.general_error'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('messages.updateed_successfully')
        ], 201);

    }

    public function destroy(string $id)
    {
        if (!$this->couponService->deletecoupon($id)) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.general_error'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('messages.deleted_successfully')
        ], 201);

    }


}
