<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /* Hello from the other side :)
    this controller has a single method that is viewing the
    categories (10 categories at a time) and passing them
    to the view_categories page and view it :)


    */

    public function viewCats()
    {
        $categories =Category::paginate(10);
        return view('user.view_categories',compact('categories'));
    }
}
