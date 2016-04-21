<?php

namespace App\Http\Controllers\Shop;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\{
    Product,
    Category
};
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
//        $products = Product::all(); // Lazy Loading of related Category and User objects. Results in more queries in this particular case.
        $products = Product::with('category','user')->orderBy('created_at', 'DESC')->get(); // Eager Loading of related Category, Tag, and User objects.

        \Debugbar::info($products);

        $data = [
            'products' => $products,
        ];

        return view('shop.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        // Pluck retrieves all of the values for a given key (name & id in dit geval)
        $categories = Category::pluck('name', 'id');
        $products = new Product();

        $data = [
            'categories' => $categories,
            'product' => $products,
        ];

        return view('shop.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->input());
        $rules = [
            'title' => 'required|unique:products|max:255',
            'content' => 'required',
            'category' => 'required|int',
        ];

        $this->validate($request, $rules);

        $category = Category::find($request->get('category'));
        $product = new Product($request->only(['title', 'content']));
        $product->category()->associate($category);
        $product->user()->associate($request->user());
        $product->save();


        return redirect()->route('shop.products.index'); // $ artisan route:list
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id) : View
    {
        $product = Product::find($id);

        $data = [
            'product' => $product,
        ];

        return view('shop.products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  $id
     * @return View
     */
    public function edit($id) : View
    {
        $categories = Category::pluck('name', 'id');
        $product = Product::find($id);
        $data = [
            'categories' => $categories,
            'product' => $product,
        ];

        return view('shop.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|int',
        ];

        $this->validate($request, $rules);

        $product = Product::find($id);

        $product->title = $request->get('title');
        $product->content = $request->get('content');
        $product->category()->associate(Category::find($request->get('category')));
        $product->save();

        return redirect()->route('shop.products.index'); // $ artisan route:list
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) : Response
    {
        Product::find($id)->delete();

        return response(Response::HTTP_OK);
    }
}