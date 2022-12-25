<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Filter Book History </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <input type="number" name="access_number" id="access_number" class="form-control"
                                placeholder="Enter access number here" aria-describedby="helpId" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-block" id="filter_button">
                            Filter
                        </button>
                    </div>
                </div>
                <div class="row mt-2" id="results_row">
                    <div class="col-md-12">
                        <div id="results_container"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.modal-content -->
</div><!-- /.modal-dialog -->

</div><!-- /.modal -->
