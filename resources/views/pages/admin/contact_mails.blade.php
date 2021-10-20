@extends('layout.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>All Contact Mails</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive" id="table">

                </table>
            </div>
            <div class="col-md-12">
                <div class="js-notification"></div>
                <div class="dataTables_paginate paging_simple_numbers pt-3" id="table_paginate">

                </div>
            </div>
        </div>
    </section>
@endsection
