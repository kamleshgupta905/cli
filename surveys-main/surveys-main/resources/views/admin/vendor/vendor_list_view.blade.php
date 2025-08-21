@if (session()->has('message'))
    <script>
        showToast('success', '{{ session('message') }}')
    </script>
@endif
<section class="layout-box-content-format1">
    <div class="card card-primary list-view">
        <div class="card-header box-shdw">
            <h3 class="card-title">Vendor List</h3>
            <x-button-component title='<i class="fas fa-plus"></i> Add' url="{{ url('admin/') }}/vendor/addedit" />
        </div>
        <div class="card-body">
            <div class="formblock-box">
                <div class="table-responsive">
                    <table class="table customTbl table-bordered table-hover dataTable dataContainer table-striped">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Vendor ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Clicks</th>
                                <th>Complete</th>
                                <th>Terminates</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendorList as $key => $vendor)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong>{{ $vendor->vendor_id }}</strong></td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td>{{ $vendor->clicks_count }}</td>
                                    <td>{{ $vendor->complete_count }}</td>
                                    <td>{{ $vendor->terminates_count }}</td>
                                    <td style="text-align: center;">
                                        @if ($vendor->is_active == 'Y')
                                            <span class="vendor-status" data-id="{{ $vendor->id }}">
                                                <i class="fas fa-check-circle"
                                                    style="font-size: 16px; cursor:pointer; color:green;"></i>
                                            </span>
                                        @else
                                            <span class="vendor-status" data-id="{{ $vendor->id }}">
                                                <i class="fa fa-times-circle"
                                                    style="font-size: 16px; cursor:pointer; color:red;"></i>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <x-edit-button-component title='<i class="fas fa-edit"></i>'
                                                        url="{{ url('admin/vendor/addedit') }}/{{ $vendor->id }}" />
                                                </td>
                                                <td>
                                                    <x-edit-button-component title='<i class="fas fa-eye"></i>'
                                                        url="{{ url('admin/vendor/view/') }}/{{ $vendor->id }}" />

                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('assets/admin/') }}/js/vendor.js"></script>