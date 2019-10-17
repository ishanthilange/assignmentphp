<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Highcharts.chart('container', {

                    title: {
                        text: 'tmpr onboarding weekly cohort'
                    },

                    yAxis: {
                        title: {
                            text: 'User Percentage (%)'
                        }
                    },
                    xAxis: {
                        categories: ['0', '1', '2','3','4','5','6','7']
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },

                    plotOptions: {
                        series: {
                            label: {
                                connectorAllowed: false
                            },
                            pointStart: 0
                        }
                    },
                series: <?php  echo $chartArray;?>,

                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 500
                            },
                            chartOptions: {
                                legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                }
                            }
                        }]
                    }

                });
            })
        </script>


    </head>
    <body>
        <h1>Onboarding Weekly Summary</h1>
        <a href="/display">Reload</a>
        <div id="container" style="width:100%; height:400px;"></div>
    </body>
</html>
