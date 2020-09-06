@extends ('layout')
@section ('header', 'Questions asked so far')
@section ('content')
  <h5>Click a question to view the answers given, or submit your own!</h5>
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope='col'>Date asked</th>
        <th scope='col'>Question asked</th>
        <th scope='col'>Number of answers</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Jan 3, 2020</th>
        <td><a href="{{route('questions.show', '1')}}">Question</a></td>
        <td>5</td>
      </tr>
      <tr>
        <th scope="row">Jan 1, 2020</th>
        <td><a href="{{route('questions.show', '2')}}">Question</a></td>
        <td>3</td>
      </tr>
    </tbody>
  </table>
@endsection