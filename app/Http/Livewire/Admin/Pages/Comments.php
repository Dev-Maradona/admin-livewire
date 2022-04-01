<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    // Traits
    use WithPagination;
    
    // public $comments = [];
    public $editForm = false;
    public $createForm = false;
    public $deleteModal = false;

    // Values
    public $content, $status, $post_id;

    // Current commentId for update
    public $currentCommentId;

    // Search input
    public $search = null;

    // Posts
    public $posts = [];

    // Get All Posts
    public function mount() {
        $posts = Post::get();
        $this->posts = $posts;
    }

    public function openEditForm($id) {
        if ($id) {
            $comment = Comment::find($id);
            if ($comment) {
                $this->content = $comment->content;
                $this->status = $comment->status;
                $this->post_id = $comment->post_id;
                $this->currentCommentId = $comment->id;
                $this->editForm = true;
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'No Comment with this ID'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'You must type commentId to find his values'
            ]);
        }
    }

    public function openCreateForm() {
        // Reset Values
        $this->content = '';
        $this->status = '';
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

    // Validation
    public function updated() {
        if ($this->editForm) {
            $this->validate([
                'content'   =>  'required|min:6|max:96',
                'status'    =>  'required',
                'post_id'   =>  'required'
            ]);
        }
    }

    // DB Methods
    public function updateComment() {
        $comment = Comment::find($this->currentCommentId);
        if ($comment) {
            $this->validate([
                'content'   =>  'required|min:6|max:96',
                'status'    =>  'required',
                'post_id'   =>  'required'
            ]);
            $updateComment = $comment->update([
                'content'    => $this->content,
                'status'  =>  $this->status,
                'post_id'   =>  $this->post_id
            ]);
            if ($updateComment) {
                $this->dispatchBrowserEvent('toastr:success', [
                    'message'   =>  'Comment is updated successfuly'
                ]);
                $this->mount();
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'Something went wrong please try again later'
                ]);
            }
        }
    }

    public function acceptComment($id) {
        $comment = Comment::find($id);
        if ($comment) {
            if ($comment->status !== 'Accepted') {
                $comment->update([
                    'status'    =>  'Accepted'
                ]);
                $this->dispatchBrowserEvent('toastr:success', [
                    'message'   =>  'Comment is accepted successfuly'
                ]);
                $this->mount();
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'Comment is already accepted'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'No Comment with this ID'
            ]);
        }
    }

    public function deleteComment($id) {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'Comment is deleted successfuly'
            ]);
            $this->mount();
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'No Comment with this ID'
            ]);
        }
    }

    public function getPostTitle($id) {
        $post = Post::find($id);
        return $post->title;
    }

    public function getUserName($id) {
        $user = User::find($id);
        return $user->name;
    }

    public function render()
    {
        return view('livewire.admin.pages.comments', [
            'comments' =>  Comment::where('content', 'like', '%'.$this->search.'%')->paginate(10),
        ])->extends('layouts.admin.app');
    }
}