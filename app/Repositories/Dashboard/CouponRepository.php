<?php

namespace App\Repositories\Dashboard;

use App\Models\Coupon;

class CouponRepository
{

    public function getcoupons()
    {
       $coupons = Coupon::latest()->get();
       return $coupons;
    }
    public function getcoupon($id)
    {
        $coupon = Coupon::find($id);
        return $coupon;
    }
    public function createcoupon($data)
    {
        $coupon = Coupon::create($data);
        return $coupon;
    }
    public function updatecoupon($coupon, $data)
    {
       return $coupon->update($data);
    }
    public function deletecoupon($coupon)
    {
       return $coupon->delete();
    }


}
