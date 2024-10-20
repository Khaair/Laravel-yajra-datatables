<!-- Modal for Create/Edit -->
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="myForm" name="myForm" class="form-horizontal">
                    <input type="hidden" name="my_id" id="my_id">
                    <!-- Main container for dynamic sections -->
                    <div id="dynamic-sections">
                        <!-- First title and body section -->
                        <div class="section">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="title" name="title[]" placeholder="Enter Title" maxlength="50" required="">
                                    <span class="text-danger" id="titleError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Body</label>
                                <div class="col-sm-12">
                                    <textarea id="body" name="body[]" required="" placeholder="Enter Body" class="form-control"></textarea>
                                    <span class="text-danger" id="bodyError"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add More button -->
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="button" id="addMoreBtn" class="btn btn-success">Add More</button>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <div class="col-sm-offset-2 col-sm-10">
                         <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
    // When 'Add More' is clicked
    $('#addMoreBtn').click(function () {
        // Clone the first section and append to the dynamic section
        var newSection = `
            <div class="section">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="title" name="title[]" placeholder="Enter Title" maxlength="50" required="">
                        <span class="text-danger" id="titleError"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Body</label>
                    <div class="col-sm-12">
                        <textarea id="body" name="body[]" required="" placeholder="Enter Body" class="form-control"></textarea>
                        <span class="text-danger" id="bodyError"></span>
                    </div>
                </div>
                <!-- Remove button -->
                <div class="form-group text-right">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-danger removeSection">Remove</button>
                    </div>
                </div>
            </div>
        `;
        $('#dynamic-sections').append(newSection); // Append new section
    });

    // Remove section when 'Remove' button is clicked
    $(document).on('click', '.removeSection', function () {
        $(this).closest('.section').remove(); // Remove the closest section
    });
});

</script>