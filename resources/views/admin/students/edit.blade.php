<div class="modal fade" id="edit{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('admin.students') }}" method="post" novalidate>
        @csrf
        @method('patch')

        <input type="hidden" name="user_id" value="{{ $user->studentDetail->user_id }}">
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
                                                        <input type="text" class="form-control" id="first name" placeholder="Enter first name" required name="fname" value="{{ $user->studentDetail->fname }}">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Middle Name</label>
                                                        <input type="text" class="form-control" id="middle name" placeholder="Enter middle name" name="mname" value="{{ $user->studentDetail->mname }}" >
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="userpassword" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" id="lname" placeholder="Enter password" required name="lname" value="{{ $user->studentDetail->lname }}">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" id="gender_column" style="transition: 0.5s">
                                                    <div class="mb-3">
                                                        <label for="userpassword" class="form-label">Gender</label>
                                                        <select name="gender" class="form-control" id="gender">
                                                            <option value="{{ $user->studentDetail->gender }}">{{ $user->studentDetail->gender }}</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="course_column">
                                                    <div class="mb-3">
                                                        <label for="userpassword" class="form-label">Course</label>
                                                        <select name="course" class="form-control" id="course" required="">
                                                            <option value="{{ $user->studentDetail->course }}">{{ $user->studentDetail->course }}</option>
                                                            <option value="BSIT">BSIT</option>
                                                            <option value="BSED">BSED</option>
                                                            <option value="BEED">BEED</option>
                                                            <option value="BSBA">BSBA</option>
                                                        </select>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="level_column">
                                                    <div class="mb-3">
                                                        <label for="userpassword" class="form-label">Year Level</label>
                                                        <select name="level" class="form-control" id="gender">
                                                            <option value="{{ $user->studentDetail->level }}">{{ $user->studentDetail->level }}</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
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