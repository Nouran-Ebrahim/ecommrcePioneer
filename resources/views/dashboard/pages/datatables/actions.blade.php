<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

        <a href="{{ route('dashboard.pages.edit', $page->id) }}" class="btn btn-outline-success">
            {{ __('dashboard.edit') }} <i class="la la-edit"></i>
        </a>

        <div class="btn-group" role="group">

            <form action="{{ route('dashboard.pages.destroy', $page->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete_confirm btn btn-outline-danger">{{ __('dashboard.delete') }}<i
                        class="la la-trash"></i></button>
            </form>
        </div>
    </div>
</div>
