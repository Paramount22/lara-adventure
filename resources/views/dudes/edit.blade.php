@extends('layouts.app')

@section('title', 'Edit dude')

@section('content')

    <section class="add-dude">
        <h2 class="mb-3">Edit dude</h2>
        <form action="{{ route('update.dude', $dude->slug ) }}" method="POST" class="" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-md-6 mb-3 offset-md-3">
                <input type="text" name="title" value="{{ $dude->title }}" class="form-control" required="" placeholder="Dude">
            </div>

            <div class="col-md-6 offset-md-3">
                <textarea name="text" placeholder="about dude" class="form-control" rows="5">{{$dude->text}}</textarea>
            </div>

            <div class="form-group">
                @foreach($tags as $tag)

                    <label class="checkbox" for="">{{ $tag->tag }}
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }} ">
                    </label>
                @endforeach
            </div>

            <div class="col-md-6 offset-md-3">
                <button class="btn btn-block mt-3 btn-primary " type="submit">Save</button>
            </div>

            <div class="col-md-6 offset-md-3 pt-2">
                <a href="{{ url('dudes/' . $dude->slug  ) }}">back</a>
            </div>
        </form>

    </section>


@endsection
