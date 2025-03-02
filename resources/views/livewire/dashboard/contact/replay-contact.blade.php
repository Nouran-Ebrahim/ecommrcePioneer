<!-- Modal -->
<div class="modal fade" id="replayContctModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-envelope"></i> {{ __('dashboard.replay') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:wire:submit.prevent="replayContact" class="form">
                    <input type="hidden" wire:model="id">
                    <div class="form-group">
                        <label for="userEmail">{{ __('dashboard.email') }}</label>
                        <input readonly wire:model="email" type="text" class="form-control" id="userEmail"
                            placeholder="{{ __('dashboard.email') }}">
                    </div>
                    <div class="form-group">
                        <label for="subject">{{ __('dashboard.subject') }}</label>
                        <input readonly wire:model="subject" type="text" class="form-control" id="subject"
                            placeholder="{{ __('dashboard.subject') }}">
                    </div>

                    <div class="form-group">
                        <label for="replayMessage">{{ __('dashboard.message') }}</label>
                        <textarea readonly wire:model="replayMessage" rows="4" class="form-control" id="replayMessage"
                            placeholder="{{ __('dashboard.message') }}"></textarea>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="ft-x"></i>{{ __('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-primary"> <i class="la la-check-square-o"></i>
                            {{ __('dashboard.send') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@script
    <script>
        Livewire.on('luanch-replay-contact-modal', () => {
            console.log(885);

            $('#replayContctModal').modal('show');
        });
        Livewire.on('close-modal', () => {
            $('#replayContctModal').modal('hide');
        });
    </script>
@endscript
