<?php

namespace App\Http\Controllers;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function validateInput(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:255|string',
            'value' => 'required|min:0.01|numeric',
        ]);

    }


    public function showAll()
    {
        return response()->json(Product::all());
    }

    public function showOne($id)
    {
        return response()->json(Product::find($id));
    }

    public function showName($name)
    {
        return response()->json(Product::where('name', '=', $name)->first());
    }


    public function create(Request $request)
    {
        self::validateInput($request);

        $product = Product::create($request->all());

        return response()->json($product);
    }

    public function update($id, Request $request)
    {
        self::validateInput($request);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json($product);
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        return response('Deleted Successfully');
    }

    public function deleteAll()
    {
        Product::truncate();
        return response('Deleted all data sucefully');
    }
}