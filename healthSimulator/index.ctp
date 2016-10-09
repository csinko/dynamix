<script src="plugins/jquery/jquery.js"></script>
<script src="plugins/bootstrap/dist/js/bootstrap.js"></script>
<link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.css">
<link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap-theme.css">
<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.css">
<style>
    #toggle {
        height: 0px;
    }
</style>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <i class="fa fa-headphones fa-2x fa-spin" id="headphones" aria-hidden="true"></i>
      </a>
    </div>
  </div>
    <div class="alert alert-success col-sm-8 col-centered" style="text-align: center; display: none;" id="success">
        <strong>Success! Activity simulated. </strong>
    </div>
    <br>
</nav>

<html>
    <div class="panel panel-default col-centered col-sm-11">
        <br>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">Dynamix</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li id="firstTab" class="active"><a href="#">Simulation</a></li>
                        <li id="secondTab" class=""><a href="#">Data Visuals</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body" id="firstTabContent">
                    <div id="controlButtons" class="btn-group col-sm-12")>
                        <button type="button" id="slow" class="simData btn btn-primary btn-lg round">Slow &nbsp <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        <button type="button" id="medium" class="simData btn btn-primary btn-lg round">Medium &nbsp <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                        <button type="button" id="fast" class="simData btn btn-primary btn-lg round">Fast &nbsp <i class="fa fa-fast-forward" aria-hidden="true"></i></button>
                    </div>      
                    <div id="yoshi">
                        <div class="col-sm-2">
                            <img id="headbang1" style="display: none;" src="headbang.gif">
                        </div>
                        <div class="col-sm-2">
                            <img id="headbang2" style="display: none;" src="headbang.gif">
                        </div>
                        <div class="col-sm-2">
                            <img id="headbang3" style="display: none;" src="headbang.gif">
                        </div>
                    </div>
                </div>
                <div class="panel-body" id="secondTabContent" style="display: none;">
                    <div id="dataVisuals" class="btn-group col-sm-12")>
                        test test test
                    </div>      
                </div>
            </div>
        </div>
    </div>
</html>
<script>
    $( document ).ready(function() {
        $('#firstTab').click(function(e){
            if(!$('#firstTabContent').is(':visible'))
            {
                $('#firstTabContent').toggle();
                $('#firstTab').addClass('active');
                $('#secondTabContent').toggle();
                $('#secondTab').removeClass('active');
            }
        });
        $('#secondTab').click(function(e){
            if(!$('#secondTabContent').is(':visible'))
            {
                $('#secondTabContent').toggle();
                $('#secondTab').addClass('active');
                $('#firstTabContent').toggle();
                $('#firstTab').removeClass('active');
            }
        });
        $('.simData').click(function(e){
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
            for (var i = 0; i < limit; ++i) { 
                var steps = Math.floor(Math.random() * (highStepRange - lowStepRange + 1)) + lowStepRange;
                var heart = Math.floor(Math.random() * (highHeartRate - lowHeartRate + 1)) + lowHeartRate;
                arrayOfPeople.push({"user_id": i, "steps": steps, "heart_rate": heart});
            }
            var arrayObject = {"type": "array", "data": arrayOfPeople};
            console.log(arrayObject);
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
                        $('#success, #headbang1').toggle("scale");
                        $('#success, #headbang1').delay(1500).toggle("scale");
                    }
                    else if(limit < 20)
                    {
                        $('#success, #headbang1, #headbang2').toggle("scale");
                        $('#success, #headbang1, #headbang2').delay(1500).toggle("scale");
                    }
                        
                    else if(limit <= 30)
                    {
                        $('#success, #headbang1, #headbang2, #headbang3').toggle("scale");
                        $('#success, #headbang1, #headbang2, #headbang3').delay(1500).toggle("scale");
                    }
                }
            });
        });
    });
</script>