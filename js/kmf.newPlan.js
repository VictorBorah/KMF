$(document).ready(function(){

/* Plan Types
	Investment Plan => 1
	Loan Plan => 2
*/

var planType = 1;//Investment Plan

	
/* START NOTIFICATION ANIMATION-VICTOR */
var mojsOpenExample = function (promise) {
    var n = this
    var Timeline = new mojs.Timeline()
    var body = new mojs.Html({
      el: n.barDom,
      x: {500: 0, delay: 0, duration: 500, easing: 'elastic.out'},
      isForce3d: true,
      onComplete: function () {
        promise(function(resolve) {
          resolve()
        })
      }
    })

    var parent = new mojs.Shape({
      parent: n.barDom,
      width: 200,
      height: n.barDom.getBoundingClientRect().height,
      radius: 0,
      x: {[150]: -150},
      duration: 1.2 * 500,
      isShowStart: true
    })

    n.barDom.style['overflow'] = 'visible'
    parent.el.style['overflow'] = 'hidden'

    var burst = new mojs.Burst({
      parent: parent.el,
      count: 10,
      top: n.barDom.getBoundingClientRect().height + 75,
      degree: 90,
      radius: 75,
      angle: {[-90]: 40},
      children: {
        fill: '#EBD761',
        delay: 'stagger(500, -50)',
        radius: 'rand(8, 25)',
        direction: -1,
        isSwirl: true
      }
    })

    const fadeBurst = new mojs.Burst({
      parent: parent.el,
      count: 2,
      degree: 0,
      angle: 75,
      radius: {0: 100},
      top: '90%',
      children: {
        fill: '#EBD761',
        pathScale: [.65, 1],
        radius: 'rand(12, 15)',
        direction: [-1, 1],
        delay: .8 * 500,
        isSwirl: true
      }
    })

    Timeline.add(body, burst, fadeBurst, parent)
    Timeline.play()
  }

  var mojsCloseExample = function (promise) {
    var n = this
    new mojs.Html({
      el: n.barDom,
      x: {0: 500, delay: 0, duration: 250, easing: 'cubic.out'},
      opacity: {1: 0, delay: 0, duration: 250},
      isForce3d: true,
      onComplete: function () {
        promise(function(resolve) {
          resolve()
        })
      }
    }).play()
  }

  var bouncejsOpenExample = function () {
    var n = this
    new Bounce()
      .translate({
        from: {x: 450, y: 0},
        to: {x: 0, y: 0},
        easing: 'bounce',
        duration: 1000,
        bounces: 4,
        stiffness: 3
      })
      .scale({
        from: {x: 1.2, y: 1},
        to: {x: 1, y: 1},
        easing: 'bounce',
        duration: 1000,
        delay: 100,
        bounces: 4,
        stiffness: 1
      })
      .scale({
        from: {x: 1, y: 1.2},
        to: {x: 1, y: 1},
        easing: 'bounce',
        duration: 1000,
        delay: 100,
        bounces: 6,
        stiffness: 1
      })
      .applyTo(n.barDom, {
        onComplete: function () {
          n.resume()
        }
      })
  }

  var bouncejsCloseExample = function () {
    var n = this
    new Bounce()
      .translate({
        from: {x: 0, y: 0},
        to: {x: 450, y: 0},
        easing: 'bounce',
        duration: 500,
        bounces: 4,
        stiffness: 1
      })
      .applyTo(n.barDom, {
        onComplete: function () {
          n.barDom.parentNode.removeChild(n.barDom)
        }
      })
  }

  var velocityShowExample = function () {
    var n = this

    Velocity(n.barDom, {
      left: 450,
      scaleY: 2
    }, {
      duration: 0
    })
    Velocity(n.barDom, {
      left: 0,
      scaleY: 1
    }, {
      easing: [8, 8]
    })
  }

  var velocityCloseExample = function () {
    var n = this

    Velocity(n.barDom, {
      left: '+=-50'
    }, {
      easing: [8, 8, 2],
      duration: 350
    })
    Velocity(n.barDom, {
      left: 450,
      scaleY: .2,
      height: 0,
      margin: 0
    }, {
      easing: [8, 8],
      complete: function () {
        n.barDom.parentNode.removeChild(n.barDom)
      }
    })
  }
/* END NOTIFICATION ANIMATION-VICTOR */	





	
$.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'err-block',
    errorPlacement: function(error, element)
	{       
		
	   if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        }
		else			
		{
           	if ( element.attr("type") == "checkbox")
			{
				var message="You must accept the Terms";				
				error.insertAfter($("#chkBoxDiv").append(error));
			}
			else
			{
				 if (element.hasClass('omni_select'))
				   {
					   error.insertAfter(element.next('span'));
				   }
				   else error.insertAfter(element);
			}
			
        }
    }
});
	


