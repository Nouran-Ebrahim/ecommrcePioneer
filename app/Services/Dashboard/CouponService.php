<?php

namespace App\Services\Dashboard;

use Nette\Utils\Image;
use App\Utils\ImageManger;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\CouponRepository;

class CouponService
{

    protected $couponRepository, $imageManger;

    public function __construct(CouponRepository $couponRepository, ImageManger $imageManger)
    {
        $this->couponRepository = $couponRepository;
        $this->imageManger = $imageManger;
    }
    public function getcoupon($id)
    {
        $coupon = $this->couponRepository->getcoupon($id);
        if (!$coupon) {
            abort(404);
        }
        return $coupon;
    }
    public function getcouponsForDatatables()
    {

        $coupons = $this->couponRepository->getcoupons();
        return DataTables::of($coupons)
            ->addIndexColumn()


            ->addColumn('action', function ($coupon) {
                return view('dashboard.coupons.datatables.actions', compact('coupon'));
            })
            ->addColumn('discount_percentage', function ($row) {
                return $row->discount_percentage . ' %';

            })
            ->rawColumns(['action']) // for render html content
            ->make(true);
    }

    public function createcoupon($data)
    {

        return $this->couponRepository->createcoupon($data);
    }


    public function updatecoupon($id, $data)
    {
        $coupon = $this->getcoupon($id);
        return $this->couponRepository->updatecoupon($coupon, $data);
    }
    public function deletecoupon($id)
    {
        $coupon = $this->getcoupon($id);

        $coupon = $this->couponRepository->deletecoupon($coupon);
        return $coupon;
    }


}
