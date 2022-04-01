<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\User;
use App\Models\Product;
use App\Models\Post;
use App\Models\Comment;

use Livewire\Component;

class Dashboard extends Component
{

    /* Properties */
    public $usersCount;
    public $productsCount;
    public $postsCount;
    public $commentsCount;

    public $products = [];

    /* Methods */
    public function countUsers() {
        $users = User::count();
        $this->usersCount = $users;
    }

    public function countProducts() {
        $products = Product::count();
        $this->productsCount = $products;
    }

    public function countPosts() {
        $posts = Post::count();
        $this->postsCount = $posts;
    }

    public function countComments() {
        $comments = Comment::count();
        $this->commentsCount = $comments;
    }
    
    public function getAllProducts() {
        $products = Product::latest('name')->limit(8)->get();
        $this->products = $products;
    }

    public function mount() {

        $this->countUsers();
        $this->countProducts();
        $this->countPosts();
        $this->countComments();

        $this->getAllProducts();
    }

    public function render()
    {
        return view('livewire.admin.pages.dashboard')->extends('layouts.admin.app');
    }
}
