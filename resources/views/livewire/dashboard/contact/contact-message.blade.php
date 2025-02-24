<div class="email-app-list">
    <div class="card-body chat-fixed-search">
        <fieldset class="form-group position-relative has-icon-left m-0 pb-1">
            <input wire:model.live="itemSearch" type="text" class="form-control" id="iconLeft4"
                placeholder="Search email">
            <div class="form-control-position">
                <i class="ft-search"></i>
            </div>
        </fieldset>
    </div>
    <div id="users-list" class="list-group">
        <div class="users-list-padding media-list">
            @forelse ($messages as $message)
                <a href="#" class="media border-0">
                    <div class="media-left pr-1">
                        <span class="avatar avatar-md">
                            <span class="media-object rounded-circle text-circle bg-info">T</span>
                        </span>
                    </div>
                    <div class="media-body w-100">
                        <h6 class="list-group-item-heading text-bold-500">{{ $message->name }}
                            <span class="float-right">
                                <span class="font-small-2 primary">{{ $message->created_at->diffForHumans() }}</span>
                            </span>
                        </h6>
                        <p class="list-group-item-text text-truncate text-bold-600 mb-0">
                            {{ $message->subject }}</p>
                        <p class="list-group-item-text mb-0">{{ $message->message }}
                            <span class="float-right primary">
                                <span class="badge badge-danger mr-1">New contact</span> <i
                                    class="font-medium-1 ft-star blue-grey lighten-3"></i></span>
                        </p>
                    </div>
                </a>
            @empty
                <div class="text-center p-3">No messages found.</div>
            @endforelse
            {{ $messages->links('vendor.pagination.simple-bootstrap-5') }}


        </div>
    </div>
</div>
