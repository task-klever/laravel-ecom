<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use App\Services\ElasticsearchService;

class ProductController extends Controller
{
    protected $elasticsearchService;

    public function __construct(ElasticsearchService $elasticsearchService)
    {
        $this->elasticsearchService = $elasticsearchService;
    }

    public function index()
    {
        $product = Product::all();
        return view('admin.product.index', compact('product'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $product = new Product();
        $data = $request->only($product->getFillable());

        $request->validate([
            'product_name' => 'required',
            'product_slug' => 'unique:products',
            'product_current_price' => 'required',
            'product_stock' => 'required',
            'product_content' => 'required',
            'product_content_short' => 'required',
            'product_featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if(empty($data['product_slug'])) {
            $data['product_slug'] = Str::slug($request->product_name);
        }

        $statement = DB::select("SHOW TABLE STATUS LIKE 'products'");
        $ai_id = $statement[0]->Auto_increment;

        $ext = $request->file('product_featured_photo')->extension();
        $final_name = 'product-'.$ai_id.'.'.$ext;
        $request->file('product_featured_photo')->move(public_path('uploads/'), $final_name);
        $data['product_featured_photo'] = $final_name;

        $product->fill($data)->save();

        // Index the product in Elasticsearch after saving
        $this->elasticsearchService->indexProduct($product);

        return redirect()->route('admin.product.index')->with('success', 'Product is added successfully and indexed in Elasticsearch!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $product = Product::findOrFail($id);
        $data = $request->only($product->getFillable());

        if($request->hasFile('product_featured_photo')) {
            $request->validate([
                'product_name' => 'required',
                'product_slug'   =>  [
                    Rule::unique('products')->ignore($id),
                ],
                'product_current_price' => 'required',
                'product_stock' => 'required',
                'product_content' => 'required',
                'product_content_short' => 'required',
                'product_featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            unlink(public_path('uploads/'.$product->product_featured_photo));
            $ext = $request->file('product_featured_photo')->extension();
            $final_name = 'product-'.$id.'.'.$ext;
            $request->file('product_featured_photo')->move(public_path('uploads/'), $final_name);
            $data['product_featured_photo'] = $final_name;
        } else {
            $request->validate([
                'product_name' => 'required',
                'product_slug'   =>  [
                    Rule::unique('products')->ignore($id),
                ],
                'product_current_price' => 'required',
                'product_stock' => 'required',
                'product_content' => 'required',
                'product_content_short' => 'required',
            ]);
            $data['product_featured_photo'] = $product->product_featured_photo;
        }

        if(empty($data['product_slug']))
        {
            unset($data['product_slug']);
            $data['product_slug'] = Str::slug($request->product_name);
        }

        $product->fill($data)->save();

        // Index the product in Elasticsearch after saving
        $this->elasticsearchService->indexProduct($product);

        return redirect()->route('admin.product.index')->with('success', 'Product is updated successfully and re-indexed in Elasticsearch!');
    }

    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $product = Product::findOrFail($id);

        // Remove the product from Elasticsearch before deleting it
        $this->elasticsearchService->removeProductFromElasticsearch($product->id);

        unlink(public_path('uploads/'.$product->product_featured_photo));
        $product->delete();
        return Redirect()->back()->with('success', 'Product is deleted successfully and removed from Elasticsearch!');
    }

    public function indexProductInElasticsearch($productId)
    {
        $product = Product::find($productId); // Fetch the product by ID
        
        if (!$product) {
            return redirect()->back()->withErrors(['Product not found']);
        }

        // Index the product in Elasticsearch
        $this->elasticsearchService->indexProduct($product);

        return redirect()->route('admin.product.index', $productId)
            ->with('success', 'Product indexed successfully in Elasticsearch.');
    }

    public function syncProductsWithElasticsearch()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Get all product IDs from Elasticsearch (you will need to adjust this query based on your index structure)
        $existingProductIds = $this->elasticsearchService->getAllIndexedProductIds();

        // Index or reindex products that exist in the database
        foreach ($products as $product) {
            $this->elasticsearchService->indexProduct($product);
        }

        // Remove products from Elasticsearch that no longer exist in the database
        foreach ($existingProductIds as $productId) {
            if (!$products->contains('id', $productId)) {
                $this->elasticsearchService->removeProductFromElasticsearch($productId);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Products synchronized with Elasticsearch!');
    }

}