jQuery.validator.addMethod("validate_email", function(value, element) {
    return this.optional(element) || /^([a-z0-9][-a-z0-9_\+\.]*[a-z0-9])@([a-z0-9][-a-z0-9\.]*[a-z0-9]\.(ru|arpa|root|aero|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|([0-9]{1,3}\.{3}[0-9]{1,3}))$/.test($.trim(value));
	}, "Invalid Email");


	
	
jQuery.validator.addMethod("validate_mobile", function(value, element) {
		//var phn=$('#custMobile').cleanVal();	
		var phn = $.trim($("#stdMobile").val());
		if(phn.length ==10) return true;
		else return false;
		
	}, "Please enter your 10 Digit Mobile Number");	
	
		
	
	
	
	
	
	
var jvalidate = $("#newPlanFrm").validate({
	ignore: [],
	rules:
	{                           
		planName: {required: true },								
		intervalID: {required: true },								
		planAmt: {required: true },								
		interestAmt: {required: true },								
		installmentAmt: {required: true }								
	},
	messages:
	{	
		planName:{required:"Enter Plan name"},					
		intervalID:{required:"Select Interval"},					
		planAmt:{required:"Enter Plan Amount"},					
		interestAmt:{required:"Enter Interest Amount"},
		installmentAmt:{required:"Enter Installment Amount"}					
	}
			
			
}); 	

var initialLoad = true;	
var process = false;
var plan_ID = parseInt($.trim($("#pk").val()));	
var period_ID = parseInt($.trim($("#intvID").val()));	
$("#planName").focus();
loadFrequencies(period_ID,plan_ID);//8=>Defaults to 8 Months, plan_ID=0=> No PlanID Provided



$("#planAmt").keyup(function(){
	process = true;
	initialLoad = false;
	processInstallment(plan_ID);	
});



$("#interestAmt").keyup(function(){
	process = true;
	initialLoad = false;
	processInstallment(plan_ID);
});

$("#durationID").change(function(){
		process = true;
		initialLoad = false;
		var duration = $.trim($("#durationID").val());
		loadFrequencies(duration,plan_ID);
});


function loadFrequencies(k,z)
{
	var intvID = $.trim($("#intervalID").val());//Frequency
	
	if(k=="")
	{
		showAlert("Please select a Duration");
		initialLoad = false;	
	}
	else
	{
		$("#createPlan").attr("disabled", false);
		$('.graph').waitMe({effect : 'ios'});
			
			
		$.ajax({ 
				url: "Controllers/getFrquencies",
				type:"GET",
				data: {period:k,planID:z},
				success: 
					function(data)
					{		 
						$("#intervalID").html("");
						$("#intervalID").html(data);
						$('.graph').waitMe('hide');
						
												
						
						if(z!=0 && initialLoad && !process)
						{
							//Skip	
							initialLoad = false;								
						}
						else
						{
							showSuccesMsg("Frequencies Loaded. Please Select.");
							if(intvID=="")
							{
								$("#installmentAmt").val("Select Frequency");
								$("#planVal").val("Select Frequency");
							}
							else processInstallment(plan_ID);
							
							initialLoad = false;	
						}
						
						//processInstallment();
					}
		});
	}
}






$("#intervalID").change(function(){
	$("#createPlan").attr("disabled", false);
	processInstallment(plan_ID);
});



$(document).on("change", '#invPlan,#loanPlan', function(e){
	$("#createPlan").attr("disabled", false);
	processInstallment(plan_ID);
});


function processInstallment(plan_ID)
{
		planType = $("input[name='planType']:checked").val();
		var planTypeVal  = parseInt(planType);
		
		
		var divisor=1;//Defaults to Monthly
		var factor=1;//Defaults to Monthly
		var interestAmt = $.trim($("#interestAmt").val());
		var planAmt = $.trim($("#planAmt").val());
		var period = $.trim($("#durationID").val());
		var intvID = $.trim($("#intervalID").val());//Frequency
		if(intvID=="") intvID=2;//Defaults to Monthly
		intvID = parseInt(intvID);	
		
		if(period=="") period=1;


		switch(intvID)
		{
			case 1:divisor = period * 30;  break; // Daily
			case 2:divisor = period * 1;  break; // Monthly, every month
			case 3:divisor = period * (1/3);  break; // Quarterly, every three months
			case 4:divisor = period * (1/6);  break; // Quarterly, every six months
			case 5:divisor = period * (1/12);  break; // Quarterly, every six months
			
		}
		
			
		
		if(interestAmt=="") interestAmt = 0;
		else 
		{
			if( isNaN(interestAmt) ){interestAmt=0}
			else
			{
				interestAmt = parseFloat(interestAmt);	
				interestAmt = interestAmt.toFixed(2);
				interestAmt = Math.round(interestAmt * 100) / 100;		
			}
		}
		
		if(planAmt=="") planAmt = 0;
		else 
		{
			if( isNaN(planAmt) ){planAmt=0}
			else
			{
				planAmt = parseFloat(planAmt);	
				planAmt = planAmt.toFixed(2);
				planAmt = Math.round(planAmt * 100) / 100;		
			}
		}
		
	if(planTypeVal==2)
	{
		/*
			Interest will be added to the Total Plan Value and
			will be reflected in the Installment
		*/
		var totalAmount = planAmt + interestAmt;	
		var inst = totalAmount / period;
		var targetIns = totalAmount / divisor;
		targetIns = targetIns.toFixed(2);
		inst = inst.toFixed(2);
	}
	else
	{
		/*
			Interest will be added to the Total Plan Value but
			will NOT BE REFLECTED in the Installment
		*/
		var totalAmount = planAmt + interestAmt;	
		var inst = planAmt / period;
		var targetIns = planAmt / divisor;
		targetIns = targetIns.toFixed(2);
		inst = inst.toFixed(2);
	}
	
	
	
	
	//$("#installmentAmt").val(inst);
	$("#installmentAmt").val(targetIns);
	$("#planVal").val(totalAmount);
				
				

		
	
}


$("#createPlan").click(function(){
	
	if($("#newPlanFrm").valid())
	{
		//showAlert("Ready to Save");
		$("#createPlan").attr("disabled", false);
		$('.graph').waitMe({effect : 'ios'});
		
		var form = $('#newPlanFrm')[0];
		var main_formData = new FormData(form);
		
		 $.ajax({
				type: "POST",
				url: "Controllers/createPlan",
				data: main_formData,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					
								
					$("#createPlan").attr("disabled", false);
					var $validator = $("#newPlanFrm").validate();
					$validator.resetForm();	
					$('#newPlanFrm')[0].reset();
					$('.graph').waitMe('hide');
					showSuccesMsg("Plan created successfully");					
					
				},
				error: function (e) {
					
					$('.graph').waitMe('hide');		
					$("#createPlan").attr("disabled", false);
					showAlert("Network Error !");
							
						
				}
		});
	}
	else 
	{
		showFailureMsg("Missing Information");
	}
	
});







