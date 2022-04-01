<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    // Traits
    use WithPagination;
    
    // public $categories = [];
    public $editForm = false;
    public $createForm = false;
    public $deleteModal = false;

    // Values
    public $name, $status;

    // Current categoryId for update
    public $currentCategoryId;

    // Search input
    public $search = null;

    public function openEditForm($id) {
        if ($id) {
            $category = ModelsCategory::find($id);
            if ($category) {
                $this->name = $category->name;
                $this->status = $category->status;
                $this->currentCategoryId = $category->id;
                $this->editForm = true;
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'No Category with this ID'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'You must type categoryId to find his values'
            ]);
        }
    }

    public function openCreateForm() {
        // Reset Values
        $this->name = '';
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
        $this->validate([
            'name'  =>  'required|min:6|max:16',
            'status'    =>  'required'
        ]);
    }

    // DB Methods
    public function createCategory() {
        // Validation
        $this->validate([
            'name'  =>  'required|min:6|max:16',
            'status'    =>  'required'
        ]);
        // Create new category
        $newCategory = ModelsCategory::create([
            'name'  =>  $this->name,
            'status'    =>  $this->status,
            'admin_id'  =>  Auth::guard('admin')->user()->id
        ]);

        if ($newCategory) {
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'Category is created successfuly'
            ]);
            $this->mount();
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'Something went wrong please try again later'
            ]);
        }
    }

    public function updateCategory() {
        $category = ModelsCategory::find($this->currentCategoryId);
        if ($category) {

            $this->validate([
                'name'  =>  'required|min:6|max:16',
                'status'    =>  'required'
            ]);

            $updateCategory = $category->update([
                'name'  =>  $this->name,
                'status'    => $this->status,
                'admin_id'  =>  Auth::guard('admin')->user()->id
            ]);

            if ($updateCategory) {
                $this->dispatchBrowserEvent('toastr:success', [
                    'message'   =>  'Category is updated successfuly'
                ]);
                $this->mount();
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'Something went wrong please try again later'
                ]);
            }
        }
    }

    public function deleteCategory($id) {
        $category = ModelsCategory::find($id);
        if ($category) {
            $category->delete();
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'Category is deleted successfuly'
            ]);
            $this->mount();
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'No Category with this ID'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.category', [
            'categories' =>  ModelsCategory::where('name', 'like', '%'.$this->search.'%')->paginate(10),
        ])->extends('layouts.admin.app');
    }
}