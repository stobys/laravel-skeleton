@props([
    'margin'    => 0,
    'size'      => 256,
    'style'     => 'round', // square, dot, round
    'ec'        => 'H', // L (7%), M (15%), Q (25%), H (30%)
    //->backgroundColor(191, 215, 50)
    //->color(0, 70, 91)
    //->merge('../public/img/adient/adient-icon-400.png', 0.3, true)

    'code' => '?',
    'text' => '',
])

<div class="qr-content text-center m-4 pt-3" style="display:inline-block; background-color:#bfd732; border: 10px solid #00465b; border-radius:10px;">
    {!! 
        QrCode::encoding('UTF-8')
            -> margin($margin)
            -> style($style) // square, dot, round
            -> size($size)
            -> backgroundColor(191, 215, 50)
            -> color(0, 70, 91)
            -> errorCorrection($ec)
            -> generate($code);
    !!}

    <p class="p-3 m-0 mt-3 qr-label" style="font-size:3rem; background-color:#00465b;">
        <strong style="color:#bfd732">&nbsp;{{ $text }}&nbsp;</strong>
    </p>
</div>
