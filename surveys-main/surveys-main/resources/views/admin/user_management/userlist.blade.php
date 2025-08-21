<script src="{{ asset('assets/admin/') }}/js/user.js"></script>

@if (session()->has('message'))
    <script>
        showToast('success', '{{ session('message') }}')
    </script>
@endif

<section class="layout-box-content-format1">
    <div class="card card-primary list-view">
        <div class="card-header box-shdw">
            <h3 class="card-title">User List</h3>
            <x-button-component title='<i class="fas fa-plus"></i> Add' mclass="openModal" mtitle="Add User"
                mhref="{{ url('admin/user/addedit') }}" />
        </div>
        <div class="card-body">
            <div class="formblock-box">
                <div class="table-responsive">
                    <table class="table customTbl table-bordered table-hover dataTable dataContainer">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Mobile No.</th>
                                <th>Email</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Login Details</th>
                                <th class="text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                foreach ($userList as $user) { ?>
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><?php echo $user->name; ?> </td>
                                <td><?php echo $user->username; ?></td>
                                <td><?php echo $user->mobile_no; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td class="text-center"><?php echo $user->role->role; ?></td>
                                <td style="text-align: center;">
                                    <?php    if ($user->is_active == 'Y') { ?>
                                    <a href="{{ url('admin/user/status/N') }}/{{ $user->id }}">
                                        <img src="{{ asset('assets') }}/img/active.png"
                                            style="width: 23px;height: 23px;" />
                                    </a>
                                    <?php    } else { ?>
                                    <a href="{{ url('admin/user/status/Y') }}/{{ $user->id }}">
                                        <img src="{{ asset('assets/') }}/img/inactive.png"
                                            style="width: 23px;height: 23px;" />
                                    </a>
                                    <?php    } ?>

                                </td>


                                <td class="text-center">
                                    @if ($user->is_online == 'Y')
                                        <img onclick="openUserloginLogoutDetailModal({{ $user->id }});"
                                            src="{{ asset('assets/img/online.png') }}"
                                            class="image-fluid cursor-pointer" width="25" />
                                    @else
                                        <img onclick="openUserloginLogoutDetailModal({{ $user->id }});"
                                            src="{{ asset('assets/img/offline.png') }}"
                                            class="image-fluid cursor-pointer" width="25" />
                                    @endif
                                </td>

                                <td class="text-center">
                                    <x-edit-button title='<i class="fas fa-edit mb-2"></i>' mclass="openModal"
                                        mtitle="Edit User"
                                        mhref="{{ url('admin/user/addedit/') . '/' . $user->id }}" />
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
