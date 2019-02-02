@extends('layouts.app')

@section('content')
<h1>About</h1>
<div class="row mb-3">
<div class="col-md-6">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, quidem, culpa. Esse soluta corrupti eaque ea voluptas id dolores eos ex dignissimos debitis voluptatem beatae iste, nesciunt iure dolore perspiciatis illo modi! Adipisci dicta, accusamus, nihil culpa impedit nam delectus! Quis repellendus aperiam eaque harum officiis eius esse, eligendi nostrum.</p>
</div>
<div class="col-md-6">
    <div class="well">
        <form action="{{ route('contact.email') }}" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="You name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="You name">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Enter your message"></textarea>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
            {{csrf_field()}}
        </form>
    </div>
</div>
</div>
@endsection