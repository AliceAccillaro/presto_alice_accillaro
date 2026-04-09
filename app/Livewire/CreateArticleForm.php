<?php

namespace App\Livewire;

use App\Jobs\ResizeImage;
use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class CreateArticleForm extends Component
{
    use WithFileUploads;

    public $temporary_images = [];

    #[Validate('required|min:5')]
    public $title;

    #[Validate('required|min:10')]
    public $description;

    #[Validate('required|numeric')]
    public $price;

    #[Validate('required')]
    public $category;

    public $article;

    public function save()
    {
        $this->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'category' => 'required',
            'temporary_images.*' => 'image|max:1024',
            'temporary_images' => 'nullable|max:6',
        ]);

        $this->article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
            'user_id' => Auth::id(),
        ]);

        if (!empty($this->temporary_images)) {
            foreach ($this->temporary_images as $image) {
                $newFileName = "articles/{$this->article->id}/";
                $newImage = $this->article->images()->create(['path' => $image->store($newFileName, 'public')]);
                
                dispatch(new ResizeImage($newImage->path, 600, 400));
            }
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        session()->flash('message', 'Articolo creato con successo!');

        $this->cleanForm();
    }

    public function removeImage($key)
    {
        if (array_key_exists($key, $this->temporary_images)) {
            unset($this->temporary_images[$key]);
            $this->temporary_images = array_values($this->temporary_images);
        }
    }

    public function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        $this->temporary_images = [];
    }

    public function render()
    {
        return view('livewire.create-article-form', [
            'categories' => Category::all(),
        ]);
    }
}
