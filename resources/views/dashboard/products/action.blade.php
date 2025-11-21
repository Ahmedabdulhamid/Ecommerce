<a  href="{{route('products.show',$product->id)}}" class="btn btn-success btn-min-width btn-glow mr-1 mb-1">{{__('admin.show')}}</a>
<a  class="btn btn-info btn-min-width btn-glow mr-1 mb-1" href="{{route('products.edit',$product->id)}}">{{__('admin.edit')}}</a>
<button type="button" class="btn btn-warning btn-min-width btn-glow mr-1 mb-1 change_status"  id={{$product->id}}>{{__('admin.change_status')}}</button>
<button type="button" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1 del"  id={{$product->id}}>{{__('admin.delete')}}</button>
