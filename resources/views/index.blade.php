<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
        />
        <link
            href="{{ asset('../css/app.css') }}"
            type="text/css"
            rel="stylesheet"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
            rel="stylesheet"
        />
        <link rel="icon" type="image/jpg" href="img/favicon.jpg"/>
        <title>To do List</title>
    </head>
    <body>
        <form class="wrapper" method="POST" action="{{ route('crear') }}">
            @csrf
            <h2 class="title">Aplicación de lista de tareas</h2>
            <br />
            
            <div class="mb-3">
                <label for="description" class="form-label"
                    >Descripción de la tarea</label
                >
                <textarea
                    required
                    class="form-control"
                    id="description"
                    name="description"
                    rows="3"
                ></textarea>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label"
                    >Fecha de realización
                </label>
                <input required type="date" id="dateform" name="dateform" class="form-control" for="date" value="<?= date('Y-m-d') ?>"
                min="<?php echo date('Y-m-d') ?>" max="2023-12-31">
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Asignar a</label>
                <select
                    required
                    class="form-select"
                    aria-label="Default select example"
                >
                    <option hidden selected value="">Selecciona una opción</option>
                    @foreach (App\Models\User::get() as $user)
                    <option value="{{$user->id}}" id="user_id" name="user_id">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-2">
                        <button type="submit" class="btn btn-success">
                            Create
                        </button>
                    </div>
                </div>
            </div>

            <!--  <input type="date" value="<?php echo date("m/d/Y") ?>" min="<?php echo date("Y-m-d") ?>"
            max="2024-12-31"><br /> -->
        </form>

        <div class="content task-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <table class="table table-striped">
                            @if($tasks->count())
                                <thead>
                                    <tr>
                                        <th scope="col"># Tarea</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Usuario asignado</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->descripcion }}</td>
                                        <td>{{ $item->user_id }}</td>
                                        <td class="action-column">
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    value=""
                                                    id="flexCheckDefault"
                                                />
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-danger custom"
                                            >
                                                Borrar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                            <div style="text-align: center;" class="mt-5 mb-4">
                                <?php echo 'No hay tareas creadas' ?>
                            </div>
                            @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
