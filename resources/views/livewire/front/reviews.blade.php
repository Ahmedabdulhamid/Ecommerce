 <div class="row g-5">
     @if (isset($reviews) && count($reviews) > 0)
         @foreach ($reviews as $review)
             @php
                 $reviewProduct = $review->product;
                 $primaryImage = optional(optional($reviewProduct)->images?->first())->file_name;
             @endphp
             <div class="col-md-6">
                 <div class="product-wrapper py-5">
                     <div class="product-img">
                         <img src="{{ $primaryImage ? asset('storage/products/' . $primaryImage) : asset('front-assets/images/homepage-one/product-img-1.webp') }}"
                             alt="product-img" style="z-index: 1;">
                     </div>
                     <div class="product-info">
                         <div class="review-date">
                             <p>{{ $review->created_at->format('F d, Y') }}</p>
                         </div>
                         <div class="ratings">
                             <span>
                                 <svg width="75" height="15" viewBox="0 0 75 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
                                         fill="#FFA800" />
                                     <path
                                         d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z"
                                         fill="#FFA800" />
                                     <path
                                         d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z"
                                         fill="#FFA800" />
                                     <path
                                         d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z"
                                         fill="#FFA800" />
                                     <path
                                         d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z"
                                         fill="#FFA800" />
                                 </svg>
                             </span>
                         </div>
                         <div class="product-description">
                             <a href="product-sidebar.html" class="product-details">
                                 {{ $reviewProduct?->getTranslation('name', app()->getLocale()) ?? __('admin.not_found') }}
                             </a>
                             <p>{{ $review->comment }}</p>
                         </div>
                     </div>
                     <div class="product-cart-btn my-3"
                         style="{{ app()->getLocale() == 'ar' ? 'direction: rtl;' : '' }}"style="z-index:1;">
                         <button class="product-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                             wire:click="editReview({{ $review->id }})">
                             {{__('front.edit_review')}}
                         </button>
                         @include('front.users.modal_actions')
                         <button class="product-btn mx-2" wire:click='confirmDelete({{ $review->id }})'>
                             {{__('front.delete_review')}}
                         </button>
                     </div>

                 </div>
             </div>
         @endforeach
     @else
         <div class="d-flex justify-content-center">
             <div class="row">
                 <div class="col-lg-6.col-md-6.col-sm-12">
                     <img src="{{ asset('front-assets/images/homepage-one/empty-wishlist.webp') }}" alt=""
                         srcset="" class="w-100">
                 </div>
             </div>


         </div>

     @endif



 </div>
 <!-- SweetAlert2 CDN -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>
     // إظهار SweetAlert لما يطلب Livewire كده
     window.addEventListener('livewire:init', () => {
         Livewire.on('show-delete-confirmation', () => {
             Swal.fire({
                 title: 'هل أنت متأكد؟',
                 text: "لا يمكنك التراجع بعد الحذف!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#d33',
                 cancelButtonColor: '#3085d6',
                 confirmButtonText: 'نعم، احذف!',
                 cancelButtonText: 'إلغاء'
             }).then((result) => {
                 if (result.isConfirmed) {
                     Livewire.dispatch('deleteItem');
                 }
             });
         });

         // بعد الحذف بنجاح
         Livewire.on('itemDeleted', () => {
             Swal.fire(
                 'تم الحذف!',
                 'تم حذف العنصر بنجاح.',
                 'success'
             );
         });
     });
 </script>
