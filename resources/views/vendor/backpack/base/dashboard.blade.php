@extends(backpack_view('blank'))
<script src="https://cdn.tailwindcss.com"></script>
@section('content')
    <div>
        <p style="font-weight: bold; font-size: 30px;">Dashboard</p>

        <p style="font-weight: bold; font-size: 20px;margin-top: 12px">Products</p>

        <div class="row mt-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['active_products']}}</div>
                        <div class="text-primary">Active Products</div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['inactive_products']}}</div>
                        <div class="text-primary">Inactive Products</div>
                    </div>
                </div>
            </div>
        </div>

        <p style="font-weight: bold; font-size: 20px;margin-top: 12px">Adoptions</p>

        <div class="row mt-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['active_adoptions']}}</div>
                        <div class="text-primary">Active</div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['inactive_adoptions']}}</div>
                        <div class="text-primary">Inactive</div>
                    </div>
                </div>
            </div>


        </div>


        <p style="font-weight: bold; font-size: 20px;margin-top: 12px">Orders</p>

        <div class="row mt-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['paid_orders_count']}}</div>
                        <div class="text-primary">Paid Orders</div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['paid_orders']/100}} EUR</div>
                        <div class="text-primary">Paid Amount</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['unpaid_orders_count']}}</div>
                        <div class="text-primary">Unpaid Orders</div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['unpaid_orders']/100}} EUR</div>
                        <div class="text-primary">Unpaid Amount</div>
                    </div>
                </div>
            </div>


        </div>

        <p style="font-weight: bold; font-size: 20px;margin-top: 12px">Donations</p>

        <div class="row mt-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['paid_donations_count']}}</div>
                        <div class="text-primary">Paid Donations</div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['paid_donations']/100}} EUR</div>
                        <div class="text-primary">Donated Amount</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['unpaid_donations_count']}}</div>
                        <div class="text-primary">Unpaid Donations</div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-value">{{$data['unpaid_donations']/100}} EUR</div>
                        <div class="text-primary">Unpaid Amount</div>
                    </div>
                </div>
            </div>


        </div>


    </div>


@endsection
