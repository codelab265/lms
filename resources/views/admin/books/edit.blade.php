
<div class="modal fade" id="edit{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <form enctype="multipart/form-data" class="needs-validation" action="{{ route('admin.book') }}" method="post" novalidate>
        @csrf
        @method('patch')
        <input type="hidden" name="id" value="{{ $id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Book </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Category</label>
                                                <select name="category_id" class="form-control" id="validationCustom01" required>
                                                <option value="{{ $book->category_id }}">{{ $book->category->name }}</option>
                                                   @foreach ($categories as $category)
                                                   <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                   @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Book Title</label>
                                                <input type="text" class="form-control" name="title" id="validationCustom01" placeholder="Book title" value="{{ $book->title }}"  required>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Book Author</label>
                                                <input type="text" class="form-control" name="author" id="validationCustom01" placeholder="Book author" value="{{ $book->author }}"   required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Publisher</label>
                                                <input type="text" class="form-control" name="publisher" id="validationCustom01" placeholder="Publisher" value="{{ $book->publisher }}"   required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Copyright</label>
                                                <input type="text" class="form-control" name="copyright" id="validationCustom01" placeholder="Copyright" value="{{ $book->copyright }}"   required>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Call Number</label>
                                                <input type="number" class="form-control" name="call_number" id="validationCustom01" placeholder="Call number" value="{{ $book->call_number }}"   required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">ISBN NO.</label>
                                                <input type="text" class="form-control" name="isbn_no" id="validationCustom01" placeholder="ISBN NO." value="{{ $book->isbn_no }}"   required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                                <label class="form-label" for="validationCustom01">Price</label>
                                                <input type="number" class="form-control" name="price" id="validationCustom01" placeholder="Price" value="{{ $book->price}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Ed.</label>
                                                <input type="text" class="form-control" name="edition" id="validationCustom01" placeholder="Edition" value="{{ $book->edition }}"   required>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Quantity</label>
                                                <input type="number" class="form-control" name="quantity" id="validationCustom01" placeholder="Quantity" value="{{ $book->quantity }}"  required>

                                            </div>
                                        </div>
                                    </div>

                                <div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-xl-12">
                                            <div class="btn-group btn-group-example mb-3 float-end" role="group">
                                                <button type="button" class="btn btn-danger w-md" data-bs-dismiss="modal"><i class="mdi mdi-thumb-down"></i> Cancel </button>
                                                <button type="submit" class="btn btn-primary w-md" name="btn_book"><i class="mdi mdi-thumb-up"></i> Save</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                                        </div>
                                                </div>

                                            </div>
                                            <!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                        </form>
                                    </div><!-- /.modal mao ni-->

