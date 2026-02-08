<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::orderBy('date', 'desc')->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp'],
            'date' => ['required', 'date'],
            'type_name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'post_by' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('storage/news');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'news/' . $imageName;
        }

        News::create($data);

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'News created successfully.');
    }

    public function show(News $news): View
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp'],
            'date' => ['required', 'date'],
            'type_name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'post_by' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image && file_exists(public_path('storage/' . $news->image))) {
                unlink(public_path('storage/' . $news->image));
            }

            $destinationPath = public_path('storage/news');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'news/' . $imageName;
        }

        $news->update($data);

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'News updated successfully.');
    }

    public function destroy(News $news): RedirectResponse
    {
        if ($news->image && file_exists(public_path('storage/' . $news->image))) {
            unlink(public_path('storage/' . $news->image));
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'News deleted successfully.');
    }
}
