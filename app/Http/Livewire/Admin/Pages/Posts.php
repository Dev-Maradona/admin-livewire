<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Posts extends Component
{
    // Traits
    use WithPagination;
    use WithFileUploads;
    
    // public $posts = [];
    public $editForm = false;
    public $createForm = false;
    public $deleteModal = false;

    // Values
    public $image, $title, $content, $status, $category_id;

    public $allCategories = [];

    // Current postId for update
    public $currentPostId;

    // Search input
    public $search = null;

    public function mount() {
        $categories = Category::get();
        $this->allCategories = $categories;
    }

    public function openEditForm($id) {
        if ($id) {
            $post = Post::find($id);
            if ($post) {
                $this->title = $post->title;
                $this->content = $post->content;
                $this->status = $post->status;
                $this->category_id = $post->category_id;
                $this->currentPostId = $post->id;
                $this->editForm = true;
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'No Post with this ID'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'You must type postId to find his values'
            ]);
        }
    }

    public function openCreateForm() {
        // Reset Values
        $this->title = '';
        $this->content = '';
        $this->status = '';
        $this->category_id = '';
        // Open form
        $this->createForm = true;
    }

    public function openDeleteModal() {
        $this->deleteModal = true;
    }

    public function resetForms() {
        $this->editForm = false;
        $this->createForm = false;
    }

    public function resetModals() {
        $this->deleteModal = false;
    }

    public function updated() {
        $this->validate([
            'title'  =>  'required|min:6|max:96',
            'content'   =>  'required|min:6',
            'status'    =>  'required',
            'image'     =>  'required',
            'category_id'   =>  'required'
        ]);
    }

    // DB Methods
    public function createPost() {
        // Validation
        $this->validate([
            'title'  =>  'required|min:6|max:96',
            'content'    =>  'required|min:6',
            'status'    =>  'required',
            'image' =>  'required|image|max:512',
            'category_id'   =>  'required'
        ]);

        $fileName = $this->image->store('posts/image', 'public');

        // Create new Post
        $newPost = Post::create([
            'title'  =>  $this->title,
            'content'    =>  $this->content,
            'status'    =>  $this->status,
            'image_path'    =>  $fileName,
            'admin_id'  =>  Auth::guard('admin')->user()->id,
            'category_id'   =>  $this->category_id
        ]);

        if ($newPost) {
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'Post is created successfuly'
            ]);
            $this->mount();
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'Something went wrong please try again later'
            ]);
        }
    }

    public function updatePost() {
        $post = Post::find($this->currentPostId);
        if ($post) {

            $this->validate([
                'title'  =>  'required|min:6|max:96',
                'content'    =>  'required|min:6',
                'status'    =>  'required',
                'category_id'   =>  'required'
            ]);

            $updatePost = $post->update([
                'title'  =>  $this->title,
                'content'    => $this->content,
                'status'    =>  $this->status,
                'admin_id'  =>  Auth::guard('admin')->user()->id,
                'category_id'   =>  $this->category_id
            ]);

            if ($updatePost) {
                $this->dispatchBrowserEvent('toastr:success', [
                    'message'   =>  'Post is updated successfuly'
                ]);
                $this->mount();
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'Something went wrong please try again later'
                ]);
            }
        }
    }

    public function deletePost($id) {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'Post is deleted successfuly'
            ]);
            $this->mount();
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'No Post with this ID'
            ]);
        }
    }

    public function getCategoryName($id) {
        if ($id) {
            $categoryName = Category::find($id);
            return $categoryName->name;
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.posts', [
            'posts' =>  Post::where('title', 'like', '%'.$this->search.'%')->paginate(10),
        ])->extends('layouts.admin.app');
    }
}