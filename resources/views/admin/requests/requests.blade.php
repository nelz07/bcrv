@extends('layouts.master')

@section('title')
    Admin | Requests
@endsection

@section('content')
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Requests table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Course</th>
                        <th>Document Name</th>
                        <th>No. of Copies</th>
                        <th>Request Date</th>
                        <th>Release Date</th>
                        <th>Processing Officer</th>
                        <th>Status</th>
                        <th>Response Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>STDNT-{{ $request->student_id }}</td>
                        <td>{{ $request->course }}</td>
                        <td>{{ $request->document_name }}</td>
                        <td>{{ $request->number_of_copies }}</td>
                        <td>{{ $request->date_of_request }}</td>
                        <td>{{ $request->release_date }}</td>
                        <td>{{ $request->processing_officer }}</td>
                        @if ($request->status == 'pending')
                            <b><td class="text-success">Pending</td></b>
                        @elseif ($request->status == 'ongoing')
                            <b><td class="text-warning">Ongoing</td></b>
                        @elseif ($request->status == 'received') 
                            <b><td class="text-info">Received</td></b>
                        @endif
                        @if ($request->is_responde == "0")
                            <b><td class="text-danger">No Response yet</td></b>
                        @else
                            <b><td class="text-success">Respond Sent</td></b>
                        @endif
                        <td style="width: 210px;">
                            <a href="/show_edit_request/{{ $request->id }}" type="button" class="btn-sm btn-primary bg-info">
                                <i class="fa fa-pen" style="padding: 10px;"></i> Edit
                            </a>
                            @if ($request->is_responded == '0')
                                <a href="/show_respond_to_request/{{ $request->id }}" type="button" class="btn-sm btn-primary bg-warning">
                                    <i class="fa fa-file" style="padding: 10px;"></i> Respond
                                </a>
                            @else 
                                <a hidden href="/show_respond_to_request/{{ $request->id }}" type="button" class="btn-sm btn-primary bg-warning">
                                    <i class="fa fa-file" style="padding: 10px;"></i> Respond
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Course</th>
                        <th>Document Name</th>
                        <th>No. of Copies</th>
                        <th>Request Date</th>
                        <th>Release Date</th>
                        <th>Processing Officer</th>
                        <th>Status</th>
                        <th>Response Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
@endsection
    
@section('scripts')
<!-- jQuery -->
<script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
    $(document).ready(function() {
      $('#example1').DataTable();
      $('#example1').on('click', '.deletbtn', function() {
          $tr = $(this).closest('tr');
  
          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get(); 
  
          // console.log(data);
  
          $('#get_course_id').val(data[0]);
          $('#deleteModalForm').attr('action', '/delete_course/'+data[0]);
          $('#deleteModalPop').modal('show');
      });
    });
  </script>
@endsection