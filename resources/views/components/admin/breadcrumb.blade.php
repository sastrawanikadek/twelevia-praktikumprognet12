<section class="content-header">
  @if (Request::is('admin/dashboard'))
    <h1>Dashboard</h1>
  @elseif(Request::is('admin/product') || Request::is('admin/product/*'))
    <h1>Products</h1>
  @elseif(Request::is('admin/discount') || Request::is('admin/discount/*'))
    <h1>Discounts</h1>
  @elseif(Request::is('admin/courier') || Request::is('admin/courier/*'))
    <h1>Courier</h1>
  @elseif(Request::is('admin/category') || Request::is('admin/category/*'))
    <h1>Category</h1>
  @elseif(Request::is('home') || Request::is('home/*'))
    <h1>Home</h1>
  @elseif(Request::is('profile'))
    <h1>Profile</h1>
  @endif
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    @if (Request::is('admin/dashboard'))
      <li class="active">Dashboard</li>
    @elseif(Request::is('admin/product') || Request::is('admin/product/*'))
      <li class="active">Products</li>
    @elseif(Request::is('admin/discount') || Request::is('admin/discount/*'))
    <li class="active">Discounts</li>
    @elseif(Request::is('admin/courier') || Request::is('admin/courier/*'))
      <li class="active">Courier</li>
    @elseif(Request::is('admin/category') || Request::is('admin/category/*'))
      <li class="active">Category</li>
    @elseif(Request::is('home') || Request::is('home/*'))
      <li class="active">Home</li>
    @elseif(Request::is('profile'))
      <li class="active">Profile</li>
    @endif
  </ol>
</section>