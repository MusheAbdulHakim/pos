@extends('layouts.app')

@push('page-css')
    
@endpush

@section('breadcrumb')
<form action="{{route('backup.store')}}" method="post">
    @csrf
    @method("PUT")
    <button class="btn btn-primary" type="submit">Create Backup</button>
</form>
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Users List</h4>

            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Disk</th>
                        <th>Backup Date</th>
                        <th>File Size</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($backups as $k => $b)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $b['disk'] }}</td>
                        <td>{{ \Carbon\Carbon::createFromTimeStamp($b['last_modified'])->formatLocalized('%d %B %Y, %H:%M') }}</td>
                        <td>{{ round((int)$b['file_size']/1048576, 2).' MB' }}</td>
                        <td>
                            @if ($b['download'])
                            <a class="float-left" href="{{ route('backup.download') }}?disk={{ $b['disk'] }}&path={{ urlencode($b['file_path']) }}&file_name={{ urlencode($b['file_name']) }}">
                                <button title="download backup" class="btn btn-primary" >
                                    <i class="fe fe-download"></i>
                                </button>
                            </a>
                            @endif
                            <form action="{{route('backup.destroy',$b['file_name'])}}?disk={{ $b['disk'] }}" method="post">
                                @csrf
                                @method("DELETE")
                                <button title="delete backup" class="btn btn-danger" type="submit">
                                    <i class="fe fe-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@push('page-js')
    
@endpush