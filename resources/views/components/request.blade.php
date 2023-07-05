@foreach ($sentRequests as $item)
<div class="my-2 shadow text-white bg-dark p-1 user-{{ $item->id }}" id="">
  <div class="d-flex justify-content-between">
    <table class="ms-1">
      <td class="align-middle">{{ $item->receiver->name }}</td>
      <td class="align-middle"> - </td>
      <td class="align-middle">{{ $item->receiver->email }}</td>
      <td class="align-middle">
    </table>
    <div>
      @if ($item->sender_id == Auth::user()->id)
        <button id="cancel_request_btn_" class="btn btn-danger me-1"
          onclick="deleteRequest({{ $item->id }})">Withdraw Request</button>
      @else
        <button id="accept_request_btn_" class="btn btn-primary me-1"
          onclick="acceptRequest({{ $item->id }})">Accept</button>
      @endif
    </div>
  </div>
</div>
@endforeach