$("#editPlan").click(function(){
	
	if($("#newPlanFrm").valid())
	{
		//showAlert("Ready to Save");
		$("#editPlan").attr("disabled", false);
		$('.graph').waitMe({effect : 'ios'});
		
		var form = $('#newPlanFrm')[0];
		var main_formData = new FormData(form);
		
		 $.ajax({
				type: "POST",
				url: "Controllers/updatePlan",
				data: main_formData,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					
								
					$("#editPlan").attr("disabled", false);
					//var $validator = $("#newPlanFrm").validate();
					//$validator.resetForm();	
					//$('#newPlanFrm')[0].reset();
					$('.graph').waitMe('hide');
					showSuccesMsg("Plan updated successfully");					
					
				},
				error: function (e) {
					
					$('.graph').waitMe('hide');		
					$("#editPlan").attr("disabled", false);
					showAlert("Network Error !");
							
						
				}
		});
	}
	else 
	{
		showFailureMsg("Missing Information");
	}
	
});










/*******************************
	HELPER FUNCTIONS
/******************************/



function showSuccesMsg(k)
{
	new Noty({
       type: 'success',
       layout: 'topCenter',
       text: k,
	   sounds: { sources: ['sounds/success.mp3'], volume: 1, conditions: ['docVisible', 'docHidden'] },
       timeout: 500,
       modal: true,
       closeWith: ['click'],
       animation: {
         //open: 'noty_effects_open',
         //close: 'noty_effects_close'
		 
		  open: mojsOpenExample,
          close: mojsCloseExample
       }
     }).show();
}

function showFailureMsg(k)
{
	new Noty({
       type: 'error',
       layout: 'topCenter',
       text: k,
	   sounds: { sources: ['sounds/fail.mp3'], volume: 1, conditions: ['docVisible', 'docHidden'] },
       timeout: 500,
       modal: true,
       closeWith: ['click'],
       animation: {
         open: mojsOpenExample,
         close: mojsCloseExample
       }
     }).show();
}



function showInfoMsg(k)
{
	new Noty({
       type: 'info',
       layout: 'topCenter',
       text: k,
	   sounds: { sources: ['sounds/fail.mp3'], volume: 1, conditions: ['docVisible', 'docHidden'] },
       timeout: 500,
       modal: true,
       closeWith: ['click'],
       animation: {
         //open: 'noty_effects_open',
         //close: 'noty_effects_close'
		 
		  open: mojsOpenExample,
          close: mojsCloseExample
       }
     }).show();
}



function showAlert(k)
{
	 bootbox.alert({
					message: k,
					size: 'small',
					backdrop: true
				});
}

	
	
	
 
	
	
});		









