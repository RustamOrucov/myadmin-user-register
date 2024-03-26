@extends('admin.layout.app')
@section('_content')


    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title d-flex justify-content-between">
                <div class="d-flex align-items-center ">
                    <h2 class="mr-3">USERS TABLE</h2>
                    <button type="button" class="btn btn-success" onclick="window.location.href = '{{ route('user.create') }}'">ADD</button>
                </div>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>


            </div>
            @if (session('success'))
                <div id="successMessage" class="alert alert-success">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(function() {
                        var successMessage = document.getElementById('successMessage');
                        if (successMessage) {
                            successMessage.remove();
                        }
                    }, 5000);
                </script>
            @endif
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action" style="width:100%">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Name</th>
                                    <th> Surname</th>
                                    <th>Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Role</th>

                                    <th class="text-center">Image</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Əməliyatlar</th>
                                    <th class="text-center">Yaradılma tarixi</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($models as $model)
                                    <tr>
                                        <td>
                                            {{$model->id}}
                                        </td>
                                        <td>
                                            {{ strlen($model->name) > 20 ? substr($model->name, 0, 20) . '...' : $model->name }}</td>
                                        <td>{{$model->fname}}  {{$model->surname}}</td>
                                        <td>
                                            {{ strlen($model->email) > 20 ? substr($model->email, 0, 20) . '...' : $model->email}}</td>
                                        <td class="text-center">
                                            @if($model->name === 'Admin' || $model->name === 'sexavet')
                                            @else
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitches{{$model->id}}" {{ $model->status == 1 ? 'checked' : '' }} onchange="updateStatus({{ $model->id }})">
                                                <label class="custom-control-label" for="customSwitches{{$model->id}}"></label>
                                            </div>
                                            @endif
                                        </td>
                                    <td class="text-center">
                                         @if(isset($model->roles))
                                            {{ $model->roles->pluck('name')->join(', ') }}

                                        @else
                                             role seçilməyib
                                        @endif
                                    </td>
                                        <td class="text-center">
                                            @if($model->img)
                                                <img width="43" height="43" src="{{ Storage::url($model->img) }}">
                                            @else
                                                <p>Empty</p>
                                            @endif
                                        </td>
                                        <td class="text-center">{{$model->prefix}}{{$model->phone}}</td>
                                        <td class=" d-flex justify-content-center">
                                            @if($model->name === 'Admin' || $model->name === 'sexavet')
                                            @else
                                                <a href="{{ route('user.edit', $model->id) }}" class="btn btn-primary">
                                                    <i class="fa fa-edit"></i> EDIT
                                                </a>

                                                <form id="deleteForm{{$model->id}}" method="POST" action="{{ route('user.destroy', ['user' => $model->id]) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger" onclick="confirmAndSubmit({{$model->id}})">
                                                        <i class="fa fa-trash"></i> DELETE
                                                    </button>
                                                </form>
                                            @endif

                                        </td>
                                        <td class="text-center">
                                            {{ $model->created_at->format('d.m.Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">{{$models->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">TESDİQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Silmək istədiyinizə misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">XEYR</button>
                    <button type="button" class="btn btn-danger" onclick="submitForm()">SİL</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmAndSubmit(id) {

            $('#confirmationModal').modal('show');
            window.submitForm = function() {
                $('#deleteForm'+id).submit();
            };
        }
        function updateStatus(id) {
            var status = document.getElementById('customSwitches' + id).checked ? 1 : 0;
            $.ajax({
                url: 'user/update-status/' + id,
                type: 'PUT',
                data: {
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
            });
        }

    </script>

@endsection
