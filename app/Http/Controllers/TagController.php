<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function showTags(){
        $tags = Tag::all();
        return view('tags.tags', compact('tags'));
    }

    public function create(){
        return view('tags.create');
    }

    public function addTag(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $tag = new Tag();
        $tag->name = $validatedData['name'];
        $tag->description = $validatedData['description'];
        $tag->save();

        return redirect('/tags')->with('success', 'Tag успешно добавлен');
    }

    public function showTag($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.show', compact('tag'));
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $tag = Tag::findOrFail($id);
        $tag->name = $validatedData['name'];
        $tag->save();

        return redirect('/tags')->with('success', 'Tag успешно обновлён');
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect('/tags')->with('success', 'Tag успешно удалён');
    }
}
