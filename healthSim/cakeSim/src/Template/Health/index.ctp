<?php use Cake\Routing\Router; ?>

<html>

<div class="alert alert-success">
  <strong>Success! <i class="fa fa-female" aria-hidden="true"></i></strong> Indicates a successful or positive action.
</div>

<div id="controlButtons")>
    <div class="col-sm-2">
        <button type="button" id="slow" class="simData btn btn-primary">Slow</button>
    </div>
    <div class="col-sm-2">
        <button type="button" id="medium" class="simData btn btn-primary">Medium</button>
    </div>
    <div class="col-sm-2">
        <button type="button" id="fast" class="simData btn btn-primary">Fast</button>
    </div>
</div>

<script>
    $( document ).ready(function() {
        $('.simData').click(function(e){
            var arrayOfPeople = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
            var highStepRange = 50;
            var lowStepRange = 0;
            var highHeartRate = 120;
            var lowHeartRate = 80;
            switch(e.target.id)
            {
                case "slow": 
                    lowStepRange = 0;
                    highStepRange = 50;
                    lowHeartRate = 80;
                    highHeartRate = 120;
                    break;
                case "medium": 
                    lowStepRange = 50;
                    highStepRange = 100;
                    lowHeartRate = 120;  
                    highHeartRate = 150;
                    break;            
                case "fast": 
                    lowStepRange = 100;
                    highStepRange = 150;
                    lowHeartRate = 150;
                    highHeartRate = 200;
                    break;
                default:
                    break;
            }
            for (var i = 0; i < 10; ++i) { 
                var steps = Math.floor(Math.random() * (highStepRange - lowStepRange + 1)) + lowStepRange;
                var heart = Math.floor(Math.random() * (highHeartRate - lowHeartRate + 1)) + lowHeartRate;
                arrayOfPeople[i] = `{"user_id":${i},"steps":${steps},"heart":${heart}}`;
            }
            console.log(arrayOfPeople);
            $.ajax({
                type: "POST",
                url: '<?php echo Router::url(array('controller'=>'health','action'=>'index'));?>',
                dataType: "json",
                data: arrayOfPeople,
                success: function(response) {
                    alert(JSON.stringify(response));
                },      
                error: function (response, desc, exception) {
                    alert("fail");
                }
            });
        });
    });
</script>

</html>
