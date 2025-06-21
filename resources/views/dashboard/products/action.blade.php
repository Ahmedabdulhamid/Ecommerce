<a  href="{{route('products.show',$product->id)}}" class="btn btn-success btn-min-width btn-glow mr-1 mb-1">Show</a>
<a  class="btn btn-info btn-min-width btn-glow mr-1 mb-1" href="{{route('products.edit',$product->id)}}">Edit</a>
<button type="button" class="btn btn-warning btn-min-width btn-glow mr-1 mb-1 change_status"  id={{$product->id}}>Change Status</button>
<button type="button" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1 del"  id={{$product->id}}>Delete</button>
<script>

</script>
