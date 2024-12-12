<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <a href="{{ route('dashboard.categories.edit', $category->id) }}" role="button"
            class="btn btn-outline-success">@lang('dashboard.edit')</a>
        <input type="checkbox" class="switch change_status" category-id={{ $category->id }} id="switch5"
            @if ($category->status == 1) checked @endif data-group-cls="btn-group-sm" />
        {{-- <button type="button" class="btn btn-outline-danger">2</button> --}}
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
