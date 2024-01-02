<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.index');
    }
    public function create(){
        return view('admin.category.create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
        ]);
        try {
            $category = Category::create([
                'name' => $request->name,
            ]);
            return redirect()->route('admin.category')->with(['success' => 'Kategori: ' . $category->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
        ]);
        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
            ]);
            return redirect()->route('admin.category')->with(['success' => 'Kategori: ' . $category->name . ' Diupdate']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category')->with(['success' => 'Kategori: ' . $category->name . ' Dihapus']);
    }
    public function getData(){
        $category = Category::orderBy('created_at', 'DESC')->get();
        return datatables()->of($category)
            ->addColumn('action', function ($category) {
                return '
                    <a href="' . route('admin.category.edit', $category->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                    <a href="' . route('admin.category.delete', $category->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

}
