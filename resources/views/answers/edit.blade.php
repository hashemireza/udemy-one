@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h1>Editing answer for question : <strong>{{ $question->title }}</strong></h1> 
                    </div>
                    <hr>
                     @include('layouts._message')
           			<form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="post">
                  	@csrf
                  	@method('patch')
	       				<div class="form-group">
	       					<textarea class="form-control" name="body" id="" rows="7">{{ old('body', $answer->body) }}</textarea>
	       					@if($errors->has('body'))
			                    <div class="alert-danger" style="">
			                        <strong>{{ $errors->first('body') }}</strong>
			                    </div>
	                		@endif
	       				</div>
	                 
	                   
	       				<div class="form-group">
	       					<input type="submit" class="btn btn-lg btn-outline-primary" value="Update">
	       				</div>
           			</form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection