<div>
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                        data-bs-toggle="dropdown">
                        <div class="position-relative">
                            <i class="align-middle" data-feather="bell"></i>
                            @if($this->countOfNotSeenNotifi() !== 0)
                                <span class="indicator">{{$this->countOfNotSeenNotifi()}}</span>
                            @endif
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                        aria-labelledby="alertsDropdown">
                        <div class="dropdown-menu-header">
                            {{$this->countOfNotSeenNotifi()}} New Notifications
                        </div>
                        <div class="list-group">
                            @foreach ($notifications as $notifi)
                                <a href="{{route('admin.notifications')}}" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            @if($notifi->type === 'danger')
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            @elseif($notifi->type === 'success')
                                                <i class="text-success" data-feather="user-plus"></i>
                                            @elseif($notifi->type === 'warning')
                                                <i class="text-warning" data-feather="bell"></i>
                                            @elseif($notifi->type === 'newest')
                                                <i class="text-primary" data-feather="home"></i>
                                            @else
                                                <i class="text-warning" data-feather="bell"></i>
                                            @endif
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">{{$notifi->title}}</div>
                                            <div class="text-muted small mt-1">{{$notifi->content}}</div>
                                            <div class="text-muted small mt-1">{{$notifi->created_at}}</div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="dropdown-menu-footer">
                            <a href="{{route('admin.notifications')}}" class="text-muted">Show all notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                        data-bs-toggle="dropdown">
                        <div class="position-relative">
                            <i class="align-middle" data-feather="message-square"></i>
                            @if($this->countOfNotSeenMsgs() !== 0)
                                <span class="indicator">{{$this->countOfNotSeenMsgs()}}</span>
                            @endif
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                        aria-labelledby="messagesDropdown">
                        <div class="dropdown-menu-header">
                            <div class="position-relative">
                                {{$this->countOfNotSeenMsgs()}} New Messages
                            </div>
                        </div>
                        <div class="list-group">
                            {{-- <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="{{asset('admin/img/avatars/avatar-5.jpg')}}" class="avatar img-fluid
                                            rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark">Vanessa Tucker</div>
                                        <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis
                                            arcu tortor.</div>
                                        <div class="text-muted small mt-1">15m ago</div>
                                    </div>
                                </div>
                            </a> --}}
                            @foreach ($messages as $message)
                                <a href="{{route('admin.messages')}}" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            @if($message->title === 'Bug')
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            @elseif($message->title === 'Contact')
                                                <i class="text-success" data-feather="user-plus"></i>
                                            @elseif($message->title === 'Thanks')
                                                <i class="text-primary" data-feather="home"></i>
                                            @else
                                                <i class="text-primary" data-feather="home"></i>
                                            @endif
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">{{$message->title}}</div>
                                            <div class="text-muted small mt-1">{{$message->content}}</div>
                                            <div class="text-muted small mt-1">{{$message->created_at}}</div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="dropdown-menu-footer">
                            <a href="{{route('admin.messages')}}" class="text-muted">Show all messages</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{asset('admin/img/avatars/avatar.jpg')}}" class="avatar img-fluid rounded me-1"
                            alt="Admin Image" /> <span class="text-dark">{{Auth::guard('admin')->user()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{route('admin.profile')}}"><i
                                class="align-middle me-1" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                data-feather="help-circle"></i> Help Center</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" wire:click="adminLogout">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
