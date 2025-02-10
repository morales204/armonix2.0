@extends('layouts.admin')

@section('template_title')
    {{ __('Update') }} Notas Premium
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Notas Premium</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('notas-premium.update', $notasPremium->id_notaP) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('notas-premium.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
