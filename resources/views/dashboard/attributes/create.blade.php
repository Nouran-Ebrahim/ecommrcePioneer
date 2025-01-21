<!-- Modal -->
<div class="modal fade" id="attributeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.create') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- validations error this medola without any refresh --}}
                <div class="alert alert-danger" id="error_div" style="display: none">
                    <ul id="error_list">
                    </ul>
                </div>

                <form id="createAttributeForm" class="form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="eventRegInput1">{{ __('dashboard.name_en') }}</label>
                                <input type="text" value="{{ old('name.en') }}" class="form-control"
                                    placeholder="{{ __('dashboard.name_en') }}" name="name[en]">
                                <strong class="text-danger" id="error_name.en"></strong>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="eventRegInput1">{{ __('dashboard.name_ar') }}</label>
                                <input type="text" value="{{ old('name.ar') }}" class="form-control"
                                    placeholder="{{ __('dashboard.name_ar') }}" name="name[ar]">
                                    <strong class="text-danger" id="error_name.ar"></strong>

                                </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row attribute_values_row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="eventRegInput1">{{ __('dashboard.attribute_value_ar') }}</label>
                                <input type="text" class="form-control"
                                    placeholder="{{ __('dashboard.attribute_value_ar') }}" name="values[1][ar]">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="eventRegInput1">{{ __('dashboard.attribute_value_en') }}</label>
                                <input  type="text" class="form-control"
                                    placeholder="{{ __('dashboard.attribute_value_en') }}" name="values[1][en]">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button disabled  type="button" class="btn btn-danger remove">
                                <i class="ft-x"></i>
                            </button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" id="add_more">
                                <i class="ft-plus"></i>
                            </button>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="ft-x"></i>{{ __('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-primary"> <i class="la la-check-square-o"></i>
                            {{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
