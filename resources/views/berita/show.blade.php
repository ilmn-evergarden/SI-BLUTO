@extends(Auth::user()->role == 'kepala_desa' 
    ? 'layouts.kepala.app' 
    : 'layouts.aparat.app')

@section('content')

<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">

<h2>{{ $news->title }}</h2>

<p class="text-muted">
Ditulis oleh: {{ $news->author->name ?? '-' }} |
{{ $news->created_at->format('d M Y') }}
</p>

@if($news->image)
<img src="{{ asset('storage/'.$news->image) }}" 
     class="img-fluid mb-3"
     style="max-height:300px;">
@endif

<hr>

<p style="white-space: pre-line;">
{!! $news->content !!}
</p>

</div>
</div>

</div>
</div>

@endsection