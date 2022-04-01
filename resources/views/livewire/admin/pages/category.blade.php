<div>
    @section('title', 'Categories | Dashboard')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between mb-2">
                <input type="text" placeholder="Search" class="border border-gray text-indent-4" wire:model="search">
                @if($editForm)
                    <button class="btn btn-outline-info" wire:click="resetForms">Return back</button>
                @elseif($createForm)
                    <button class="btn btn-outline-info" wire:click="resetForms">Return back</button>
                @else
                    <button class="btn btn-success" wire:click="openCreateForm">Create category</button>
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
                                        <input type="text" placeholder="Enter Category Name" class="form-control mt-4" wire:model.lazy="name">
                                        @error('name')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <select name="status" class="form-control mt-4" wire:model.lazy="status">
                                            <option value="Active">Active</option>
                                            <option value="Pinding">Pinding</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <button class="btn btn-success my-4" wire:click="updateCategory">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($createForm)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Create new Category</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md">
                                        <input type="text" placeholder="Enter Category Name" class="form-control mt-4" wire:model.lazy="name">
                                        @error('name')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <select name="status" class="form-control mt-4" wire:model.lazy="status">
                                            <option value="Active">Active</option>
                                            <option value="Pinding">Pinding</option>
                                            <option value="Hidden">Hidden</option>
                                            <option value="Debug">Debug</option>
                                            <option value="Test">Test</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <button class="btn btn-success my-4" wire:click="createCategory">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Categories Table</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row">{{$category->id}}</th>
                                            <td>{{$category->name}}</td>

                                            @if($category->status == 'Active')
                                                <td><span class="badge bg-success">{{$category->status}}</span></td>
                                            @elseif($category->status == 'Pinding')
                                                <td><span class="badge bg-warning">{{$category->status}}</span></td>
                                            @else
                                                <td><span class="badge bg-danger">{{$category->status}}</span></td>
                                            @endif

                                            <td>
                                                <button class="btn btn-outline-primary" wire:click="openEditForm({{$category->id}})">Edit</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-danger" wire:click="deleteCategory({{$category->id}})">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                {{ $categories->links('livewire.admin.pages.custom-pagination') }}
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
