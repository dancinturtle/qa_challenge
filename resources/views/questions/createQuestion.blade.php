@extends ('layout')

@section ('content')
<h1 class="mt-3">Ask your question</h1>
<form action="{{route('questions.store')}}" method="POST">
  @csrf
  <div class="form-group">
    <label for="question">Question</label>
    <input
      type="text"
      class="form-control
        {{$errors->has('question') ? 'is-invalid' : ''}}
      "
      id="question"
      name="question"
      aria-describedby="questionHelp"
      placeholder="Is yeast vegan?"
      value="{{old('question')}}"
    >
    <small
      id="questionHelp"
      class="form-text
        {{$errors->has('question') ? 'text-danger' : 'text-muted'}}
      "
    >
      @if($errors->has('question'))
        {{$errors->first('question')}}
      @else
        5 character minimum and end with a question mark please.
      @endif
    </small>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection