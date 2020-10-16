
var userArray = new Array(0)
var verifiedIDs = [];
function TimeDivider(start_or_end, timeInt) {
    this.type = start_or_end;
    this.time = timeInt;
}
function AvailableTime(myDay, startTime, endTime) {
	this.day = myDay;
	this.start = startTime;
	this.end = endTime;
}

$('#form-add-attend-btn').on("click", function () {
	$('#inviteModal').css("display", "block");
});

$('#datepicker').on("click", function () {
	$('#availablilities-list').empty();
});

$('#startTime').on("click", function () {
	$('#availablilities-list').empty();
});

$('#endTime').on("click", function () {
	$('#availablilities-list').empty();
});

// use add button instead?
$('.btn.addUser').on('click', function (event) {
	var inviteEmail = $('#form-invitedUser').val();
	var mailformat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	if (inviteEmail !== "" && inviteEmail.match(mailformat))
	{
		searchUsersList(inviteEmail).then(function() {

			//create a list element of for each user to invite
			var newLi = document.createElement('li');

			newLi.setAttribute('id', 'invitedUser');

			document.getElementById('userList').appendChild(newLi);

			var newEmailSpan = document.createElement('span');

			newEmailSpan.setAttribute('class', 'userSpan');

			document.getElementById('invitedUser').appendChild(newEmailSpan);

			var newCloseSpan = document.createElement('span');

			newCloseSpan.setAttribute('class', 'closeSpan')

			document.getElementById('invitedUser').appendChild(newCloseSpan);

			newEmailSpan.innerHTML = inviteEmail;

			newCloseSpan.innerHTML = "&times;";

			newLi.removeAttribute('id');

			document.getElementById('form-invitedUser').value = "";

			userArray.push(inviteEmail);

			$('.closeSpan').on("click", function (event) {
				userArray.splice(userArray.indexOf(event), 1);
				verifiedIDs.splice(verifiedIDs.indexOf(event), 1);

				$(this).parent().remove();
			});

			document.getElementById("emails").value = verifiedIDs.join(',');
		});
	}
});

// When the user clicks anywhere outside of the modal, it should be closed
window.onclick = function (event) {
	if (event.target == document.getElementById('inviteModal')) {
		$('#inviteModal').css("display", "none");
	}
}

function rand() {
    return Math.random().toString(36).slice(2, 10); // remove `0.`
};

function generateToken() {

	//return token of length 16
	return rand() + rand();

};

function searchUsersList(inviteEmail) {
	return new Promise(function(resolve, reject) {
		const find = verifiedIDs.find(element => element === inviteEmail);
		if (!find) {
			verifiedIDs.push(inviteEmail);
			return resolve();
		}
		return null;
	});
};

function checkOverlapEvents(eventStart, eventEnd, eventDate, userID) {
	return new Promise(function(resolve, reject) {
		firebase.database().ref('users/' + userID).once("value").then(function(snapshot) {
			var userEvents = snapshot.val().events.slice();
			userEvents.forEach(function(data, index, array) {
				if(data == "0"){
					return resolve();
				}
				firebase.database().ref('events/' + data).once("value").then(function(res) {
					//check to see if user's events overlap with the newly inputted start times and end times
					var newStartTime = eventStart;
					var eventStartTime = res.val().eventStartTime;
					var newEndTime = eventEnd;
					var eventEndTime = res.val().eventEndTime;
					if(eventDate === res.val().eventDate) {
						if(newStartTime >= eventStartTime && newStartTime < eventEndTime ||
							eventStartTime >= newStartTime && eventStartTime < newEndTime) {
							//overlap found
							return reject();
						}
					}
					else if(index === array.length - 1) //at last index of array (no overlaps found)
					{
						return resolve();
					}
				});
			});
		});
	});
};

