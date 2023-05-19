{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> Users</a></li>

<li class="nav-title">SHOP</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('shop/product') }}"><i class="nav-icon la la-box"></i> Products</a></li>

<li class="nav-title">ORDERS</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('shop/payment') }}"><i class="nav-icon la la-newspaper"></i> Orders</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('shop/payment-item') }}"><i class="nav-icon la la-paperclip"></i> Order Items</a></li>

<li class="nav-title">DONATIONS</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('donation/donation') }}"><i class="nav-icon la la-hand-holding"></i> Donations</a></li>

<li class="nav-title">Adoptions</li>


<li class="nav-item"><a class="nav-link" href="{{ backpack_url('adopt/adopt') }}"><i class="nav-icon la la-heart"></i> Adopt pet</a></li>
