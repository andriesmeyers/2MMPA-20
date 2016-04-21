<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Category, Product};
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|unique:products|max:255',
            'content' => 'required',
            'category.id' => 'required|integer',
            'tags' => 'array',
        ];

        $validator = Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all(),
                ])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $product = new Product($request->only(['title', 'content']));

        $category = Category::find($request->get('category')['id']);
        $product->category()->associate($category);

        $user = User::find(1); // @todo Do not hardcode user.
        $product->user()->associate($user);

        if ($product->save()) {
            return response()
                ->json($product)
                ->setStatusCode(Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        return $product ?: response()
            ->json([
                'error' => "Product `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            'category.id' => 'required|integer|exists:categories,id',
            'tags' => 'array',
        ];

        $validator = Validator::make($request->input(), $rules);

        $this->validate($request, $rules);

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all(),
                ])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $product = Product::find($id);

        $product->fill($request->input());

        $category = Category::find($request->get('category')['id']);
        $product->category()->associate($category);

        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            if ($product->delete()) {
                return response()
                    ->json($product)
                    ->setStatusCode(Response::HTTP_OK);
            }

            return response()
                ->json([
                    'error' => "Product `${id}` could not be deleted",
                ])
                ->setStatusCode(Response::HTTP_CONFLICT);
        }

        return response()
            ->json([
                'error' => "Product `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
    }
}
