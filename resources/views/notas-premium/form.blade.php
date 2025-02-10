<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_nota_p" class="form-label">{{ __('Id Notap') }}</label>
            <input type="text" name="id_notaP" class="form-control @error('id_notaP') is-invalid @enderror" value="{{ old('id_notaP', $notasPremium?->id_notaP) }}" id="id_nota_p" placeholder="Id Notap">
            {!! $errors->first('id_notaP', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nombre_nota_p" class="form-label">{{ __('Nombre Notap') }}</label>
            <input type="text" name="nombre_notaP" class="form-control @error('nombre_notaP') is-invalid @enderror" value="{{ old('nombre_notaP', $notasPremium?->nombre_notaP) }}" id="nombre_nota_p" placeholder="Nombre Notap">
            {!! $errors->first('nombre_notaP', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="contenido_nota_p" class="form-label">{{ __('Contenido Notap') }}</label>
            <input type="text" name="contenido_notaP" class="form-control @error('contenido_notaP') is-invalid @enderror" value="{{ old('contenido_notaP', $notasPremium?->contenido_notaP) }}" id="contenido_nota_p" placeholder="Contenido Notap">
            {!! $errors->first('contenido_notaP', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>