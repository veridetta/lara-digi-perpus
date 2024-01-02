<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Exports\BookExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    public function index(){
        return view('user.book.index');
    }
    public function create(){
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('user.book.create', compact('categories'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:130',
            'category_id' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'cover' => 'required|image',
            'pdf' => 'required|mimes:pdf',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['error' => 'Data gagal diupload']);
        }

        try {
            $book = Book::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'description' => $request->description,
                'amount' => $request->amount,
            ]);
            $cover = $request->file('cover');
            if ($cover != null) {
                $destinationPath = public_path('uploads/cover');
                $filename = time() . '_' . str_replace(' ', '_', $cover->getClientOriginalName());
                if ($cover->move($destinationPath, $filename)) {
                    $book->cover = $filename;
                    $book->save();
                    // File berhasil dipindahkan
                } else {
                    // Gagal memindahkan file
                    dd('Gagal memindahkan file.');
                }
            }
            $pdf = $request->file('pdf');

            if ($pdf != null) {
                $destinationPath = $destinationPath = public_path('uploads/pdf');
                $filename = time() . '_' . str_replace(' ', '_', $pdf->getClientOriginalName());


                if ($pdf->move($destinationPath, $filename)) {
                    $book->pdf = $filename;
                    $book->save();
                    // File berhasil dipindahkan
                } else {
                    // Gagal memindahkan file
                    dd('Gagal memindahkan file.');
                }
            }
            return redirect()->route('user.book')->with(['success' => 'Buku: ' . $book->title . ' Ditambahkan']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function edit($id){
        $book = Book::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('user.book.edit', compact('book', 'categories'));
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:130',
            'category_id' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'cover' => 'nullable|image',
            'pdf' => 'nullable|mimes:pdf',
        ]);
        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['error' => 'Data gagal diupload']);
        }
        try {
            $book = Book::findOrFail($id);
            $book->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'description' => $request->description,
                'amount' => $request->amount,
            ]);
            $cover = $request->file('cover');
            if ($cover != null) {
                $destinationPath = public_path('uploads/cover');
                $filename = time() . '_' . str_replace(' ', '_', $cover->getClientOriginalName());
                if ($cover->move($destinationPath, $filename)) {
                    $book->cover = $filename;
                    $book->save();
                    // File berhasil dipindahkan
                } else {
                    // Gagal memindahkan file
                    dd('Gagal memindahkan file.');
                }
            }
            $pdf = $request->file('pdf');

            if ($pdf != null) {
                $destinationPath = $destinationPath = public_path('uploads/pdf');
                $filename = time() . '_' . str_replace(' ', '_', $pdf->getClientOriginalName());


                if ($pdf->move($destinationPath, $filename)) {
                    $book->pdf = $filename;
                    $book->save();
                    // File berhasil dipindahkan
                } else {
                    // Gagal memindahkan file
                    dd('Gagal memindahkan file.');
                }
            }
            return redirect()->route('user.book')->with(['success' => 'Buku: ' . $book->title . ' Diupdate']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function delete($id){
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('user.book')->with(['success' => 'Buku: ' . $book->title . ' Dihapus']);
    }
    public function getData(Request $request)
    {
        //where user_id = auth()->user()->id
        $query = Book::with(['category', 'user'])->where('user_id', Auth::user()->id);

        // Filter berdasarkan kategori jika terdapat input kategori
        if ($request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // Pencarian berdasarkan judul jika terdapat input pencarian
        if ($request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $books = $query->get();

        $data = [];
        foreach ($books as $book) {
            $data[] = [
                'title' => substr($book->title, 0, 30),
                'category' => $book->category->name,
                'description' => substr($book->description, 0, 100),
                'amount' => $book->amount,
                'cover' => $book->cover,
                'pdf' => $book->pdf,
                'view_url' => route('user.book.show', $book->id),
                'edit_url' => route('user.book.edit', $book->id),
                'delete_url' => route('user.book.delete', $book->id),
            ];
        }

        return response()->json(['data' => $data]);
    }
    public function getCategories(){
        $categories = Category::all();
        return response()->json($categories);
    }
    public function show($id){
        $book = Book::findOrFail($id);
        return view('user.book.show', compact('book'));
    }
    public function export(){
        $nama = 'books_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new BookExport, $nama);
    }
}
