@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">

<div>
{{{"ssss"}}}
<span>
@foreach($categories as $category)
{{$category}}
@endforeach
</span>

</div>
</div>

@endsection
