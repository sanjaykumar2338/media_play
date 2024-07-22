@extends('admin.layout.main')

@section('content')
      <style>
        /* Example styles for pagination */
        .pagination {
          font-size: 21px;
          /* padding: 43px; */
          float: inline-end;
          padding-right: 18px;
        }

        .pagination ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .pagination ul li {
            display: inline;
            margin-right: 5px;
        }

        .pagination ul li a {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .pagination ul li a.active {
            background-color: #007bff;
            color: white;
        }
    </style>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-photo-video"></i> Media List(s)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Media List(s)</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card-header right">
            <h3 class="card-title d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ url('admin/media/add/new') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New Media
                </a>
                <a href="{{ url('admin/media/groupaction/1') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-play"></i> Play All
                </a>
                <a href="{{ url('admin/media/groupaction/0') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-stop"></i> Stop All
                </a>
                <a href="{{ url('admin/media/stop-all') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-video"></i> Total Media ({{$total}})
                </a>
                <a href="{{ url('admin/media/stop-all') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-play-circle"></i> Current Playing ({{$play}})
                </a>
                <a href="{{ url('admin/media/stop-all') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-stop-circle"></i> Current Stopped ({{$stop}})
                </a>
            </div>

            <!-- Search form -->
            <form action="{{ url('admin/media') }}" method="GET" class="input-group" style="max-width:179px;margin-left: 241px;">
                <input type="text" name="query" value="{{ request('query') }}" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-sm" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </h3>

            </div>
            <br>
              <!-- /.card-header -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                
                    <table id="sortable-table" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1 col-md-1">Sr. No.</th>
                                        <th class="col-sm-1 col-md-1">Title</th>
                                        <th class="col-sm-1 col-md-1">URL</th>
                                        
                                        <th class="col-sm-2 col-md-2">Created On</th>
                                        <th class="col-sm-2 col-md-2">Updated On</th>
                                        <th class="col-sm-2 col-md-2">Status</th>
                                        <th class="col-sm-3 col-md-3" style="text-align: right;">Action</th>
                                    </tr>
                                </thead>
                    <tbody>
                    @if(count($medias)>0)
                    @foreach($medias as $key=>$media)
                              
                                    <tr data-id="{{$media->id}}">
                                        <td class="col-sm-1 col-md-1">
                                            {{$key + $medias->firstItem()}}).
                                        </td>
                                        <td class="col-sm-1 col-md-1">
                                           {{ $media->title }}
                                        </td>
                                        <td class="col-sm-1 col-md-1">
                                            <a href="{{ $media->url }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Click to view {{ $media->url }}">View</a>
                                        </td>



                                        <td class="col-sm-2 col-md-2">
                                           {{ $media->created_at }}
                                        </td>

                                        <td class="col-sm-2 col-md-2">
                                           {{ $media->updated_at }}
                                        </td>

                                        <td class="col-sm-2 col-md-2">
                                            @if ($media->status == 1)
                                                <button class="btn btn-success">
                                                    <i class="fas fa-play"></i> Playing
                                                </button>
                                            @else
                                                <button class="btn btn-danger">
                                                    <i class="fas fa-stop"></i> Stopped
                                                </button>
                                            @endif
                                        </td>

                                        <td class="col-sm-2 col-md-2" style="text-align: right;">
                                            @if($media->status == 1)
                                                <a href="{{ url('/admin/media/changestatus/0/' . $media->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-stop-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('/admin/media/changestatus/1/' . $media->id) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-play-circle"></i>
                                                </a>
                                            @endif

                                            <a href="{{ url('/admin/media/edit/' . $media->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a onclick="return confirm('Are you sure?')" href="{{ url('/admin/media/remove/' . $media->id) }}" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <a href="{{ url('/admin/media/stats/' . $media->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-chart-bar"></i>
                                            </a>
                                        </td>


                                    </tr>
                                    <!-- Additional table rows -->
                              
                          

                          
                        @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="text-center display-8" style="padding: 20px;">
                            <i class="fas fa-exclamation-circle" style="font-size: 24px; color: red;"></i>
                            <b> THERE'S NO MEDIA</b>
                        </td>
                    </tr>

                     @endif
                    </tbody>
                    </table>
                </div>

              


              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>
    </section>

    <style>
        /* Example styles for pagination */
        .pagination {
          font-size: 21px;
          /* padding: 43px; */
          float: inline-end;
          padding-right: 18px;
        }

        .pagination ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .pagination ul li {
            display: inline;
            margin-right: 5px;
        }

        .pagination ul li a {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .pagination ul li a.active {
            background-color: #007bff;
            color: white;
        }
</style>

  <nav>
      <ul class="pagination justify-content-center">
          @if ($medias->onFirstPage())
              <li class="page-item disabled"><span class="page-link"><< Previous</span></li>
          @else
              <li class="page-item"><a class="page-link" href="{{ $medias->previousPageUrl() }}" rel="prev"><< Previous</a></li>
          @endif

          @for ($i = 1; $i <= $medias->lastPage(); $i++)
              @if ($i == $medias->currentPage())
                  <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
              @else
                  <li class="page-item"><a class="page-link" href="{{ $medias->url($i) }}">{{ $i }}</a></li>
              @endif
          @endfor

          @if ($medias->hasMorePages())
              <li class="page-item"><a class="page-link" href="{{ $medias->nextPageUrl() }}" rel="next">Next >></a></li>
          @else
              <li class="page-item disabled"><span class="page-link">Next >></span></li>
          @endif
      </ul>
  </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
@endsection