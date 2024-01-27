@extends('layouts.master')

@section('content')
    
	 <!-- Begin Page Content -->
                <div class="container-fluid">
                     <div class="row">
                      <div class="col-md-10">
                       <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                         </ol>
                       </nav>
                      </div>
                     
                    </div>
                  
                    
                    <div>
                      <div class="tab-pane fade show" >
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           <th> Id</th>
										                       <th>Name</th>
                                           <th>Mobile</th>
                                           <th>Address</th>
										                       <th>City</th>
                                           <th>State</th>
                                           <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th> Id</th>
										                       <th>Name</th>
                                           <th>Mobile</th>
                                           <th>Address</th>
										                       <th>City</th>
                                           <th>State</th>
                                           <th>Image</th>
                                       </tr>
                                    </tfoot>
                                    <tbody>
                     						   @foreach($users as $user)
                                    <tr>
                                     <td>{{$user->id}}</td>           
                                     <td>{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</td>            
                                     <td>{{$user->mobile}}</td>
                                     <td>{{$user->address}}</td>
                                     <td>{{$user->city}}</td>
                                     <td>{{$user->state}}</td>
                                     <td>     <img class="card-img img-fluid" style="height:100px; width:100px;" src="{{ asset('images/users/')}}/{{$user->image_name}}" alt="Blog image">
                                       </td>
                                    </tr>
                                    @endforeach
                                     </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>  




                      </div>
                      <div class="tab-pane show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                       </div>
                    </div>
                  

                </div>
                <!-- /.container-fluid -->
				<!-- Edit Module Modal -->
	
	

@stop

