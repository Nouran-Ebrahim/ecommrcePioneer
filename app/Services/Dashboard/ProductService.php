<?php

namespace App\Services\Dashboard;

use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\ProductRepository;
use App\Utils\ImageManger;
use DB;
use Illuminate\Support\Facades\Cache;
use Log;
class ProductService
{
    /**
     * Create a new class instance.
     */
    protected $productRepository, $imageManager;
    public function __construct(ProductRepository $productRepository, ImageManger $imageManager)
    {
        $this->productRepository = $productRepository;
        $this->imageManager = $imageManager;
    }
    public function getProduct($id)
    {
        $product = $this->productRepository->getProduct($id);
        return $product ?? abort(404);
    }
    public function getProductsForDatatables()
    {
        $products = $this->productRepository->getProducts();
        return DataTables::of($products)

            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->getTranslation('name', app()->getLocale());
            })
            ->addColumn('has_variants', function ($row) {
                return $row->hasVariantsTranslated();
            })
            ->addColumn('images', function ($row) {
                $row->load('images');
                return view('dashboard.products.datatables.images', compact('row'));
            })
            ->addColumn('status', function ($row) {
                return $row->getStatusTranslated();
            })
            ->addColumn('category', function ($row) {
                return $row->category->name;
            })
            ->addColumn('brand', function ($row) {
                return $row->brand->name;

            })
            ->addColumn('action', function ($row) {
                return view('dashboard.products.datatables.actions', compact('row'));
            })

            ->make(true);
    }
    public function createProductWithDetails($ProductData, $productVariant, $images)
    {

        try {
            // create Product
            $product = $this->productRepository->createProduct($ProductData);
            // create Product Variant
            foreach ($productVariant as $variant) {
                $variant['product_id'] = $product->id;
                $productVariant = $this->productRepository->createProductVariant($variant);

                // create Variant Attributes
                foreach ($variant['attriubte_value_ids'] as $attribute_value_id) {
                    $this->productRepository->createProductVariantAttribute([
                        'product_variant_id' => $productVariant->id,
                        'attribute_value_id' => $attribute_value_id,
                    ]);
                }
            }

            // create Product Images
            $this->imageManager->uploadImages($images, $product, 'products');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating product: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }

    }
    public function updateProduct($id, $data)
    {
        $product = $this->getProduct($id);
        return $this->productRepository->updateProduct($product, $data);
    }
    public function deleteProduct($id)
    {
        $product = $this->getProduct($id);
        return $this->productRepository->deleteProduct($product);
    }

    public function changeStatus($request)
    {
        $product = $this->getProduct($request->id);
        $product->status == 1 ? $status = 0 : $status = 1;
        return $this->productRepository->changeStatus($product, $status);
    }

}
