<script src="plugins/jquery/jquery.js"></script>
<script src="plugins/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="plugins/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="plugins/canvasjs-1/canvasjs.min.js"></script>
<link rel="stylesheet" href="plugins/jquery-ui-1.12.1/jquery-ui.css">
<link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.css">
<link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap-theme.css">
<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.css">
<style>
#toggle {
    height: 0px;
}
body {
  font-family: 'PT Sans', sans-serif;
  font-size: 13px;
  font-weight: 400;
  color: #4f5d6e;
  position: relative;
  background: rgb(26, 49, 95);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(26, 49, 95, 1)), color-stop(10%, rgba(26, 49, 95, 1)), color-stop(24%, rgba(29, 108, 141, 1)), color-stop(37%, rgba(41, 136, 151, 1)), color-stop(77%, rgba(39, 45, 100, 1)), color-stop(90%, rgba(26, 49, 95, 1)), color-stop(100%, rgba(26, 49, 95, 1)));
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#1a315f', endColorstr='#1a315f', GradientType=0);
}
.body-wrap {
  min-height: 700px;
}

.body-wrap {
  position: relative;
  z-index: 0;
}
.body-wrap:before,
.body-wrap:after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: -1;
  height: 260px;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(26, 49, 95, 1)), color-stop(100%, rgba(26, 49, 95, 0)));
  background: linear-gradient(to bottom, rgba(26, 49, 95, 1) 0%, rgba(26, 49, 95, 0) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#1a315f', endColorstr='#001a315f', GradientType=0);
}
.body-wrap:after {
  top: auto;
  bottom: 0;
  background: linear-gradient(to bottom, rgba(26, 49, 95, 0) 0%, rgba(26, 49, 95, 1) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#001a315f', endColorstr='#1a315f', GradientType=0);
}
nav {
  box-shadow: 5px 4px 5px #000;
}
</style>
<br>
<br>
<br>
<br>
<html>
    <nav class="navbar navbar-inverse col-sm-12 navbar-fixed-top" style="border-radius:0">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Dynamix</a>
            </div>
            <div class="nav navbar-nav" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><button type="button" id="slow" class="simData btn btn-primary btn-lg round">Slow &nbsp <i class="fa fa-angle-right" aria-hidden="true"></i></button></li>
                    <li><button type="button" id="medium" class="simData btn btn-primary btn-lg round">Medium &nbsp <i class="fa fa-angle-double-right" aria-hidden="true"></i></button></li>
                    <li><button type="button" id="fast" class="simData btn btn-primary btn-lg round">Fast &nbsp <i class="fa fa-fast-forward" aria-hidden="true"></i></button></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="panel panel-default col-centered col-sm-11">
    <nav class="navbar navbar-default">
        <div class="container-fluid col-sm-13">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <i class="fa fa-headphones fa-2x fa-spin" id="headphones" aria-hidden="true"></i>
                </a>
            </div>
            <div class="col-sm-2 col-centered">
                <img src="dynamixLogo.png">
            </div>
        </div>
    </nav>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body" id="secondTabContent">
                    <div id="dataVisuals" class="btn-group col-sm-12")>
                        <body>
                            <div id="chartContainer1" class="col-centered" style="height: 500px; width: 50%;"></div>
                        </body>
                        <body>
                            <div id="chartContainer2" class="col-centered" style="height: 500px; width: 50%;"></div>
                        </body>
                        <body>
                            <div id="chartContainer3" class="col-centered" style="height: 500px; width: 50%;"></div>
                        </body>
                        <body>
                            <div id="chartContainer4" class="col-centered" style="height: 500px; width: 50%;"></div>
                        </body>
                        <body>
                            <div id="chartContainer5" class="col-centered" style="height: 500px; width: 50%;"></div>
                        </body>
                    </div>      
                </div>
                <div id="yoshi">
                    <div class="col-sm-2">
                        <img id="headbang1" class="col-centered" style="display: none;" src="headbang.gif">
                    </div>
                    <div class="col-sm-2">
                        <img id="headbang2" class="col-centered" style="display: none;" src="headbang.gif">
                    </div>
                    <div class="col-sm-2">
                        <img id="headbang3" class="col-centered" style="display: none;" src="headbang.gif">
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>
<script>
    function getPerson(i)
    {
        var person;
        switch(i)
        {
            case 0: 
                person = "Aron";
                break;
            case 1: 
                person = "Mica";
                break;
            case 2: 
                person = "Cameron";
                break;
            case 3: 
                person = "Beth";
                break;
            case 4: 
                person = "Steven";
                break;
            case 5: 
                person = "Emerson";
                break;
            case 6: 
                person = "Russel";
                break;
            case 7: 
                person = "Blaize";
                break;
            case 8: 
                person = "Matthew";
                break;
            case 9: 
                person = "Elizabeth";
                break;
            case 10: 
                person = "Anne";
                break;
            case 11: 
                person = "Mara";
                break;
            case 12: 
                person = "Parker";
                break;
            case 13: 
                person = "Grant";
                break;
            case 14: 
                person = "Jesse";
                break;
            case 15: 
                person = "Katie";
                break;
            case 16: 
                person = "Jessica";
                break;
            case 17: 
                person = "Ryan";
                break;
            case 18: 
                person = "Lisa";
                break;
            case 19: 
                person = "Shawn";
                break;
            case 20: 
                person = "Ivan";
                break;
            case 21: 
                person = "Rebecca";
                break;
            case 22: 
                person = "Peter";
                break;
            case 23: 
                person = "Istvan";
                break;
            case 24: 
                person = "Tasha";
                break;
            case 25: 
                person = "Nathan";
                break;
            case 26: 
                person = "Austin";
                break;
            case 27: 
                person = "Ariella";
                break;
            case 28: 
                person = "Cliff";
                break;
            case 29: 
                person = "Samantha";
                break;
        }
        return person;
    }
    $( document ).ready(function() {
        var topThreeMoments = [{"label": 0, "y": 0}, {"label": 0, "y": 0}, {"label": 0, "y": 0}];
        var arrayAvgDanceability = [];
        $('.simData').click(function(e){
            var arraySpcDanceability = [];
            var arrayStepsChart = [];
            var arrayHeartChart = [];
            var arrayOfPeople = [];
            var highStepRange = 50;
            var lowStepRange = 0;
            var highHeartRate = 120;
            var lowHeartRate = 80;
            var limit = Math.floor(Math.random() * (30 - 1 + 1)) + 1;
            switch(e.target.id)
            {
                case "slow": 
                    lowStepRange = 0;
                    highStepRange = 50;
                    lowHeartRate = 60;
                    highHeartRate = 100;
                    break;
                case "medium": 
                    lowStepRange = 50;
                    highStepRange = 100;
                    lowHeartRate = 100;  
                    highHeartRate = 140;
                    break;            
                case "fast": 
                    lowStepRange = 100;
                    highStepRange = 150;
                    lowHeartRate = 140;
                    highHeartRate = 200;
                    break;
                default:
                    break;
            }
            var average_danceability = 0;
            var specific_danceability = 0;
            for (var i = 0; i < limit; ++i) { 
                var steps = Math.floor(Math.random() * (highStepRange - lowStepRange + 1)) + lowStepRange;
                var heart = Math.floor(Math.random() * (highHeartRate - lowHeartRate + 1)) + lowHeartRate;
                arrayOfPeople.push({"user_id": i, "steps": steps, "heart_rate": heart});
                var person = getPerson(i);
                arrayStepsChart[i] = ({"label": person, "y": steps});
                arrayHeartChart[i] = ({"label": person, "y": heart});
                average_danceability += ((1/500) * steps + (1/600) * (heart - 80));
                spcDanceability = ((1/500) * steps + (1/600) * (heart - 80)) * 1.8;
                arraySpcDanceability[i] = ({"label": person, "y": spcDanceability});
            }
            average_danceability = average_danceability / limit;
            average_danceability = average_danceability * 1.8;
            for (var i = 0; i < topThreeMoments.length; ++i)
            {
                if(topThreeMoments[i].y < average_danceability)
                {
                    var now = new Date();
                    var outStr = now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
                    topThreeMoments[i].label = outStr;
                    topThreeMoments[i].y = average_danceability;
                    break;
                }
            }
            arrayAvgDanceability.push({"x": arrayAvgDanceability.length, "y": average_danceability});
            arrayObject = {"type": "array", "data": arrayOfPeople};
            $.ajax({
                type: "POST",
                url: 'http://dynamix.tech:8888/api/mix',
                dataType: "json",
                data: arrayObject,
                success: function(response) {
                    alert(response);
                },      
                error: function (response, desc, exception) {
                    if(limit < 10)
                    {
                        $('#headbang1').toggle("scale");
                        $('#headbang1').delay(1500).toggle("scale");
                    }
                    else if(limit < 20)
                    {
                        $('#headbang1, #headbang2').toggle("scale");
                        $('#headbang1, #headbang2').delay(1500).toggle("scale");
                    }
                        
                    else if(limit <= 30)
                    {
                        $('#headbang1, #headbang2, #headbang3').toggle("scale");
                        $('#headbang1, #headbang2, #headbang3').delay(1500).toggle("scale");
                    }
                    var chart1 = new CanvasJS.Chart("chartContainer1",{
                        animationEnabled: true,
                        title :{
                            text: "Steps per person"
                        },
                        axisX: {						
                            title: "People"
                        },
                        axisY: {						
                            title: "Steps"
                        },
                        data: [{
                            type: "pie",
                            dataPoints : arrayStepsChart
                        }]
                    });
                    chart1.render();
                    var chart2 = new CanvasJS.Chart("chartContainer2",{
                        animationEnabled: true,
                        title :{
                            text: "Heart Rate per person"
                        },
                        axisX: {						
                            title: "People"
                        },
                        axisY: {						
                            title: "Heart Rate"
                        },
                        data: [{
                            type: "bar",
                            dataPoints : arrayHeartChart
                        }]
                    });
                    chart2.render();
                    var chart3 = new CanvasJS.Chart("chartContainer3",{
                        animationEnabled: true,
                        title :{
                            text: "Danceability per person"
                        },
                        axisX: {						
                            title: "People"
                        },
                        axisY: {						
                            title: "Danceability"
                        },
                        data: [{
                            type: "doughnut",
                            dataPoints : arraySpcDanceability
                        }]
                    });
                    chart3.render();
                    var chart4 = new CanvasJS.Chart("chartContainer4",{
                        animationEnabled: true,
                        title :{
                            text: "Average Danceability"
                        },
                        axisX: {						
                            title: "Index * 10 Seconds"
                        },
                        axisY: {						
                            title: "Danceability"
                        },
                        data: [{
                            type: "spline",
                            dataPoints : arrayAvgDanceability
                        }]
                    });
                    chart4.render();
                    var chart5 = new CanvasJS.Chart("chartContainer5",{
                        animationEnabled: true,
                        title :{
                            text: "Top Moments"
                        },
                        axisX: {						
                            title: "Time (seconds)"
                        },
                        axisY: {						
                            title: "Danceability"
                        },
                        data: [{
                            type: "column",
                            dataPoints : topThreeMoments
                        }]
                    });
                    chart5.render();
                }
            });
        });
    });
</script>