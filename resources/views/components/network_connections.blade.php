<div class="row justify-content-center mt-5">
  <div class="col-12">
    <div class="card shadow  text-white bg-dark">
      <div class="card-header">Coding Challenge - Network connections</div>
      <div class="card-body">
        <div class="btn-group w-100 mb-3" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" onchange="getSuggestions()"  id="btnradio1" autocomplete="off" value="suggestions">
          <label class="btn btn-outline-primary" for="btnradio1">Suggestions ({{ $array['suggestions'] }})</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" onchange="getRequests('pending')" autocomplete="off" value="sent">
          <label class="btn btn-outline-primary" for="btnradio2">Sent Requests ({{ $array['requests'] }})</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" onchange="getSendRequests('received')" autocomplete="off" value="received">
          <label class="btn btn-outline-primary" for="btnradio3">Received Requests({{ $array['received'] }})</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio4" onchange="getConnections()" autocomplete="off" value="connections">
          <label class="btn btn-outline-primary" for="btnradio4">Connections ({{ $array['connections'] }})</label>
          <input type="hidden" class="get-url" value="{{ route('get.content') }}">
        </div>
        <hr>
        <div id="content" class="">
          
          {{-- Display data here --}}
   
        </div>

      <div id="connections_in_common_skeleton" class="d-none">
        <br>
        <span class="fw-bold text-white">Loading Skeletons</span>
        <div class="px-2">
          @for ($i = 0; $i < 10; $i++)
            <x-skeleton />
          @endfor
        </div>
      </div>

      </div> 
    </div>
  </div>
</div>

{{-- Remove this when you start working, just to show you the different components --}}
