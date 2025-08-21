<style>
    body {
        background: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border-radius: 15px;
        border: 1px solid black;
        margin-bottom: 20px;
    }

    .card:hover {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
    }

    .copy-icon {
        cursor: pointer;
        color: #007bff;
        font-size: 0.9rem;
        margin-left: 5px;
    }

    .copy-icon:hover {
        color: #0056b3;
    }

    .redirect-url {
        font-size: 0.8rem;
        color: #142df8;
    }

    .redirect-url:hover {
        color: #0056b3;
        text-decoration: none;
    }

    .center-heading {
        text-align: center;
    }

    .me-2 {
        margin: 0 0 0 30px;
    }

    @media (max-width: 768px) {
        .me-2 {
            margin: 0;
        }
    }

</style>

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="d-flex justify-content-between align-items-center py-3">
                    <h2 class="h5 mb-0"><span class="text-muted .center-heading" style="margin: 5px 0 0 5px;">Vendor Details</span></h2>
                    <a href="{{ url('admin/vendor/addedit') }}/{{ $vendorData->id }}" class="btn btn-outline-primary">Edit</a>

                </div>
            
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body" style="height: 125px;">
                                <h5>Clicks</h5>
                                <hr>
                                <p><strong style="font-size: 30px;">{{ $vendorData->clicks_count }}</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body" style="height: 125px;">
                                <h5>Completes</h5>
                                <hr>
                                <p><strong style="font-size: 30px;">{{ $vendorData->complete_count }}</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body" style="height: 125px;">
                                <h5>Terminates</h5>
                                <hr>
                                <p><strong style="font-size: 30px;">{{ $vendorData->terminates_count }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4" style="margin-top: 20px;">
                    <div class="card-body">
                        <h5>vendor info</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name: </strong>{{ $vendorData->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email: </strong>{{ $vendorData->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>vendor ID: {{ $vendorData->vendor_id }}</strong></p>
                            </div>
                        </div>
                        @if(!empty($vendorData->entry_link))
                            <p><strong>Entry Link:</strong><br> <a href="{{ url('/') }}/{{ $vendorData->entry_link }}" target="_blank" style="font-size: 1rem;" class="redirect-url">{{ url('/') }}/{{ $vendorData->entry_link }}</a> <i class="fas fa-copy copy-icon"></i></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/') }}/js/vendors.js"></script>
