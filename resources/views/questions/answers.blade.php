@extends ('layout')
@section ('header', 'Answers to: ' . $question->question)
@section ('content')


  @if($flash)
    <div class="alert alert-success" role="alert">
      {{$flash}}
    </div>
  @endif
  <form action="{{route('answers.store', $question)}}" method="POST">
    <div class="form-group">
      @csrf
      <label for="answer">{{$labelText}}</label>
      <input
        type="text"
        class="form-control
          {{$errors->has('answer') ? 'is-invalid' : ''}}
        "
        name="answer"
        id="answer"
        aria-describedby="answerHelp"
        value="{{old('answer')}}"
      >
      <small
        id="answerHelp"
        class="form-text
          {{$errors->has('answer') ? 'text-danger': 'text-muted'}}
        "
      >
        @if($errors->has('answer'))
          {{$errors->first('answer')}}
        @else
          5 character minimum.
        @endif
      </small>
    </div>
    <input type="hidden" value="{{$question->id}}" name="question_id">
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  @if(count($answers) > 0)
    <table class="table table-dark mt-5">
      <thead>
        <tr>
          <th scope="col">Date answered</th>
          <th scope="col">Answer</th>
        </tr>
      </thead>
      <tbody>
        @foreach($answers as $answer)
        <tr>
          <th scope="row">{{date('F j, Y', strtotime($answer->created_at))}}</th>
          <td>{{$answer->answer}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @endif
@endsection