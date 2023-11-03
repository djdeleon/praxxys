<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductService
{
	public function get()
	{
		if (request('category') == null) {
			return $this->paginate(Product::latest()->filter()->get());
		}

		return $this->paginate(Product::latest()->filter());
	}

	public function store(Request $request): Product
	{
		$product = Product::create($request->validated());

		if ($request->file()) {
			foreach ($request->images as $image) {
					$file_name = time().'_'.$image->getClientOriginalName();
					$file_path = $image->storeAs('uploads', $file_name, 'public');

					$imageUpload = new Image;
					$imageUpload->product_id = $product->id;
					$imageUpload->name = time().'_'.$image->getClientOriginalName();
					$imageUpload->path = '/storage/' . $file_path;
					$imageUpload->save();
			}
		}

		return $product;
	}

	public function update(array $data, int $id): Product
	{
		$product = Product::find($id);

		$product->update($data);

		return $product;
	}

	private function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
