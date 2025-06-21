<button type="button" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1 del ">Delete</button>
<button class="btn btn-info btn-min-width btn-glow mr-1 mb-1" data-bs-toggle="modal"
    data-bs-target="#exampleModal">Edit</button>
<button class="btn btn-success btn-min-width btn-glow mr-1 mb-1 text-white" data-bs-toggle="modal"
    data-bs-target="#add_role_{{$admin->id}}">Assign Role</button>
    @include('dashboard.admins.addRoles')
