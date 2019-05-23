<section class="content-header">
  @if (Request::is('admin/dashboard'))
    <h1>Dashboard</h1>
  @elseif(Request::is('admin/product') || Request::is('admin/product/*'))
    <h1>Products</h1>
  @elseif(Request::is('admin/product-image') || Request::is('admin/product-image/*'))
    <h1>Product Image</h1>
  @elseif(Request::is('admin/courier') || Request::is('admin/courier/*'))
    <h1>Courier</h1>
  @elseif(Request::is('admin/category') || Request::is('admin/category/*'))
    <h1>Category</h1>
  @endif
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    @if (Request::is('admin/dashboard'))
      <li class="active">Dashboard</li>
    @elseif(Request::is('admin/product') || Request::is('admin/product/*'))
      <li class="active">Products</li>
    @elseif(Request::is('admin/product-image') || Request::is('admin/product-image/*'))
      <li class="active">Product Image</li>
    @elseif(Request::is('admin/courier') || Request::is('admin/courier/*'))
      <li class="active">Courier</li>
    @elseif(Request::is('admin/category') || Request::is('admin/category/*'))
      <li class="active">Category</li>
    @endif
  </ol>
</section>