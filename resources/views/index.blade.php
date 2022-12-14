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
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"
        ></script>

        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
            rel="stylesheet"
        />
        <link rel="icon" type="image/jpg" href="img/favicon.jpg" />
        <title>To do List</title>

        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
        />
        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"
        ></script>

        <link
            href="{{ asset('../css/app.css') }}"
            type="text/css"
            rel="stylesheet"
        />
    </head>

    <body>
        @if(Session::has('message'))
        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >
            <strong>{{Session::get('message')}}</strong>
            <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
            >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif
        <form class="wrapper" method="POST" action="{{ route('crear') }}">
            @csrf
            <h2 class="title">Aplicaci??n de lista de tareas</h2>
            <br />

            <div class="mb-3">
                <label for="description" class="form-label"
                    >Descripci??n de la tarea</label
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
                    >Fecha de realizaci??n
                </label>
                <input
                    required
                    type="date"
                    id="dateform"
                    name="dateform"
                    class="form-control"
                    for="date"
                    value="<?= date('Y-m-d') ?>"
                    min="<?php echo date('Y-m-d') ?>"
                    max="2023-12-31"
                />
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Asignar a</label>
                <select
                    required
                    class="form-select"
                    aria-label="Default select example"
                    id="user_id"
                    name="user_id"
                >
                    <option hidden selected value="">
                        Selecciona una opci??n
                    </option>
                    @foreach (App\Models\User::get() as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
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
        </form>
        <h2 class="title second">Tareas</h2>

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
                                        <th scope="col">Descripci??n</th>
                                        <th scope="col">Usuario asignado</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->descripcion }}</td>
                                        <td>{{ $item->users->name }}</td>
                                        <td class="action-column">
                                            <div class="form-check">
                                                <form
                                                    action="{{ route('cambiarEstado', $item->id) }}"
                                                    method="POST"
                                                    id="completado"
                                                >
                                                    @csrf @method('PUT')
                                                    <?php if($item->estado ==
                                                    "1"){ ?>
                                                    <input
                                                        class="form-check-input"
                                                        value="{{$item->id}}-button"
                                                        type="checkbox"
                                                        id="flexCheckDefault"
                                                        checked
                                                        onChange="formSubmit(event)"
                                                    />
                                                    <?php }else{ ?>
                                                    <input
                                                        class="form-check-input"
                                                        value="{{$item->id}}-button"
                                                        type="checkbox"
                                                        id="flexCheckDefault"
                                                        onChange="formSubmit(event)"
                                                    />
                                                    <?php } ?>
                                                    <button
                                                        style="display: none"
                                                        id="{{$item->id}}-button"
                                                        type="submit"
                                                    ></button>
                                                </form>
                                            </div>
                                            <form
                                                action="{{ route('borrar', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('??Est?? seguro de que quiere eliminar esta tarea?')"
                                            >
                                                @csrf @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger custom"
                                                >
                                                    Borrar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach @else
                                    <div
                                        style="text-align: center"
                                        class="mt-5 mb-4"
                                    >
                                        <?php echo 'No hay tareas creadas' ?>
                                    </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        {{$tasks->links()}}

        <script>
            function formSubmit(e) {
                let inputCheckSubmit = document.getElementById(e.target.value);
                inputCheckSubmit.click();
            }
        </script>
    </body>
</html>
