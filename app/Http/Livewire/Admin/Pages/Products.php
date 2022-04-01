<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Products extends Component
{
    // Traits
    use WithPagination;
    use WithFileUploads;
    
    // public $products = [];
    public $editForm = false;
    public $createForm = false;
    public $deleteModal = false;

    // Values
    public $image, $name, $desc, $price, $status;

    // Current productid for update
    public $currentProductId;

    // Search input
    public $search = null;

    public function openEditForm($id) {
        if ($id) {
            $product = Product::find($id);
            if ($product) {
                $this->name = $product->name;
                $this->desc = $product->desc;
                $this->price = $product->price;
                $this->status = $product->status;
                $this->currentProductId = $product->id;
                $this->editForm = true;
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'No Product with this ID'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'You must type productID to find his values'
            ]);
        }
    }

    public function openCreateForm() {
        // Reset Values
        $this->name = '';
        $this->desc = '';
        $this->price = '';
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
            'name'  =>  'required|min:6|max:32',
            'desc'  =>  'required|min:6|max:64',
            'price'  =>  'required|integer',
            'status'   =>   'required',
            'image' =>  'required'
        ]);
    }

    // DB Methods
    public function createProduct() {
        // Validation
        $this->validate([
            'name'  =>  'required|min:6|max:32',
            'desc'  =>  'required|min:6|max:64',
            'price'  =>  'required|integer',
            'status'    =>  'required',
            'image' =>  'required|image|max:512',
        ]);

        $fileName = $this->image->store('products/image', 'public');

        // Create new product
        $newProduct = Product::create([
            'name'  =>  $this->name,
            'desc' =>  $this->desc,
            'price'  =>  $this->price,
            'status'    =>  $this->status,
            'image_path'    =>  $fileName,
            'admin_id'  =>  Auth::guard('admin')->user()->id
        ]);

        if ($newProduct) {
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'Product is created successfuly'
            ]);
            $this->mount();
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'Something went wrong please try again later'
            ]);
        }
    }

    public function updateProduct() {
        $product = Product::find($this->currentProductId);
        if ($product) {

            $this->validate([
                'name'  =>  'required|min:6|max:32',
                'desc'  =>  'required|min:6|max:64',
                'price'  =>  'required|integer',
                'status'    =>  'required'
            ]);

            $updateProduct = $product->update([
                'name'  =>  $this->name,
                'desc' =>  $this->desc,
                'price'  =>  $this->price,
                'status'    => $this->status,
                'admin_id'  =>  Auth::guard('admin')->user()->id
            ]);

            if ($updateProduct) {
                $this->dispatchBrowserEvent('toastr:success', [
                    'message'   =>  'Product is updated successfuly'
                ]);
                $this->mount();
            } else {
                $this->dispatchBrowserEvent('toastr:error', [
                    'message'   =>  'Something went wrong please try again later'
                ]);
            }
        }
    }

    public function deleteProduct($id) {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            $this->dispatchBrowserEvent('toastr:success', [
                'message'   =>  'Product is deleted successfuly'
            ]);
            $this->mount();
        } else {
            $this->dispatchBrowserEvent('toastr:error', [
                'message'   =>  'No product with this ID'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.products', [
            'products' =>  Product::where('name', 'like', '%'.$this->search.'%')->paginate(10),
        ])->extends('layouts.admin.app');
    }
}