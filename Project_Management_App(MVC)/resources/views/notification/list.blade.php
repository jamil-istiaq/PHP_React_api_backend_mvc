@extends('layouts.menubar')

@section('body')

<div class="col-lg-12">
    <div class="card-style mb-30">
      <h6 class="mb-10">Messages</h6>
      <div class="table-wrapper table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th><h6>SL No.</h6></th>
              <th><h6>Send By</h6></th>
              <th><h6>Receiver</h6></th>
              <th><h6>Message</h6></th>
              <th><h6>Attachment</h6></th>
              <th><h6>Action</h6></th>
            </tr>
            <!-- end table row-->
          </thead>
          <tbody>
            <tr>
                @foreach ($messages as $msg)
              <td class="min-width">
                <div class="lead">
                 <p>{{$msg->id}}</p>
                </div>
              </td>
              <td class="min-width">
                <p>{{$msg->sender_id}}</p>
              </td>
              <td class="min-width">
                <p>{{$msg->receiver}}</p>
              </td>
              <td class="min-width">
                <p>{{$msg->message}}</p>
              </td>
              <td class="min-width">
                <p>{{$msg->attachment}}</p>
              </td>
              <td>
                <div class="action">
                  <button class="text-danger">
                    <i class="lni lni-trash-can"></i>
                  </button>
                </div>
              </td>
              @endforeach
            </tr>
            <!-- end table row -->
          </tbody>
        </table>
        <!-- end table -->
      </div>
    </div>
    <!-- end card -->
  </div>

@endsection