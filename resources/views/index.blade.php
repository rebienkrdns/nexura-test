<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nexura Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="col-12">
        <button class="btn btn-primary float-end" onclick="$('#crearEmpleado').modal('show')">Crear</button>
    </div>
    <div class="col-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><i class="fas fa-user-alt"></i> Nombre</th>
                <th scope="col"><i class="fas fa-at"></i> Email</th>
                <th scope="col"><i class="fas fa-venus-mars"></i> Sexo</th>
                <th scope="col"><i class="fas fa-briefcase"></i> Area</th>
                <th scope="col"><i class="fas fa-envelope"></i> Boletin</th>
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal" tabindex="-1" id="crearEmpleado">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                    Los campos con asteriscos (*) son obligatorios
                </div>

                <form method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="iN" class="col-sm-4 col-form-label fw-bold text-end">Nombre completo *</label>
                        <div class="col-sm-8">
                            <input name="nombre" type="text" class="form-control" id="iN"
                                   placeholder="Nombre completo del aempleado" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="iCe" class="col-sm-4 col-form-label fw-bold text-end">Correo electrónico *</label>
                        <div class="col-sm-8">
                            <input name="correo" type="email" class="form-control" id="iCe"
                                   placeholder="Correo electrónico" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label fw-bold text-end">Sexo *</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" id="iSM" type="radio" name="sexo" value="M" checked>
                                <label class="form-check-label" for="iSM">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="iSF" type="radio" name="sexo" value="F">
                                <label class="form-check-label" for="iSF">
                                    Femenino
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label fw-bold text-end">Área *</label>
                        <div class="col-sm-8">
                            <select name="area" class="form-select">
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label fw-bold text-end">Descripción *</label>
                        <div class="col-sm-8">
                            <textarea name="descripcion" class="form-control" id="iD" rows="3"
                                      placeholder="Descripción de la experiencia del empleado" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="offset-sm-4 col-sm-8">
                            <input name="boletin" class="form-check-input" type="checkbox" value="1" id="iB">
                            <label class="form-check-label" for="iB">
                                Deseo recibir boletín informativo
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-form-label fw-bold text-end">Roles</label>
                        <div class="col-8">
                            @foreach($roles as $rol)
                                <div class="col-12">
                                    <input name="rol{{ $rol->id }}" class="form-check-input" type="checkbox" value="1"
                                           id="rol{{ $rol->id }}">
                                    <label class="form-check-label" for="rol{{ $rol->id }}">
                                        {{ $rol->nombre }}
                                    </label>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="modificarEmpleado">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                    Los campos con asteriscos (*) son obligatorios
                </div>

                <form method="post" action="{{url('/empleados/update')}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id">
                    <div class="row mb-3">
                        <label for="iN" class="col-sm-4 col-form-label fw-bold text-end">Nombre completo *</label>
                        <div class="col-sm-8">
                            <input name="nombreM" type="text" class="form-control" id="iN"
                                   placeholder="Nombre completo del aempleado" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="iCe" class="col-sm-4 col-form-label fw-bold text-end">Correo electrónico *</label>
                        <div class="col-sm-8">
                            <input name="correoM" type="email" class="form-control" id="iCe"
                                   placeholder="Correo electrónico" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label fw-bold text-end">Sexo *</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" id="iSM" type="radio" name="sexoM" value="M" checked>
                                <label class="form-check-label" for="iSM">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="iSF" type="radio" name="sexoM" value="F">
                                <label class="form-check-label" for="iSF">
                                    Femenino
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label fw-bold text-end">Área *</label>
                        <div class="col-sm-8">
                            <select name="areaM" class="form-select">
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label fw-bold text-end">Descripción *</label>
                        <div class="col-sm-8">
                            <textarea name="descripcionM" class="form-control" id="iD" rows="3"
                                      placeholder="Descripción de la experiencia del empleado" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="offset-sm-4 col-sm-8">
                            <input name="boletinM" class="form-check-input" type="checkbox" value="1" id="iB">
                            <label class="form-check-label" for="iB">
                                Deseo recibir boletín informativo
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-form-label fw-bold text-end">Roles</label>
                        <div class="col-8">
                            @foreach($roles as $rol)
                                <div class="col-12">
                                    <input name="rol{{ $rol->id }}M" class="form-check-input" type="checkbox" value="1"
                                           id="rol{{ $rol->id }}M">
                                    <label class="form-check-label" for="rol{{ $rol->id }}M">
                                        {{ $rol->nombre }}
                                    </label>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    window.App = {
        baseurl: "{{url('/')}}",
        csrf: "{{ csrf_token() }}",
        roles: {!! json_encode($roles) !!}
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/5ce803a603.js" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    @if(session()->has('error'))
        toastr["warning"]("{{ session('error') }}", "");
    @elseif(session()->has('success'))
        toastr["success"]("{{ session('success') }}", "");
    @endif
</script>
</body>
</html>
