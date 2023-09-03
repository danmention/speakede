<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function getIndex()
    {
        return view('admin.categories.add-category');
    }

    /**
     * @return Application|Factory|View
     */
    public function getEditCategory($id)
    {
        $category = Category::query()->where('id', $id)->get();
        return view('admin.categories.edit-category', compact('category'));
    }

    /**
     * @return Application|Factory|View
     */
    public function getCategory()
    {
        $category = Category::query()->where('class_name','language')->get();
        return view('admin.Categories.view-category', compact( 'category'));
    }

    /**
     * @param $id
     * @return int
     */
    private function getTotalSubCategory($id) : int
    {
        return Category::where('parent_id', '=', $id)->count();
    }



    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeCategory(Request $request): RedirectResponse
    {
        if (empty($request->assoc_category)) {
            $parent_ID = 0;
        } else {
            $parent_ID = $request->assoc_category;
        }
        $post = new Category;
        $user_id = Auth::user()->id;
        $post->title = $request->category_name;
        $post->parent_id = $parent_ID;
        $post->class_name = $request->class_name ?? null;
        $post->user_id = $user_id;
        $post->url = strtolower(CommonHelpers::str_slug($request->category_name));

        if ($request->hasFile('post_image')) {

            if($request->class_name ==="language"){
                // Create directory if it does not exist
                if (!is_dir("lang/icons/")) {
                    $path = "lang/icons/";
                    File::makeDirectory(public_path() . '/' . $path, 0777, true);
                }
                if (!is_dir("lang/icons/")) {
                    $path = "lang/icons/";
                    File::makeDirectory(public_path() . '/' . $path, 0777, true);
                }
                $location = public_path('lang/icons/');
            } else {
                // Create directory if it does not exist
                if (!is_dir("categories/icons/" . $user_id . "/")) {
                    $path = "categories_images/headers/" . $user_id . "/";
                    File::makeDirectory(public_path() . '/' . $path, 0777, true);
                }

                if (!is_dir("categories/icons/" . $user_id . "/")) {
                    $path = "categories/icons/" . $user_id . "/";
                    File::makeDirectory(public_path() . '/' . $path, 0777, true);
                }
                $location = public_path('categories/icons/' . $user_id . '/');
            }

            $image = $request->file('post_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($location, $filename);
            $post->featured_img = $filename;
        }

        $post->save();
        return back()->withInput()->with('response', 'Language Added');

    }



    /**
     * @param $id
     * @return mixed|void
     */
    public function getName($id)
    {
        $parent = User::select('firstname')->where('id', $id)->get();
        foreach ($parent as $row) {
            return $row['firstname'];
        }
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteCategory(Request $request): RedirectResponse
    {
        $data = Category::find($request->id);
        $data->delete();
        return back()->withInput()->with('response', 'Language Deleted');
    }

    public function makePopular(Request $request): RedirectResponse
    {
        $data = Category::find($request->id);
        $data->popular_status = $request->popular_status;
        $data->update();
        return back()->withInput()->with('response', 'Popular Status Updated');
    }


    /**
     * @return Application|Factory|View
     */
    public function getUseCasesIndex()
    {
        $category = Category::query()->where('class_name', 'use_cases')->orderBy('id','DESC')->get();
        return view('admin.categories.theme', compact('category'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeUseCases(Request $request): RedirectResponse
    {
        $post = new Category;
        $user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->parent_id = 0;
        $post->class_name = "use_cases";
        $post->user_id = $user_id;
        $post->url = strtolower(CommonHelpers::str_slug($request->title));

        $post->save();
        return back()->withInput()->with('response', 'Use Cases Added');

    }

}
