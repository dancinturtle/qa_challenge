@extends ('layout')
@section ('header', 'Answers to: ' . $question->question)
@section ('content')
  <form>
    <div class="form-group">
      <label for="answer">{{$labelText}}</label>
      <input type="text" class="form-control" id="answer" aria-describedby="questionHelp">
      <small id="answerHelp" class="form-text text-muted">5 character minimum</small>
    </div>
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