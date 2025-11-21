<div class="modal fade" id="role_{{$role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @forelse ($role->permissions as $permission)
                <p>{{$permission->getTranslation('name',app()->getLocale())}}</p>
            @empty
                <p class="text-center">{{__('admin.no_per')}}</p>
            @endforelse

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin.close')}}</button>

        </div>
      </div>
    </div>
  </div>
