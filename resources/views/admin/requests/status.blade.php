<div class="modal fade" id="status{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('admin.requests.status') }}" method="post" novalidate>
        @csrf 
                                        <input type="hidden" name="id" value="{{ $id }}"/>
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myExtraLargeModalLabel">Change status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- <div class="form-group">
                                              <label for="status">Status</label>
                                              <select class="form-control" name="status" id="status" required>
                                                <option value="">select</option>
                                                <option value="1">Accept</option>
                                                <option value="2">Rejected</option>
                                                
                                              </select>
                                            </div> --}}

                                            <div class="form-group">
                                              <label for="">Status</label>
                                              <select class="form-control" name="status" id="">
                                                <option value=""></option>
                                                <option value="1">Accept</option>
                                                <option value="2">Reject</option>
                                              </select>
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