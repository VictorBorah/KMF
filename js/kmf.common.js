$(document).ready(function(){




	$(document).on("click", '.logoutBtn', function(e){
	
		var rid=this.id;
		var splitArr=rid.split("-");
		var dataID=splitArr[1];
		
		bootbox.confirm({
				size: 'small',
				message: "Logout ?",
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
					if(result) location.href="Controllers/logout" ;				
				}
			});		
	
	
	});	
	
	
	
});		