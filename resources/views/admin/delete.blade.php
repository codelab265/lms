<div id="delete{{ $id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="{{ route('delete') }}" enctype="multipart/form-data" method="post">
        @csrf
    <input type="hidden" name="page" value="{{ $page }}">
    <input type="hidden" name="id" value="{{ $id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel">Delete Modal</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Are you sure want to delete?</h5>
                                                </div>
                                                <div class="modal-footer">
                                <div class="row">
                                    <div class="col-xl-12">
                                            <div class="btn-group btn-group-example mb-3 float-end" role="group">
                                                   <button type="button" class="btn btn-danger w-md" data-bs-dismiss="modal"><i class="mdi mdi-close"></i> Cancel </button> 
                                                <button type="submit" class="btn btn-primary w-md" name="btn_delete"><i class="mdi mdi-check"></i> Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                        </form>
                                    </div><!-- /.modal -->