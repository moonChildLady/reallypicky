    $( document ).ready(function() {
    	var shipment_order_price1 = 0;
    	var shipment_cost = 0;
    	$("#shippingMethod_id, #destination").attr('disabled',true);
    	$("#pickup_location_area").hide();
    	$("#other_country_area").hide();
		$("input[name^=quantity]").bind('keyup', function(){
			recalc();
		});
		recalc();
$("#countryselect").change(function(){
		var access = ['HK','TW','MO'];

		if($.inArray($(this).val(), access) != -1){
			
			$("#destination").val($(this).val());
			if($(this).val()=="HK"){
				$("#shippingMethod_id").attr('disabled',false);
			}else{
				$("#shippingMethod_id").attr('disabled',true);
			}
		}else{
			$("#destination").val('OO');
			$("#shippingMethod_id").attr('disabled',true);
		}
		$("#shippingMethod_id").val(0);
		$("#pickup_location_area").hide();
});
$("#shippingMethod_id").change(function(){
	if($(this).val()=='SELF PICKUP'){
		$("#pickup_location_area").show();
$("#shipcost").text(0.00);
		$("#shipment_cost_").val(0);
	}else{
		$("#pickup_location_area").hide();

				$("#shipcost").text(33.0);
		$("#shipment_cost_").val(33.0);
	}
});

$("#countryselect").change(function(){
	if($(this).val()=="OO"){
	$("#other_country_area").show();
}else{
	$("#other_country_area").hide();
}
});




		function recalc(){
		$("input[name^=total_]").calc(
	// the equation to use for the calculation
	"qty * price",
	// define the variables used in the equation, these can be a jQuery object
	{
		qty: $("input[id^=qty_]"),
		price: $("[id^=dprice_]")
	},
	// define the formatting callback, the results of the calculation are passed to this function
	function (s){
		// return the number as a dollar amount
		return s.toFixed(2);
	},
	// define the finish callback, this runs after the calculation has been complete
	function ($this){
		// sum the total of the $("[id^=total_item]") selector
		var sum = $this.sum();

		$("#totalPrice").text(
			// round the results to 2 digits
			 sum.toFixed(2)
		);
		$("#total_order_price").val(sum.toFixed(2));
		console.log(shipment_order_price1);
		if($("#total_order_price").val() <= shipment_order_price1){
			//$("#shipcost").text(shipment_cost);
		}
	}
);
		}
//qtyminus
//qtyplus
$(".qtyminus").click(function(){
	
	var elm = $(this).parent().children('.qty');
	
	var val = elm.val();
val = Number(val) == NaN ? 0 : Number(val);
if(Number(elm.val())>0){
elm.val(val - 1);
}
$("input[name^=quantity]").keyup();
});

$(".qtyplus").click(function(){
	var elm = $(this).parent().children('.qty');
	var val = elm.val();
val = Number(val) == NaN ? 0 : Number(val);
elm.val(val + 1);
$("input[name^=quantity]").keyup();
});

	/*$("#customer_54").change(function(){
		alert(1);
	});*/
    });


function changeshipinfo(a,b){
	//( 多購買<span class="sprice">HK$122.00</span>可免運費 )
	console.log(b);
	if(a=="free"){
		$("#shipinfo").html("( 免運費 )");
	}else{
		$("#shipinfo").html("( 多購買<span class='sprice''>HK$"+b+"</span>可免運費 )");
	}
}