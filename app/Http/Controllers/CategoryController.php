<?php

namespace App\Http\Controllers;

use App\Models\{Category, Product};
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {
        // Return the view;;
        // 'Category' is the name of the page in resources/js/Pages/Category.vue
        return Inertia::render('Category', [
            // Get the category with the id passed in the url
            'category_name' => Category::find($id),

            // Get all products with the category id equal to the id passed in the url
            'category_by_id' => Product::where('category', $id)->get()
        ]);
    }
}
