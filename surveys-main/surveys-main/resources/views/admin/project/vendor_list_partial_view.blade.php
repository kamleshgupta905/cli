<table class="table customTbl table-bordered table-hover dataTable dataContainer table-striped"
    style="border-radius: 2px;">
    <thead>
        <tr>
            <th>VID</th>
            <th>Email</th>
            <th>CPI</th>
            <th>Limit</th>
            <th>Status</th>
            <th>Clicks</th>
            <th>Complete</th>
            <th>Terminates</th>
            <th>Entry Link</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($assignedVendorList as $List)
            <tr>
                <td><a href="{{ url('/') }}/admin/vendor/view/{{ $List->id }}"
                        target="_blank"><strong>{{ $List->vendor_id }}</strong></a>
                </td>
                <td><a href="mailto:{{ $List->email }}">{{ $List->email }}</a>
                </td>
                <td>{{ $projectsData->cost_per_complete }}</td>
                <td>{{ $projectsData->max_limit }}</td>
                <td><span class="{{ $projectsData->status }}-status">{{ $projectsData->status }}</span></td>
                <td>{{ $List->clicks_count }}</td>
                <td>{{ $List->complete_count }}</td>
                <td>{{ $List->terminates_count }}</td>
                <td><span class="entryLinkModel" data-entry_link="{{ $List->entry_link }}"
                        data-email="{{ $List->email }}" data-vendor_id="{{ $List->vendor_id }}"
                        style="cursor: pointer; color: #142df8;"><i class="fa fa-link" aria-hidden="true"></i> Entry
                        Link</span></td>
            </tr>
        @endforeach
    </tbody>
</table>


<div id="entrylinkmodel" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-body">
                <h3 style="font-size: 1.1rem;font-weight: bold;font-family: sans-serif;" id="vendor_id_model"></h3>
                <p style="font-size: 0.9rem;">{{ $projectsData->name }} project for <span id="email_model"></span>
                </p>
                <p id="entry_link_model"></p>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#entrylinkmodel').on('hidden.bs.modal', function() {
            $("#vendor_id_model").empty();
            $("#email_model").empty();
            $("#entry_link_model").empty();
        });

        $(".entryLinkModel").click(function() {
            var entry_link = $(this).data("entry_link");
            var email = $(this).data("email");
            var vendor_id = $(this).data("vendor_id");

            $("#vendor_id_model").text(`Entry Link for ${vendor_id}`);
            $("#email_model").text(email);
            $("#entry_link_model").html(
                `<a href="{{ url('/') }}/${entry_link}" target="_blank" style="font-size: 1rem;" class="redirect-url">{{ url('/') }}/${entry_link}</a> <i class="fas fa-copy copy-icon"></i>`
            )
            $("#entrylinkmodel").modal('show');
        });

    });
</script>