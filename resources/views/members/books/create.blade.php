<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('members.reservation') }}" method="post"
        novalidate>
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}" />

        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Create a request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <input type="text" name="" id="search_query" class="form-control"
                                    placeholder="search" aria-describedby="helpId">

                            </div>
                        </div>
                    </div>
                    <div id="search_container" style="z-index: 50">

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_id">Book Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="book_id">Book</label>
                                <select class="form-control" style="width: 100%" name="book_id" id="book_id">

                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="author">Author</label>
                                <select class="form-control" style="width: 100%" name="author" id="author">

                                </select>

                            </div>
                        </div>

                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="book_id">Book</label>
                                <select class="form-control" name="book_id" id="book_id" required>
                                    
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="access_number">Access number</label>
                                <select class="form-control" name="access_number" id="access_number" required>

                                </select>
                            </div>
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
