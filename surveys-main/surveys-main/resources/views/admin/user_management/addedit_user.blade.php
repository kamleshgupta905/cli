<form name="userForm" id="userForm" enctype="multipart/form-data">
    @csrf

    <div class="row">

        <input type="hidden" name="user_id" id="user_id"
            value="@if ($mode == 'Edit' && !empty($usereditData)) {{ $id }} @endif">
        <input type="hidden" name="mode" id="mode" value="{{ $mode }}">

        <x-image-component column="col-md-3" label="Image Size (200 X 200)" name="imagefile" id="imagefile"
            class="" imagePreview="imagePreview"
            value="{{ getEditData($mode, $usereditData, 'profile_image', asset('storage/users')) }}" />
        <div class="col-md-9">
            <div class="row">
                <x-input-component column="col-md-7" type="text" label="Name" name="name" id="name"
                    class="" placeholder="Enter name" value="{{ getEditData($mode, $usereditData, 'name') }}" />

                <x-input-component column="col-md-5" type="text" label="Mobile No" name="mobile_no" id="mobile_no"
                    class="onlynumber" placeholder="Enter mobile no"
                    value="{{ getEditData($mode, $usereditData, 'mobile_no') }}" />

                <x-input-component column="col-md-7" type="email" label="Email" name="email" id="email"
                    class="" placeholder="Enter email" value="{{ getEditData($mode, $usereditData, 'email') }}" />

                <x-select-component :data="$roleList" arraykey="id" arrayValue="role" column="col-md-5" label="Role"
                    name="role_id" id="role_id" class="" placeholder=""
                    value="{{ getEditData($mode, $usereditData, 'role_id') }}" />
            </div>
        </div>

        <x-input-component column="col-md-6" type="text" label="Username" name="username" id="username"
            class="" placeholder="Enter username" value="{{ getEditData($mode, $usereditData, 'username') }}" />

        @if ($mode == 'Add')
            <x-input-component column="col-md-6" type="password" label="Password" name="password" id="password"
                class="" placeholder="Enter password" value="" />

            <x-input-component column="col-md-6" type="password" label="Confirm Password" name="confirm_password"
                id="confirm_password" class="" placeholder="Enter confirm password" value="" />
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <p class="invalid-feedback d-block" id="errormsg"></p>
            <p class="text-brown d-block" id="successmsg"></p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-sm action-button">{{ $btntext }}</button>
        </div>
    </div>

</form>
