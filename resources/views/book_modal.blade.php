<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookForm" name="bookForm">
                    <input type="hidden" name="book_id" id="book_id">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Title</label>
                                <div class="col-lg-12">
                                    <input type="text" name="title" id="title" class="form-control"
                                        placeholder="Title" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Description</label>
                                <div class="col-lg-12">
                                    <textarea name="description" rows="5" id="description" class="form-control" placeholder="Description"
                                        value="" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-sm-2 control-label">Price</label>
                                <div class="col-lg-12">
                                    <input type="number" name="price" id="price" class="form-control"
                                        placeholder="Price" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-sm-2 control-label">Image</label>
                                <div class="col-lg-12">
                                    <input type="file" accept="jpg,png,svg" name="image" id="image" class="form-control"
                                        placeholder="Image" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="current_image" class="col-sm-2 control-label">Current Image</label>
                                <div class="col-12">
                                    <img id="current_image" src="" style="max-width: 100%; height: auto;"
                                        width="100px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 mt-2">
                            <button type="submit" class="btn btn-primary btn-sm" id="saveBook"><i
                                    class="fas fa-plus"></i> Add Book</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="updateBook"><i
                                    class="far fa-edit"></i> Update Book</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
