@extends ('layout')
@section ('header', 'Answers to this question')
@section ('content')
  <form>
    <div class="form-group">
      <label for="answer">Don't like these answers? Post your own!</label>
      <input type="text" class="form-control" id="answer" aria-describedby="questionHelp">
      <small id="answerHelp" class="form-text text-muted">5 character minimum</small>
    </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <table class="table table-dark mt-5">
    <thead>
      <tr>
        <th scope="col">Date answered</th>
        <th scope="col">Answer</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Jan 3, 2020</th>
        <td>Answer to question</td>
      </tr>
      <tr>
        <th scope="row">Jan 5, 2020</th>
        <td>Answer to question as well</td>
      </tr>
    </tbody>
  </table>
@endsection