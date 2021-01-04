<?php
namespace App\Http\Service;

use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Traits\Image;

class ProductService {
    use Image;
    public function getProducts($per_page)
    {
        $products = Product::paginate($per_page);

        return $products;
    }

    public function getProduct($id)
    {
        $product = Product::find($id);

        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return $product;
    }

    public function createOrUpdate($data_product)
    {
        $product = new Product();

        if(!empty($data_product['id'])) {
            $product = Product::where([
                'id' => $data_product['id'],
            ])->first();
        }

        if(!$product){
            throw new KT9NotFound();
        }

        $avatar = $this->uploadImage($data_product['file']);
        if($avatar) {
            $product->avatar = $avatar;
        }

        $product->name = $data_product['name'];
        $product->add_date = $data_product['add_date'];
        $product->expiration_date = $data_product['expiration_date'];
        $product->category_id = $data_product['category_id'];
        $product->amount = $data_product['amount'];
        $product->save();

        return $product;
    }

    public function validate($data_product)
    {
        $validator = Validator::make($data_product, $this->rules(), $this->messages());

        return $validator;
    }

    private function rules()
    {
        return [
            'name' => 'required',
            'add_date' => 'required',
            'expiration_date' => 'required',
            'category_id' => 'required',
            'amount' => 'required'
        ];
    }

    private function messages()
    {
        return [
            'name.required' => trans('validation.required', ['attribute' => 'name']),
            'add_date.required' => trans('validation.required', ['attribute' => 'add_date']),
            'expiration_date.required' => trans('validation.required', ['attribute' => 'expiration_date']),
            'category_id.required' => trans('validation.required', ['attribute' => 'category_id']),
            'category_id.amount' => trans('validation.required', ['attribute' => 'amount']),
        ];
    }

    public function searchProducts($conditions, $per_page)
    {
        $conditions = array_filter($conditions, function($value) {
            return $value != null && $value != '';
        });

        $where_conditon = Arr::only($conditions, ['category_id']);
        $between_condition = Arr::only($conditions, ['date_search']);
        $products = Product::where($where_conditon);

        if(!empty($between_condition)) {
            $products = Product::where('add_date', '=<', $between_condition['date_search'])
            ->where('expiration_date', '>=', $between_condition['date_search']);
        }

        $products = $products->paginate($per_page);

        return $products;
    }
}