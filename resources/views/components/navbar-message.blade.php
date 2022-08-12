@props([
    'sender' => 'User',
    'text'   => 'Message Preview ...',
    'time'   => 'some time ago',
    'avatar'    => 'user1-128x128',
])

<div class="media">
    <img src="{{ asset('img/'. $avatar .'.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
    <div class="media-body">
        <h3 class="dropdown-item-title">
            {{ $sender }}
            <span class="float-right text-sm text-danger">
                <i class="fas fa-star"></i>
            </span>
        </h3>
        <p class="text-sm">{{ $text }}</p>
        <p class="text-sm text-muted">
            <i class="far fa-clock mr-1"></i>
            {{ $time }}
        </p>
    </div>
</div>
