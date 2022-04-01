<div>
    @section('title', 'Users | Dashboard')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between mb-2">
                <input type="text" placeholder="Search" class="border border-gray text-indent-4" wire:model="search">
                @if($editForm)
                    <button class="btn btn-outline-info" wire:click="resetForms">Return back</button>
                @elseif($createForm)
                    <button class="btn btn-outline-info" wire:click="resetForms">Return back</button>
                @else
                    <button class="btn btn-success" wire:click="openCreateForm">Create user</button>
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
                                        <input type="text" placeholder="Enter User Name" class="form-control mt-4" wire:model.lazy="name">
                                        @error('name')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        <input type="email" placeholder="Enter User Email" class="form-control mt-4" wire:model.lazy="email">
                                        @error('email')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <input type="password" placeholder="Enter User Password" class="form-control mt-4" wire:model.lazy="password">
                                        @error('password')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        <input type="password" placeholder="Retype Password Again" class="form-control mt-4" wire:model.lazy="rpassword">
                                        @error('rpassword')
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
                                        <button class="btn btn-success my-4" wire:click="updateUser">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($createForm)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Create new user</h5>
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
                                        <input type="text" placeholder="Enter User Name" class="form-control mt-4" wire:model.lazy="name">
                                        @error('name')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        <input type="email" placeholder="Enter User Email" class="form-control mt-4" wire:model.lazy="email">
                                        @error('email')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <input type="password" placeholder="Enter User Password" class="form-control mt-4" wire:model.lazy="password">
                                        @error('password')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        <input type="password" placeholder="Retype Password Again" class="form-control mt-4" wire:model.lazy="rpassword">
                                        @error('rpassword')
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
                                        <button class="btn btn-success my-4" wire:click="createUser">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Users Table</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{$user->id}}</th>
                                            <td><img style="width: 40px;height: 40px; object-fit: cover; border-radius: 10px" src="{{asset("storage/$user->image_path")}}" /></td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>

                                            @if($user->status == 'Active')
                                                <td><span class="badge bg-success">{{$user->status}}</span></td>
                                            @elseif($user->status == 'Pinding')
                                                <td><span class="badge bg-warning">{{$user->status}}</span></td>
                                            @else
                                                <td><span class="badge bg-danger">{{$user->status}}</span></td>
                                            @endif

                                            <td>
                                                <button class="btn btn-outline-primary" wire:click="openEditForm({{$user->id}})">Edit</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-danger" wire:click="deleteUser({{$user->id}})">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                {{ $users->links('livewire.admin.pages.custom-pagination') }}
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
