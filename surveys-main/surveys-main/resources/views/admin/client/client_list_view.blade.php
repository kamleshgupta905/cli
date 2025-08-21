@if (session()->has('message'))
    <script>
        showToast('success', '{{ session('message') }}')
    </script>
@endif
<section class="layout-box-content-format1">
    <div class="card card-primary list-view">
        <div class="card-header box-shdw">
            <h3 class="card-title">Client List</h3>
            <x-button-component title='<i class="fas fa-plus"></i> Add' url="{{ url('admin/') }}/client/addedit" />
        </div>
        <div class="card-body">
            <div class="formblock-box">
                <div class="table-responsive">
                    <table class="table customTbl table-bordered table-hover dataTable dataContainer table-striped">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Client name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientList as $key => $client)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $client->client_name }}</td>
                                    <td style="text-align: center;">
                                        @if ($client->is_active == 'Y')
                                            <span class="client-status" data-id="{{ $client->id }}">
                                                <i class="fas fa-check-circle"
                                                    style="font-size: 16px; cursor:pointer; color:green;"></i>
                                            </span>
                                        @else
                                            <span class="client-status" data-id="{{ $client->id }}">
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
                                                        url="{{ url('admin/client/addedit') }}/{{ $client->id }}" />
                                                </td>
                                                <td>
                                                    <x-edit-button-component title='<i class="fas fa-eye"></i>'
                                                        url="{{ url('admin/client/view/') }}/{{ $client->id }}" />

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

<script src="{{ asset('assets/admin/') }}/js/client.js"></script>