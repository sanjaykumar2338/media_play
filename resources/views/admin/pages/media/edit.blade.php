@extends('admin.layout.main')

@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Media</h1>
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
            <form method="post" enctype="multipart/form-data" action="{{ url('/admin/media/update/'.$media->id) }}">
                
                @csrf
                <div class="mb-3 mt-3">
                  <label for="product_name">Title:</label>
                  <input type="text" value="{{$media->title}}" class="form-control" id="title" placeholder="Enter Title" name="title">
                </div>

                <div class="mb-3 mt-3">
                  <label for="product_name">Media URL:</label>
                  <input type="url" value="{{$media->url}}"  class="form-control" id="url" placeholder="Enter URL" name="url">
                </div>

                <div class="form-group" style="display: flex; align-items: center;">
                  <label for="hour" style="margin-right: 10px;">Hour:</label>
                  <select class="form-control" id="hour" name="hour" style="width: 100px; margin-right: 10px;">
                      @for ($i = 0; $i <= 24; $i++)
                          <option value="{{ $i }}" {{ $media->hour == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                  </select>
                  
                  <label for="minute" style="margin-right: 10px;">Minute:</label>
                  <select class="form-control" id="minute" name="minute" style="width: 100px; margin-right: 10px;">
                      @for ($i = 0; $i <= 59; $i++)
                          <option value="{{ $i }}" {{ $media->minute == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                      @endfor
                  </select>
                  
                  <label for="second" style="margin-right: 10px;">Second:</label>
                  <select class="form-control" id="second" name="second" style="width: 100px;">
                      @for ($i = 0; $i <= 59; $i++)
                          <option value="{{ $i }}" {{ $media->second == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                      @endfor
                  </select>
                </div>
                
                <button type="submit" class="btn btn-primary">UPDATE</button>
              </form>
          </div>
        </div>
        <br>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection