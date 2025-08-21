@if (session()->has('message'))
    <script>
        showToast('success', '{{ session('message') }}')
    </script>
@endif

<section class="layout-box-content-format1">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary list-view">
                <div class="card-header box-shdw">
                    <h3 class="card-title">Project</h3>
                    <x-button-component title='<i class="fas fa-list"></i> List' url="{{ url('admin/') }}/projects" />
                    @if ($mode == 'Edit')
                        <x-button-component title='<i class="fas fa-history"></i> LOG' mclass="openModal" mtitle="LOG"
                            mhref="{{ url('admin/log/projects/') }}/{{ $editData ? $editData->id : '' }}" />
                    @endif

                </div>
                <form name="projectForm" id="projectForm" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="formblock-box">
                            @csrf
                            <input type="hidden" name="mode" id="mode" value="{{ $mode }}" />
                            <input type="hidden" name="id" id="id"
                                value="{{ $editData ? $editData->id : '' }}" />

                            <input type="hidden" name="client_id_temp" id="client_id_temp"
                                value="{{ $editData ? $editData->client_id : '' }}" />

                            <div class="row p-2">

                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="user_role_id">Client</label>
                                        <div id="state_id_error">
                                            <select class="form-control select2 disabled-field" name="client_id"
                                                id="client_id" @if ($mode == 'Edit')  @endif>
                                                <option value="">Select</option>
                                                @foreach ($clientList as $List)
                                                    <option value="{{ $List->id }}"
                                                        @if ($editData && $editData->client_id == $List->id) selected @endif>
                                                        {{ $List->client_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="client_id_error" class="invalid-feedback d-block error-text">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Project Name</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            placeholder="Enter Project Name"
                                            value="{{ $editData ? $editData->name : '' }}" />
                                        <div id="name_error" class="invalid-feedback d-block error-text"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Cost Per Completes (CPI)</label>
                                        <input class="form-control onlynumber" type="text" id="cost_per_complete"
                                            name="cost_per_complete" placeholder="Enter CPI"
                                            value="{{ $editData ? $editData->cost_per_complete : '' }}" />
                                        <div id="cost_per_complete_error" class="invalid-feedback d-block error-text">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Maximum Completes (Limit)</label>
                                        <input class="form-control onlynumber" type="text" id="max_limit"
                                            name="max_limit" placeholder="Enter Max Limit"
                                            value="{{ $editData ? $editData->max_limit : '' }}" />
                                        <div id="max_limit_error" class="invalid-feedback d-block error-text"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">LOI (In minutes)</label>
                                        <input class="form-control onlynumber" type="text" id="loi"
                                            name="loi" placeholder="Enter Length of interview"
                                            value="{{ $editData ? $editData->loi : '' }}" />
                                        <div id="loi_error" class="invalid-feedback d-block error-text"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">IR</label>
                                        <input class="form-control numberwithdecimal" type="text" id="ir"
                                            name="ir" placeholder="Enter IR"
                                            value="{{ $editData ? $editData->ir : '' }}" />
                                        <div id="ir_error" class="invalid-feedback d-block error-text"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Live URL</label>
                                        <input class="form-control" type="text" id="live_url" name="live_url"
                                            placeholder="Enter Live URL"
                                            value="{{ $editData ? $editData->live_url : '' }}" />
                                        <div id="live_url_error" class="invalid-feedback d-block error-text"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label ckEditor">Description</label>
                                        <textarea class="form-control" id="description" name="description">{{ $editData ? $editData->description : '' }}</textarea>
                                        <div id="description_error" class="invalid-feedback d-block error-text"></div>
                                    </div>
                                </div>



                                <div class="col-md-10" id="btnDiv1"></div>
                                <div class="col-md-2 mt-2 " id="btnDiv2">
                                    <div class="form-group mt-4 ">
                                        <button type="submit" style="width: 135px;" class="btn btn-sm action-button"
                                            id="savebtn">{{ $btntext }}</button>
                                    </div>
                                </div>

                                <span id="sussess_msg" style="padding: 5px;color: #0b6c0b;font-weight: bold;"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('assets/admin/') }}/js/projects.js"></script>
<script>
    CKEDITOR.replace('description');
</script>