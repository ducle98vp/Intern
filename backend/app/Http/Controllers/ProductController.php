<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Exceptions\KT9NotFound;
use App\Http\Service\ProductService;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private $product_service;

    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }

    public function index(Request $request)
    {
        $per_page = config('setting.per_page');

        if($request->has('per_page')){
            $per_page = $request->per_page;
        }

        $products = $this->product_service->getProducts($per_page);

        $product_resource = ProductResource::collection($products);

        return $product_resource;
    }

    public function show(Request $request)
    {
        $product_id = $request->id;
        $product = $this->product_service->getProduct($product_id);

        if(!$product){
            throw new KT9NotFound();
        }

        return new ProductResource($product);
    }

    public function destroy(Request $request)
    {
        $product_id = $request->id;

        $product = $this->product_service->deleteProduct($product_id);

        if(!$product){
            throw new KT9NotFound();
        }

        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        $data_product = $request->only([
            'id',
            'name',
            'add_date',
            'expiration_date',
            'category_id',
            'amount',
            'created_at',
            'updated_at',
            'file',
        ]);
        $validator = $this->product_service->validate($data_product);
        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors(),
                'status' => Response::HTTP_BAD_REQUEST,
            ]);
        }

        $product = $this->product_service->createOrUpdate($data_product);

        if(!$product){
            return response()->json([
                'errors' => [trans('messages.internal_server_error')],
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }

        $product_resource = new ProductResource($product);

        return response()->json([
            'data' => $product_resource,
            'message' => $request->id ?  __('messages.updated', ['field' => 'Company']) :__('messages.created', ['field' => 'product_resource']),
            'status' => Response::HTTP_OK,
        ]);
    }

    public function search(Request $request)
    {
        $per_page = config('setting.per_page');

        if($request->has('per_page')){
            $per_page = $request->per_page;
        }

        $data_search = $request->only([
            'start_date',
            'end_date',
            'category_id',
        ]);

        $products = $this->product_service->searchProducts($request->all(), $per_page);
        $product_resource = ProductResource::collection($products);

        return $product_resource;
    }
}
