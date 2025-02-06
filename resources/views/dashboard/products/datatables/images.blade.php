<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($row->images as $index => $image)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }} ">
                <img class="d-block w-100" src="{{ asset('uploads/products/' . $image->file_name) }}" alt="First slide">
            </div>
        @endforeach


    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="mt-1">
    <button class="btn btn-small btn-outline-primary" data-toggle="model" data-target="#fullscreenModal_{{ $row->id }}">
        <i class="fa fa-expand"></i>Fullscreen
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="fullscreenModal_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalTitle"
    aria-hidden="true">
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
                        @foreach ($row->images as $index => $image)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }} ">
                                <img class="d-block w-100" src="{{ asset('uploads/products/' . $image->file_name) }}"
                                    alt="First slide">
                            </div>
                        @endforeach


                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
