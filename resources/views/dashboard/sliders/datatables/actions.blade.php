<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">


        <div class="btn-group" role="group">
            <button id="btnGroupDrop2" type="button" class="btn btn-outline-danger dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('dashboard.delete') }}<i class="la la-trash"></i>
            </button>

            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                <form action="{{ route('dashboard.sliders.destroy', $slider->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete_confirm btn  dropdown-item">{{ __('dashboard.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
