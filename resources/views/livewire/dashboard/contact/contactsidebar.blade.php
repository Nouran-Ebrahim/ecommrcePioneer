<div>
    <div class="form-group form-group-compose text-center">
        <button type="button" class="btn btn-danger btn-block my-1"><i class="ft-mail"></i>
            Compose</button>
    </div>
    <h6 class="text-muted text-bold-500 mb-1">Messages</h6>
    <div class="list-group list-group-messages">
        <a wire:click.prevent="selectScreen('inbox')" href="#"
            class="list-group-item @if ($screen == 'inbox') active @endif border-0">
            <i class="ft-inbox mr-1"></i> Inbox
            <span class="badge badge-secondary badge-pill float-right">8</span>
        </a>
        <a wire:click.prevent="selectScreen('readed')" href="#"
            class="list-group-item @if ($screen == 'readed') active @endif list-group-item-action border-0"><i
                class="la la-paper-plane-o mr-1"></i> Readed</a>
        <a wire:click.prevent="selectScreen('answered')" href="#"
            class="list-group-item @if ($screen == 'answered') active @endif list-group-item-action border-0"><i
                class="ft-file mr-1"></i> Answered</a>

        <a href="#" class="list-group-item list-group-item-action border-0"><i class="ft-star mr-1"></i>
            Starred<span class="badge badge-danger badge-pill float-right">3</span> </a>
        <a wire:click.prevent="selectScreen('trash')" href="#" class="list-group-item @if ($screen == 'trash') active @endif list-group-item-action border-0"><i class="ft-trash-2 mr-1"></i>
            Trash</a>
    </div>
    {{-- <h6 class="text-muted text-bold-500 mt-1 mb-1">Labels</h6>
    <div class="list-group list-group-messages">
        <a href="#" class="list-group-item list-group-item-action border-0">
            <i class="ft-circle mr-1 warning"></i> Work
            <span class="badge badge-warning badge-pill float-right">5</span>
        </a>
        <!--<a href="#" class="list-group-item list-group-item-action border-0"><i class="ft-circle mr-1 danger"></i> Family</a>-->
        <!--<a href="#" class="list-group-item list-group-item-action border-0"><i class="ft-circle mr-1 primary"></i> Friends</a>-->
        <a href="#" class="list-group-item list-group-item-action border-0"><i class="ft-circle mr-1 success"></i>
            Private <span class="badge badge-success badge-pill float-right">3</span> </a>
    </div> --}}
</div>
