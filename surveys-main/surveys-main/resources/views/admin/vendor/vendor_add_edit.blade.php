@if (session()->has('message'))
    <script>
        showToast('success', '{{ session('message') }}')
    </script>
@endif

<section class="layout-box-content-format1">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card card-primary list-view">
                <div class="card-header box-shdw">
                    <h3 class="card-title">Vendor</h3>
                    <x-button-component title='<i class="fas fa-list"></i> List' url="{{ url('admin/') }}/vendor" />
                    @if ($mode == 'Edit')
                        <x-button-component title='<i class="fas fa-history"></i> LOG' mclass="openModal" mtitle="LOG"
                            mhref="{{ url('admin/log/vendor/') }}/{{ $editData ? $editData->id : '' }}" />
                    @endif

                </div>
                <form name="vendorForm" id="vendorForm" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="formblock-box">
                            @csrf
                            <input type="hidden" name="mode" id="mode" value="{{ $mode }}" />
                            <input type="hidden" name="id" id="id"
                                value="{{ $editData ? $editData->id : '' }}" />

                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Vendor name</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            placeholder="Enter Vendor Name"
                                            value="{{ $editData ? $editData->name : '' }}" />
                                        <div id="name_error" class="invalid-feedback d-block error-text"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Vendor email</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            placeholder="Enter Vendor Email"
                                            value="{{ $editData ? $editData->email : '' }}" />
                                        <div id="email_error" class="invalid-feedback d-block error-text"></div>
                                    </div>
                                </div>

                                <div class="col-md-10" id="btnDiv1"></div>
                                <div class="col-md-2 mt-2 " id="btnDiv2">
                                    <div class="form-group mt-4 ">
                                        <button type="submit" style="width: 135px; margin: 0px -28px;" class="btn btn-sm action-button"
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

<script src="{{ asset('assets/admin/') }}/js/vendor.js"></script>
