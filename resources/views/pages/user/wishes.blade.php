@extends('layout.user')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                 <h2 class="section-title mb-4">Wishes</h2>
                <form action="#">
                    <table class="table table-bordered table-wish">
                        <thead>
                            <tr>
                                <th class="pro-thumbnail">Image</th>
                                <th class="pro-title">Course</th>
                                <th class="pro-price">Price</th>
                                <th class="pro-subtotal">Visit</th>
                                <th class="pro-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="wishlist">

                        </tbody>
                        <tfoot>
                           
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
