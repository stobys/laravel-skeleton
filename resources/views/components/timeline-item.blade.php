@props([
    'icon'  => 'clock',
    'bg' => 'primary',
])

@php
	// $text = $text ?? $slot;
@endphp

<!-- timeline item -->
<div>
    <i class="fas fa-{{ $icon }} bg-{{ $bg }}"></i>
    <div class="timeline-item">
        <span class="time">
            <i class="fas fa-clock"></i>
            12:05
        </span>
        <h3 class="timeline-header">
            <a href="#">Support Team</a>
            sent you an email
        </h3>

        <div class="timeline-body">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
            weebly ning heekya handango imeem plugg dopplr jibjab, movity
            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
            quora plaxo ideeli hulu weebly balihoo...
        </div>

        <div class="timeline-footer">
            <a class="btn btn-primary btn-sm">Read more</a>
            <a class="btn btn-danger btn-sm">Delete</a>
        </div>
    </div>
</div><!-- END timeline item -->