function insertTime(allEvents, start_or_end, time) {
	let timeInt = time.substring(0,2)+time.substring(3);
	let t = new TimeDivider(start_or_end, parseInt(timeInt));

	console.log(start_or_end+": "+time);
	if (start_or_end == "end") console.log('\n');

	let allEventsLength = allEvents.length;
	for (let i = 0; i < allEventsLength; ++i) {
		if (t.time < allEvents[i].time) {
			allEvents.splice(i, 0, t);
			return Promise.resolve();
		}
	}
	allEvents.push(t);
	return Promise.resolve();
};

function insertTime(allEvents, start_or_end, time) {
	let timeInt = time.substring(0,2)+time.substring(3);
	let t = new TimeDivider(start_or_end, parseInt(timeInt));

	let allEventsLength = allEvents.length;
	for (let i = 0; i < allEventsLength; ++i) {
		if (t.time < allEvents[i].time) {
			allEvents.splice(i, 0, t);
			return Promise.resolve();
		}
	}
	allEvents.push(t);
	return Promise.resolve();
};

async function displayAvailabilities(availabilities) {

	let availabilitiesList = document.getElementById('availablilities-list');
	$(availabilitiesList).empty();
	let availLength = availabilities.length;
	for (let i = 0; i < availLength; ++i) {

		let newButton = document.createElement("button");
		newButton.setAttribute("class", "btn-availability");
		newButton.onclick = availabilityButton;
		availabilitiesList.appendChild(newButton);

		let newRow = document.createElement("div");
		newRow.setAttribute("class", "row");
		newButton.appendChild(newRow);

		let newCol1 = document.createElement("div");
		newCol1.setAttribute("class", "col-md-6");
		newCol1.innerHTML = availabilities[i].day;

		newRow.appendChild(newCol1);

		let newCol2 = document.createElement("div");
		newCol2.setAttribute("class", "col-md-6");
		let startTime = await militaryTo12Hour(availabilities[i].start);
		let endTime = availabilities[i].end;
		endTime = await militaryTo12Hour(endTime);
		newCol2.innerHTML = startTime + "<br>" + endTime;
		newRow.appendChild(newCol2);

		// Add custom data attributes
		$(newButton).attr("date", availabilities[i].day);
		$(newButton).attr("startTime", availabilities[i].start);
		$(newButton).attr("endTime", availabilities[i].end);
	}
};

function militaryToMinutes(military) {
	let resultMins = Math.floor(military/100) * 60 + (military%100);
	return Promise.resolve(resultMins);
};

function minutesToMilitary(minutes) {
	let hours = Math.floor(minutes / 60);
	minutes -= hours * 60;
	let military = hours * 100 + minutes;
	return Promise.resolve(military);
};

function militaryTo12Hour(intTime) {
	if (intTime == 0) {
		return Promise.resolve("12:00 AM");
	}
	else if (intTime == 2400) {
		return Promise.resolve("11:59 PM");
	}
	let hour = Math.floor(intTime/100);
	let timePeriod = (hour < 12) ? "AM" : "PM";
	hour = (hour == 0 || hour == 12) ? "12" : (hour % 12).toString();
	let minute = intTime % 100;
	if (minute < 10) minute = '0'+minute.toString();
	return Promise.resolve(hour + ':' + minute + ' ' + timePeriod);
};

function militaryToString(intTime) {
	if (intTime == 0) {
		return Promise.resolve("00:00");
	}
	else if (intTime == 2400) {
		return Promise.resolve("23:59");
	}
	let hour = Math.floor(intTime/100).toString();
	if (hour.length == 1) hour = '0' + hour;
	let minute = intTime % 100;
	if (minute < 10) {
		minute = "0"+minute.toString();
	}
	return Promise.resolve(hour + ':' + minute);
};

async function availabilityButton() {
	document.getElementById("datepicker").value = this.getAttribute("date");

	let startTime = this.getAttribute("startTime");
	startTime = await militaryToString(startTime);
	document.getElementById("startTime").value = startTime;

	let endTime = this.getAttribute("endTime");
	endTime = await militaryToString(endTime);
	document.getElementById("endTime").value = endTime
};
