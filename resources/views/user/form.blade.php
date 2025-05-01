@extends('templates/header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ empty($result) ? 'Tambah' : 'Edit' }} Data User <small>Minimarket</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ empty($result) ? 'Tambah' : 'Edit' }} Data User</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('templates/feedback')
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <a href="{{ url('/') }}" class="btn btn-success">
                <i class="fa fa-chevron-left"></i>
                Kembali
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="{{ empty($result) ?  url('user/add') : url("user/$result->id_user/edit") }}" class="form-horizontal" method="POST">
                {{ csrf_field () }}

                @if (!empty($result))
                {{ method_field('patch') }}
                @endif
                <div class="form-group">
                    <label class="control-label col-sm-2">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" value="{{ @$result->username }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password" value="{{ @$result->password}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="role" class="control-label col-sm-2">Role</label>
                    <div class="col-sm-10">
                        <select name="role" id="role" class="form-control">
                            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="kasir" {{ old('role', $user->role ?? '') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </div>




            </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection