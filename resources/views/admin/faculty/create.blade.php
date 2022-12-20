<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('admin.faculty') }}" method="post" novalidate>
        @csrf
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myExtraLargeModalLabel">Add Student</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="useremail" class="form-label">First Name</label>
                                                        <input type="text" class="form-control" id="first name" placeholder="Enter first name" required name="fname">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Middle Name</label>
                                                        <input type="text" class="form-control" id="middle name" placeholder="Enter middle name" name="mname" >
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="userpassword" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" id="lname" placeholder="Enter password" required name="lname" value="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12" id="gender_column" style="transition: 0.5s">
                                                    <div class="mb-3">
                                                        <label for="userpassword" class="form-label">Gender</label>
                                                        <select name="gender" class="form-control" id="gender">
                                                            <option selected="" disabled="">Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="userpassword" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" placeholder="Enter email" required name="email" >
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="userpassword" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="userpassword" placeholder="Enter password" required name="password" >
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                                    
                                <div>
                                <div class="modal-footer">
                                <div class="row">
                                    <div class="col-xl-12">
                                            <div class="btn-group btn-group-example mb-3 float-end" role="group">
                                                <button type="button" class="btn btn-danger w-md" data-bs-dismiss="modal"><i class="mdi mdi-thumb-down"></i> Cancel </button> 
                                                <button type="submit" class="btn btn-primary w-md" name="btn_category"><i class="mdi mdi-thumb-up"></i> Save</button>
                                            </div>  
                                </div>
                            </div>
                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>