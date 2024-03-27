@extends('layouts.admin')

@section('content')
    <div class="card card-primary mt-4">

        <div class="card-header">
            <h3 class="card-title">Nuevo prestamo</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action=" {{ route('prestamo.store') }}" method="POST" class="form">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="materia">Materia</label>
                                    <select name="materia" id="materia" class="form-control">
                                        @foreach ($materias as $materia)
                                            <option value="{{ $materia->id_materia }}">{{ $materia->materia }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="grado_grupo">Grado y grupo</label>
                                    <div class="input-group">
                                        {{--      <input type="text" class="form-control" id="grado" name="grado" value="" placeholder="Grado"> --}}
                                        <select name="grado" id="grado" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                        </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text">-</span>
                                        </div>
                                        <select name="grupo" id="grupo" class="form-control">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="carrera">Carrera</label>
                                    <select name="carrera" id="carrera" class="form-control">
                                        @foreach ($carreras as $carrera)
                                            <option value="{{ $carrera->id_carrera }}">{{ $carrera->nombre_carrera }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                        min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>

                            <div class="col-md-2 col-12">
                                <div class="form-group">
                                    <label for="fecha_adquisicion">Hora de inicio</label>
                                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio"
                                        min="07:00" max="21:00" step="3600" required>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="fecha_caducidad">Fecha de fin</label>
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                                </div>
                            </div>

                            <div class="col-md-2 col-12">
                                <div class="form-group">
                                    <label for="fecha_caducidad">Hora de fin</label>
                                    <input type="time" class="form-control" id="hora_fin" name="hora_fin">
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="responsable">Responsable/Docente</label>
                                    <select name="responsable" id="responsable" class="form-control">
                                        @foreach ($responsables as $responsable)
                                            <option value="{{ $responsable->id_usuario }}">
                                                {{ $responsable->nombre_completo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="unidad_tematica">Unidad Tematica</label>
                                    <input type="text" class="form-control" id="unidad_tematica" name="unidad_tematica"
                                        placeholder="Ingrese la unidad tematica">
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="laboratorio">Laboratorio</label>
                                    <select name="laboratorio" id="laboratorio" class="form-control">
                                        @foreach ($laboratorios as $laboratorio)
                                            <option value="{{ $laboratorio->id_laboratorio }}">
                                                {{ $laboratorio->nombre_laboratorio }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 col-12">
                                <div class="form-group">
                                    <label for="numero_practica">N. de practica</label>
                                    <input type="number" class="form-control" id="numero_practica"
                                        name="numero_practica" min="1">
                                </div>
                            </div>

                            <div class="col-md-5 col-12">
                                <div class="form-group">
                                    <label for="titulo_practica">Titulo de la practica</label>
                                    <input type="text" class="form-control" id="titulo_practica"
                                        name="titulo_practica">
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nombre_reactivo">Introducion</label>
                                    <textarea class="form-control" id="introduccion" name="introduccion" rows="4"
                                        placeholder="Ingresa la introduccion..."></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nombre_reactivo">Objetivo</label>
                                    <textarea class="form-control" id="objetivo" name="objetivo" rows="4" placeholder="Ingresa el objetivo..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
                    <div id="formulario" style="display: none;">
                        <h2>Selecciona la hora para el evento</h2>
                        <form id="eventoForm">
                          <div class="form-group">
                            <label for="fecha_inicio">Fecha de inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" min="{{ date('Y-m-d') }}" required>
                          </div>
                          <div class="form-group">
                            <label for="hora_inicio">Hora de inicio</label>
                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" min="07:00" max="21:00" step="3600" required>
                          </div>
                          <div class="form-group">
                            <label for="fecha_fin">Fecha de fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                          </div>
                          <div class="form-group">
                            <label for="hora_fin">Hora de fin</label>
                            <input type="time" class="form-control" id="hora_fin" name="hora_fin">
                          </div>
                          <button type="submit" class="btn btn-primary">Guardar evento</button>
                        </form>
                      </div>
                    
                      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
                      <script>
                        document.addEventListener('DOMContentLoaded', function() {
                          var calendarEl = document.getElementById('calendar');
                          var calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            selectable: true,
                            select: function(info) {
                              // Mostrar el formulario para ingresar los detalles del evento
                              document.getElementById('formulario').style.display = 'block';
                              // Mostrar la fecha seleccionada en el formulario
                              document.getElementById('fecha_inicio').value = info.start.toLocaleDateString('es-ES');
                            },
                            slotMinTime: "07:00:00", // Hora mínima: 7:00 AM
                            slotMaxTime: "21:00:00", // Hora máxima: 9:00 PM
                            allDaySlot: false, // Ocultar el slot de "todo el día"
                            weekends: false, // Ocultar los fines de semana
                            locale: 'es',
                          });
                          calendar.render();
                    
                          // Capturar el envío del formulario
                          document.getElementById('eventoForm').addEventListener('submit', function(event) {
                            event.preventDefault(); // Prevenir el envío del formulario por defecto
                    
                            // Obtener los valores del formulario
                            var fechaInicio = document.getElementById('fecha_inicio').value;
                            var horaInicio = document.getElementById('hora_inicio').value;
                            var fechaFin = document.getElementById('fecha_fin').value;
                            var horaFin = document.getElementById('hora_fin').value;
                    
                            // Crear el evento en el calendario
                            calendar.addEvent({
                              title: 'Evento',
                              start: fechaInicio + 'T' + horaInicio, // Concatenar fecha y hora de inicio
                              end: fechaFin + 'T' + horaFin, // Concatenar fecha y hora de fin
                            });
                    
                            // Ocultar el formulario después de guardar el evento
                            document.getElementById('formulario').style.display = 'none';
                          });
                        });
                      </script>
   
   
                    <div class="col-md-6 col-12">
                        <div class="row">
                        <div id='calendar' class="col-md-10 col-12"></div>
                        </div>
                    </div>

                    <div class="col-md-12 col-12 mt-4 division-titulo">
                        <h1 class="titulo">Materiales reactivos y equipos</h1>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12 mt-2 mb-4 col-12">
                        <span class="titulo">NOTA: Si su material o reactivo no aparece en la lista, es porque no hay
                            disponibles</span>
                    </div>

                    <div class="col-md-6 col-12 mt-2">
                        <div class="form-group row">
                            <label for="material" class="col-sm-2 col-form-label">Material</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select name="material" id="material" class="form-control selectpicker"
                                        data-live-search='true'>
                                        @foreach ($materiales as $material)
                                            <option value="{{ $material->id_material }}">{{ $material->material }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="cantidad_material" id="cantidad_material"
                                        class="form-control col-md-3" min="0" placeholder="Cantidad">
                                    <div class="input-group-append">
                                        <button id="add_material" class="btn btn-outline-secondary" type="button"><i
                                                class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 mt-2">
                        <div class="form-group row">
                            <label for="reactivo" class="col-sm-2 col-form-label">Reactivo</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select name="reactivo" id="reactivo" class="form-control selectpicker"
                                        data-live-search='true'>
                                        @foreach ($reactivos as $reactivo)
                                            <option value="{{ $reactivo->id_reactivo }}">{{ $reactivo->nombre_reactivo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="cantidad_reactivo" id="cantidad_reactivo"
                                        class="form-control col-md-3" min="0" placeholder="Cantidad">
                                    <div class="input-group-append">
                                        <button id="add_reactivo" class="btn btn-outline-secondary" type="button"><i
                                                class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id='detallePrestamo' class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                        </tbody>
                    </table>
                </div>




            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
    @push('scripts')
        <script>
            //agregar un material
            $(document).ready(function() {
                $('#add_material').click(function() {
                    agregarMaterial()
                });
            });

            //agregar un reactivo
            $(document).ready(function() {
                $('#add_reactivo').click(function() {
                    agregarReactivo()
                });
            });

            var cont = 0;

            $("#material").change(mostrarValoresMaterial);
            $("#reactivo").change(mostrarValoresReactivo);

            function mostrarValoresMaterial() {
                datosMaterial = document.getElementById('material').value.split('_');
                $("#cantidad_material").val(datosMaterial[1]);
            }

            function mostrarValoresReactivo() {
                datosReactivo = document.getElementById('reactivo').value.split('_');
                $("#cantidad_reactivo").val(datosReactivo[1]);
            }

            function agregarMaterial() {
                datosMaterial = document.getElementById('material').value.split('_');


                idMaterial = datosMaterial[0];
                material = $("#material option:selected").text();
                cantidadMaterial = $("#cantidad_material").val();

                if (idMaterial != "" && cantidadMaterial != "" && cantidadMaterial > 0) {

                    var materialExistente = $("#detallePrestamo").find("[data-idMaterial='" + idMaterial + "']").length > 0;


                    if (!materialExistente) {
                        var fila = '<tr class="selected bg-cyan" id="fila' + cont + '" data-idMaterial="' + idMaterial + '">' +
                            '<td>' + material + '</td>' + '<input type="hidden" name="idMaterial[]" value="' + idMaterial +
                            '">' +
                            '<td><input type="number" name="cantidadMaterial[]" value="' + cantidadMaterial + '"></td>' +
                            '<td><button class="btn btn-warning" type="button" onclick="eliminarMaterial(' + cont +
                            ');">X</button></td>' +
                            '</tr>';

                        cont++;
                        limpiarCantMaterial();
                        $("#detallePrestamo").append(fila);

                        // Ocultar la opción del desplegable
                        $("#material option[value='" + idMaterial + "']").prop("disabled", true);
                        $("#material").selectpicker("refresh"); // Actualizar el desplegable
                    } else {
                        alert("El material ya ha sido seleccionado");
                    }
                } else {
                    alert("Ingrese una cantidad o revise el campo cantidad")

                }

            }

            function agregarReactivo() {
                datosReactivo = document.getElementById('reactivo').value.split('_');

                idReactivo = datosReactivo[0];
                reactivo = $("#reactivo option:selected").text();
                cantidadReactivo = $("#cantidad_reactivo").val();

                if (idReactivo != "" && cantidadReactivo != "" && cantidadReactivo > 0) {

                    var reactivoExistente = $("#detallePrestamo").find("[data-idReactivo='" + idReactivo + "']").length > 0;

                    if (!reactivoExistente) {
                        var fila = '<tr class="selected bg-gradient-teal" id="fila' + cont + '" data-idReactivo="' +
                            idReactivo + '">' +
                            '<td>' + reactivo + '</td>' +
                            '<input type="hidden" name="idReactivo[]" value="' + idReactivo +
                            '">' +
                            '<td><input type="hidden" style="width: 80px; padding: 5px; border: 1px solid #ccc; border-radius: 5px;" name="cantidadReactivo[]" value="' +
                            cantidadReactivo + '"><p>' + cantidadReactivo + '</p></td>' +
                            '<td><button class="btn btn-warning" type="button" onclick="eliminarReactivo(' + cont +
                            ');">X</button></td>' +
                            '</tr>';
                        cont++;
                        limpiarCantReactivo();
                        $("#detallePrestamo").append(fila);

                        // Ocultar la opción del desplegable
                        $("#reactivo option[value='" + idReactivo + "']").prop("disabled", true);
                        $("#reactivo").selectpicker("refresh"); // Actualizar el desplegable
                    } else {
                        alert("El reactivo ya ha sido seleccionado");
                    }
                } else {
                    alert("Ingrese una cantidad o revise el campo cantidad")
                }
            }

            function limpiarCantMaterial() {
                $("#cantidad_material").val("");
            }

            function limpiarCantReactivo() {
                $("#cantidad_reactivo").val("");
            }

            function eliminarMaterial(index) {
                var idMaterial = $("#fila" + index).data("idmaterial");

                // Mostrar nuevamente la opción del desplegable
                $("#material option[value='" + idMaterial + "']").prop("disabled", false);
                $("#material").selectpicker("refresh"); // Actualizar el desplegable


                $("#fila" + index).remove();
            }

            function eliminarReactivo(index) {
                var idReactivo = $("#fila" + index).data("idreactivo");

                // Mostrar nuevamente la opción del desplegable
                $("#reactivo option[value='" + idReactivo + "']").prop("disabled", false);
                $("#reactivo").selectpicker("refresh"); // Actualizar el desplegable


                $("#fila" + index).remove();
            }
        </script>
    @endpush
@endsection
