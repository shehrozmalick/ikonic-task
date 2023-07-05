var skeletonId = 'skeleton';
var contentId = 'content';
var skipCounter = 0;
var takeAmount = 10;


function getRequests(mode='pending',limit=10) {
  var functionsOnSuccess = [
    [getSuccessFunction, ['response']]
  ];

  ajax('/get/sent-requests?limit'+limit, 'GET', functionsOnSuccess);
  
}


function getSendRequests(mode='pending') {
  var functionsOnSuccess = [
    [getSuccessFunction, ['response']]
  ];

  ajax('/received-requests', 'GET', functionsOnSuccess);
  
}


function getMoreRequests(mode) {
   takeAmount +=10;
   getSuggestions(takeAmount);
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnections() {
  var functionsOnSuccess = [
    [getSuccessFunction, ['response']]
  ];

   ajax('/connections', 'GET', functionsOnSuccess);
  //  alert()
}

function getMoreConnections() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnectionsInCommon(userId, connectionId='') {

  // ajax('/connections-in-common/'+userId, 'GET', commonfunctionsOnSuccess);
  
   
  $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/connections-in-common/'+userId,
      type: 'GET',
      success: function(response) {

        console.log(userId);
        $('#content_'+userId).html(response);
      },
      error: function(xhr, textStatus, error) {
        console.log(xhr.responseText);
        console.log(xhr.statusText);
        console.log(textStatus);
        console.log(error);
      }

    });

}



function getMoreConnectionsInCommon(userId, connectionId) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getSuggestions(limit=10) {
  var functionsOnSuccess = [
    [getSuccessFunction, ['response']]
  ];

   ajax('/get/content?limit='+limit, 'GET', functionsOnSuccess);
  //  alert()
}



function getSuccessFunction(response) {

  // console.table(response);
  $('#content').html(response);
}


function getMoreSuggestions() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function sendRequest(userId='', suggestionId='') {
  var functionsOnSuccess = [
    [sendSuccessFunction, ['response']]
  ];

  ajax('/sent-requests/'+userId, 'GET', sendSuccessFunction);
  $('.user-'+userId).remove();
}



function deleteRequest(userId, requestId) {
    var functionsOnSuccess = [
      [sendSuccessFunction, ['response']]
    ];

    ajax('/withdraw-request/'+userId, 'GET', sendSuccessFunction);
    $('.user-'+userId).remove();

}

function acceptRequest(userId, requestId) {
  // your code here...
  var functionsOnSuccess = [
    [sendSuccessFunction, ['response']]
  ];

  ajax('/accept-request/'+userId, 'GET', sendSuccessFunction);
  $('.user-'+userId).remove();
 
}

function removeConnection(userId, connectionId='') {

    // your code here...
    var functionsOnSuccess = [
      [sendSuccessFunction, ['response']]
    ];
  
    ajax('/remove-connection/'+userId, 'GET', sendSuccessFunction);
    $('.user-'+userId).remove();
   
  
}


function sendSuccessFunction(response){
  //  console.log(response);
 
}


$(function () {
  getSuggestions();
});


// main.js

// // Function to handle AJAX request and update the content
// function getContent(url, data, successCallback, errorCallback) {
//   $.ajax({
//     headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
//     url: url,
//     type: 'POST',
//     data: data,
//     success: successCallback,
//     error: errorCallback
//   });
// }

// // Function to handle the click event on "Withdraw Request" button
// function withdrawRequest(requestId) {
//   const url = `/withdraw-request/${requestId}`;

//   getContent(url, null, function(response) {
//     console.log(response.message);
//     // Refresh the sent requests list or perform any other necessary action
//   }, function(xhr, textStatus, error) {
//     console.log(xhr.responseText);
//     console.log(xhr.statusText);
//     console.log(textStatus);
//     console.log(error);
//   });
// }

// // Function to handle the click event on "Accept Request" button
// function acceptRequest(requestId) {
//   const url = `/accept-request/${requestId}`;

//   getContent(url, null, function(response) {
//     console.log(response.message);
//     // Refresh the received requests list or perform any other necessary action
//   }, function(xhr, textStatus, error) {
//     console.log(xhr.responseText);
//     console.log(xhr.statusText);
//     console.log(textStatus);
//     console.log(error);
//   });
// }

// // Function to handle the click event on "Remove Connection" button
// function removeConnection(connectionId) {
//   const url = `/remove-connection/${connectionId}`;

//   getContent(url, null, function(response) {
//     console.log(response.message);
//     // Refresh the connections list or perform any other necessary action
//   }, function(xhr, textStatus, error) {
//     console.log(xhr.responseText);
//     console.log(xhr.statusText);
//     console.log(textStatus);
//     console.log(error);
//   });
// }

// // Function to handle the click event on "Connections in Common" button
// function getConnectionsInCommon(userId) {
//   const url = `/connections-in-common/${userId}`;

//   getContent(url, null, function(response) {
//     console.log(response);
//     // Update the UI to display the connections in common or perform any other necessary action
//   }, function(xhr, textStatus, error) {
//     console.log(xhr.responseText);
//     console.log(xhr.statusText);
//     console.log(textStatus);
//     console.log(error);
//   });
// }

// // Event listener for "Withdraw Request" button click
// $(document).on('click', '.withdraw-request-btn', function() {
//   const requestId = $(this).data('request-id');
//   withdrawRequest(requestId);
// });

// // Event listener for "Accept Request" button click
// $(document).on('click', '.accept-request-btn', function() {
//   const requestId = $(this).data('request-id');
//   acceptRequest(requestId);
// });

// // Event listener for "Remove Connection" button click
// $(document).on('click', '.remove-connection-btn', function() {
//   const connectionId = $(this).data('connection-id');
//   removeConnection(connectionId);
// });

// // Event listener for "Connections in Common" button click
// $(document).on('click', '.connections-in-common-btn', function() {
//   const userId = $(this).data('user-id');
//   getConnectionsInCommon(userId);
// });
