<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'string', 'max:255'],
            'status' => ['required'],
            'deskripsi' => ['required', 'string'],
            'gambar' => ['required', 'file', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('blog.create')->withErrors($validator)->withInput();
        }
        try {
            if ($request->hasFile('gambar')) {
                $file = md5(time()) . '_Blog_' . $request->file('gambar')->getClientOriginalName();
                $path = $request->file('gambar')->storeAs('public/blogs', $file);
                Blog::create([
                    "judul" => $request->judul,
                    "status" => $request->status,
                    "deskripsi" => $request->deskripsi,
                    "gambar" => $file,
                ]);
            } else {
                Blog::create([
                    "judul" => $request->judul,
                    "status" => $request->status,
                    "deskripsi" => $request->deskripsi,
                    "gambar" => '',
                ]);
            }

            return redirect()->route('blog.index')->with('success', 'Berhasil tambah blog!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('admin.blog.detail', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        if ($request->hasFile('gambar')) {
            $validator = Validator::make($request->all(), [
                'judul' => ['required', 'string', 'max:255'],
                'status' => ['required'],
                'deskripsi' => ['required', 'string'],
                'gambar' => ['required', 'file', 'mimes:jpg,jpeg,png'],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'judul' => ['required', 'string', 'max:255'],
                'status' => ['required'],
                'deskripsi' => ['required', 'string'],
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('blog.edit', ['blog' => $blog->id])->withErrors($validator)->withInput();
        }
        try {
            if ($request->hasFile('gambar')) {
                unlink(storage_path('app/public/blogs/' . $blog->gambar));
                $file = md5(time()) . '_Blog_' . $request->file('gambar')->getClientOriginalName();
                $path = $request->file('gambar')->storeAs('public/blogs', $file);
                $blog->update([
                    "judul" => $request->judul,
                    "status" => $request->status,
                    "deskripsi" => $request->deskripsi,
                    "gambar" => $file,
                ]);
            } else {
                $blog->update([
                    "judul" => $request->judul,
                    "status" => $request->status,
                    "deskripsi" => $request->deskripsi,
                ]);
            }

            return redirect()->route('blog.index')->with('success', 'Berhasil edit blog!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        unlink(storage_path('app/public/blogs/' . $blog->gambar));
        $blog->delete();
        return redirect()->back()->with('success', 'Blog berhasil dihapus!');
    }
}
