        $(document).ready(function () {


                var config4 = liquidFillGaugeDefaultSettings();
                config4.circleThickness = 0.15;
                config4.circleColor = "#368ee0";
                config4.textColor = "#368ee0";
                config4.waveTextColor = "#FFFFFF";
                config4.waveColor = "#368ee0";
                config4.textVertPosition = 0.5;
                config4.waveAnimateTime = 1000;
                config4.waveHeight = 0.05;
                config4.waveAnimate = false;
                config4.waveRise = false;
                config4.waveHeightScaling = false;
                config4.waveOffset = 0.15;
                config4.textSize = 0.75;
				config4.minValue = 30;
				config4.maxValue = 1000
                config4.displayPercent = false;
                var gauge5 = loadLiquidFillGauge("fillgauge5", {{$userLogin['user_login_count']}}, config4);

                var config5 = liquidFillGaugeDefaultSettings();
                config5.circleThickness = 0.2;
                config5.circleColor = "#368ee0";
                config5.textColor = "#368ee0";
                config5.waveTextColor = "#FFFFFF";
                config5.waveColor = "#368ee0";
                config5.textVertPosition = 0.5;
                config5.waveAnimateTime = 1000;
                config5.waveHeight = 0.05;
                config5.waveAnimate = false;
                config5.waveRise = false;
                config5.waveHeightScaling = false;
                config5.waveOffset = 0.15;
                config5.textSize = 0.75;
				config5.minValue = 30;
				config5.maxValue = 500
                config5.displayPercent = false;
				
                var gauge6 = loadLiquidFillGauge("fillgauge6", 18, config5);

                var chart = c3.generate({
                    bindto: '#top5ward',
                    data: {
                        x: 'x',
                        columns: [
                            //  ['data1', 30, 200, 100, 400, 150]

                            ['x',
                                @foreach($graphDataforWard as $data)
                                        '{{ $data->page_title}}',
                                @endforeach
                            ],
                            ['Ward',
                                @foreach($graphDataforWard as $data)
                                       '{{number_format($data->percentage, 2, '.', ',')}}',
                                @endforeach
                            ]
                        ],
                        type: 'bar'
                    },
                    axis: {
                        x: {
                            type: 'category',
                        },
                        y: {
                            max: 91,
                            tick: {
                                values: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]
                            }
                        }
                    },
                    tooltip: {
                        show: true,
                        format: {
                            value: function (value, ratio, id) {
                                return value + '%';
                            }
                        }
                    },
                    legend: {
                        show: false,
                    },
                    size: {
                        height: 320
                    }
                });


                var chart = c3.generate({
                    bindto: '#top5page',
                    data: {
                        x: 'x',
                        columns: [
                            //['data1', 30, 200, 100, 400, 150]

                            ['x',
                                @foreach($graphDataforPage as $data)
                                        '{{ $data->page_title}}',
                                @endforeach
                            ],
                            ['Page',
                                @foreach($graphDataforPage as $data)
                                        '{{number_format($data->percentage, 2, '.', ',')}}',

                                @endforeach
                            ]
                        ],
                        type: 'bar',
                    },
                    axis: {
                        x: {
                            type: 'category',
                        },
                        y: {
                            max: 91,
                            tick: {
                                values: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]
                            }
                        }
                    },
                    tooltip: {
                        show: true,
                        format: {
                            value: function (value, ratio, id) {
                                return value + '%';
                            }
                        }
                    },
                    legend: {
                        show: false,
                    },
                    size: {
                        height: 320
                    }
                });

            });