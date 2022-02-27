@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

<style>
    .pull-right {
        float: right;
        padding-bottom: 3px;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if (session()->has('error-message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get('error-message') }}
                        </div>
                    @endif

                    <div class="actions">
                        <div class="pull-right">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createTaskModal">Create task</button>
                        </div>
                    </div>

                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todos as $todo) 
                                <tr>
                                    <td>{{$todo->task_description}}</td>
                                    <td>{{ date('d/m/Y H:i A', strtotime(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $todo->deadline, auth()->user()->timezone))) }}
                                    </td>
                                </tr>
                            @endforeach

                            @if(!count($todos)) 
                                <tr>
                                    <td class="text-center" colspan="2">Create your first todo now</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


		<!-- Modal Example Start-->
        <div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria- 
            labelledby="demoModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="demoModalLabel">Create new task</h5>
								<button type="button" class="close" data-dismiss="modal" aria- 
                                label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							<form action="{{ route('task-create') }}" method="POST" class="form-horizontal" id="create-task-form">
                                {{ csrf_field() }}
                                <label for="description" class="form-label">Task Description</label>
                                <input type="text" name="description" class="form-control">
                                <label for="deadline">Deadline</label>
                                <input type="text" class="form-control datetimepicker" name="deadline"> 
                            </form>
						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-primary" onclick="$('#create-task-form').submit();">Save 
                                changes</button>
						</div>
					</div>
				</div>
			</div>
	 <!-- Modal Example End-->
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
           $('.datetimepicker').datetimepicker();
        });
    </script> 
@endsection
