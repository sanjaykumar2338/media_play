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
            <h1><i class="fas fa-chart-bar"></i> Stats List(s)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('/admin/media')}}">Media</a></li>
              <li class="breadcrumb-item active">{{$media->title}}</li>
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
                                        <th class="col-sm-1 col-md-1">IP</th>
                                        <th class="col-sm-1 col-md-1">Created On</th>
                                        <th class="col-sm-1 col-md-1">Updated On</th>
                                    </tr>
                                </thead>
                    <tbody>
                    @if(count($stats)>0)
                    @foreach($stats as $key=>$stat)
                              
                                    <tr data-id="{{$media->id}}">
                                        <td class="col-sm-1 col-md-1">
                                            {{$key + $stats->firstItem()}}).
                                        </td>
                                        <td class="col-sm-1 col-md-1">
                                           {{ $stat->ip }}
                                        </td>
                                        <td class="col-sm-1 col-md-1">
                                           {{ $stat->created_at }}
                                        </td>
                                        <td class="col-sm-1 col-md-1">
                                           {{ $stat->updated_at }}
                                        </td>
                                        </td>


                                    </tr>
                                    <!-- Additional table rows -->
                              
                          

                          
                        @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="text-center display-8" style="padding: 20px;">
                            <i class="fas fa-exclamation-circle" style="font-size: 24px; color: red;"></i>
                            <b> THERE'S NO STATS</b>
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
          @if ($stats->onFirstPage())
              <li class="page-item disabled"><span class="page-link"><< Previous</span></li>
          @else
              <li class="page-item"><a class="page-link" href="{{ $stats->previousPageUrl() }}" rel="prev"><< Previous</a></li>
          @endif

          @for ($i = 1; $i <= $stats->lastPage(); $i++)
              @if ($i == $stats->currentPage())
                  <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
              @else
                  <li class="page-item"><a class="page-link" href="{{ $stats->url($i) }}">{{ $i }}</a></li>
              @endif
          @endfor

          @if ($stats->hasMorePages())
              <li class="page-item"><a class="page-link" href="{{ $stats->nextPageUrl() }}" rel="next">Next >></a></li>
          @else
              <li class="page-item disabled"><span class="page-link">Next >></span></li>
          @endif
      </ul>
  </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
@endsection