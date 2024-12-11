<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <a href="{{ route('dashboard.categories.edit', $category->id) }}" role="button"
            class="btn btn-outline-success">@lang('dashboard.edit')</a>
        <button type="button" class="btn btn-outline-danger">2</button>
        <div class="btn-group" role="group">
            <button id="btnGroupDrop2" type="button" class="btn btn-outline-info dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('dashboard.delete')
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="dropdown-item delete_confirm" type="submit">@lang('dashboard.delete')</button>
                </form>
            </div>
        </div>
    </div>
</div>
