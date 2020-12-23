<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = array();

        foreach (Category::get() as $category) {

            array_push($categories, array(
                'category_id' => $category->id,
                'category_name' => $category->name,
                'subcategories' => Subcategory::where('category_id', $category->id)->get()
            ));
        }


        $products = Product::all();

        return view('dashboard.product.index', compact(
            'categories',
            'products'
        ));
    }
    public function add(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'subcat_id'  => 'required',
        ]);

        if (Subcategory::where('id', $request->subcat_id)->count() == 0) {
            return redirect('/dashboard/products');
        }

        if ($request->hasFile('img')) {

            $file = $request->file('img');
            $unique_id = uniqid();
            $filename =  $unique_id . '_prod.' . $file->getClientOriginalExtension();
            $file->move('images/products', $filename);

            $product = new Product();
            $product->img =  $filename;
            $product->name = $request->name;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->desc = $request->desc;
            $product->subcat_id = $request->subcat_id;
            $product->save();
        }

        return redirect('/dashboard/products');
    }
    public function view($product_id)
    {

        $product =   Product::find($product_id);

        if ($product) {

            $subcat = Subcategory::find($product->subcat_id);
            if (!$subcat) {
                $product->subcat_id = 0;
                $product->save();
            }

            $categories = array();

            foreach (Category::get() as $category) {

                array_push($categories, array(
                    'category_id' => $category->id,
                    'category_name' => $category->name,
                    'subcategories' => Subcategory::where('category_id', $category->id)->get()
                ));
            }


            return view('dashboard.product.single', compact(
                'product',
                'categories'
            ));
        }




        return redirect('/dashboard/products');
    }
 
    public function edit(Request $request)
    {

        $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'subcat_id'  => 'required',
        ]);

        if (Subcategory::where('id', $request->subcat_id)->count() == 0) {
            return redirect('/dashboard/products');
        }
        $product =  Product::find($request->product_id);
        if ($product) {
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $unique_id = uniqid();
                $filename =  $unique_id . '_prod.' . $file->getClientOriginalExtension();
                $file->move('images/products', $filename);
                $product->img =  $filename;
            } 
            $product->name = $request->name;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->desc = $request->desc;
            $product->subcat_id = $request->subcat_id;
            $product->save();
            return redirect('/dashboard/product/view/' . $product->id);
        }
 
        return redirect('/dashboard/products');
    }

       public function remove($product_id)
    {

        $product =   Product::find($product_id);

        if ($product) {
 
            $product->delete(); 
        }
 
        return redirect('/dashboard/products');
    }


}
