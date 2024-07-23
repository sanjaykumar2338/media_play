@extends('admin.layout.main')

@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Media</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Media List(s)</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif


          <div class="col-md-12">
            <form method="post" enctype="multipart/form-data" action="{{ route('admin.media.store') }}">
                @csrf

                <div class="mb-3 mt-3">
                  <label for="title">Media Title:</label>
                  <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title">
                </div>

                <div class="mb-3 mt-3">
                  <label for="url">Media URL:</label>
                  <input type="url" class="form-control" id="title" placeholder="Enter Title" name="url">
                </div>

                <div class="form-group" style="display: flex; align-items: center;">
                  <label for="duration">Duration:</label><br>&nbsp;&nbsp;&nbsp;&nbsp;
                  <label for="hour" style="margin-right: 10px;">Hour</label>
                  <select class="form-control" id="hour" name="hour" style="width: 100px; margin-right: 10px;">
                      @for ($i = 0; $i <= 24; $i++)
                          <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                  </select>
                  
                  <label for="minute" style="margin-right: 10px;">Minute</label>
                  <select class="form-control" id="minute" name="minute" style="width: 100px; margin-right: 10px;">
                      @for ($i = 0; $i <= 59; $i++)
                          <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                      @endfor
                  </select>
                  
                  <label for="second" style="margin-right: 10px;">Second</label>
                  <select class="form-control" id="second" name="second" style="width: 100px;">
                      @for ($i = 0; $i <= 59; $i++)
                          <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                      @endfor
                  </select>
              </div>

      
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
          </div>
        </div>
        <br>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
@endsection