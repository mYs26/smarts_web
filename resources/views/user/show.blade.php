@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p>Patient Profile</p>
            </div>
            <div class="card-subtitle" style="padding-left: 20px">
                <br> 
                <p>Name : {{$users->name}}</p>
                <p>Email : {{$users->email}}</p>
                <p>Address : {{$detail->address}}</p>
                <p>Contact Number : {{$detail->p_num}}</p>
                {{-- <p>{{$user->address}}</p> --}}
            </div>
            <hr>
            <div class="card-body">
                @if (count($dataG) > 0)
                    <div id="chartcontainer" style="width:100%; height:400px;"></div>
                @else
                    <p>No Data Yet</p>
                @endif
                
                

                <hr>

                <p> <b>User Asssessment Report<b> </p>
                    @if (count($report) > 0)
                        @foreach ($report as $item)
                        <div class="well">
                            User report at : <a href="/user/{{$users->id}}/{{$item->id}}">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}
                            </a>
                        </div>
                        @endforeach
                    @else
                        Data not exist
                    @endif
                
            </div>
        </div>
    </div>    
@endsection

@section('footer')
    

    <script>
        //nanti dalam ni hg declare satu variable nama data 
        
        document.addEventListener('DOMContentLoaded', function(){
            var mydata = {!! json_encode($dataG) !!}; //pastu guna cara ni nk passing
            console.log("test:",mydata)
            
            //aku rasa chart load dulu sebelom console log sbbtu dia xdpt data sbb variable mydata tu kosong lg kot
            Highcharts.chart('chartcontainer', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Weekly User Intake'
                },
                subtitle: {
                    text: 'Source: smarts d4d'
                },
                xAxis: {
                    categories: [
                        'Last 7 Day',
                        'Last 6 Day',
                        'Last 5 Day',
                        'Last 4 Day',
                        'last 3 Day',
                        'Yesterday',
                        'Today'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    max: 150,
                    title: {
                        text: 'Percentage (%)'
                    },
                    plotLines: [{
                        color: '#FF0000',
                        dashStyle: 'shortdash',
                        width: 2,
                        value: 100
                    }]
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: mydata
            });
            
        });
    </script>
@endsection
