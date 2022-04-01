<div>
    @section('title', 'Messages | Dashboard')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between mb-2">
                <input type="text" placeholder="Search" class="border border-gray text-indent-4" wire:model="search">
                <button class="btn btn-danger" wire:click="clearAllMessages">Clear All</button>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Messages Table</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($messages as $message)
                                <div class="shadow-lg p-4 border border-gray mb-4 d-flex justify-content-between alert-dismissible fade show" role="alert">
                                    <div>
                                        <p>{{$message->title}}</p>
                                        <p>{{$message->email}}</p>
                                        <p>{{$message->content}}</p>
                                        <p>{{$message->created_at}}</p>
                                        @if ($message->status === 'NotSeen')
                                            <button class="btn btn-outline-primary" wire:click="markAsRead({{$message->id}})">Mark As Read</button>
                                        @endif
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" wire:click="clearMessage({{$message->id}})"></button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- {{ $messages->links('livewire.admin.pages.custom-pagination') }} --}}
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
