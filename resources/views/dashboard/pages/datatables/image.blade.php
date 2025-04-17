<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img style="max-height: 85px" class="d-block w-75" src="{{ asset('uploads/pages/' . $page->image) }}"
                alt="First slide">
        </div>



    </div>

</div>
<div class="mt-1">
    <button class="btn btn-small btn-outline-primary" data-toggle="model"
        data-target="#fullscreenModal_{{ $page->id }}">
        <i class="fa fa-expand"></i>Fullscreen
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="fullscreenModal_{{ $page->id }}" tabindex="-1"
    aria-labelledby="fullscreenModal_{{ $page->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullscreenModal_{{ $page->id }}Label">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('uploads/pages/' . $page->image) }}" class="d-block w-100" alt="...">
                        </div>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
