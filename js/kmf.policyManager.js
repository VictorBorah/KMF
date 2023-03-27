$(document).ready(function(){

	
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
	
	
	
	
    var transactionsPane;
	
	$(document).on("click", '.viewTrnsBtn', function(e){
		var rid=this.id;
		var splitArr=rid.split("-");
		var dataID=splitArr[1];
		
		
		console.log("\n Record PK=>"+dataID);
		
		
		$('.page-container').waitMe({ effect : 'ios'	});
	    jsPanel.ziBase = 9000;
		transactionsPane = jsPanel.create({
			id:'recordViewWin',		
			  theme: {
				bgPanel: 'url("images/Panel_Header_BG.png") left top no-repeat',
				bgContent: '#fdfdff',
				colorHeader :"#fff",
				colorContent  :"#0f0f1e",
				border: 'thin #002040 solid'
			},
			
			footerToolbar:"<button type='button' id='closeModal' class='btn btn-danger pull-right closeViewWIn'>Close</button>",	
			panelSize: {
				width: () => { return Math.min(800, window.innerWidth*0.9);},
				height: () => { return Math.min(750, window.innerHeight*0.8);}
			},
			position:    'center',
			resizeit: {
				disable: true
			},	
			onclosed: function(){
				
			},
			onwindowresize: true,
			headerTitle: 'View Transactions',
			contentFetch:
			{
				resource: 'Controllers/viewTransactionsWindow?pk='+dataID,
				beforeSend: function()
				{
					this.headerlogo.innerHTML = "&nbsp;&nbsp;<i class='fa fa-spinner fa-spin'></i>",	
					this.content.innerHTML ="<br><br><br><div class='row txt-center' style='color:#868695;'><img src='images/loaders/LoaderIcon.gif' width='60' height='50' /><br>Loading..</div>"
				},
				fetchInit:
				{
					method: 'POST'
				},
				done: function (panel, response) 
				{
					this.content.innerHTML = response;
					this.headerlogo.innerHTML = "&nbsp;&nbsp;<i class='fa fa-check'></i>";	
					//Add Dynamic Methods
					$('.page-container').waitMe('hide');
					init_DataTable();					
					//transactionsPane.setHeaderTitle("Collect Cash from: "+dataName);
				
				}
			}
		});
	
	});		
	
	
	
	$(document).on("click", '.cancelPolicyBtn', function(e){
	
		var rid=this.id;
		var splitArr=rid.split("-");
		var dataID=splitArr[1];
		
		bootbox.confirm({
				size: 'small',
				message: "Cancel Policy ? <br> You cannot revive it after Cancellation !",
				buttons: {
					confirm: {
						label: 'Yes',
						className: 'btn-success'
					},
					cancel: {
						label: 'No',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if(result) cancelPolicy(dataID);				
				}
			});		
	
	
	});	
	
	
	
	function cancelPolicy(k)
	{
		$('.page-container').waitMe({ effect : 'ios'	});
		
		
		
		var form_ID = "#policyForm-"+k;
		
		$(".cancelPolicyBtn").attr("disabled", false);
		
		console.log("\n Record PK=>"+k);
		console.log("\n Form ID=>"+form_ID);
		
		
		var form = $(form_ID)[0];
		var main_formData = new FormData(form);
		
		 $.ajax({
				type: "POST",
				url: "Controllers/cancelPolicy",
				data: main_formData,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					
								
					$(".cancelPolicyBtn").attr("disabled", false);				
															
					$('.page-container').waitMe('hide');
					//showAlert("Policy Cancelled");
					showSuccesMsg("Policy Cancelled");	
					location.reload();
					
				},
				error: function (e) {
					
					$('.page-container').waitMe('hide');		
					$(".cashBtn").attr("disabled", false);
					showAlert("Network Error !");
							
						
				}
		});
		
		
		
		
	}
	
	
	
	function init_DataTable()
	{
		$('.datatable').DataTable({
		
			responsive: true,
			columnDefs: [
				{ responsivePriority: 1, targets: 0 },
				{ responsivePriority: 2, targets: 1 },
				{ responsivePriority: 3, targets: 4 },
				{ responsivePriority: 4, targets: 3 },
				{ responsivePriority: 5, targets: 2 }
				
			],
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'pdf', 'print' 
			],
			"createdRow": function( row, data, dataIndex){
							
			}
			
		});
		
		$(".datatable").on('page.dt',function () {
			onresize(100);
		});



	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


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
       timeout: 1500,
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
       timeout: 1500,
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
       timeout: 1500,
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

	
	
 $(document).on("click", '.closeViewWIn', function(e){
	closePanel(transactionsPane);	
 });





function closePanel(k)
{
	k.close();
}
 
	
	
});		



	
	