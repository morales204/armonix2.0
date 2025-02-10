@extends('layouts.admin')

@section('template_title')
    {{ __('Create') }} Notas Premium
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Notas Premium</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('notas-premium.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('notas-premium.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
