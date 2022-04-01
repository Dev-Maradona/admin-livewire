<div>
    @section('title', 'Comments | Dashboard')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between mb-2">
                <input type="text" placeholder="Search" class="border border-gray text-indent-4" wire:model="search">
                @if($editForm)
                    <button class="btn btn-outline-info" wire:click="resetForms">Return back</button>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    @if($editForm)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Update Comment</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md">
                                        <input type="text" placeholder="Enter Comment content" class="form-control mt-4" wire:model.lazy="content">
                                        @error('content')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <select name="status" class="form-control mt-4" wire:model.lazy="status">
                                            <option value="Accepted">Accepted</option>
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
                                        <select name="post_id" class="form-control mt-4" wire:model.lazy="post_id">
                                            @foreach($posts as $post)
                                                <option value="{{$post->id}}">{{$post->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('post_id')
                                            <span class="text-danger" role="alert">{{$message}}</span>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <button class="btn btn-success my-4" wire:click="updateComment">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Comments Table</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Post</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Accept</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comments as $comment)
                                        <tr>
                                            <th scope="row">{{$comment->id}}</th>
                                            <td>{{$comment->content}}</td>

                                            <th>{{$this->getPostTitle($comment->post_id)}}</th>

                                            <th>{{$this->getUserName($comment->user_id)}}</th>

                                            @if($comment->status == 'Accepted')
                                                <td><span class="badge bg-success">{{$comment->status}}</span></td>
                                            @elseif($comment->status == 'Pinding')
                                                <td><span class="badge bg-warning">{{$comment->status}}</span></td>
                                            @else
                                                <td><span class="badge bg-danger">{{$comment->status}}</span></td>
                                            @endif

                                            <td>
                                                <button class="btn btn-outline-success" wire:click="acceptComment({{$comment->id}})">Accept</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-primary" wire:click="openEditForm({{$comment->id}})">Edit</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-danger" wire:click="deleteComment({{$comment->id}})">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                {{ $comments->links('livewire.admin.pages.custom-pagination') }}
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
