<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

        <div class="btn-group" role="group">


            <div>
                <form action="{{ route('dashboard.faqsQuestions.destroy', $faqsQuestion->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="delete_confirm btn btn-outline-danger">{{ __('dashboard.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
