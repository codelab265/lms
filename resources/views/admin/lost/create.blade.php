<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <form enctype="multipart/form-data" class="needs-validation" action="{{ route('admin.lostbooks') }}" method="post"
        novalidate>
        @csrf
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Add Book </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_id">Borrower's name</label>
                                <select class="form-control" name="user_id" id="student_id" required>
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->studentDetail->fname }} {{ $user->studentDetail->lname }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="book_title">Book title</label>
                                    <Select name="book_title" id="book_title" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                                        @endforeach
                                    </Select>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="date_of_lost">Date of lost</label>
                                <input type="date" name="date_of_lost" id="date_of_lost" class="form-control"
                                    placeholder="" aria-describedby="helpId" required>

                            </div>

                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="course">Course/year</label>
                                <input type="text" name="course" id="course" class="form-control" placeholder=""
                                    aria-describedby="helpId" required>

                            </div>

                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="access_number">Access Number</label>
                                <select name="access_number" id="access_number" class="form-control" required>

                                </select>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="btn-group btn-group-example mb-3 float-end" role="group">
                                <button type="button" class="btn btn-danger w-md" data-bs-dismiss="modal"><i
                                        class="mdi mdi-thumb-down"></i> Cancel </button>
                                <button type="submit" class="btn btn-primary w-md"><i class="mdi mdi-thumb-up"></i>
                                    Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</form>
</div><!-- /.modal -->
