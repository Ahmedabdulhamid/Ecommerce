<button type="button" class="btn btn-sm btn-primary" wire:click="$dispatch('attrUpdate', { id: {{ $attribute->id }} })"
    data-bs-toggle="modal" data-bs-target="#attribute_{{ $attribute->id }}">
    {{ __('categories.edit') }}
</button>
<div class="modal fade editModal" id="attribute_{{ $attribute->id }}" data_id="{{ $attribute->id }}" tabindex="-1"
    aria-labelledby="attribute_{{ $attribute->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @livewire('admin.attributes.update-attribute')
            </div>

        </div>
    </div>
</div>

<button class="btn btn-sm btn-outline-success " wire:click="$dispatch('show',{id:{{ $attribute->id }}})"
    type="button"id="" data-bs-toggle="modal" data-bs-target="#show_{{ $attribute->id }}">Show</button>

{{-- MODAL START --}}
<div class="modal fade showModal" id="show_{{ $attribute->id }}" data_id="{{ $attribute->id }}" tabindex="-1"
    aria-labelledby="show_{{ $attribute->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @livewire('admin.attributes.show-data')
            </div>

        </div>
    </div>
</div>
{{-- MODAL END --}}
<button type="button" class="btn btn-sm btn-danger del"
    wire:click="$dispatch('deleteAttr', { id: {{ $attribute->id }} })" id="{{ $attribute->id }}"data-bs-toggle="modal"
    data-bs-target="#delattr_{{ $attribute->id }}">
    {{ __('categories.delete') }}
</button>
<div class="modal fade delattr" id="delattr_{{ $attribute->id }}" data_id="{{ $attribute->id }}" tabindex="-1"
    aria-labelledby="delattr_{{ $attribute->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @livewire('admin.attributes.delete-data')
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('EditAttributeModal', function() {
        let id = $('.editModal').attr('data_id');
        let modal = bootstrap.Modal.getInstance(document.getElementById(`#attribute_${id}`));
        if (modal) {
            modal.hide();
        }

        // إزالة الخلفية المظللة
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());


        // ✅ إعادة تفعيل التمرير بعد إخفاء المودال
        document.body.classList.remove('modal-open');
        document.body.style.overflow = 'auto';
    })
    window.addEventListener('deleteModalHide', function() {
        let id = $('.delattr').attr('data_id');
        let modal = bootstrap.Modal.getInstance(document.getElementById(`#delattr_${id}`));
        if (modal) {
            modal.hide();
        }

        // إزالة الخلفية المظللة
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());

        document.body.classList.remove('modal-open');
        document.body.style.overflow = 'auto';

    })
</script>
<script>
    window.addEventListener('refreshData',()=>{
        console.log('hello');

    })
</script>
