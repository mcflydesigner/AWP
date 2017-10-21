$(document).ready(function(){
	$.ajax({
		url : "http://adscity.ru/gets/followersdata.php",
		type : "GET",
		success: function(data) {
				console.log(data);

				//data = JSON.parse(data);

				var time = [];
				var temperature_1 = [];
				var humid_1 = [];
				var temperature_2 = [];
				var humid_2 = [];
				var temperature_3 = [];
				var humid_3 = [];
				var temperature_4 = [];
				var humid_4 = [];

				for(var i in data) {
					time.push(data[i].time);
					temperature_1.push(data[i].temp1);
					temperature_2.push(data[i].temp2);
					temperature_3.push(data[i].temp3);
					temperature_4.push(data[i].temp4);
					humid_1.push(data[i].hum1);
					humid_2.push(data[i].hum2);
					humid_3.push(data[i].hum3);
					humid_4.push(data[i].hum4);
				}

				var chartdata = {
					labels: time,
					datasets: [
						{
							label: "humid_1",
							fill: false,
							lineTension: 0.1,
							backgroundColor: "rgba(37, 220, 106, 1)",
							borderColor: "rgba(37, 220, 106, 1)",
							pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
							pointHoverBorderColor: "rgba(29, 202, 255, 1)",
							data: humid_1
						}
					]
				};

				var ctx = $("#hum1");

				var LineGrap = new Chart(ctx, {
					type: 'line',
					data: chartdata
				});
				chartdata = {
					labels: time,
					datasets: [
						{
							label: "temperature_1",
							fill: false,
							lineTension: 0.1,
							backgroundColor: "rgba(232, 92, 92, 1)",
							borderColor: "rgba(232, 92, 92, 1)",
							pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
							pointHoverBorderColor: "rgba(59, 89, 152, 1)",
							data: temperature_1
						}
					]
				};

				ctx = $("#temp1");
				LineGrap = new Chart(ctx, {
					type: 'line',
					data: chartdata
				});



				chartdata = {
					labels: time,
					datasets: [
						{
							label: "humid_2",
							fill: false,
							lineTension: 0.1,
							backgroundColor: "rgba(37, 220, 106, 1)",
							borderColor: "rgba(37, 220, 106, 1)",
							pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
							pointHoverBorderColor: "rgba(59, 89, 152, 1)",
							data: humid_2
						}
					]
				};
				ctx = $("#hum2");
				LineGrap = new Chart(ctx, {
					type: 'line',
					data: chartdata
				});
				chartdata = {
					labels: time,
					datasets: [
						{
							label: "temperature_2",
							fill: false,
							lineTension: 0.1,
							backgroundColor: "rgba(232, 92, 92, 1)",
							borderColor: "rgba(232, 92, 92, 1)",
							pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
							pointHoverBorderColor: "rgba(59, 89, 152, 1)",
							data: temperature_2
						}
					]
				};

				ctx = $("#temp2");
				LineGrap = new Chart(ctx, {
					type: 'line',
					data: chartdata
				});


				chartdata = {
					labels: time,
					datasets: [
						{
							label: "humid_3",
							fill: false,
							lineTension: 0.1,
							backgroundColor: "rgba(37, 220, 106, 1)",
							borderColor: "rgba(37, 220, 106, 1)",
							pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
							pointHoverBorderColor: "rgba(59, 89, 152, 1)",
							data: humid_3
						}
					]
				};
				ctx = $("#hum3");
				LineGrap = new Chart(ctx, {
					type: 'line',
					data: chartdata
				});
				chartdata = {
					labels: time,
					datasets: [
						{
							label: "temperature_3",
							fill: false,
							lineTension: 0.1,
							backgroundColor: "rgba(232, 92, 92, 1)",
							borderColor: "rgba(232, 92, 92, 1)",
							pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
							pointHoverBorderColor: "rgba(59, 89, 152, 1)",
							data: temperature_3
						}
					]
				};

				ctx = $("#temp3");
				LineGrap = new Chart(ctx, {
					type: 'line',
					data: chartdata
				});



				chartdata = {
					labels: time,
					datasets: [
						{
							label: "humid_4",
							fill: false,
							lineTension: 0.1,
							backgroundColor: "rgba(37, 220, 106, 1)",
							borderColor: "rgba(37, 220, 106, 1)",
							pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
							pointHoverBorderColor: "rgba(59, 89, 152, 1)",
							data: humid_4
						}
					]
				};
				ctx = $("#hum4");
				LineGrap = new Chart(ctx, {
					type: 'line',
					data: chartdata
				});
				chartdata = {
					labels: time,
					datasets: [
						{
							label: "temperature_4",
							fill: false,
							lineTension: 0.1,
							backgroundColor: "rgba(232, 92, 92, 1)",
							borderColor: "rgba(232, 92, 92, 1)",
							pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
							pointHoverBorderColor: "rgba(59, 89, 152, 1)",
							data: temperature_4
						}
					]
				};

				ctx = $("#temp4");
				LineGrap = new Chart(ctx, {
					type: 'line',
					data: chartdata
				});
		},
		error : function(data) {

		}
		});
});