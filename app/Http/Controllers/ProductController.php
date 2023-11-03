<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function search()
    {
        return [
            'products' => (new ProductService())->get()
        ];
    }

    public function store(ProductStoreRequest $request)
    {
        $product = (new ProductService())->store($request);
        
        return response($product, 201);
    }

    public function show($id)
    {
        $product = Product::find($id);

        return new ProductResource($product);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = (new ProductService())->update($request->validated(), $id);

        return response($product, 200);
    }

    public function destroy($id)
    {
        Product::find($id)->delete();

        return response(200);
    }
}
