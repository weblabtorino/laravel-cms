@if( $slider )
    <x-slider-home-page/>
@endif
<section class="container">
    <h1 class="text-3xl font-bold mt-5"> {{ $title }}</h1>
    <article>
        <div class="mt-5 text-sm">
            {!! $content !!}
        </div>
    </article>
</section>

