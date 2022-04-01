<div>
    @section('title', 'Posts | Dashboard')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between mb-2">
                <input type="text" placeholder="Search" class="border border-gray text-indent-4" wire:model="search">
                @if($editForm)
                    <button class="btn btn-outline-info" wire:click="resetForms">Return back</button>
                @elseif($createForm)
                    <button class="btn btn-outline-info" wire:click="resetForms">Return back</button>
                @else
                    <button class="btn btn-success" wire:click="openCreateForm">Create post</button>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    @if($editForm)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Update {{$title}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md">
                                        <input type="text" placeholder="Enter Post title" class="form-control mt-4" wire:model.lazy="title">
                                        @error('title')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <input type="text" placeholder="Enter Post content" class="form-control mt-4" wire:model.lazy="content">
                                        @error('content')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <select name="status" class="form-control mt-4" wire:model.lazy="status">
                                            <option value="Active">Active</option>
                                            <option value="Pinding">Pinding</option>
                                            <option value="Refused">Refused</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <select name="category_id" class="form-control mt-4" wire:model.lazy="category_id">
                                            @foreach($allCategories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <button class="btn btn-success my-4" wire:click="updatePost">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($createForm)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Create new Post</h5>
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
                                        <input type="text" placeholder="Enter Post title" class="form-control mt-4" wire:model.lazy="title">
                                        @error('title')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <input type="text" placeholder="Enter Post content" class="form-control mt-4" wire:model.lazy="content">
                                        @error('content')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <select name="status" class="form-control mt-4" wire:model.lazy="status">
                                            <option value="Active">Active</option>
                                            <option value="Pinding">Pinding</option>
                                            <option value="Refused">Refused</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <select name="category_id" class="form-control mt-4" wire:model.lazy="category_id">
                                            {{-- @if Just one category make it selected else : make your foreach
                                                Or by another way and this is the best IS : make every first element selected by default--}}
                                            @foreach($allCategories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <button class="btn btn-success my-4" wire:click="createPost">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Posts Table</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Thumb Image</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                        <tr>
                                            <th scope="row">{{$post->id}}</th>
                                            <td><img style="width: 40px;height: 40px; object-fit: cover; border-radius: 10px" src="{{asset("storage/$post->image_path")}}" /></td>
                                            <td>{{$post->title}}</td>

                                            @if($post->status == 'Active')
                                                <td><span class="badge bg-success">{{$post->status}}</span></td>
                                            @elseif($post->status == 'Pinding')
                                                <td><span class="badge bg-warning">{{$post->status}}</span></td>
                                            @else
                                                <td><span class="badge bg-danger">{{$post->status}}</span></td>
                                            @endif

                                            <td>{{$this->getCategoryName($post->category_id)}}</td>

                                            <td>
                                                <button class="btn btn-outline-primary" wire:click="openEditForm({{$post->id}})">Edit</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-danger" wire:click="deletePost({{$post->id}})">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                {{ $posts->links('livewire.admin.pages.custom-pagination') }}
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
