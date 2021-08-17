@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('store.import.data') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Type</label>

                            <select name="type" class="form-control">
                                <option value="">Select Upload Type</option>
                                <option value="departments">Departments</option>
                                <option value="users">Staff</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="data">Upload File</label>
                            <input type="file" class="form-control" name="data" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary btn-sm" type="submit">
                            Upload Data
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop
