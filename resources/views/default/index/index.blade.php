@extends($view_base_prefix . '/layouts/app')

@section('content')
<div class="row J_mainContent" id="content-main">
    <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="{{route('manage.panel')}}" frameborder="0" data-id="{{route('manage.panel')}}" seamless></iframe>
</div>
@endsection