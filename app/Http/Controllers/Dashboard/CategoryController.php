<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

        // return $categories;
        return view('dashboard.category.index', compact(
            'categories'
        ));
    }
    public function add(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $cat = new Category();
        $cat->name = $request->name;
        $cat->save();


        return redirect('/dashboard/categories');
    }
    public function remove(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
        ]);

        $cat =   Category::find($request->category_id);

        if ($cat) {
            Subcategory::where('category_id', $request->category_id)->delete();
            $cat->delete();
        }


        return redirect('/dashboard/categories');
    }

    public function addSubCat(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);

        $cat =   Category::find($request->category_id);

        if ($cat) {

            $cat = new Subcategory();
            $cat->category_id = $request->category_id;
            $cat->name = $request->name;
            $cat->save();
        }


        return redirect('/dashboard/categories');
    }

    public function removeSubCat($subcat_id)
    {

        $subcat =   Subcategory::find($subcat_id);

        if ($subcat) {
            $subcat->delete();
        }
 
        return redirect('/dashboard/categories');
    }
}
