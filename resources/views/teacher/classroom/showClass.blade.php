
@foreach($classforms as $classform)
    <div class="class-card">

        @if($classform->form)
            <h2>{{ $classform->form->title }}</h2>
            <div>{!! $classform->form->html_content !!}</div>
        @endif
    </div>
@endforeach
