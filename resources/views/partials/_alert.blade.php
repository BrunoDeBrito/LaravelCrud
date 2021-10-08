@if(Session::has('success'))
    
<div class="alert alert-success alert-dismissible fade show" role="alert">
        <div>{{ Session::get('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif($errors && count($errors) > 0)

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{-- <ul class="mb-0">
            @foreach($errors->all() as $error) 
                <li>{{ $error }}</li>
            @endforeach
        </ul> --}}
        <div>{{ $errors->first() }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
@endif
