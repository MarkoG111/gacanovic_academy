@extends('layout.user')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title mb-4">Cart</h2>
                <form action="#">
                    <table class="table table-bordered table-cart">
                        <thead>
                            <tr>
                                <th class="pro-thumbnail">Image</th>
                                <th class="pro-title">Course</th>
                                <th class="pro-price">Price</th>
                                <th class="pro-hours">Total Hours</th>
                                <th class="">Remove</th>
                                <th class="">Order</th>
                            </tr>
                        </thead>
                        <tbody id="cart">
                             
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
