<div class="modal fade" id="edit{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('admin.user') }}" method="post" novalidate>
        @csrf
        @method('patch')
        <input type="hidden" name="id" value="{{ $id }}">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myExtraLargeModalLabel">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom03">Name</label>
                                                <input type="text" class="form-control" name="name" id="validationCustom03" value="{{ $user->name }}"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom03">Email</label>
                                                <input type="email" class="form-control" name="email" id="validationCustom03" value="{{ $user->email }}"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom03">Password</label>
                                                <input type="password" class="form-control" name="password" id="validationCustom03"  required>
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