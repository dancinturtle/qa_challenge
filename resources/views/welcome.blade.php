@extends ('layout')
@section ('header', "Let's talk about veganism")
@section ('content')

  <div class="card mb-3">
    <div class="row">
      <div class="col">
        <img class="img-thumbnail img-fluid" src="{{asset('images/green.jpg')}}" alt="Green sign for new vegans">
      </div>
      <div class="col">
        <div class="card-body">
          <h5 class="card-title">Ask questions</h5>
          <p class="card-text">Veganism, you know it is the way. Is something keeping you from getting started? <a href="{{route('questions.create')}}"> Ask away</a> and see what the vegan community here has to say!</p>
        </div>
      </div>
    </div>
  </div>
  <div class="card mb-3">
    <div class="row">
      <div class="col">
        <img class="img-thumbnail img-fluid" src="{{asset('images/chilies.jpg')}}" alt="Dried chilies for old vegans">
      </div>
      <div class="col">
        <div class="card-body">
          <h5 class="card-title">Answer questions</h5>
          <p class="card-text">Or perhaps you're a seasoned vegan with tips to share with the newcomers. Please <a href="{{route('questions.index')}}">view people's burning questions here</a> and grace us with your wisdom!</p>
        </div>
      </div>
    </div>
  </div>
@endsection