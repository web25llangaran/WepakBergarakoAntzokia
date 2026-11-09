@extends('layouts.admin')

@section('content')
<div class="tab-content admin-main flex-grow-1 p-4 d-flex flex-column overflow-hidden" id="v-pills-tabContent">
    {{-- DASHBOARD --}}
        @include('admin.dashboard')
    {{-- EKITALDIAK --}}
    <div class="tab-pane fade" id="v-pills-ekitaldiak" role="tabpanel" aria-labelledby="v-pills-ekitaldiak-tab" tabindex="0">
        @include('admin.ekitaldiak.dashboard')
    </div>
    {{-- ERABILTZAILEAK --}}
    <div class="tab-pane fade" id="v-pills-erabiltzaileak" role="tabpanel" aria-labelledby="v-pills-erabiltzaileak-tab" tabindex="0">
        ...ERABILTZAILEAK
    </div>
    {{-- SARRERAK --}}
    <div class="tab-pane fade" id="v-pills-sarrerak" role="tabpanel" aria-labelledby="v-pills-sarrerak-tab" tabindex="0">
        @include('admin.sarrerak.dashboard')
    </div>
</div>
@endsection

@push('scripts')
<script>
    // URL-ak #sarrerak bezalako hash bat badu (adib. sarrera bat gorde ondoren), fitxa hori ireki.
    document.addEventListener('DOMContentLoaded', () => {
        const fitxa = window.location.hash.substring(1);
        if (fitxa) {
            document.getElementById(`v-pills-${fitxa}-tab`)?.click();
        }
    });
</script>
@endpush
