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
                <div class="clearfix">
                    <div id="chartol" class="box"></div>
                    <div class="box">calendar</div>
                </div>
                

                <hr>

                <p> <b>User Asssessment Report<b> </p>
                    @if (count($report) > 0)
                        @foreach ($report as $item)
                        <div class="well">
                            User report at : <a href="/user/{{$users->id}}/{{$item->id}}">{{$item->created_at}}</a>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    //nanti dalam ni hg declare satu variable nama data 
    var user =  {!! json_encode($users->toArray()) !!}; //pastu guna cara ni nk passing
    console.log("test:",user)
    Highcharts.chart('chartol', {
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
                'Mon',
                'Tue',
                'Wed',
                'Thu',
                'Fri',
                'Sat',
                'Sun'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
        series: [{ //just tukar series : data
            name: 'Sodium',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 105.0]

        }, {
            name: 'Phosphate',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0]

        }, {
            name: 'Fluid',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0]

        }, {
            name: 'Potassium',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4]

        }, {
            name: 'Protein',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4]

        }, {
            name: 'Calorie',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4]

        }]
    });
</script>
@endsection
