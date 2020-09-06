@extends ('layout')

@section ('content')
<h1 class="mt-3">Ask your question</h1>
<form>
  <div class="form-group">
    <label for="question">Question</label>
    <input
      type="text"
      class="form-control"
      id="question"
      aria-describedby="questionHelp"
      placeholder="Is yeast vegan?"
    >
    <small
      id="questionHelp"
      class="form-text text-muted"
    >
      5 character minimum and end with a question mark please
    </small>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection