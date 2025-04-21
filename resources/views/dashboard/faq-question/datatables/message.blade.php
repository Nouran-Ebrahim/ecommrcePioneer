<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_{{ $faqsQuestion->id }}">
    Show message
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_{{ $faqsQuestion->id }}" tabindex="-1"
    aria-labelledby="exampleModal_{{ $faqsQuestion->id }}_Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal_{{ $faqsQuestion->id }}_Label">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="color: black">
                    {{ $faqsQuestion->message }}
                </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
