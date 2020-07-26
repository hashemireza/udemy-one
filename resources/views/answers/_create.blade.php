<div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Your Answer</h3> 
                    </div>
                    <hr>
                     @include('layouts._message')
           			<form action="{{ route('questions.answers.store', $question->id) }}" method="post">
                  @csrf
           				<div class="form-group">
           					<textarea class="form-control" name="body" id="" rows="7"></textarea>
           				</div>
                  @if($errors->first('body'))
                    <div class="alert-danger" style="padding: 3px;">
                        <strong>{{ $errors->first('body') }}</strong>
                    </div>
                  @endif
                   
           				<div class="form-group">
           					<input type="submit" class="btn btn-lg btn-outline-primary">
           				</div>
           			</form>
                </div>
            </div>
        </div>
    </div>