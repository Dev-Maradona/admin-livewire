<div>
    @section('title', 'Profile | Dashboard')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Profile</h1>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    @if($changeInformationsForm)
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="card-title mb-0">Informations</h5>
                                <button class="btn btn-outline-primary" wire:click="closeInformationForm">Return Back</button>
                            </div>
                            <div class="card-body h-100">
                                <div class="p-2">
                                    <label class="fw-bold my-1">Name:</label>
                                    <input type="text" placeholder="Name" class="form-control" wire:model.lazy="name">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>   
                                    @enderror
                                </div>
                                <div class="p-2">
                                    <label class="fw-bold my-1">Email Address:</label>
                                    <input type="email" placeholder="Email Adress" class="form-control" wire:model.lazy="email">
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>   
                                    @enderror
                                </div>
                                <div class="p-2">
                                    <label class="fw-bold my-1">Old Password</label>
                                    <input type="password" placeholder="Password" class="form-control" wire:model.lazy="oldPassword">
                                    @error('oldPassword')
                                        <span class="text-danger">{{$message}}</span>   
                                    @enderror
                                </div>
                                <div class="p-2">
                                    <label class="fw-bold my-1">New Password</label>
                                    <input type="password" placeholder="Retype Password" class="form-control" wire:model.lazy="newPassword">
                                    @error('newPassword')
                                        <span class="text-danger">{{$message}}</span>   
                                    @enderror
                                </div>
                                <div class="p-2">
                                    <button class="form-control btn btn-outline-primary" wire:click="saveChanges">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Informations</h5>
                            </div>
                            <div class="card-body h-100">
                                <div class="p-2">
                                    <label class="fw-bold my-1">Admin Name:</label>
                                    <p>{{Auth::guard('admin')->user()->name}}</p>
                                </div>
                                <div class="p-2">
                                    <label class="fw-bold my-1">Email Adress:</label>
                                    <p>{{Auth::guard('admin')->user()->email}}</p>
                                </div>
                                <div class="p-2">
                                    <button class="form-control btn btn-outline-danger" wire:click="openInformationForm">Change Informations</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
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