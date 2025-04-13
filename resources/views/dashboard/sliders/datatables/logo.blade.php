<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-75" src="{{ asset($slider->file_name) }}" alt="First slide">
        </div>



    </div>

</div>
<div class="mt-1">
    <button class="btn btn-small btn-outline-primary" data-toggle="model"
        data-target="#fullscreenModal_{{ $slider->id }}">
        <i class="fa fa-expand"></i>Fullscreen
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="fullscreenModal_{{ $slider->id }}" tabindex="-1" role="dialog"
    aria-labelledby="fullscreenModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Full Screen View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset($slider->file_name) }}" alt="First slide">
                        </div>


                    </div>

                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
