<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('profile') }}" method="post">
        @csrf
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if (Auth()->user()->role == 1)
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Name</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom03"
                                        value="{{ Auth()->user()->name }}" required>
                                </div>
                            </div>
                        @else
                            @php
                                $member = Auth()->user()->role == 2 ? Auth()->user()->studentDetail : Auth()->user()->facultyDetail;
                            @endphp
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first name"
                                            placeholder="Enter first name" required name="fname"
                                            value="{{ $member->fname }}">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middle name"
                                            placeholder="Enter middle name" name="mname" value="{{ $member->mname }}">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="userpassword" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lname"
                                            placeholder="Enter password" required name="lname"
                                            value="{{ $member->lname }}">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom03">Email</label>
                                <input type="email" class="form-control" name="email" id="validationCustom03"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom03">Password</label>
                                <input type="password" class="form-control" name="password" id="validationCustom03"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <input class=" form-control" type="file" name="profile" id="">
                        </div>
                    </div>
                    <div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="btn-group btn-group-example mb-3 float-end" role="group">
                                        <button type="button" class="btn btn-danger w-md" data-bs-dismiss="modal"><i
                                                class="mdi mdi-thumb-down"></i> Cancel </button>
                                        <button type="submit" class="btn btn-primary w-md" name="btn_category"><i
                                                class="mdi mdi-thumb-up"></i> Save</button>
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
