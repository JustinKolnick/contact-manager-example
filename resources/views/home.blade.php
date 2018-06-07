@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Contacts
					<small class="float-right">
						<button class="btn-xs btn-primary" data-toggle="collapse" href="#search">Search</button>
					</small>
					<small class="float-right">
						<button class="btn-xs btn-success" data-toggle="collapse" href="#contactForm">Add</button>
					</small>
					<!-- <small class="float-right">
						<button class="btn-xs btn-danger" data-toggle="collapse" href="#destroyButtons">Remove</button>
					</small> -->

				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					<div class="collapse col-md-8" id="contactForm">
						<form method="post" action="{{ url('add') }}">
							{{ csrf_field() }}

							<div class="form-group form-inline">
						      <label for="firstName" class="col-sm-3">First Name</label>
						      <input type="text" class="form-control col-sm-6" id="firstName" name="firstName">
						    </div>
							<div class="form-group form-inline">
						      <label for="lastName" class="col-sm-3">Last Name</label>
						      <input type="text" class="form-control  col-sm-6" id="lastName" name="lastName">
						    </div>
							<div class="form-group form-inline">
						      <label for="phone" class="col-sm-3">Phone Number</label>
						      <input type="text" class="form-control  col-sm-6" id="phone" name="phone">
						    </div>
							<div class="form-group form-inline">
						      <label for="street" class="col-sm-3">Street</label>
						      <input type="text" class="form-control  col-sm-6" id="street" name="street">
						    </div>
							<div class="form-group form-inline">
							  <label for="city" class="col-sm-3">City</label>
							  <input type="text" class="form-control  col-sm-6" id="city" name="city">
							</div>
							<div class="form-group form-inline">
							  <label for="state" class="col-sm-3">State</label>
							  <input type="text" class="form-control  col-sm-6" id="state" name="state">
							</div>
							<div class="form-group form-inline">
							  <label for="zip" class="col-sm-3">Zip</label>
							  <input type="text" class="form-control  col-sm-6" id="zip" name="zip">
							</div>
							<div class="form-group text-center">
								<input class="btn btn-primary" align="center" type="submit" value="Submit">
							</div>
						</form>
						<br><br>
					</div>
					<div class="collapse col-sm-7" id="search">
						<form class="form-inline" method="get" action="{{ url('search') }}">
							{{ csrf_field() }}

							<div class="form-group col-sm-10">
						      <label for="search" class="col-sm-3">Search</label>
						      <input type="text" class="form-control col-sm-6" id="search" name="search">
						    </div>
							<div class="form-group text-center col-sm-2">
								<input class="btn btn-primary" align="center" type="submit" value="Submit">
							</div>
						</form>
						<br>
					</div>

					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Phone</th>
								<th scope="col">Street</th>
								<th scope="col">City</th>
								<th scope="col">State</th>
								<th scope="col">Zip</th>
								<th scope="col">User</th>
								<th scope="col">Delete</th>
							</tr>
						</thead>
						<tbody>
							@foreach($contacts as $c)
							<tr>
								<th scope="row">{{ $loop->iteration }}</th>
								<td>{{ $c->firstName }}</td>
								<td>{{ $c->lastName }}</td>
								<td>{{ $c->phone }}</td>
								<td>{{ $c->street }}</td>
								<td>{{ $c->city }}</td>
								<td>{{ $c->state }}</td>
								<td>{{ $c->zip }}</td>
								<td>{{ $c->userID }}</td>
								<td id="destroyButtons{{$c->id}}">
									<a class="btn-sm btn-danger" method="get" href="destroy/{{ $c->id }}">X</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
