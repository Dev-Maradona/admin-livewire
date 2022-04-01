<div>
    @section('title', 'Dashboard')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
            <div class="row">
                <div class="col-xl-6 col-xxl-5 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Products</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="truck"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$productsCount}}</h1>
                                        {{-- <div class="mb-0">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                -3.65% </span>
                                            <span class="text-muted">Since last week</span>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Users</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$usersCount}}</h1>
                                        {{-- <div class="mb-0">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                5.25% </span>
                                            <span class="text-muted">Since last week</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Posts</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="columns"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$postsCount}}</h1>
                                        {{-- <div class="mb-0">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                6.65% </span>
                                            <span class="text-muted">Since last week</span>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Comments</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="repeat"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{$commentsCount}}</h1>
                                        {{-- <div class="mb-0">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                -2.25% </span>
                                            <span class="text-muted">Since last week</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('charts.recent-movement')
            </div>

            <div class="row">
                @include('charts.browse-usage')
                @include('charts.calendar')
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Latest Products</h5>
                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th class="d-none d-xl-table-cell">Price</th>
                                    <th>Status</th>
                                    <th class="d-none d-md-table-cell">User Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td class="d-none d-xl-table-cell">{{$product->price}}</td>
                                            @if ($product->status === 'Active')  
                                                <td><span class="badge bg-success">{{$product->status}}</span></td>
                                            @elseif($product->status === 'Pinding')
                                                <td><span class="badge bg-warning">{{$product->status}}</span></td>
                                            @else
                                                <td><span class="badge bg-danger">{{$product->status}}</span></td>
                                            @endif
                                        <td class="d-none d-md-table-cell">
                                            {{$product->user_id}}
                                        </td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('charts.monthly-sales')
            </div>
        </div>
    </main>
</div>
