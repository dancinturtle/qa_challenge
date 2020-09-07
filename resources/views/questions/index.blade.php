@extends ('layout')
@section ('header', 'Questions asked so far')
@section ('content')
  <h5>Click a question to view the answers given, or submit your own!</h5>

  @if($flash)
    <div class="alert alert-success" role="alert">
      {{$flash}}
    </div>
  @endif

  <table class="table table-dark">
    <thead>
      <tr>
        <th scope='col'>Date asked</th>
        <th scope='col'>Question asked</th>
        <th scope='col'>Number of answers</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($questions as $question)
      <tr>
        <th scope="row">{{date('F j, Y', strtotime($question->created_at))}}</th>
        <td><a href="{{route('questions.show', $question)}}" class="text-light">{{$question->question}}</a></td>
        <td>{{$question->answers_count}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection