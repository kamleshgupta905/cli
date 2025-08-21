<style>
    .dt-button {
        color: #fff;
        letter-spacing: 1px;
        font-weight: 700;
        background: #2e3094;
        border: 0;
        border-radius: 5px;
        padding: 2px 10px 2px 10px;
    }
</style>

@if (session()->has('message'))
    <script>
        showToast('success', '{{ session('message') }}')
    </script>
@endif
<section class="layout-box-content-format1">
    <div class="card card-primary list-view">
        <div class="card-header box-shdw">
            <h3 class="card-title">Leads</h3>
        </div>
        <div class="card-body">
            <div class="formblock-box">
                <div class="table-responsive">
                    <table class="table customTbl table-bordered table-hover dataTable dataContainer table-striped">
                        <thead>
                            <tr>
                                <th style="display: none;"></th>
                                <th>Id</th>
                                <th>Project Id</th>
                                <th>Project Name</th>
                                {{-- <th>Vendor</th> --}}
                                {{-- <th>CPI</th> --}}
                                <th class="text-center">Status</th>
                                <th>UID</th>
                                <th>Date</th>
                                <th>IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leadList as $key => $lead)
                                <tr>
                                    <td style="display: none;"></td>
                                    <td>{{ $lead->id }}</td>
                                    <td>{{ $lead->project_id }}</td>
                                    <td>{{ $lead->project_name }}</td>
                                    {{-- <td><a href="{{ url('/') }}/admin/vendor/view/{{ $lead->vid }}"
                                            target="_blank">{{ $lead->vendor_email }}</a></td> --}}
                                    {{-- <td><strong>${{ $lead->cpi }}</strong></td> --}}
                                    <td><span
                                            class="text-center {{ str_replace(' ', '', $lead->status) }}-status">{{ $lead->status }}</span>
                                    </td>
                                    <td><strong>{{ $lead->uid }}</strong></td>
                                    <td>{{ $lead->date }}</td>
                                    <td>{{ json_decode($lead->user_info)->ip_address }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('.dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
