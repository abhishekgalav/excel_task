@extends('layouts.master')

@section('content')
    
	 <!-- Begin Page Content -->
                <div class="container-fluid">
                     <div class="row">
                      <div class="col-md-10">
                       <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Import User</li>
                         </ol>
                       </nav>
                      </div>
                     
                    </div>
                  
                    
                    <div>
                      <div class="tab-pane fade show" >
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Import Users</h6>
                        </div>
                        
                        <div class="card-body">
                        <form class="user" action="{{ route('importFile') }}" method="POST" enctype="multipart/form-data">
                        @csrf  
                        <!-- Form Row-->
                              <div class="row gx-3 mb-3">
                                     <!-- Form Group (first name)-->
                                     <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">Name</label>
                                        <input class="form-control" id="file" name="file" type="file" placeholder="Import Your File" required>
                                     </div>
                                      <!-- Form Group (last name)-->
                                      <div class="col-md-6">
                                      <br>
                                      <input class="btn btn-primary" id="butsave" type="submit" value="Submit">
                                     </div>
                             </div>

                        </form>
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

