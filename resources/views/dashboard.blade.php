@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h3>Dashboard</h3>

        {{--show sample dashboard here--}}
       <div class="row">
           <div class="col-md-8">
               <div class="panel">
                   <div class="panel-heading">
                       <strong class="panel-title">Jumlah Sebaran Jumantik Per Tahun</strong>
                   </div>
                   <div class="panel-body">
                       <div class="line"></div>
                   </div>
               </div>
           </div>
           <div class="col-md-4">
                <div class="panel">
                    <div class="panel-heading">
                        <strong class="panel-title">Sebaran Usia Suspect</strong>
                    </div>
                    <div class="panel-body">
                        <div class="pie"></div>
                    </div>
                </div>
           </div>
       </div>
        {{--/show sample dashboard--}}
    </div>
@endsection
