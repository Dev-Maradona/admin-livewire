<div>
    @section('title', 'Products | Dashboard')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between mb-2">
                <input type="text" placeholder="Search" class="border border-gray text-indent-4" wire:model="search">
                @if($editForm)
                    <button class="btn btn-outline-info" wire:click="resetForms">Return back</button>
                @elseif($createForm)
                    <button class="btn btn-outline-info" wire:click="resetForms">Return back</button>
                @else
                    <button class="btn btn-success" wire:click="openCreateForm">Create product</button>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    @if($editForm)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Update {{$name}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md">
                                        <input type="text" placeholder="Enter Product Name" class="form-control mt-4" wire:model.lazy="name">
                                        @error('name')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        <input type="text" placeholder="Enter Product Description" class="form-control mt-4" wire:model.lazy="desc">
                                        @error('desc')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <input type="text" placeholder="Enter Product Price" class="form-control mt-4" wire:model.lazy="price">
                                        @error('price')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <select name="status" class="form-control mt-4" wire:model.lazy="status">
                                            <option value="Active">Active</option>
                                            <option value="Pinding">Pinding</option>
                                            <option value="Solt">Solt</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <button class="btn btn-success my-4" wire:click="updateProduct">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($createForm)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Create new product</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md">
                                        <input type="file" class="form-control mt-4" wire:model.lazy="image">
                                        @error('image')
                                            <span class="text-danger" role="alert">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <input type="text" placeholder="Enter Product Name" class="form-control mt-4" wire:model.lazy="name">
                                        @error('name')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        <input type="desc" placeholder="Enter Product Description" class="form-control mt-4" wire:model.lazy="desc">
                                        @error('desc')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <input type="text" placeholder="Enter Product Price" class="form-control mt-4" wire:model.lazy="price">
                                        @error('price')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <select name="status" class="form-control mt-4" wire:model.lazy="status">
                                            <option value="Active">Active</option>
                                            <option value="Pinding">Pinding</option>
                                            <option value="Solt">Solt</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <button class="btn btn-success my-4" wire:click="createProduct">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Products Table</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Preview</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{$product->id}}</th>
                                            <td><img style="width: 40px;height: 40px; object-fit: cover; border-radius: 10px" src="{{asset("storage/$product->image_path")}}" /></td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->desc}}</td>
                                            <td>{{$product->price}}</td>

                                            @if($product->status == 'Active')
                                                <td><span class="badge bg-success">{{$product->status}}</span></td>
                                            @elseif($product->status == 'Pinding')
                                                <td><span class="badge bg-warning">{{$product->status}}</span></td>
                                            @else
                                                <td><span class="badge bg-danger">{{$product->status}}</span></td>
                                            @endif

                                            <td>
                                                <button class="btn btn-outline-primary" wire:click="openEditForm({{$product->id}})">Edit</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-danger" wire:click="deleteProduct({{$product->id}})">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                {{ $products->links('livewire.admin.pages.custom-pagination') }}
            </div>
        </div>
    </main>
    {{-- Javascript -- Toastr --}}
    <script>
        document.addEventListener('livewire:load', function () {
            window.addEventListener('toastr:success', event => {
                toastr.success(event.detail.message);
            });
            window.addEventListener('toastr:error', event => {
                toastr.error(event.detail.message);
            });
        });
    </script>
</div>
