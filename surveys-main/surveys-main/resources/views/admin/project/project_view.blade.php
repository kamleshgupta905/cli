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

    .content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .text {
        flex: 1;
    }

    .button {
        position: relative;
        transition: all 0.3s ease-in-out;
        padding-block: 0.5rem;
        padding-inline: 1.25rem;
        background-color: rgb(46, 48, 148);
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #ffff;
        gap: 10px;
        font-weight: bold;
        border: 3px solid #ffffff4d;
        outline: none;
        overflow: hidden;
        font-size: 15px;
    }

    .icon {
        width: 24px;
        height: 24px;
        transition: all 0.3s ease-in-out;
    }

    .button:hover {
        transform: scale(1.05);
        border-color: #fff9;
    }

    .button:hover .icon {
        transform: translate(4px);
    }

    .button:hover::before {
        animation: shine 1.5s ease-out infinite;
    }

    .button::before {
        content: "";
        position: absolute;
        width: 100px;
        height: 100%;
        background-image: linear-gradient(120deg,
                rgba(255, 255, 255, 0) 30%,
                rgba(255, 255, 255, 0.8),
                rgba(255, 255, 255, 0) 70%);
        top: 0;
        left: -100px;
        opacity: 0.6;
    }

    @keyframes shine {
        0% {
            left: -100px;
        }

        60% {
            left: 100%;
        }

        to {
            left: 100%;
        }
    }

    .layout-box-content-format1 .table.customTbl thead th {
        background: #f3f3ff;
        background-color: rgb(243, 243, 255);
        background-position-x: 0%;
        background-position-y: 0%;
        background-repeat: repeat;
        background-attachment: scroll;
        background-image: none;
        background-size: auto;
        background-origin: padding-box;
        background-clip: border-box;
        border-bottom: 1px solid #f5f5f5;
        font-family: "Montserrat", sans-serif;
    }

    .dropdown-toggle {
        padding: 9px;
    }

    .dropdown-item {
        font-weight: 400;
        width: 100%;
        color: black;
        text-align: inherit;
        white-space: nowrap;
    }

    .dropdown-item:active {
        background-color: #ffcd11;
        color: black;
        text-decoration: none;
    }


    #assignVendorModel .modal-dialog {
        max-width: 500px;
    }

    #assignVendorModel .modal-content {
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    #assignVendorModel .modal-body {
        padding: 2rem;
    }

    #assignVendorModel .form-select {
        width: 100%;
        border-radius: 10px;
        border: 1px solid #ddd;
        background-color: #fff;
        font-size: 1rem;
    }

    #assignVendorModel .form-label {
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .custom-label {
        display: block;
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
        color: #333;
    }
</style>

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="row d-flex flex-column flex-md-row align-items-center">
                    <div class="col-md-8 mb-3 mb-md-0">
                        <h2 class="h5 mb-0">
                            <span class="text-muted center-heading" style="margin: 5px 0 0 5px;">Project Details</span>
                        </h2>
                    </div>
                    <div class="col-md-1 mb-2 mb-md-0">
                        <button class="btn btn-outline-danger w-100" id="project-status" type="button"
                            data-id="{{ $projectsData->id }}">
                            <i class="fas fa-{{ $projectsData->status == 'Live' ? 'pause' : 'play' }}"></i>
                        </button>
                    </div>
                    <div class="col-md-1 mb-2 mb-md-0">
                        <a href="{{ url('admin/project/addedit') }}/{{ $projectsData->id }}"
                            class="btn btn-outline-primary w-100">Edit</a>
                    </div>
                    <div class="col-md-2 mb-2 mb-md-0">
                        <span class="btn btn-outline-secondary w-100" id="duplicate" data-id="{{ $projectsData->id }}"
                            style="cursor: pointer;">Duplicate</span>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body" style="height: 125px;">
                                <h5>Clicks</h5>
                                <hr>
                                <p><strong style="font-size: 30px;">{{ $projectsData->clicks_count ?? 0 }}</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body" style="height: 125px;">
                                <h5>Completes</h5>
                                <hr>
                                <p><strong style="font-size: 30px;">{{ $projectsData->complete_count ?? 0 }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body" style="height: 125px;">
                                <h5>Terminates</h5>
                                <hr>
                                <p><strong style="font-size: 30px;">{{ $projectsData->terminates_count ?? 0 }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4" style="margin-top: 20px;">
                    <div class="card-body">
                        <h5>Project info</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Project Name: {{ $projectsData->name }}</strong></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Status: <span class="{{ $projectsData->status }}-status"
                                            id="status">{{ $projectsData->status }}</span></strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Client Name: {{ $projectsData->client_name }}</strong></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Project ID: {{ $projectsData->project_id }}</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Cost Per Complete (CPI): ${{ $projectsData->cost_per_complete }}</strong>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Maximum Completes (Limit): {{ $projectsData->max_limit }}</strong></p>
                            </div>
                        </div>
                        <p><strong>Live URL:</strong><br> <a href="{{ $projectsData->live_url }}" target="_blank"
                                style="font-size: 1rem;" class="redirect-url">{{ $projectsData->live_url }}</a> <i
                                class="fas fa-copy copy-icon"></i></p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Description</h5>
                        <hr>
                        {!! $projectsData->description !!}
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <div class="content">
                            <div class="text">
                                <h5>Vendors</h5>
                            </div>
                            <button class="button" id="assignbtn">
                                Assign Vendors
                                <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                    <path clip-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <hr style="border: 1px solid black;">
                        <section class="layout-box-content-format1">
                            <div class="formblock-box">
                                <div style="text-align: center;" id="loader">
                                    <img src="{{ asset('assets/') }}/img/loader1.gif" id="gear-loader"
                                        style="margin-left: auto;margin-right: auto;" />
                                </div>

                                <div class="table-responsive" id="vendor_list"></div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="assignVendorModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <form name="vendorAssignForm" method="post" id="vendorAssignForm" enctype="multipart/form-data">
                <input type="hidden" name="project_id" id="project_id" value="{{ $projectsData->id }}" />
                <input type="hidden" name="project_unique_id" id="project_unique_id"
                    value="{{ $projectsData->project_id }}" />
                <input type="hidden" name="client_id" id="client_id" value="{{ $projectsData->client_id }}" />

                <div class="modal-body p-4">
                    <div class="formblock-box">
                        <div class="form-group mb-4">
                            <label for="assign_vendor_id" class="form-label custom-label">Select Vendor*</label>
                            <select class="form-select selectpicker" name="assign_vendor_id[]" id="assign_vendor_id"
                                multiple></select>
                            <div id="assign_vendor_id_error" class="invalid-feedback d-block error-text"></div>
                        </div>
                        <button type="submit" class="button w-100" id="assignVendorButton">Assign Vendor <svg
                                fill="currentColor" viewBox="0 0 24 24" class="icon">
                                <path clip-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                    fill-rule="evenodd"></path>
                            </svg></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{{ asset('assets/admin/') }}/js/projects.js"></script>

