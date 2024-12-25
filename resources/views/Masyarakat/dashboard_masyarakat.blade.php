@extends('layout_masyarakat.index')

@section('content')
 	<!--start page wrapper -->
     <div class="page-wrapper">
        <div class="page-content">
            <div class="row ">
                <div class="col">
                    <div class="card radius-10 border-danger border-start border-0 border-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p  style="font-size:20px;" class="mb-1">Total Pengaduan</p>
                                    <h4 class="my-1 text-danger">{{ $ar_pengaduan  }}</h4>
                                </div>
                                <div class="text-danger ms-auto font-35"><i class="bx bx-comment-detail" style="font-size: 2em;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10  border-warning border-start border-0 border-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p style="font-size:20px; " class="mb-1">Jumlah pengaduan yang telah mendapatkan tanggapan</p>
                                    <h4 class="text-warning my-1">{{  $dataTanggapan  }}</h4>
                                </div>
                                <div class="text-warning ms-auto font-35"><i class="bx bx-user-pin" style="font-size: 2em;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->

           
                   <div class="card radius-10">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Jumlah Status Pengaduan</h6>
                            </div>
                        </div>
                    </div>
                       <div class="card-body">
                        <div class="chart-container-0">
                            <canvas id="chart2"></canvas>

                            <script>
                                $(function() {"use strict";
                                var label = [@foreach($ar_label as $label) '{{$label}}', @endforeach];
                                var ctx = document.getElementById("chart2").getContext('2d');
                                   var myChart = new Chart(ctx, {
                                       type: 'doughnut',
                                       data: {
                                       labels: label,
                                       datasets: [{
                                           backgroundColor: [
                                           '#fd3550',
                                           '#008cff',
                                           '#15ca20'
                                           ],
                                           hoverBackgroundColor: [
                                           '#fd3550',
                                           '#008cff',
                                           '#15ca20'
                                           ],
                                           data: ['{{ $stt_blm }}','{{ $stt_proses }}','{{ $stt_selesai }}'],
                                               borderWidth: [1, 1, 1]
                                       }]
                                       },
                                       options: {
                                           maintainAspectRatio: false,
                                           cutoutPercentage: 75,
                                           legend: {
                                           position: 'bottom',
                                           display: true,
                                           labels: {
                                               boxWidth:20
                                           }
                                           },
                                           tooltips: {
                                           displayColors:false,
                                           }
                                       }
                                   });
   
   
   
                                   // worl map
   
                                   jQuery('#geographic-map-2').vectorMap(
                                   {
                                   map: 'world_mill_en',
                                   backgroundColor: 'transparent',
                                   borderColor: '#818181',
                                   borderOpacity: 0.25,
                                   borderWidth: 1,
                                   zoomOnScroll: false,
                                   color: '#009efb',
                                   regionStyle : {
                                       initial : {
                                       fill : '#008cff'
                                       }
                                   },
                                   markerStyle: {
                                   initial: {
                                               r: 9,
                                               'fill': '#fff',
                                               'fill-opacity':1,
                                               'stroke': '#000',
                                               'stroke-width' : 5,
                                               'stroke-opacity': 0.4
                                               },
                                               },
                                   enableZoom: true,
                                   hoverColor: '#009efb',
                                   markers : [{
                                       latLng : [21.00, 78.00],
                                       name : 'Lorem Ipsum Dollar'
                                   
                                   }],
                                   hoverOpacity: null,
                                   normalizeFunction: 'linear',
                                   scaleColors: ['#b6d6ff', '#005ace'],
                                   selectedColor: '#c9dfaf',
                                   selectedRegions: [],
                                   showTooltip: true,
                                   });
                                });
                               </script>
                          </div>
                       </div>
                   </div>
               </div>
            </div><!--end row-->
   
    <!--end page wrapper -->   
@endsection